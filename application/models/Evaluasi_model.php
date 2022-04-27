<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function createTable($field)
    {
        $fields = array(
            'nama_pelamar VARCHAR(120) not null',
            'id_posisi INT not null'
        );


        foreach ($field as $item => $value) {
            $value->kriteria = str_replace(' ', '_', $value->kriteria);
            $fields[] = $value->kriteria . ' DECIMAL(13,2) not null ';
        }

        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('saw');
    }


    public function getAllSaw()
    {
        $query = $this->db->get('saw');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $saw[] = $row;
            }
            return $saw;
        }
    }

    public function insertSaw($data)
    {
        $status = $this->db->insert('saw', $data);
        return $status;
    }

    public function getStatus($key, $id_posisi)
    {
        $key = str_replace('_', ' ', $key);
        $this->db->select('sifat');
        // $this->db->where('id_posisi', $id_posisi);
        // $this->db->where('kriteria', $key);
        return $this->db->get_where('kriteria', ['id_posisi' => $id_posisi, 'kriteria' => $key])->row();
    }

    public function updateSaw($data, $where)
    {
        $this->db->update('saw', $data, $where);
    }

    public function getBobotKriteria($id_posisi)
    {
        $query = $this->db->query('SELECT kriteria, bobot from kriteria WHERE id_posisi = ' . $id_posisi);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $bobot[] = $row;
            }
            return $bobot;
        }
    }

    public function addColumnTotalRangking()
    {
        $fields = array(
            'Total  DECIMAL(13,2)',
            'Rangking  INT'
        );
        $this->dbforge->add_column('saw', $fields);
    }
    public function getSortTotalByDesc()
    {
        $this->db->order_by('Total', 'DESC');
        $query = $this->db->get('saw');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $dataSaw[] = $row;
            }
            return $dataSaw;
        }
    }
    public function dropTable()
    {
        $this->dbforge->drop_table('saw', TRUE);
    }
}
