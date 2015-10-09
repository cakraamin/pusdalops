<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marey extends CI_Model{

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

	function getMenu($id)
	{
		$data = array();

		$tingkat = $this->getTingkatSchool($id);

		$kueri = $this->db->query("SELECT * FROM fasilitas a,detail_fasilitas b WHERE a.id_fasilitas=b.id_fasilitas AND b.jenjang_school='".$tingkat['tingkat']."'");
		$hasil = $kueri->result();
		foreach($hasil as $dt_hasil)
		{
			$data[] = $dt_hasil->jenis_fasilitas;
		}

		return array_unique($data);
	}	
}
?>