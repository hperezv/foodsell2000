<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_reportes extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('areas_model');
        $this->load->model('trabajador_model');
        $this->load->model('ventas_model');
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
        $this->phpexcel->getProperties()
                                   ->setTitle("Excel")
                                   ->setDescription("Descripción");
        $sheet=$this->phpexcel->getActiveSheet();
        $sheet->setTitle("Reporte de Usuarios");
        
        $areas=$this->areas_model->getAreas();
        $fechaInicio = strtotime('2015-04-30');
        $fechaFin = strtotime('2015-05-02');
        foreach ($areas as $area) {
            $trabajadores=$this->trabajador_model->getTrabajadoresByArea($area['id']);
            $numeroTrabajador = 1;
            echo "area";
            foreach ($trabajadores as $trabajador){
                $numeroDia = 1;
                for ($fechaIndex = $fechaInicio; $fechaIndex<=$fechaFin; $fechaIndex+=86400){
                    $ventaDiaria = $this->ventas_model->getVentaDiaria($trabajador['id'], date("Y-m-d", $fechaIndex));
                    $monto_diario=0;
                    $monto_diario_almuerzo=0;
                    if (count($ventaDiaria)>0)
                    {
                        $monto_diario = $ventaDiaria[0]['total'];
                        $monto_diario_almuerzo = $ventaDiaria[0]['total_almuerzo'];
                    }
                    $sheet->setCellValueByColumnAndRow($numeroDia, $numeroTrabajador, "a");
                    $numeroDia++;
                }
                $numeroTrabajador++;
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
        
        
        
        /*
        $datos=$this->reportes_model->getTrabareportesByArea();
        //cargar las propiedades de nuestro excel
        $this->phpexcel->getProperties()
                                   ->setTitle("Excel")
                                   ->setDescription("Descripción");
        $sheet=$this->phpexcel->getActiveSheet();
        $sheet->setTitle("Reporte de Usuarios");
        $sheet->getColumnDimension('A')->setWidth(20);
        //creamos el encabezado de cada columna
        $sheet->setCellValue("A1",'id');
        $sheet->setCellValue("B1",'codigo');
        $sheet->setCellValue("C1",'nombres');
        $sheet->setCellValue("D1",'apellidos');
        $sheet->setCellValue("E1",'dni');
        $sheet->setCellValue("F1",'areas_id');

        $i=1;
        foreach ($datos as $dato) 
        {
                $i++;
                $sheet->setCellValue("A".$i,$dato->id);
                //$sheet->setCellValue("A".$i,utf8_decode($dato->nombre));
                $sheet->setCellValue("B".$i,$dato->codigo);
            $sheet->setCellValue("C".$i,$dato->nombres);
            $sheet->setCellValue("D".$i,$dato->apellidos);
            $sheet->setCellValue("E".$i,$dato->dni);
            $sheet->setCellValue("F".$i,$dato->areas_id);
        }
        //salida
        header("Content-Type: application/vnd.ms-excel");
        $nombre="Reporte de Usuarios_".date("Y-m-d H:i:s");
        header("Content-Disposition: attachment; filename=\"$nombre.xls\"");
        header("Cache-Control: max-age=0");

        $writer=PHPExcel_IOFactory::createWriter($this->phpexcel,"Excel5");
        $writer->save("php://output");		
        exit;
         * 
         */
    }

	public function excel()
	{
		//$this->load->library("PHPExcel");
		$datos=$this->reportes_model->getTrabareportes();
		//cargar las propiedades de nuestro excel
		$this->phpexcel->getProperties()
					   ->setTitle("Excel")
					   ->setDescription("Descripción");
		$sheet=$this->phpexcel->getActiveSheet();
		$sheet->setTitle("Reporte de Usuarios");
		$sheet->getColumnDimension('A')->setWidth(20);
		//creamos el encabezado de cada columna
		$sheet->setCellValue("A1",'id');
		$sheet->setCellValue("B1",'codigo');
		$sheet->setCellValue("C1",'nombres');
		$sheet->setCellValue("D1",'apellidos');
                $sheet->setCellValue("E1",'dni');
                $sheet->setCellValue("F1",'areas_id');

		$i=1;
		foreach ($datos as $dato) 
		{
			$i++;
			$sheet->setCellValue("A".$i,$dato->id);
			//$sheet->setCellValue("A".$i,utf8_decode($dato->nombre));
			$sheet->setCellValue("B".$i,$dato->codigo);
		    $sheet->setCellValue("C".$i,$dato->nombres);
		    $sheet->setCellValue("D".$i,$dato->apellidos);
                    $sheet->setCellValue("E".$i,$dato->dni);
                    $sheet->setCellValue("F".$i,$dato->areas_id);
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

/* End of file admin_reportes.php */
/* Location: ./application/controllers/admin_reportes.php */