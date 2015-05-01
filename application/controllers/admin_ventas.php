<?php
class Admin_ventas extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('trabajador_model');
        $this->load->model('productos_model');
        //$this->load->model('ventas_model');        

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {   
        $cadenaBusqueda = $this->input->post('search_string'); 
        //pagination settings
        $config['per_page'] = 10;
        $config['base_url'] = base_url().'admin/ventas';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        
        //limit end
        $page = $this->uri->segment(3);
        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }
        
        //$data['ventas'] = $this->ventas_model->get_ventas('', $cadenaBusqueda, '','', $config['per_page'],$limit_end);
        $data['search_string'] = $cadenaBusqueda;
        //initializate the panination helper 
        //$this->pagination->initialize($config);   

        //load the view        
        $data['trabajadores'] = $this->trabajador_model->get_trabaj(null,null,'apellidos','Asc',1,9999999);
        $data['productos'] = $this->productos_model->get_productos(null,null,'nombre','Asc',1,9999999);        
        $data['main_content'] = 'admin/ventas/list';
        $this->load->view('includes/template', $data);  

    }//index
    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('trabajadores_id', 'Trabajador', 'required');
            $this->form_validation->set_rules('productos_id', 'Producto', 'required');
            $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'nombre'   => $this->input->post('nombre'),
                    'precio'   => $this->input->post('precio'),
                    'cantidad' => $this->input->post('cantidad'),
                    'acuenta'  => $this->input->post('acuenta')  
                );
                //if the insert has returned true then we show the flash message
                if($this->productos_model->new_ventas($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
        }
        
        //load the view
        $data['main_content'] = 'admin/ventas/add';
        $this->load->view('includes/template', $data);  
    }
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->productos_model->delete_productos($id);
        redirect('admin/productos');
    }//delete
    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation            
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('precio', 'precio', 'required');
            $this->form_validation->set_rules('cantidad', 'cantidad', 'required');            
           
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'nombre' => $this->input->post('nombre'),
                    'precio' => $this->input->post('precio'),
                    'cantidad' => $this->input->post('cantidad')
                );
                //if the insert has returned true then we show the flash message
                if($this->productos_model->update_productos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/productos/update/'.$id.'');
            }//validation run

        }
        $data['producto'] = $this->productos_model->get_producto_by_id($id);
        $data['main_content'] = 'admin/productos/edit';
        $this->load->view('includes/template', $data);            

    }//update
}