<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('msekolah','',TRUE);
		$this->load->library(array('page','SimpleLoginSecure','arey'));

		$this->load->library('acl',$this->session->userdata('user_id'));

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index()
	{
		$kueri = $this->msekolah->getSekolahDetail($this->session->userdata('user_id'));
		$ta_aktif = $this->msekolah->getTaAktif();

		$data = array(	  		
			'main'			=> 'frmSekolah',
			'ket'			=> 'Form Data Sekolah',
			'jenis'			=> 'Tambah',
			'sek'			=> 'select',
			'link'			=> 'simpan_sekolah/'.$this->session->userdata('id_school').'/'.$ta_aktif['tahun'],
			'kecamatan'		=> $this->msekolah->getSelekKec(),
			'status'		=> $this->arey->getStatus(),
			'kueri'			=> $kueri,			
			'kepala'		=> $this->msekolah->getKepSek($this->session->userdata('id_school')),
			'kelompok'		=> $this->arey->getKelompok(),
			'iso'			=> $this->arey->getSertifikat(),
			'klasifikasi'	=> $this->arey->getKlasifikasi(),
			'akreditasi'	=> $this->arey->getAkreditasi(),
			'provider'		=> $this->arey->getProvider(),
			'kelompoky'		=> $this->arey->getKelompokY(),
			'tahun'			=> $this->arey->getTahunDiri(),
			'akreditasi'	=> $this->arey->getAkreditasi(),
			'status_mutu'	=> $this->arey->getStatusMutu(),
			'kategori'		=> $this->arey->getKetegori(),
			'waktu'			=> $this->arey->getWaktu(),
			'waktuwp'		=> $this->arey->getWaktuWp(),
			'waktupra'		=> $this->arey->getWaktuPra(),
			'ket_sk'		=> $this->arey->getKetSK(),
			'inklusi'		=> $this->arey->YaTidak()
		);
			
		$this->load->view('template',$data);
	}

	function simpan_sekolah($id,$thn)
	{		
		if($this->msekolah->cekNpsn($id))
		{
			$this->message->set('notice','Maaf NPSN tidak boleh sama');
			redirect('sekolah');	
		}

		if($this->msekolah->cekNss($id))
		{
			$this->message->set('notice','Maaf NSS tidak boleh sama');
			redirect('sekolah');	
		}

		if($thn == 0)
		{
			$this->message->set('notice','Tidak ada Tahun Ajaran yang aktif');
			redirect('sekolah');
		}

		$kueri = $this->msekolah->updateSekolah($id,$thn);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Update data sekolah berhasil');
		}
		else
		{
			$this->message->set('notice','Update data sekolah gagal');
		}

		redirect('sekolah');
	}
}