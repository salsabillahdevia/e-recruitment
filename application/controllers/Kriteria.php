<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Kriteria_model');
        $this->load->model('Lowongan_model');
        $this->load->model('SubKriteria_model');
    }

    public function index()
    {
        $data['title'] = "Kriteria";
        $data['css'] = "";
        $data['js'] = "";

        $data['lowongan'] = $this->Lowongan_model->getLowongan();

        $this->load->view('template/header', $data);
        $this->load->view('kriteria/index');
        $this->load->view('template/footer', $data);
    }

    public function kriteriaPosisi($id_posisi)
    {
        $data['title'] = "Kriteria Per Posisi";
        $data['css'] = "";
        $data['js'] = "";

        $data['kriteria'] = $this->Kriteria_model->getKriteriaById($id_posisi);
        $data['lowongan'] = $this->Lowongan_model->lowonganById($id_posisi);

        $this->load->view('template/header', $data);
        $this->load->view('kriteria/kriteriaPosisi', $data);
        $this->load->view('template/footer', $data);
    }
    public function kriteria($id_posisi = NULL, $id_kriteria = NULL)
    {
        if ($id_posisi && $id_kriteria) {
            $data['title'] = "Ubah Kriteria";
            $data['css'] = "";
            $data['js'] = "";

            $data['lowongan'] = $this->Lowongan_model->lowonganById($id_posisi);
            $data['kriteria'] = $this->Kriteria_model->kriteria(['id_kriteria' => $id_kriteria]);
            $data['subKriteria'] = $this->SubKriteria_model->getSubKriteria($id_kriteria);

            //form validation
            $this->form_validation->set_rules('kriteria', 'Kriteria', 'required');
            $this->form_validation->set_rules('bobot', 'Bobot', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('kriteria/ubahKriteria', $data);
                $this->load->view('template/footer', $data);
            } else {
                // update sub kriteria
                $sub_kriteria = array();

                for ($i = 1; $i <= 5; $i++) {

                    $sub_kriteria[$i] =   array(
                        'id_sub_kriteria' => $this->input->post('id_sub_kriteria' . $i, true),
                        'sub_kriteria' => $this->input->post('sub_kriteria' . $i, true),
                        'value' => $i
                    );
                }
                // update kriteria
                $where = ['id_kriteria' => $id_kriteria];
                $this->Kriteria_model->id_posisi = $id_posisi;
                $this->Kriteria_model->kriteria = $this->input->post('kriteria');
                $this->Kriteria_model->sifat = $this->input->post('sifat');
                $this->Kriteria_model->bobot = $this->input->post('bobot');
                $this->Kriteria_model->update($where);


                foreach ($sub_kriteria as $item) {

                    $this->SubKriteria_model->id_kriteria = $id_kriteria;
                    $this->SubKriteria_model->id_sub_kriteria = $item['id_sub_kriteria'];
                    $this->SubKriteria_model->sub_kriteria = $item['sub_kriteria'];
                    $this->SubKriteria_model->value = $item['value'];
                    $update = $this->SubKriteria_model->update();
                };
                $this->session->set_flashdata('message', 'Data Kriteria Berhasil Diubah!');
                redirect('kriteria/kriteriaPosisi/' . $id_posisi);
            }
        } else {
            // input kriteria
            $this->Kriteria_model->id_posisi = $id_posisi;
            $this->Kriteria_model->kriteria = $this->input->post('kriteria');
            $this->Kriteria_model->sifat = $this->input->post('sifat');
            $this->Kriteria_model->bobot = $this->input->post('bobot');
            $this->Kriteria_model->insert();

            $query = $this->Kriteria_model->kriteria(['id_posisi' => $id_posisi, 'kriteria' => $this->Kriteria_model->kriteria]);


            // input sub kriteria
            $subKriteria = array(
                array(
                    'sub_kriteria' => $this->input->post('sub_kriteria1', true),
                    'value' => 1
                ),
                array(
                    'sub_kriteria' => $this->input->post('sub_kriteria2', true),
                    'value' => 2
                ),
                array(
                    'sub_kriteria' => $this->input->post('sub_kriteria3', true),
                    'value' => 3
                ),
                array(
                    'sub_kriteria' => $this->input->post('sub_kriteria4', true),
                    'value' => 4
                ),
                array(
                    'sub_kriteria' => $this->input->post('sub_kriteria5', true),
                    'value' => 5
                )
            );
            foreach ($subKriteria as $item) {
                $this->SubKriteria_model->id_kriteria = $query['id_kriteria'];
                $this->SubKriteria_model->sub_kriteria = $item['sub_kriteria'];
                $this->SubKriteria_model->value = $item['value'];
                $this->SubKriteria_model->insert();
            }
            $this->session->set_flashdata('message', 'Data Kriteria Berhasil Diubah!');
            redirect('kriteria/kriteriaPosisi/' . $id_posisi);
        }
    }

    public function delete($id_posisi, $id_kriteria)
    {
        $this->SubKriteria_model->delete($id_kriteria);
        $this->Kriteria_model->delete($id_kriteria);
        $this->session->set_flashdata('message', 'Data Kriteria Berhasil Dihapus!');
        redirect('kriteria/kriteriaPosisi/' . $id_posisi);
    }
}
