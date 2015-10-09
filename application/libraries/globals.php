<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Globals

{

	function Globals()

	{

		$this->ci =& get_instance();

		$this->ci->load->model('mglobal','',TRUE);

	}	



	function cek()

	{

		$cek = $this->ci->mglobal->getDirektori();

		if(!$cek)

		{

			$this->ci->message->set('notice','Setting Direktori Kosong[<a href="'.base_url().'setting">Setting</a>]');			

		}

	}

	function import()

	{

		$this->ci->mglobal->import();

	}

	function notification($id)
	{
		$jumlah = 0;
		$detail = array();
		$links = "";

		$berita = $this->ci->mglobal->getBerita();
		foreach($berita as $dt_berita)
		{
			$mystring = $dt_berita->read_berita;
			$pecah = explode(",", $mystring);
			$key = array_search($id, $pecah);
			if($key == "")
			{
				$jumlah = $jumlah + 1;
				$detail[] = $dt_berita->id_berita;				
			}
			else
			{				
				$jumlah = $jumlah;				
			}			
		}

		foreach ($detail as $dt_detail) 
		{
			$links = $links."-".$dt_detail;
		}

		$jml = ($jumlah == 0)?'':'<div class="notification" >'.$jumlah.'</div>';
		$data = array(
			'jml'		=> $jml,
			'detail'	=> $links
		);
		return $data;
	}

}

