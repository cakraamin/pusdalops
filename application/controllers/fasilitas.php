<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fasilitas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mfasilitas','',TRUE);
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

		$tingkat = $this->mfasilitas->getTingkatSchool($this->session->userdata('id_school'));		
		if($tingkat['tingkat'] == 0)
		{
			$this->message->set('notice','Maaf jenjang sekolah belum ditentukan');
		}

		$ta_aktif = $this->mfasilitas->getTaAktif();

		$data = array(	  		
			'main'			=> 'frmFasilitas',
			'ket'			=> 'Form Data Fasilitas Sekolah',
			'jenis'			=> 'Tambah',
			'fasilitas'		=> 'select',
			'link'			=> 'simpan_fasilitas/'.$ta_aktif['tahun'],
			'kueri'			=> $this->mfasilitas->getListFasilitas($ta_aktif['tahun'],$tingkat['tingkat'],$this->session->userdata('id_school'))
		);
			
		$this->load->view('template',$data);
	}

	function tanah()
	{
		$kelas = 0;

		$tingkat = $this->mfasilitas->getTingkatSchool($this->session->userdata('id_school'));		
		if($tingkat['tingkat'] == 0)
		{
			$this->message->set('notice','Maaf jenjang sekolah belum ditentukan');
		}

		$ta_aktif = $this->mfasilitas->getTaAktif();

		$data = array(	  		
			'main'			=> 'frmTanah',
			'ket'			=> 'Form Tanah Sekolah',
			'jenis'			=> 'Tambah',
			'fasilitas'		=> 'select',
			'link'			=> 'simpan_tanah/'.$this->session->userdata('id_school')."/".$ta_aktif['tahun'],
			'kueri'			=> $this->mfasilitas->getListTanah($this->session->userdata('id_school'),$ta_aktif['tahun'])
		);
			
		$this->load->view('template',$data);
	}

	function detil($id,$nama)
	{
		$kelas = 0;

		$tingkat = $this->mfasilitas->getTingkatSchool($this->session->userdata('id_school'));		
		if($tingkat['tingkat'] == 0)
		{
			$this->message->set('notice','Maaf jenjang sekolah belum ditentukan');
		}

		$ta_aktif = $this->mfasilitas->getTaAktif();

		$data = array(	  		
			'main'			=> 'frmFasilitas',
			'ket'			=> 'Form Data Fasilitas Sekolah',
			'jenis'			=> 'Tambah',
			'fasilitas'		=> 'select',
			'link'			=> 'simpan_fasilitas/'.$id."/".$nama,
			'kueri'			=> $this->mfasilitas->getListFasilitas($ta_aktif['tahun'],$tingkat['tingkat'],$this->session->userdata('id_school'),$id),
			'id'			=> $id
		);
			
		$this->load->view('template',$data);
	}

	function simpan_tanah($id,$thn)
	{

		$this->mfasilitas->addTanahSekolah($id,$thn);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data tanah sekolah berhasil ditambahkan');			
		}
		else
		{
			$this->message->set('notice','Data tanah sekolah gagal ditambahkan');
		}

		redirect('fasilitas/tanah');
	}

	function simpan_fasilitas($ids,$nama)
	{	
		$nilai = $this->input->post('nilai');
		$ta_aktif = $this->mfasilitas->getTaAktif();

		for($i=1;$i<=$nilai;$i++)
		{
			$input = $this->input->post('jumlah'.$i);
			$no = 1;
			foreach($input as $dt_input)
			{
				$id = $this->input->post('kode'.$i);

				$this->mfasilitas->addDetailFasilitas($id,$ta_aktif['tahun'],$no,$dt_input);
				$no++;
			}
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data fasilitas sekolah berhasil ditambahkan');			
		}
		else
		{
			$this->message->set('notice','Data fasilitas sekolah gagal ditambahkan');
		}

		redirect('fasilitas/detil/'.$ids.'/'.$nama);
	}
}