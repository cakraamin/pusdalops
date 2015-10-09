<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('members'))
{
	function members($var)
	{
		if($var == 'ad')
		{
			$nilai = 'Admin';
		}
		elseif($var == 'op')
		{
			$nilai = 'Operator';
		}
		elseif($var == 'pn')
		{
			$nilai = 'Peneliti';
		}
		else
		{
			$nilai = 'Viewer';
		}
		return $nilai;
	}
}

if ( ! function_exists('bilangan_uang'))
{
	function bilangan_uang($var)
	{
		$uang = $var;
		$koma = ',';
		$cari = strpos($uang,$koma);
		
		if($cari == true)
		{
			$uang = str_replace($koma,"",$uang);
		}
		$titik = ".";
		$cari = strpos($uang,$titik);
		if($cari == true)
		{
			$uang = str_replace($titik,"",$uang);
		}
		$uang = doubleval($uang);
		return number_format($uang,"2",",",".");
	}
}