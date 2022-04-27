<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{
    public $id_kriteria;
    public $id_posisi;
    public $kriteria;
    public $sifat;
    public $bobot;

    public function __construct()
    {
        parent::__construct();
    }

    // ini privat
    private function getData()
    {
        $data = array(
            'id_posisi' => $this->id_posisi,
            'kriteria' => $this->kriteria,
            'sifat' => $this->sifat,
            'bobot' => $this->bobot
        );

        return $data;
    }

    public function getkriteria()
    {
        $this->db->order_by('tgl_dibuka', 'DESC');
        return $this->db->get('lowongan')->result_array();
    }
    public function getKriteriaById($id_posisi)
    {
        $this->db->select('*');
        $this->db->from('kriteria');
        $this->db->join('lowongan', 'lowongan.id_posisi = kriteria.id_posisi', 'left');
        $this->db->where('kriteria.id_posisi', $id_posisi);
        return $this->db->get()->result_array();
    }

    // public function kriteria($id_kriteria)
    // {
    //     return $this->db->get_where('kriteria', ['id_kriteria' => $id_kriteria])->row_array();
    // }

    public function kriteria($where)
    {
        return $this->db->get_where('kriteria', $where)->row_array();
    }

    public function getAll($where)
    {
        // kalo pake cara ini malah eror
        // return $this->db->get_where('kriteria', $where)->result_array();
        $nama_pelamar = array();
        $query = $this->db->get_where('kriteria', $where);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nama_pelamar[] = $row;
            }
        }
        return $nama_pelamar;
    }

    public function insert()
    {
        $this->db->insert('kriteria', $this->getData());
        return $this->db->insert_id();
    }

    public function update($where)
    {
        $this->db->update('kriteria', $this->getData(), $where);
        return $this->db->affected_rows();
    }

    public function delete($id_kriteria)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->delete('kriteria');
    }
}
