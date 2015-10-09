<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gbr_lib {

	var $create_thumb		= FALSE;
	var $create_crop		= FALSE;
	var $width				= '';
	var $height				= '';
	var $source_folder	= '';	
	var $dest_thumb		= '';	
	var $dest_crop			= '';
	var $file_name			= '';
	var $CI					= NULL;
			 
	public function __construct($props = array())
	{
		$this->CI =& get_instance();
		
		if (count($props) > 0)
		{
			$this->initialize($props);
		}

		log_message('debug', "Library Image Gagal Diinisialisasi");
	}

	function initialize($props = array())
	{
		if (count($props) > 0)
		{
			foreach ($props as $key => $val)
			{
				$this->$key = $val;
			}
		}
		
		if ($this->file_name == '')
		{
			$this->set_error('Sumber File Tidak Ditemukan');
			return FALSE;	
		}
		
		if ($this->source_folder == '')
		{
			$this->set_error('Folder Sumber File Tidak Ditemukan');
			return FALSE;	
		}
		
		if ($this->width == '')
		{
			$this->set_error('Lebar Gambar yang Diinginkan Belum Dimasukkan');
			return FALSE;	
		}
		
		if ($this->height == '')
		{
			$this->set_error('Tinggi Gambar yang diinginkan belum Dimasukkan');
			return FALSE;	
		}
		
		if ($this->dest_thumb == '' && $this->create_thumb == TRUE)
		{
			$this->set_error('Folder Tujuan Thumbnail Belum DItentukan');
			return FALSE;	
		}
		
		if ($this->dest_crop == '' && $this->create_crop == TRUE)
		{
			$this->set_error('Folder Tujuan Crop Belum DItentukan');
			return FALSE;	
		}		
		
		return TRUE;
	}
	
	public function make_thumb()
	{
		if($this->create_thumb == TRUE)
		{
			$this->CI->load->library('image_lib');	
	
			$path = $this->source_folder.$this->file_name;
			$ext = strrchr($path, '.'); 
			$propt_asal = getimagesize($path);
			$width_asal = $propt_asal[0];
			$height_asal = $propt_asal[1];
											
			$config['image_library'] = 'GD2';
			$config['source_image'] = $path;
			$config['master_dim'] = 'width';
			$config['quality'] = 600;
			$config['maintain_ratio'] = TRUE;
			$config['height'] = $this->height;
			$config['width'] = $this->width;	
			
			if($width_asal > $height_asal)
			{
				$config['master_dim'] = 'height';	
			}
			else
			{
				$config['master_dim'] = 'width';	
			}
			$config['new_image'] = $this->dest_thumb.$this->file_name;
			$this->CI->image_lib->initialize($config);
									
			if($this->CI->image_lib->resize())
			{
				return TRUE;
			}
			else
			{
				return FALSE;		
			}
		}
	}
	
	public function make_crop()
	{
		if($this->create_crop == TRUE)
		{
			$this->CI->load->library('image_lib');	
	
			$this->CI->image_lib->clear();
			copy($this->dest_thumb.$this->file_name, $this->dest_crop.$this->file_name);
			$file = $this->dest_crop.$this->file_name;
		
			list($width, $height, $type, $attr) = getimagesize($file);
								
			$image_width = $width;
			$image_height = $height;
			$image_type = $type;
								
			$scale = 1;
			$final_width = $this->width;
			$final_height = $this->height;
								
			$x = $final_width/$image_width;
			$y = $final_height/$image_height;
								
			if($x < $y) 
			{
				$new_width = round($image_width *($final_height/$image_height));
				$new_height = $final_height;
			}
			else 
			{
				$new_height = round($image_height *($final_width/$image_width));
				$new_width = $final_width;
			}
								
			$to_crop_left = ($new_width - ($final_width *$scale))/2; 
			$to_crop_top = ($new_height - ($final_height *$scale))/2;
							
			$config['image_library'] = 'GD2';
			$config['source_image'] = $this->dest_crop.$this->file_name;
			$config['width'] = $final_width;
			$config['height'] = $final_height;								
			$config['x_axis'] = $to_crop_left;
			$config['y_axis'] = $to_crop_top;
			$config['maintain_ratio'] = false;
			$config['new_image'] = $this->dest_crop.$this->file_name;
								
			$this->CI->image_lib->initialize($config);
								
			if ( ! $this->CI->image_lib->crop())
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}	
	}

	function set_error($msg)
	{
		$this->CI->lang->load('imglib');

		if (is_array($msg))
		{
			foreach ($msg as $val)
			{

				$msg = ($this->CI->lang->line($val) == FALSE) ? $val : $this->CI->lang->line($val);
				$this->error_msg[] = $msg;
				log_message('error', $msg);
			}
		}
		else
		{
			$msg = ($this->CI->lang->line($msg) == FALSE) ? $msg : $this->CI->lang->line($msg);
			$this->error_msg[] = $msg;
			log_message('error', $msg);
		}
	}
	
	function display_errors($open = '<p>', $close = '</p>')
	{
		$str = '';
		foreach ($this->error_msg as $val)
		{
			$str .= $open.$val.$close;
		}

		return $str;
	}

}