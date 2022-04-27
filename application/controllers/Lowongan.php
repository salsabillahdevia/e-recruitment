<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lowongan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Lowongan_model');
    }

    public function index()
    {
        $data['title'] = "Lowongan";
        $data['css'] = "";
        $data['js'] = "";

        $data['lowongan'] = $this->Lowongan_model->getLowongan();
        $this->load->view('template/header', $data);
        $this->load->view('lowongan/index');
        $this->load->view('template/footer', $data);
    }

    public function ubahLowongan($id_posisi)
    {
        $data['title'] = "Ubah Lowongan";
        $data['css'] = "";
        $data['js'] = "";

        $data['lowongan'] = $this->Lowongan_model->lowonganById($id_posisi);

        //form validation
        $this->form_validation->set_rules('posisi', 'Posisi Lowongan', 'required');
        $this->form_validation->set_rules('kuota', 'Kuota', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('lowongan/ubahLowongan');
            $this->load->view('template/footer', $data);
        } else {
            $this->Lowongan_model->ubahLowongan($id_posisi);
            $this->session->set_flashdata('message', 'Data Lowongan Berhasil Diubah!');
            redirect('lowongan');
        }
    }

    public function tambahLowongan()
    {
        $data['title'] = "Tambah Lowongan";
        $data['css'] = "";
        $data['js'] = "";

        $funct = time();
        $date = "%Y-%m-%d";
        $data['currentDate'] = mdate($date, $funct);

        //form validation
        $this->form_validation->set_rules('posisi', 'Posisi Lowongan', 'required');
        $this->form_validation->set_rules('kuota', 'Kuota', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('lowongan/tambahLowongan', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->Lowongan_model->tambahLowongan();
            $this->session->set_flashdata('message', 'Data Lowongan Berhasil Ditambah!');
            redirect('lowongan');
        }
    }
}
