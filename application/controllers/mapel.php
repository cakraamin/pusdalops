<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapel extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mmapel','',TRUE);
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

		$tingkat = $this->mmapel->getTingkatSchool($this->session->userdata('id_school'));		
		if($tingkat['tingkat'] == 0)
		{
			$this->message->set('notice','Maaf jenjang sekolah belum ditentukan');
		}

		$ta_aktif = $this->mmapel->getTaAktif();

		$data = array(	  		
			'main'			=> 'frmMapel',
			'ket'			=> 'Form Data Fasilitas Sekolah',
			'jenis'			=> 'Tambah',
			'mapel'			=> 'select',
			'link'			=> 'simpan_mapel/'.$ta_aktif['tahun'],
			'kueri'			=> $this->mmapel->getListMapel($ta_aktif['tahun'],$tingkat['tingkat'],$this->session->userdata('id_school'))
		);
			
		$this->load->view('template',$data);
	}

	function simpan_mapel($id="")
	{	
		$kode = $this->input->post('kode');
		$ta_aktif = $this->mmapel->getTaAktif();

		foreach($kode as $dt_kode)
		{
			echo $this->mmapel->addDetailMapel($dt_kode,$ta_aktif['tahun']);
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Mata pelajaran berhasil ditambahkan');			
		}
		else
		{
			$this->message->set('notice','Mata pelajaran gagal ditambahkan');
		}

		redirect('mapel');
	}
}