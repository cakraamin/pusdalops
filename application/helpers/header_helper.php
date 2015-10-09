<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_header'))
{
    function get_header()
    {
		$dir = "uploads/background/";
		if ($handle = opendir($dir)) 
		{		
		   while (false !== ($file = readdir($handle)))
		   {
		   		$ext = explode(".",$file);
				$eks = $ext[count($ext) - 1];
			   	if($file == '.' || $file == '..' || $eks == 'db') continue;
			   	$path = $dir.$file;
		   }	   
		   closedir($handle);
		}
		return '<img src="'.base_url().$path.'" width="100%" />';
    }	
}

if ( ! function_exists('get_img'))
{
    function get_img()
    {
		$dir = "uploads/background/";
		if ($handle = opendir($dir)) 
		{		
		   while (false !== ($file = readdir($handle)))
		   {
		   		$ext = explode(".",$file);
				$eks = $ext[count($ext) - 1];
			   	if($file == '.' || $file == '..' || $eks == 'db') continue;
			   	$path = $dir.$file;
		   }	   
		   closedir($handle);
		}
		return $path;
    }	
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */