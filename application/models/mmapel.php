<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmapel extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}

	function getTingkatSchool($id)
	{
		$sql = "SELECT * FROM schools WHERE id_school='$id'";		
		$kueri = $this->db->query($sql);
		if($kueri->num_rows() > 0)
		{
			$hasil = $kueri->row();
			$data = array(
				'tingkat'		=> $hasil->jenjang_school
			);
		}
		else
		{
			$data = array(
				'tingkat'		=> 0
			);
		}

		return $data;
	}

	function getTaAktif()
	{
		$kueri = $this->db->query("SELECT * FROM tahun_ajaran WHERE status_ta='1'");
		if($kueri->num_rows() > 0)
		{
			$hasil = $kueri->row();

			$data = array(
				'tahun'		=> $hasil->id_ta
			);
		}
		else
		{
			$data = array(
				'tahun'		=> '0'
			);
		}

		return $data;
	}		

	function getListMapel($ta,$tingkat,$kode)
	{
		$hasil = array();

		$kueri = $this->db->query("SELECT * FROM mapel a,detail_mapel b WHERE a.id_mapel=b.id_mapel AND b.jenjang_school='$tingkat'");
		$kueris = $kueri->result();
		foreach($kueris as $dt_kueris)
		{
			$detil = $this->db->query("SELECT * FROM mapel_school WHERE id_school='".$kode."' AND id_detail_mapel='".$dt_kueris->id_detail_mapel."' ORDER BY id_mapel_school DESC LIMIT 0,1");
			$status = $detil->num_rows();
			$data = $detil->row();
			$nilai = (isset($data->nilai_mapel))?$data->nilai_mapel:"";

			$hasil[] = array(
				'nama_mapel'				=> $dt_kueris->nama_mapel,
				'id_mapel'					=> $dt_kueris->id_mapel,
				'id_detail_mapel'			=> $dt_kueris->id_detail_mapel,
				'nilai'						=> $nilai
			);
		}

		return $hasil;
	}

	function addDetailMapel($kode,$tahun)
	{
		$data = array(
			'id_mapel_school'			=> '',
			'id_ta'						=> $tahun,
			'id_school'					=> $this->session->userdata('id_school'),
			'id_detail_mapel'			=> $kode,
			'nilai_mapel'				=> $this->input->post('nilai_'.$kode)
		);

		$this->db->insert('mapel_school', $data); 
	}
}
?>