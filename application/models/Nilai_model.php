<?php
class Nilai_model extends CI_Model
{

    public $id_pelamar;
    public $id_posisi;
    public $id_kriteria;
    public $nilai;

    public function __construct()
    {
        parent::__construct();
    }

    private function getData()
    {
        $data = array(
            'id_pelamar' => $this->id_pelamar,
            'id_posisi' => $this->id_posisi,
            'id_kriteria' => $this->id_kriteria,
            'nilai' => $this->nilai
        );

        return $data;
    }

    public function insert()
    {
        $status = $this->db->insert('penilaian_pelamar', $this->getData());
        return $status;
    }

    public function getNilaiByPelamar($id_pelamar)
    {
        // query buat ambil semua penilaian pelamar
        // SELECT pelamar.id_pelamar, pelamar.nama_pelamar, kriteria.id_kriteria, penilaian_pelamar.nilai FROM pelamar,kriteria,penilaian_pelamar WHERE pelamar.id_pelamar = penilaian_pelamar.id_pelamar AND  kriteria.id_kriteria = penilaian_pelamar.id_kriteria

        $query = $this->db->query(
            'SELECT pelamar.id_pelamar, pelamar.nama_pelamar, kriteria.id_kriteria, penilaian_pelamar.nilai FROM pelamar,kriteria,penilaian_pelamar WHERE penilaian_pelamar.id_pelamar = ' . $id_pelamar . ' AND pelamar.id_pelamar = penilaian_pelamar.id_pelamar AND kriteria.id_kriteria = penilaian_pelamar.id_kriteria'
        );
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function getNilaiPelamar($id_posisi)
    {
        $query = $this->db->query(
            'SELECT pelamar.id_pelamar, pelamar.nama_pelamar,pelamar.id_posisi,kriteria.id_kriteria,kriteria.kriteria,penilaian_pelamar.nilai from pelamar,kriteria,penilaian_pelamar WHERE pelamar.id_pelamar = penilaian_pelamar.id_pelamar AND kriteria.id_kriteria = penilaian_pelamar.id_kriteria AND pelamar.id_posisi = ' . $id_posisi . ''
        );
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function update()
    {
        $data = array('nilai' => $this->nilai);
        $this->db->where('id_pelamar', $this->id_pelamar);
        $this->db->where('id_kriteria', $this->id_kriteria);
        $this->db->update('penilaian_pelamar', $data);
        return $this->db->affected_rows();
    }
}
