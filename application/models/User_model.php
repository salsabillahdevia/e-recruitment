<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

	// ==================================Lowongan================================================
	public function getLowongan()
	{
		$this->db->order_by('tgl_dibuka', 'DESC');
		return $this->db->get('lowongan')->result_array();
	}

	public function getLowonganOpen()
	{
		return $this->db->get_where('lowongan', ['buka' => 1])->result_array();
	}

	public function getLowonganById($id_posisi)
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

	// ==================================Kriteria================================================
	public function getKriteriaById($id_posisi)
	{
		$this->db->select('*');
		$this->db->from('kriteria');
		$this->db->join('lowongan', 'lowongan.id_posisi = kriteria.id_posisi', 'left');
		$this->db->where('kriteria.id_posisi', $id_posisi);
		return $this->db->get()->result_array();
	}

	public function kriteriaLowongan($id_posisi)
	{
		$this->db->select('*');
		$this->db->from('kriteria');
		$this->db->join('lowongan', 'lowongan.id_posisi = kriteria.id_posisi', 'right');
		$this->db->join('sub_kriteria', 'sub_kriteria.id_kriteria = kriteria.id_kriteria', 'right');
		$this->db->where('kriteria.id_posisi', $id_posisi);
		return $this->db->get()->row_array();
	}

	public function kriteriaById($id_posisi)
	{
		$this->db->select('*');
		$this->db->from('kriteria');
		$this->db->join('lowongan', 'lowongan.id_posisi = kriteria.id_posisi', 'left');
		$this->db->where('kriteria.id_posisi', $id_posisi);
		return $this->db->get()->row_array();
	}

	public function subKriteria($id_kriteria)
	{
		$this->db->select('*');
		$this->db->from('kriteria');
		$this->db->join('sub_kriteria', 'sub_kriteria.id_kriteria = kriteria.id_kriteria', 'right');
		$this->db->where('kriteria.id_kriteria', $id_kriteria);
		return $this->db->get()->row_array();
	}

	public function subKriteriaResult()
	{
		return $this->db->get('sub_kriteria')->result_array();
	}

	public function getSub($id_kriteria)
	{
		return $this->db->get_where('sub_kriteria', ['id_kriteria' => $id_kriteria])->row_array();
	}

	public function kriteria($id_kriteria)
	{
		return $this->db->get_where('kriteria', ['id_kriteria' => $id_kriteria])->row_array();
	}

	public function kriteriaByName($namaKriteria, $id_posisi)
	{
		return $this->db->get_where('kriteria', ['id_posisi' => $id_posisi, 'kriteria' => $namaKriteria])->row_array();
	}


	public function saveKriteria($id_kriteria, $id_posisi)
	{
		$aksi = $this->input->post('aksi');
		if ($aksi == "update") {
			$kriteria = [
				'id_posisi' => $id_posisi,
				'kriteria' => $this->input->post('kriteria'),
				'bobot' => $this->input->post('bobot'),
				'sifat' => $this->input->post('sifat')
			];
			$this->db->where('id_kriteria', $id_kriteria);
			$this->db->update('kriteria', $kriteria);

			$query = $this->getSub($id_kriteria);
			if ($query) {
				$subKriteria = [
					'id_kriteria' => $id_kriteria,
					'nama_sub1' => $this->input->post('nama_sub1'),
					'nama_sub2' => $this->input->post('nama_sub2'),
					'nama_sub3' => $this->input->post('nama_sub3'),
					'nama_sub4' => $this->input->post('nama_sub4'),
					'nama_sub5' => $this->input->post('nama_sub5')
				];
				$this->db->where('id_kriteria', $id_kriteria);
				$this->db->update('sub_kriteria', $subKriteria);
			} else {
				$subKriteria = [
					'id_kriteria' => $id_kriteria,
					'nama_sub1' => $this->input->post('nama_sub1'),
					'nama_sub2' => $this->input->post('nama_sub2'),
					'nama_sub3' => $this->input->post('nama_sub3'),
					'nama_sub4' => $this->input->post('nama_sub4'),
					'nama_sub5' => $this->input->post('nama_sub5')
				];
				$this->db->insert('sub_kriteria', $subKriteria);
			}
		} elseif ($aksi == 'insert') {
			$namaKriteria = $this->input->post('kriteria');
			$kriteria = [
				'id_posisi' => $id_posisi,
				'kriteria' => $namaKriteria,
				'bobot' => $this->input->post('bobot'),
				'sifat' => $this->input->post('sifat')
			];
			$this->db->insert('kriteria', $kriteria);

			$query = $this->kriteriaByName($namaKriteria, $id_posisi);
			$subKriteria = [
				'id_kriteria' => $query['id_kriteria'],
				'nama_sub1' => $this->input->post('nama_sub1'),
				'nama_sub2' => $this->input->post('nama_sub2'),
				'nama_sub3' => $this->input->post('nama_sub3'),
				'nama_sub4' => $this->input->post('nama_sub4'),
				'nama_sub5' => $this->input->post('nama_sub5')
			];
			$this->db->insert('sub_kriteria', $subKriteria);
		} else {
			$this->session->set_flashdata('gagal', 'Data Kriteria Gagal Diubah!');
			redirect('user/kriteriaPosisi/' . $id_posisi);
		}
	}

	// ===========================Pelamar========================================================
	public function getPelamar()
	{
		return $this->db->get('pelamar')->result_array();
	}

	public function dataByParam($table, $field, $value)
	{
		return $this->db->get_where($table, [$field => $value])->result_array();
	}

	public function pelamar($id_pelamar)
	{
		return $this->db->get_where('pelamar', ['id_pelamar' => $id_pelamar])->row_array();
	}

	public function pelamarByParam($id_posisi, $nama)
	{
		return $this->db->get_where('pelamar', ['id_posisi' => $id_posisi], ['nama' => $nama])->row_array();
	}

	public function tambahPelamar()
	{
		$id_posisi = $this->input->post('id_posisi');
		$pelamar = [
			'id_posisi' => $id_posisi,
			'nama_pelamar' => $this->input->post('nama_pelamar'),
			'nilai1' => $this->input->post('nilai1'),
			'nilai2' => $this->input->post('nilai2'),
			'nilai3' => $this->input->post('nilai3'),
			'nilai4' => $this->input->post('nilai4'),
			'nilai5' => $this->input->post('nilai5')
		];
		$this->db->insert('pelamar', $pelamar);
		$lowongan = [
			'jumlah_pelamar' => $this->input->post('jumlah_pelamar')
		];
		$this->db->where('id_posisi', $id_posisi);
		$this->db->update('lowongan', $lowongan);
	}

	public function tambahPenilaian()
	{
		// $penilaian = [
		// 	'pelamar' => $id_posisi,
		// 	'nama_pelamar' => $nama_pelamar
		// ];
		// $query = $this->pelamarByParam($id_posisi, $nama_pelamar);
		// $this->db->insert('pelamar', $pelamar);
	}
}
