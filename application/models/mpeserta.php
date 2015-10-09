<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpeserta extends CI_Model{

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

	function getListProdi($ta,$tingkat,$kode)
	{
		$hasil = array();

		$kueri = $this->db->query("SELECT * FROM prodi a,detail_prodi b WHERE a.id_prodi=b.id_prodi AND b.jenjang_school='$tingkat'");
		$kueris = $kueri->result();
		foreach($kueris as $dt_kueris)
		{
			$detil = $this->db->query("SELECT * FROM prodi_school WHERE id_school='".$kode."' AND id_detail_prodi='".$dt_kueris->id_detail_prodi."' ORDER BY id_prodi_school DESC LIMIT 0,1");
			$status = $detil->num_rows();
			$data = $detil->row();
			$peserta = (isset($data->peserta))?$data->peserta:"";
			$lulus = (isset($data->lulus))?$data->lulus:"";

			$hasil[] = array(
				'nama_prodi'				=> $dt_kueris->nama_prodi,
				'id_prodi'					=> $dt_kueris->id_prodi,
				'id_detail_prodi'			=> $dt_kueris->id_detail_prodi,
				'peserta'					=> $peserta,
				'lulus'						=> $lulus
			);
		}

		return $hasil;
	}

	function addDetailProdi($kode,$tahun)
	{
		$data = array(
			'id_prodi_school'			=> '',
			'id_ta'						=> $tahun,
			'id_school'					=> $this->session->userdata('id_school'),
			'id_detail_prodi'			=> $kode,
			'peserta'					=> $this->input->post('peserta_'.$kode),
			'lulus'						=> $this->input->post('lulus_'.$kode)
		);

		$this->db->insert('prodi_school', $data); 
	}
}
?>