<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('bilang'))
{
	function bilang($var)
	{	
		$bil = (isset($var))?$var:0;

        return $bil;
	}    
}