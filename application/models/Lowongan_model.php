<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lowongan_model extends CI_Model
{
    public function getLowongan()
    {
        $this->db->order_by('tgl_dibuka', 'DESC');
        return $this->db->get('lowongan')->result_array();
    }
    public function getLowonganOpen()
    {
        $this->db->order_by('tgl_dibuka', 'DESC');
        return $this->db->get_where('lowongan', ['buka' => 1])->result_array();
    }
    public function lowonganById($id_posisi)
    {
        return $this->db->get_where('lowongan', ['id_posisi' => $id_posisi])->row_array();
    }

    public function tambahLowongan()
    {
        $lowongan = [
            'posisi' => $this->input->post('posisi'),
            'kuota' => $this->input->post('kuota')
        ];
        $this->db->insert('lowongan', $lowongan);
    }

    public function ubahLowongan($id_posisi)
    {
        $lowongan = [
            'posisi' => $this->input->post('posisi'),
            'kuota' => $this->input->post('kuota')
        ];
        $this->db->where('id_posisi', $id_posisi);
        $this->db->update('lowongan', $lowongan);
    }

    public function updateJumlahPelamar($id_posisi)
    {
        $lowongan = [
            'jumlah_pelamar' => $this->input->post('jumlah_pelamar')
        ];
        $this->db->where('id_posisi', $id_posisi);
        $this->db->update('lowongan', $lowongan);
    }
}
