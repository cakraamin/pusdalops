<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Uang
{
	function Uang()
	{
	
	}
	
	function nominal($a)
	{
		$a = str_replace(".","",$a);
		$a = strrev($a);
		$panjang = strlen($a);
		$uang = "";
		for($i=0;$i<$panjang;$i+=3)
		{
			$uang .= ".".substr($a,$i,3);
		}
		$panjangjadi = strlen($uang)-1;
		$uang = substr($uang,1,$panjangjadi);
		$uang = strrev($uang);
		return $uang;
	}
	
	function terbilang($a)
	{
		$a = str_replace(".","",$a);
		$a = strrev($a);
		$panjang = strlen($a);
		$uang = "";
		for($i=0;$i<$panjang;$i+=3)
		{
			$uang .= ".".substr($a,$i,3);
		}
		$panjangjadi = strlen($uang)-1;
		$uang = substr($uang,1,$panjangjadi);
		$uang = strrev($uang);
		return "Rp. ".$uang.",-";
	}
	
	function bilangan($a)
	{
		return $a;
	}
}
