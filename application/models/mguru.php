<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mguru extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}

	function cekNipGuru()
	{
		$nip = strip_tags(ascii_to_entities(addslashes($this->input->post('nik',TRUE))));

		$kueri = $this->db->query("SELECT * FROM guru WHERE nik_guru='$nip'");
		return $kueri->num_rows();
	}

	function addGuru($id)
	{
		$data = array(
		   'id_guru' 			=> '' ,
		   'id_school'			=> $id,
		   'nik_guru' 			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nik',TRUE)))),
		   'nama_guru' 			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),
		   'tgl_lahir'			=> $this->input->post('tahun',TRUE)."-".$this->input->post('bulan',TRUE)."-".$this->input->post('tanggal',TRUE),
		   'tmt_guru'			=> $this->input->post('tahund',TRUE)."-".$this->input->post('buland',TRUE)."-".$this->input->post('tanggald',TRUE),
		   'jenis_kel'			=> $this->input->post('jenisKel',TRUE),
		   'status_guru'		=> $this->input->post('status',TRUE),
		   'status_peg'			=> $this->input->post('statuspeg',TRUE),
		   'tunjangan_guru'		=> $this->input->post('tunjangan',TRUE),
		   'tahun_tunjangan'	=> $this->input->post('sertif',TRUE),
		   'id_jabatan'			=> $this->input->post('jabatan',TRUE),
		   'jenis_kendaraan'	=> $this->input->post('kendaraan',TRUE),
		   'jarak'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('jarak',TRUE))))
		);

		$this->db->insert('guru', $data); 
	}

	function getGuru($num,$offset,$sort_by,$sort_order)//menu admin
	{
		if (empty($offset))
		{
			$offset=0;
		}
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('guru.id_guru');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'guru.id_guru';
		$sql = "SELECT * FROM guru WHERE id_school='".$this->session->userdata('id_school')."' ORDER BY $sort_by $sort_order LIMIT $offset,$num";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function editGUru($id)
	{
		$kueri = $this->db->query("SELECT * FROM guru WHERE id_guru='$id'");
		return $kueri->row();
	}

	function updateGuru($id)
	{
		$data = array(		   
		   'nik_guru' 			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nik',TRUE)))),
		   'nama_guru' 			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),
		   'tgl_lahir'			=> $this->input->post('tahun',TRUE)."-".$this->input->post('bulan',TRUE)."-".$this->input->post('tanggal',TRUE),
		   'tmt_guru'			=> $this->input->post('tahund',TRUE)."-".$this->input->post('buland',TRUE)."-".$this->input->post('tanggald',TRUE),
		   'jenis_kel'			=> $this->input->post('jenisKel',TRUE),
		   'status_guru'		=> $this->input->post('status',TRUE),
		   'status_peg'			=> $this->input->post('statuspeg',TRUE),
		   'tunjangan_guru'		=> $this->input->post('tunjangan',TRUE),
		   'tahun_tunjangan'	=> $this->input->post('sertif',TRUE),
		   'id_jabatan'			=> $this->input->post('jabatan',TRUE),
		   'jenis_kendaraan'	=> $this->input->post('kendaraan',TRUE),
		   'jarak'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('jarak',TRUE))))
		);

		$this->db->where('id_guru', $id);
		$this->db->update('guru', $data); 
	}

	function deleteGuru($id)
	{
		$kueri = $this->db->query("DELETE FROM guru WHERE id_guru='$id'");
		return $kueri;
	}

	function getIdSekolah($id)	
	{
		$kueri = $this->db->query("");
		return $kueri->row();
	}
}
?>