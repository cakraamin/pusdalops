<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('msetting','',TRUE);
		$this->load->library(array('page','SimpleLoginSecure','arey'));

		$this->load->library('acl',$this->session->userdata('user_id'));

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index()
	{
		$kueri = $this->msetting->getDirektori();
		$links = (isset($kueri->id_direktori))?"setting/update/".$kueri->id_direktori:"setting/simpan";

		$data = array(
			'ket'		=> 'Setting Direktori',
			'main'		=> 'setting',
			'link'		=> $links,
			'jenis'		=> 'Simpan',
			'kueri'		=> $kueri

		);

		$this->load->view('template',$data);
	}

	function import()
	{
		$this->globals->import();
	}

	function simpan()
	{
		$kueri = $this->msetting->addSetting();

		if($this->db->affected_rows() > 0)
		{			
			$this->message->set('succes','Update Data Setting Berhasil');
		}
		else
		{
			$this->message->set('notice','Update Data Setting Gagal');
		}

		redirect('setting');		
	}

	function update($id)
	{
		$kueri = $this->msetting->updateSetting($id);

		if($this->db->affected_rows() > 0)
		{			
			$this->message->set('succes','Update Data Setting Berhasil');
		}
		else
		{
			$this->message->set('notice','Update Data Setting Gagal');
		}

		redirect('setting');
	}
}