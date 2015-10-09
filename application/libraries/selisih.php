<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Selisih
{
	function Selisih()
	{
	
	}
	
	function hitung($tgl1,$tgl2)
	{
		$tanggal1 = strtotime($tgl1);
		$tanggal2 = strtotime($tgl2);
		$selisih = $tanggal2 - $tanggal1;
		if($selisih > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
