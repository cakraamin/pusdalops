<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpeta extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getLokasi($id="")	
	{
		if($id == "")
		{
			$kueri = $this->db->query("SELECT * FROM schools");
		}
		else
		{
			$kueri = $this->db->query("SELECT * FROM schools WHERE id_school='$id'");
		}		
		$hasil = $kueri->result();

		$json = '{"wilayah": {';
		$json .= '"petak":[ ';
		foreach($hasil as $dt_hasil)
		{
			$isi = "<table>";
			$isi .= "<tr><td width='200px'>Nama Sekolah</td><td>".$dt_hasil->nama_school."</td></tr>";
			$isi .= "</table>";

		    $json .= '{';
		    $json .= '"id":"'.$dt_hasil->id_school.'",
		        "judul":"'.$dt_hasil->nama_school.'",
		        "deskripsi":"'.$isi.'",
		        "x":"'.$dt_hasil->lintang_school.'",
		        "y":"'.$dt_hasil->bujur_school.'",
		        "jenis":"sekolah"
		    },';
		}
		$json = substr($json,0,strlen($json)-1);
		$json .= ']';

		$json .= '}}';
		return $json;
	}
}
?>