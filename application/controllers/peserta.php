<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mpeserta','',TRUE);
		$this->load->library(array('page','SimpleLoginSecure','arey'));

		$this->load->library('acl',$this->session->userdata('user_id'));

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index()
	{
		$kelas = 0;

		$tingkat = $this->mpeserta->getTingkatSchool($this->session->userdata('id_school'));		
		if($tingkat['tingkat'] == 0)
		{
			$this->message->set('notice','Maaf jenjang sekolah belum ditentukan');
		}

		$ta_aktif = $this->mpeserta->getTaAktif();

		$data = array(	  		
			'main'			=> 'frmPeserta',
			'ket'			=> 'Form Data Peserta UN',
			'jenis'			=> 'Tambah',
			'peserta'		=> 'select',
			'link'			=> 'simpan_peserta/'.$ta_aktif['tahun'],
			'kueri'			=> $this->mpeserta->getListProdi($ta_aktif['tahun'],$tingkat['tingkat'],$this->session->userdata('id_school'))
		);
			
		$this->load->view('template',$data);
	}

	function simpan_peserta($id="")
	{	
		$kode = $this->input->post('kode');
		$ta_aktif = $this->mpeserta->getTaAktif();

		foreach($kode as $dt_kode)
		{
			echo $this->mpeserta->addDetailProdi($dt_kode,$ta_aktif['tahun']);
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Peserta UN berhasil ditambahkan');			
		}
		else
		{
			$this->message->set('notice','Peserta UN gagal ditambahkan');
		}

		redirect('peserta');
	}
}