<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_reportes extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('trabajador_model');
        //$this->load->model('productos_model');
        //$this->load->model('ventas_model'); 
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
		}
	
	}

	public function index()
	{
		$data['trabajadores'] = $this->trabajador_model->get_trabaj(null,null,'apellidos','Asc',1,9999999);
        $data['main_content'] = 'admin/reportes/list';
        $this->load->view('includes/template', $data); 
	}

	public function excel()
	{
		$this->load->library("PHPExcel");
		$datos=$this->trabajador_model->get_trabaj();
		//cargar las propiedades de nuestro excel
		$this->phpexcel->getProperties()
					   ->setTitle("Excel")
					   ->setDescription("Descripción");
		$sheet=$this->phpexcel->getActiveSheet();
		$sheet->setTitle("Reporte de trabajadores");
		$sheet->getColumnDimension('A')->setWidth(20);
		//creamos el encabezado de cada columna
		$sheet->setCellValue("A1",'Codigo');
		$sheet->setCellValue("B1",'Nombres');
		$sheet->setCellValue("C1",'Apellidos');
		$sheet->setCellValue("D1",'Area');
		$i=1;
		foreach ($datos as $dato) 
		{
			$i++;
			$sheet->setCellValue("A".$i,$dato->codigo);
			//$sheet->setCellValue("A".$i,utf8_decode($dato->nombre));
			$sheet->setCellValue("B".$i,$dato->nombres);
		    $sheet->setCellValue("C".$i,$dato->apellidos);
		    $sheet->setCellValue("D".$i,$dato->dni);
		    $sheet->setCellValue("E".$i,$dato->areas_id);

		}
		//salida
		header("Content-Type: application/vnd.ms-excel");
		$nombre="Reporte de Trabajadores_".date("Y-m-d H:i:s");
		header("Content-Disposition: attachment; filename='".$nombre.".xlsx'");
		header("Cache-Control: max-age=0");

		//$writer=PHPExcel_IOFactory::createWriter($this->phpexcel,"Excel2007");
		$writer=IOFactory::createWriter($this->phpexcel, 'Excel2007');
		$writer->save("php://output");		
		exit;

	}
}

/* End of file admin_reportes.php */
/* Location: ./application/controllers/admin_reportes.php */