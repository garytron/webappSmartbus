<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model("MapsModel");
        $this->load->helper('url');
    }
	public function index()
	{
        //$this->MapsModel->findAll();
        $this->load->view('shared/header');
        $this->load->view('shared/nav');
		$this->load->view('inicio');
        $this->load->view('shared/footer');
	}

    public function coordenadas()
    {
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');
        $fecha = date("Y-m-d H:m:s");

        $data = array(
            'time' => $fecha,
            'lat' => $lat,
            'long' => $long
        );
        //echo "<script>alert(".$lat.");</script>";
        //echo "<script>console.log(".$lat.");</script>";
        //echo $lat;

        $success = $this->MapsModel->insertarCoordenadas($data);

        echo $success;

    }

    public function getRutas()
    {
        $nombre = $this->input->post('ruta');

        $data = $this->MapsModel->getRutas($nombre);

        echo($data);

    }
}
