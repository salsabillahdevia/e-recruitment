<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelamar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pelamar_model');
        $this->load->model('Lowongan_model');
        $this->load->model('Nilai_model');
        $this->load->model('Kriteria_model');
        $this->load->model('SubKriteria_model');

        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = "Daftar Pelamar";
        $data['css'] = "<link href='" . base_url() . "assets/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css' rel='stylesheet'>";
        $data['js'] = "
			<script src='" . base_url() . "assets/assets/extra-libs/DataTables/datatables.min.js'></script>
			<script>
				/****************************************
				 *       Basic Table                   *
				 ****************************************/
				$('#zero_config').DataTable();
			</script>";

        $data['lowongan'] = $this->Lowongan_model->getLowonganOpen();
        $data['pelamar'] = $this->Pelamar_model->getAllPelamar();
        $this->load->view('template/header', $data);
        $this->load->view('pelamar/index');
        $this->load->view('template/footer', $data);
    }

    public function tambahPelamar($id_posisi)
    {
        $data['title'] = "Tambah Pelamar";
        $data['css'] = "";
        $data['js'] = "";

        $funct = time();
        $date = "%d-%m-%Y";
        $data['currentDate'] = mdate($date, $funct);

        $data['dataView'] = $this->getDataInsert($id_posisi);
        $data['lowongan'] = $this->Lowongan_model->lowonganById($id_posisi);

        $this->form_validation->set_rules('nama_pelamar', 'Nama Pelamar', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('pelamar/tambahPelamar');
            $this->load->view('template/footer', $data);
        } else {
            $id_posisi = $this->input->post('id_posisi');
            $nama_pelamar = $this->input->post('nama_pelamar');
            $nilai = $this->input->post('nilai');

            $this->Pelamar_model->id_posisi = $id_posisi;
            $this->Pelamar_model->nama_pelamar = $nama_pelamar;
            if ($this->Pelamar_model->insert($id_posisi) == true) {
                $success = false;
                $id_pelamar = $this->Pelamar_model->getLastID()->id_pelamar;
                foreach ($nilai as $item => $value) {
                    $this->Nilai_model->id_pelamar = $id_pelamar;
                    $this->Nilai_model->id_posisi = $id_posisi;
                    $this->Nilai_model->id_kriteria = $item;
                    $this->Nilai_model->nilai = $value;
                    if ($this->Nilai_model->insert()) {
                        $success = true;
                        $this->Lowongan_model->updateJumlahPelamar($id_posisi);
                    }
                }
                if ($success == true) {
                    $this->session->set_flashdata('message', 'Data Penilaian Pelamar Berhasil Disimpan!');
                    redirect('pelamar');
                } else {
                    $this->session->set_flashdata('gagal', 'Data Penilaian Pelamar Gagal Disimpan!');
                    redirect('pelamar');
                }
            }
        }
    }

    // belum
    public function detailPelamar($id_pelamar)
    {
        $data['title'] = "Detail Pelamar";
        $data['css'] = "";
        $data['js'] = "";

        // get data pelamar
        $data['pelamar'] = $this->Pelamar_model->pelamar($id_pelamar);
        $id_posisi = $data['pelamar']['id_posisi'];
        $data['dataView'] = $this->getDataInsert($id_posisi);
        $data['lowongan'] = $this->Lowongan_model->lowonganById($id_posisi);
        $data['nilaiPelamar'] = $this->Nilai_model->getNilaiByPelamar($id_pelamar);

        $this->form_validation->set_rules('nama_pelamar', 'Nama Pelamar', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('pelamar/detailPelamar');
            $this->load->view('template/footer', $data);
        } else {
            $id_posisi = $this->input->post('id_posisi');
            $nama_pelamar = $this->input->post('nama_pelamar');
            $nilai = $this->input->post('nilai');

            $where = array('id_pelamar' => $id_pelamar, 'id_posisi' => $id_posisi);
            $this->Pelamar_model->id_posisi = $id_posisi;
            $this->Pelamar_model->nama_pelamar = $nama_pelamar;
            if ($this->Pelamar_model->update($where) == true) {
                $success = false;
                foreach ($nilai as $item => $value) {
                    $this->Nilai_model->id_pelamar = $id_pelamar;
                    $this->Nilai_model->id_kriteria = $item;
                    $this->Nilai_model->nilai = $value;
                    if ($this->Nilai_model->update()) {
                        $success = true;
                    }
                }
                if ($success == true) {
                    $this->session->set_flashdata('message', 'Berhasil mengubah data :)');
                    redirect('pelamar');
                } else {
                    echo 'gagal';
                }
            }
        }
    }

    private function getDataInsert($id_posisi)
    {
        $dataView = array();
        $kriteria = $this->Kriteria_model->getAll(['id_posisi' => $id_posisi]);
        foreach ($kriteria as $item) {
            $this->SubKriteria_model->id_kriteria = $item->id_kriteria;
            $dataView[$item->id_kriteria] = array(
                'nama' => $item->kriteria,
                'data' => $this->SubKriteria_model->getById(),
                'bobot' => $item->bobot
            );
        }
        return $dataView;
    }
}
