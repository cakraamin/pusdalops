<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Background extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mberita','',TRUE);
		$this->load->helper('header');
		$this->load->library(array('page','SimpleLoginSecure','arey'));

		$this->load->library('acl',$this->session->userdata('user_id'));

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index()
	{
		$data = array(	  		
			'main'			=> 'background',			
			'background'	=> 'select',
			'link'			=> 'simpan_berita/'.$this->session->userdata('user_id'),
			'ket'			=> 'Update Background',
			'jenis'			=> 'Update'
		);		
			
		$this->load->view('template',$data);
	}

	function upload()
	{		
		$config['upload_path'] = './uploads/background/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '1000000';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->message->set('notice','Background Gagal Upload');
		}
		else
		{
			unlink('./'.$this->input->post('gambar',TRUE));
			$this->message->set('succes','Background Berhasil Upload');
		}
		redirect('background');
	}
}