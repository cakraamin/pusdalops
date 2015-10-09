<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('msiswa','',TRUE);
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

		$tingkat = $this->msiswa->getTingkatSchool($this->session->userdata('id_school'));		
		if($tingkat['tingkat'] == 0)
		{
			$this->message->set('notice','Maaf jenjang sekolah belum ditentukan');
		}

		$ta_aktif = $this->msiswa->getTaAktif();

		if($this->arey->getJenjang($tingkat['tingkat']) == "SD/MI")
		{
			$kelas = 6;
		}
		else
		{
			$kelas = 3;
		}

		$data = array(	  		
			'main'			=> 'formSiswa',
			'ket'			=> 'Form Data Siswa',
			'jenis'			=> 'Tambah',
			'siswa'			=> 'select',
			'link'			=> 'simpan_sekolah/'.$ta_aktif['tahun'],
			'kelas'			=> $kelas,
			'jenjang'		=> $this->arey->getJenjang($tingkat['tingkat']),
			'kueri'			=> $this->msiswa->getDetailSiswa($ta_aktif['tahun'],$kelas),
			'nilai'			=> $this->msiswa->getUmur($tingkat['tingkat']),
			'prodi'			=> $this->msiswa->getProdi($tingkat['tingkat'],$kelas),
			'nonprodi'		=> $this->msiswa->getNonProdi($tingkat['tingkat'],$kelas)
		);
			
		$this->load->view('template',$data);
	}

	function simpan_siswa($id="")
	{	
		$ta_aktif = $this->msiswa->getTaAktif();

		$this->msiswa->addDetailSiswa($ta_aktif['tahun']);

		if($this->db->affected_rows() > 0)
		{
			if($id == "")
			{
				$this->message->set('succes','Data siswa berhasil ditambahkan');
				redirect('siswa');
			}
			else
			{
				echo "ok";
			}			
		}
		else
		{
			if($id == "")
			{
				$this->message->set('notice','Data siswa gagal ditambahkan');
				redirect('siswa');
			}
			else
			{
				echo "gagal";
			}			
		}
	}
}