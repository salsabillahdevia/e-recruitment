<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Lowongan_model');
	}
	public function index()
	{
		$data['title'] = "Dashboard";
		$data['css'] = "";
		$data['js'] = "";

		$data['lowongan'] = $this->Lowongan_model->getLowongan();
		$this->load->view('template/header', $data);
		$this->load->view('index');
		$this->load->view('template/footer');
	}
}
