<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mberita','',TRUE);
		$this->load->helper('header');
		$this->load->library('arey');

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index()
	{
		$tahun = date("Y");

		$data = array(
			'home'			=> 'select',
			'main'			=> 'home',
			'roles'			=> $this->mberita->getRole($this->session->userdata('user_id')),
			'grafik'		=> $this->mberita->getGrafik(),
			'lokasi'		=> $this->mberita->getGrafikBencana(),
			'rusak'			=> $this->mberita->getGrafikRusak(),
			'tahunan'		=> $this->mberita->getGrafikTahunan($tahun),
			'tahun'			=> $tahun,
		);

		$this->load->view('template',$data);
	}	
}