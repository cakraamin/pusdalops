<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuesioner extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mkuesioner','',TRUE);
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

		$tingkat = $this->mkuesioner->getTingkatSchool($this->session->userdata('id_school'));		
		if($tingkat['tingkat'] == 0)
		{
			$this->message->set('notice','Maaf jenjang sekolah belum ditentukan');
		}

		$ta_aktif = $this->mkuesioner->getTaAktif();

		$data = array(	  		
			'main'			=> 'frmKuesioner',
			'ket'			=> 'Form Data Kuesioner',
			'jenis'			=> 'Tambah',
			'kuesioner'		=> 'select',
			'link'			=> 'simpan_kuesioner/'.$ta_aktif['tahun'],
			'kueri'			=> $this->mkuesioner->getListKuesioner($ta_aktif['tahun'],$tingkat['tingkat'],$this->session->userdata('id_school'),$tingkat['jenjang'])
		);
			
		$this->load->view('template',$data);
	}

	function simpan_kuesioner($id="")
	{	
		$kode = $this->input->post('kode');
		$ta_aktif = $this->mkuesioner->getTaAktif();

		foreach($kode as $dt_kode)
		{
			echo $this->mkuesioner->addDetailKuesioner($dt_kode,$ta_aktif['tahun']);
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data kuesioner berhasil ditambahkan');			
		}
		else
		{
			$this->message->set('notice','Data kuesioner gagal ditambahkan');
		}

		redirect('kuesioner');
	}
}