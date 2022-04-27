<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Evaluasi_model');
        $this->load->model('Lowongan_model');
        $this->load->model('Kriteria_model');
        $this->load->model('Pelamar_model');
        $this->load->model('Nilai_model');
    }

    public function index()
    {
        $data['title'] = "Evaluasi Pelamar";
        $data['css'] = "";
        $data['js'] = "";

        $data['lowongan'] = $this->Lowongan_model->getLowonganOpen();
        //form validation
        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('evaluasi/index');
            $this->load->view('template/footer', $data);
        } else {
            redirect('evaluasi/evaluasiPosisi/' . $this->input->post('posisi'));
        }
    }

    public function evaluasiPosisi($id_posisi)
    {
        $data['title'] = 'Evaluasi Per Posisi';
        $data['css'] = "<link href='" . base_url() . "assets/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css' rel='stylesheet'>";
        $data['js'] = "
        		<script src='" . base_url() . "assets/assets/extra-libs/DataTables/datatables.min.js'></script>
        		<script>
        			/****************************************
        			 *       Basic Table                   *
        			 ****************************************/
        			$('#zero_config').DataTable();
        		</script>";

        $data['lowongan'] = $this->Lowongan_model->lowonganById($id_posisi);
        $data['kriteria'] = $this->Kriteria_model->getAll(['id_posisi' => $id_posisi]);
        // $data['pelamar'] = $this->Pelamar_model->getPelamarPosisi($id_posisi);


        $data['pelamar'] = $this->Pelamar_model->getPelamarByPosisi($id_posisi);
        if ($data['pelamar'] == null) {
            $this->session->set_flashdata('gagal', 'Tidak Ada Data Pelamar!');
            redirect('evaluasi');
        }

        /**
         * Menghapus table SAW jika ada
         */
        $this->Evaluasi_model->dropTable();

        /**
         * $kriteria data dari table kriteria. solved
         */
        $kriteria = $this->Kriteria_model->getAll(['id_posisi' => $id_posisi]);
        // dump($kriteria);

        /**
         * membuat table SAW berdasarkan data dari table kriteria
         * menginputkan semua data nilai
         */
        $this->Evaluasi_model->createTable($kriteria);

        /**
         * Ambil data dari table SAW untuk perhitungan awal. solved
         */
        $table1 = $this->initialTableSAW($data['pelamar'], $id_posisi);
        $this->page->setData('table1', $table1);
        // dump($table1);

        /**
         * mengambil sifat kriteria. di headernya ada nama_pelamar sama id_posisi, harusnya gaada
         * @var $dataSifat array
         */
        // solved
        // $dataSifat = $this->getDataSifat($id_posisi);
        // $this->page->setData('dataSifat', $dataSifat);
        // dump($dataSifat);
        // die;

        /**
         * Mengambil nilai maksimal dan minimal berdasarkan sifat
         */
        // $dataValueMinMax = $this->getVlueMinMax($dataSifat);
        // $this->page->setData('valueMinMax', $dataValueMinMax);
        // dump($dataValueMinMax);

        /**
         * Proses 1 ubah data berdasarkan sifat
         */

        // $table2 = $this->getCountBySifat($dataSifat, $dataValueMinMax);
        // $this->page->setData('table2', $table2);

        /**
         * Hitung perkalian bobot dengan nilai kriteria. solved
         */
        // $bobot = $this->Evaluasi_model->getBobotKriteria($id_posisi);
        // $this->page->setData('bobot', $bobot);
        // $table3 = $this->getCountByBobot($bobot);
        // $this->page->setData('table3', $table3);

        /**
         * Add kolom total dan rangking
         */
        $this->Evaluasi_model->addColumnTotalRangking();

        /**
         * Menghitung nilai total
         */
        $this->countTotal();

        /**
         * Mengambil data yang sudah di rangking
         */
        $tableFinal = $this->getDataRangking();
        $this->page->setData('tableFinal', $tableFinal);

        /**
         * Menghapus table SAW
         */
        $this->Evaluasi_model->dropTable();


        $this->load->view('template/header', $data);
        $this->load->view('evaluasi/evaluasiPosisi');
        $this->load->view('template/footer', $data);
    }


    private function initialTableSAW($pelamar, $id_posisi)
    {
        $nilai = $this->Nilai_model->getNilaiPelamar($id_posisi);

        $dataInput = array();
        $no = 0;
        foreach ($pelamar as $item => $itemPelamar) {
            foreach ($nilai as $index => $itemNilai) {
                if ($itemPelamar->id_pelamar == $itemNilai->id_pelamar) {
                    $itemNilai->kriteria = str_replace(' ', '_', $itemNilai->kriteria);
                    $dataInput[$no]['nama_pelamar'] = $itemPelamar->nama_pelamar;
                    $dataInput[$no]['id_posisi'] = $itemPelamar->id_posisi;
                    $dataInput[$no][$itemNilai->kriteria] = $itemNilai->nilai;
                }
            }
            $no++;
        }

        foreach ($dataInput as $data => $item) {
            $this->Evaluasi_model->insertSaw($item);
        }
        return $this->Evaluasi_model->getAllSaw();
    }

    private function getDataSifat($id_posisi)
    {
        $sawData = $this->Evaluasi_model->getAllSaw();
        $dataSifat = array();
        foreach ($sawData as $item => $value) {
            // x itu key nya, z itu value nya
            foreach ($value as $x => $z) {
                // x udah bener
                // dump($x);
                // $x = str_replace(' ', '_', $x);
                // ini buat ilangin nama_pelamar sama id_posisi. soalnya eror kalo ga diilangin
                if ($x == 'nama_pelamar') {
                    continue;
                } elseif ($x == 'id_posisi') {
                    continue;
                }
                // error di dataSifat nya. ini yang diambil key nya aja. tapi nama_pelamar sama id_posisi jangan diajak
                $dataSifat[$x] = $this->Evaluasi_model->getStatus($x, $id_posisi);
                // var_dump($x);
                // die;
            }
        }
        return $dataSifat;
    }

    private function getVlueMinMax($dataSifat)
    {
        $sawData = $this->Evaluasi_model->getAllSaw();
        $dataValueMinMax = array();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'nama_pelamar') {
                    continue;
                } elseif ($x == 'id_posisi') {
                    continue;
                }
                // dump($dataSifat);
                foreach ($dataSifat as $item => $itemX) {
                    if ($x == $item) {
                        // dump($item);
                        if ($x == $item && $itemX->sifat == 'B') {
                            if (!isset($dataValueMinMax['max' . $x])) {
                                $dataValueMinMax['kriteria' . $x] = $x;
                                $dataValueMinMax['max' . $x] = $z;
                                $dataValueMinMax['sifat' . $x] = 'Benefit';
                            } elseif ($z > $dataValueMinMax['max' . $x]) {
                                $dataValueMinMax['max' . $x] = $z;
                            }
                        } else {
                            if (!isset($dataValueMinMax['min' . $x])) {
                                $dataValueMinMax['kriteria' . $x] = $x;
                                $dataValueMinMax['min' . $x] = $z;
                                $dataValueMinMax['sifat' . $x] = 'Cost';
                            } elseif ($z < $dataValueMinMax['min' . $x]) {
                                $dataValueMinMax['min' . $x] = $z;
                            }
                        }
                        // dump($itemX);
                        // die;
                    }
                }
            }
        }

        return $dataValueMinMax;
    }
    private function getCountBySifat($dataSifat, $dataValueMinMax)
    {
        $sawData = $this->Evaluasi_model->getAllSaw();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'nama_pelamar' || $x == 'id_posisi') {
                    continue;
                }
                foreach ($dataSifat as $item => $sifat) {
                    if ($x == $item) {
                        if ($sifat->sifat == 'B') {

                            $newData = $z / $dataValueMinMax['max' . $x];
                            $dataUpdate = array(
                                $x => $newData
                            );
                            $where = array(

                                'nama_pelamar' => $value->nama_pelamar,
                                'id_posisi' => $value->id_posisi
                            );

                            $this->Evaluasi_model->updateSaw($dataUpdate, $where);
                        } else {
                            $newData = $dataValueMinMax['min' . $x] / $z;
                            $dataUpdate = array(
                                $x => $newData
                            );
                            $where = array(

                                'nama_pelamar' => $value->nama_pelamar,
                                'id_posisi' => $value->id_posisi
                            );

                            $this->Evaluasi_model->updateSaw($dataUpdate, $where);
                        }
                    }
                }
            }
        }

        return $this->Evaluasi_model->getAllSaw();
    }

    private function getCountByBobot($bobot)
    {

        $sawData = $this->Evaluasi_model->getAllSaw();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'nama_pelamar' || $x == 'id_posisi') {
                    continue;
                }
                foreach ($bobot as $item => $itemKriteria) {
                    // dump($itemKriteria->kriteria);
                    // die;

                    if ($x == $itemKriteria->kriteria) {

                        $sawData[$point]->$x =  $z * $itemKriteria->bobot;
                        $newData = $z * $itemKriteria->bobot;
                        $dataUpdate = array(
                            $x => $newData
                        );
                        $where = array(
                            'nama_pelamar' => $value->nama_pelamar,
                            'id_posisi' => $value->id_posisi
                        );

                        $this->Evaluasi_model->updateSaw($dataUpdate, $where);
                    }
                }
            }
        }

        return $this->Evaluasi_model->getAllSaw();
    }

    private function countTotal()
    {
        $sawData = $this->Evaluasi_model->getAllSaw();

        foreach ($sawData as $item => $value) {
            $total = 0;
            foreach ($value as $item => $itemData) {
                if ($item == 'nama_pelamar' || $item == 'id_posisi') {
                    continue;
                } elseif ($item == 'Total') {
                    $dataUpdate = array(
                        'Total' => $total
                    );

                    $where = array(
                        'nama_pelamar' => $value->nama_pelamar,
                        'id_posisi' => $value->id_posisi
                    );

                    $this->Evaluasi_model->updateSaw($dataUpdate, $where);
                } else {
                    $total = $total + $itemData;
                }
            }
        }
    }
    private function getDataRangking()
    {
        $sawData = $this->Evaluasi_model->getSortTotalByDesc();
        $no = 1;
        foreach ($sawData as $item => $value) {
            $dataUpdate = array(
                'Rangking' => $no
            );
            $where = array(
                'nama_pelamar' => $value->nama_pelamar,
                'id_posisi' => $value->id_posisi
            );

            $this->Evaluasi_model->updateSaw($dataUpdate, $where);
            $no++;
        }
        return $this->Evaluasi_model->getAllSaw();
    }
}
