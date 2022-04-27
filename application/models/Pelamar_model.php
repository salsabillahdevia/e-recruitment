<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelamar_model extends CI_Model
{
    public $id_posisi;
    public $id_pelamar;
    public $nama_pelamar;

    public function __construct()
    {
        parent::__construct();
    }

    private function getData()
    {
        $data = array(
            'nama_pelamar' => $this->nama_pelamar,
            'id_posisi' => $this->id_posisi
        );

        return $data;
    }

    public function getAllPelamar()
    {
        $this->db->order_by('tgl_interview', 'DESC');
        return $this->db->get('pelamar')->result_array();
    }

    public function getPelamarPosisi($id_posisi)
    {
        return $this->db->get_where('pelamar', ['id_posisi' => $id_posisi])->result_array();
    }

    public function pelamar($id_pelamar)
    {
        return $this->db->get_where('pelamar', ['id_pelamar' => $id_pelamar])->row_array();
    }

    public function getPelamarByPosisi($id_posisi)
    {
        // return $this->db->get_where('pelamar', ['id_posisi' => $id_posisi])->result_array();
        $nama_pelamar = array();
        $query = $this->db->get_where('pelamar', ['id_posisi' => $id_posisi]);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nama_pelamar[] = $row;
            }
        }
        return $nama_pelamar;
    }


    public function insert()
    {
        $this->db->insert('pelamar', $this->getData());
        return $this->db->insert_id();
    }

    public function update($id_posisi)
    {
        $status = $this->db->update('pelamar', $this->getData($id_posisi));
        return $status;
    }

    public function delete($id)
    {
        $this->db->where('id_pelamar', $id);
        return $this->db->delete('pelamar');
    }

    public function getLastID()
    {
        $this->db->select('id_pelamar');
        $this->db->order_by('id_pelamar', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pelamar');
        return $query->row();
    }
}
