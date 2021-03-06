<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends CI_Controller {
	function __construct() {
		parent::__construct();

	}
   	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

   	//index() pide usuario y contraseña para poder entrar al sistema
	public function inicio()
	{	
		$hoy = date('Y-m-d');
		$manana = date('Y-m-d', strtotime($hoy . ' + 1 day'));		
		$datos['bread'] = 21;
		$datos['manana'] = $this->Consulta_model->manana($manana);
		$datos['agenda'] = $this->Consulta_model->agenda($hoy);
		$this->load->view('estructura/head', $datos);
		$this->load->view('consulta/inicio', $datos);
		$this->load->view('estructura/foot');
	}

	public function buscar(){
		$datos['bread']	= 21;
		$buscar = $this->input->post('buscar');
		$datos['consulta'] = $this->Inicio_model->buscar($buscar);
		$this->load->view('estructura/head', $datos);
		$this->load->view('usuarios/buscar', $datos);
		$this->load->view('estructura/foot');
	}

	public function captura()
	{
		$hoy = date('Y-m-d');
		if($_POST){
			$evento = $this->input->post('Evento');
			$lugar	= $this->input->post('Lugar');
			$fecha	= $this->input->post('Fecha');
			$hora	= $this->input->post('Hora');
			$this->Inicio_model->agregar_agenda($evento, $lugar,$fecha, $hora);
		}
		$manana = date('Y-m-d', strtotime($hoy . ' + 1 day'));		
		$datos['bread'] = 22;
		$datos['agenda'] = $this->Consulta_model->agenda($hoy);
		$datos['manana'] = $this->Consulta_model->manana($manana);
		$this->load->view('estructura/head', $datos);
		$this->load->view('consulta/inicio', $datos);
		$this->load->view('estructura/foot');
	}
}
