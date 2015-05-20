<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_reportes extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('areas_model');
        //$this->load->model('trabajador_model');
        //$this->load->model('ventas_model');
        $this->load->model('reportes_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }

    }

    public function index()
    {
            //$data['trabajadores'] = $this->reportes_model->get_trabaj(null,null,'apellidos','Asc',1,9999999);
    $data['main_content'] = 'admin/reportes/list';
    $this->load->view('includes/template', $data); 
    }
        
    public function procesar()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('fecha_inicio', 'Fecha Inicio', 'required');
            $this->form_validation->set_rules('fecha_fin', 'Fecha Fin', 'required');
                        
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
        
                $this->phpexcel->getProperties()
                    ->setTitle("Excel")
                    ->setDescription("Descripción");

                $areas=$this->reportes_model->getAreas();
                $fechaInicio = strtotime($this->input->post('fecha_inicio'));
                $fechaFin = strtotime($this->input->post('fecha_fin'));
                
                $pestanha = array('Obreros', 'Administrativos');

                //foreach ($areas as $area) {
                for($indexArea=0; $indexArea<2; $indexArea++){    
                    for ($indexReporte=1; $indexReporte<=2; $indexReporte++)
                    {
                        $positionInExcel = 0;
                        $this->phpexcel->createSheet($positionInExcel); //Loque mencionaste
                        $this->phpexcel->setActiveSheetIndex(0); //Seleccionar la pestaña deseada
                        $this->phpexcel->getActiveSheet()->setTitle($pestanha[$indexArea].$indexReporte); //Establecer nombre 
                        $sheet=$this->phpexcel->getActiveSheet();
                        //
                        //$trabajadores=$this->trabajador_model->getTrabajadoresByArea($area['id']);
                        
                        $sheet->setCellValueByColumnAndRow(0, 1, "CODIGO");
                        $sheet->setCellValueByColumnAndRow(1, 1, "NOMBRES");
                        $sheet->setCellValueByColumnAndRow(2, 1, "APELLIDOS");

                        $numeroDia = 3;
                        for ($fechaIndex = $fechaInicio; $fechaIndex<=$fechaFin; $fechaIndex+=86400){
                            $sheet->setCellValueByColumnAndRow($numeroDia, 1,date("d-m-Y", $fechaIndex));
                            $numeroDia++;
                        }
                        $sheet->setCellValueByColumnAndRow($numeroDia, 1, "TOTAL");

                        $numeroTrabajador = 2;
                        for($indexGR=1; $indexGR<=$indexArea+1; $indexGR++){
                            $area = $this->areas_model->getAreaById($indexArea+$indexGR);                        
                            $trabajadores=$this->reportes_model->getTrabajadoresByArea($area['id']);            
                            
                            foreach ($trabajadores as $trabajador){                
                                $sheet->setCellValueByColumnAndRow(0, $numeroTrabajador, $trabajador['codigo']);
                                $sheet->setCellValueByColumnAndRow(1, $numeroTrabajador, $trabajador['nombres']);
                                $sheet->setCellValueByColumnAndRow(2, $numeroTrabajador, $trabajador['apellidos']);
                                $numeroDia = 3;
                                $tmpTotal = 0;

                                $listaMontos = array();

                                for ($fechaIndex = $fechaInicio; $fechaIndex<=$fechaFin; $fechaIndex+=86400){
                                    $ventaDiaria = $this->reportes_model->getVentaDiaria($trabajador['id'], date("Y-m-d", $fechaIndex));

                                    $monto_diario = 0;                                                
                                    $monto_diario_almuerzo = 0;

                                    if (count($ventaDiaria)>0)
                                    {
                                        $monto_diario = $ventaDiaria[0]['total'];
                                        //if ($ventaDiaria[0]['total_almuerzo']>0)
                                        //    $monto_diario_almuerzo = $area['bono']; 

                                        if ($indexReporte == 1){
                                            $monto_diario=$area['bono'];
                                        //    $monto_diario_almuerzo = 0;
                                        }
                                    }
                                    $subTotal = $monto_diario - $monto_diario_almuerzo;
                                    $tmpTotal+=($subTotal);
                                    $sheet->setCellValueByColumnAndRow($numeroDia, $numeroTrabajador, $subTotal);
                                    $numeroDia++;
                                }
                                $sheet->setCellValueByColumnAndRow($numeroDia, $numeroTrabajador, $tmpTotal);
                                if ($tmpTotal > 0)
                                    $numeroTrabajador++;
                                else
                                    $sheet->removeRow($numeroTrabajador);                            
                            }
                        }
                    }
                }
                
                //salida
                header("Content-Type: application/vnd.ms-excel");
                $nombre="Reporte de Usuarios_".date("Y-m-d H:i:s");
                header("Content-Disposition: attachment; filename=\"$nombre.xls\"");
                header("Cache-Control: max-age=0");

                $writer=PHPExcel_IOFactory::createWriter($this->phpexcel,"Excel5");
                $writer->save("php://output");		
                exit;
                
            }
        }
        
        $data['main_content'] = 'admin/index';
        $this->load->view('includes/template', $data);  
    }
}

/* End of file admin_reportes.php */
/* Location: ./application/controllers/admin_reportes.php */