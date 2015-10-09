<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perijinan extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library(array('arey','excel'));
		$this->load->helper('tanggal');
		$this->load->model('mlaporan','',TRUE);

		if($this->session->userdata('user_level') != 2)
		{
			redirect('dashboard');
		}
	}

	function index()
	{
		redirect('laporan/harian');
	}

	function scanning()
	{
		$data = array(
			'main'			=> 'scanning',
			'perijinan'		=> 'select',
			'skpd'			=> $this->arey->skpd(),
			'jam'			=> $this->arey->jam(),
			'menit'			=> $this->arey->menit(),
			'pegawai'		=> $this->mlaporan->getPegawai($this->session->userdata('cab_id_auto')),
			'status'		=> $this->mlaporan->getStatus()
		);

		$this->load->view('template',$data);
	}

	function submit_scanning()
	{
		$nama = $this->input->post('nama',TRUE);		

		foreach($nama as $dt_nama)
		{
			$this->mlaporan->setScanning($dt_nama,$this->session->userdata('user_email'));
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Ijin Scanning Berhasil');
			redirect('perijinan/scanning');
		}
		else
		{
			$this->message->set('notice','Ijin Scanning Gagal');
			redirect('perijinan/scanning');
		}
	}

	function absensi()
	{
		$data = array(
			'main'			=> 'absensi',
			'perijinan'		=> 'select',
			'skpd'			=> $this->arey->skpd(),
			'pegawai'		=> $this->mlaporan->getPegawai($this->session->userdata('cab_id_auto')),
			'absen'			=> $this->mlaporan->getAbsensi()
		);

		$this->load->view('template',$data);
	}

	function submit_absensi()
	{
		$nama = $this->input->post('nama',TRUE);

		foreach($nama as $dt_nama)
		{
			$this->mlaporan->setAbsensi($dt_nama,$this->session->userdata('user_email'));
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Ijin Absensi Berhasil');
			redirect('perijinan/absensi');
		}
		else
		{
			$this->message->set('notice','Ijin Absensi Gagal');
			redirect('perijinan/absensi');
		}
	}
}