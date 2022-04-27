<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubKriteria_model extends CI_Model
{
    // get = result_array
    // non get = row_array
    public $id_sub_kriteria;
    public $id_kriteria;
    public $sub_kriteria;
    public $value;

    public function __construct()
    {
        parent::__construct();
    }

    private function getData()
    {
        $data = array(
            'id_kriteria' => $this->id_kriteria,
            'sub_kriteria' => $this->sub_kriteria,
            'value' => $this->value
        );
        return $data;
    }

    public function getSubKriteria($id_kriteria)
    {
        return $this->db->get_where('sub_kriteria', ['id_kriteria' => $id_kriteria])->result_array();
    }

    public function insert()
    {
        $data = $this->getData();
        $this->db->insert('sub_kriteria', $data);
        return $this->db->insert_id();
    }

    public function update()
    {
        $data = $this->getData();
        $this->db->where('id_sub_kriteria', $this->id_sub_kriteria);
        $this->db->where('id_kriteria', $this->id_kriteria);
        $this->db->update('sub_kriteria', $data);
        return $this->db->affected_rows();
    }


    public function delete($id_kriteria)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->delete('sub_kriteria');
    }

    public function getById()
    {
        // $this->db->where('id_kriteria', $this->id_kriteria);
        // return $this->db->get('sub_kriteria')->result_array();
        $this->db->where('id_kriteria', $this->id_kriteria);
        $query = $this->db->get('sub_kriteria');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $sub_kriteria[] = $row;
            }

            return $sub_kriteria;
        }
    }
}
