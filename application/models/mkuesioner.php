<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mkuesioner extends CI_Model{

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
				'tingkat'		=> $hasil->jenjang_school,
				'jenjang'		=> $hasil->tingkat_school
			);
		}
		else
		{
			$data = array(
				'tingkat'		=> 0,
				'jenjang'		=> 0
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

	function getListKuesioner($ta,$tingkat,$kode,$jenjang)
	{
		$hasil = array();

		$sql = "SELECT * FROM kuesioner a,ket_kuesioner b,detail_kuesioner c WHERE a.id_kuesioner=b.id_kuesioner AND b.id_ket_kuesioner=c.id_ket_kuesioner AND c.jenjang_school='$tingkat' AND b.stat_ket_kuesioner='1' AND c.detail_jenjang_kuesioner='$jenjang' ORDER BY b.id_ket_kuesioner";				
		$kueri = $this->db->query($sql);
		$kueris = $kueri->result();
		foreach($kueris as $dt_kueris)
		{
			$sql = "SELECT * FROM kuesioner_school WHERE id_school='".$kode."' AND id_detail_kuesioner='".$dt_kueris->id_detail_kuesioner."' ORDER BY id_kuesioner_school DESC LIMIT 0,1";
			$detil = $this->db->query($sql);
			$status = $detil->num_rows();
			$data = $detil->row();			
			$status = (isset($data->ket_kuesioner_school))?$data->ket_kuesioner_school:"";
			$option = (isset($data->input_kuesioner_school))?$data->input_kuesioner_school:"";

			$hasil[] = array(
				'id_kuesioner'			=> $dt_kueris->id_kuesioner,
				'id_ket_kuesioner'		=> $dt_kueris->id_ket_kuesioner,
				'id_detail_kuesioner'	=> $dt_kueris->id_detail_kuesioner,
				'stat_ket_kuesioner'	=> $dt_kueris->stat_ket_kuesioner,
				'text_ket_kuesioner'	=> $dt_kueris->text_ket_kuesioner,
				'jawaban'				=> $dt_kueris->jawaban,
				'value'					=> $status,
				'option'				=> $option
			);
		}
		return $hasil;		
	}

	function addDetailKuesioner($kode,$tahun)
	{
		$data = array(
			'id_kuesioner_school'		=> '',
			'id_school'					=> $this->session->userdata('id_school'),
			'id_ta'						=> $tahun,			
			'id_detail_kuesioner'		=> $kode,
			'ket_kuesioner_school'		=> $this->input->post('cek_'.$kode),
			'input_kuesioner_school'	=> $this->input->post('input_'.$kode)
		);

		$this->db->insert('kuesioner_school', $data); 
	}
}
?>