<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mglobal extends CI_Model{



	function __construct()

	{

		parent::__construct();

	}



	function getDirektori()

	{

		$hasil = array();



		$file = array("datscale.DBF","tabbrg.DBF","tabcust.DBF","tabstf.DBF","tabtara.DBF","tabtrsp.DBF");



		$kueri = $this->db->query("SELECT * FROM direktori");

		if($kueri->num_rows() > 0)

		{

			$data = $kueri->row();



			foreach($file as $dt_file)

			{

				if(file_exists($data->dir_direktori.$dt_file) == 1)

				{

					$hasil[] = '1';

				}

				else

				{

					$hasil[] = '0';

				}				

			}			



			$cari = array_search("0", $hasil);

			if($cari == "")

			{

				return TRUE;

			}

			else

			{

				return FALSE;

			}

		}

		else

		{

			return FALSE;

		}

	}



	function import()

	{

		$file = array("datscale.DBF","tabbrg.DBF","tabcust.DBF","tabstf.DBF","tabtara.DBF","tabtrsp.DBF");



		$kueri = $this->db->query("SELECT * FROM direktori");

		if($kueri->num_rows() > 0)

		{

			$data = $kueri->row();



			foreach($file as $dt_file)

			{				

				$db_path = $data->dir_direktori.$dt_file;



				$tabel = explode(".", $dt_file);			

				$this->import_dbf($tabel[0], $db_path);				

			}			



			if($this->db->affected_rows() > 0)

			{

				echo "ok";

			}

			else

			{

				echo "gagal";

			}

		}				

	}



	function import_dbf($table, $dbf_file)

	{

		$status = array();



		$cek = array(

			'datscale'		=> 'notrans',

			'tabbrg'		=> 'kodebrg',

			'tabcust'		=> 'kodecust',

			'tabstf'		=> 'stfid',

			'tabtara'		=> 'nokend',

			'tabtrsp'		=> 'kodetrsp'

		);

		$field = $cek[$table];

		$fieldm = strtoupper($field);



		if (!$dbf = dbase_open ($dbf_file, 0)){ die("Could not open $dbf_file for import."); }

		$num_rec = dbase_numrecords($dbf);

		$num_fields = dbase_numfields($dbf);		



		$min = $this->cekJumlah($table,$field) + 1;



		$j = 1;

		for ($i=$min; $i<=$num_rec; $i++)

		{

			if($j <= 100)

			{

				$row = @dbase_get_record_with_names($dbf,$i);

				$q = "INSERT INTO ".$table." VALUES (";

				foreach ($row as $key => $val)

				{	

					if ($key == 'deleted'){ continue; }

					$q .= "'" . addslashes(trim($val)) . "',";				

				}



				if (isset($extra_col_val)){ $q .= "'$extra_col_val',"; }

				$q = substr($q, 0, -1);

				$q .= ')';						

				$dupli = $this->cekDuplicate($table,$field,addslashes(trim($row[$fieldm])));

				if($dupli == 0)

				{

					$kueri = $this->db->query($q);					

				}				

			}			

			$j++;

		}	

	}



	function cekJumlah($tabel,$field)

	{		

		$kueri = $this->db->query("SELECT * FROM $tabel ORDER BY $field DESC");

		if($kueri->num_rows() > 0)

		{

			$data = $kueri->row();

			return $data->$field;

		}

		else

		{

			return 0;

		}

	}



	function cekDuplicate($tabel,$field,$jum)

	{		

		$sql = "SELECT * FROM $tabel WHERE $field='$jum'";

		$kueri = $this->db->query($sql);

		return $kueri->num_rows();		

	}

	function getBerita()
	{
		$kueri = $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC");
		return $kueri->result();
	}

}

?>