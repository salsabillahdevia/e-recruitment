<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}


	//ini halaman login
	public function index()
	{
		if ($this->session->userdata('kode_petugas')) {
			redirect('dashboard');
		}

		$this->form_validation->set_rules('kode_petugas', 'Kode Petugas', 'trim|required');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['title'] = "Login";

			$this->load->view('template/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('template/auth_footer');
		} else {
			$this->_login();
		}
	}



	private function _login()
	{
		$kode = $this->input->post('kode_petugas');
		$pass = $this->input->post('pass');

		$user = $this->db->get_where('user', ['kode_petugas' => $kode])->row_array();


		// jika usernya ada
		if ($user['kode_petugas']) {
			//jika petugas aktif. status itu nama field di database user

			//cek password
			if ($pass == $user['password']) {
				//ini bikin data buat session
				$data = [
					'kode_petugas' => $user['kode_petugas'],
					'nama' => $user['nama']
				];
				$this->session->set_userdata($data);
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kode petugas salah!</div>');
			redirect('auth');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('kode_petugas');
		$this->session->unset_userdata('nama');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah logout!</div>');
		redirect('auth');
	}
}
