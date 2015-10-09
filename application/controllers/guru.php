<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guru extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mguru','',TRUE);
		$this->load->library(array('page','SimpleLoginSecure','arey'));

		$this->load->library('acl',$this->session->userdata('user_id'));

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index()
	{
		redirect('guru/daftar');
	}

	function daftar($short_by='id_school',$short_order='desc',$page=0)
	{
		$per_page = 20;
		$total_page = $this->db->count_all('guru WHERE id_school="'.$this->session->userdata('id_school').'"');
		$url = 'guru/daftar/'.$short_by.'/'.$short_order.'/';
		
		$query = $this->mguru->getGuru($per_page,$page,$short_by,$short_order);
		if(count($query) == 0 && $page != 0)
		{
			redirect('guru/daftar/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}
				
		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),
			'main'			=> 'guru',
			'guru'			=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page
		);
		$this->load->view('template',$data);
	}

	function tambah_guru()
	{		
		$data = array(	  		
			'main'			=> 'formGuru',
			'ket'			=> 'Form Guru',
			'jenis'			=> 'Tambah',
			'guru'			=> 'select',
			'link'			=> 'simpan_guru/'.$this->session->userdata('id_school'),
			'jabatan'		=> $this->arey->getJabatan(),
			'status'		=> $this->arey->getStatusGuru(),
			'kendaraan'		=> $this->arey->getKendaraan(),
			'tanggal'		=> $this->arey->getTanggal(),
			'bulan'			=> $this->arey->getBulan(),
			'tahun'			=> $this->arey->getTahun(),
			'statuspeg'		=> $this->arey->getStatusPeg(),
			'tunjangan'		=> $this->arey->getTunjangan(),
			'sertif'		=> $this->arey->tahunSertif(),
			'jenisKel'		=> $this->arey->getJenisKel()
		);		
			
		$this->load->view('template',$data);
	}

	function edit_guru($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');
			redirect('guru/daftar');
		}

		$data = array(	  	
			'main'			=> 'formGuru',
			'ket'			=> 'Form Data Guru',
			'jenis'			=> 'Edit',
			'master'		=> 'select',
			'link'			=> 'update_guru/'.$id,
			'kueri'			=> $this->mguru->editGUru($id),
			'jabatan'		=> $this->arey->getJabatan(),
			'status'		=> $this->arey->getStatusGuru(),
			'kendaraan'		=> $this->arey->getKendaraan(),
			'tanggal'		=> $this->arey->getTanggal(),
			'bulan'			=> $this->arey->getBulan(),
			'tahun'			=> $this->arey->getTahun(),
			'statuspeg'		=> $this->arey->getStatusPeg(),
			'tunjangan'		=> $this->arey->getTunjangan(),
			'sertif'		=> $this->arey->tahunSertif(),
			'jenisKel'		=> $this->arey->getJenisKel()
		);
			
		$this->load->view('template',$data);
	}

	function simpan_guru($id)
	{
		if($this->mguru->cekNipGuru() > 0)
		{
			$this->message->set('notice','Maaf NIP tidak boleh sama');
			redirect('guru/tambah_guru');
		}

		$this->mguru->addGuru($id);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data guru berhasil dibuat');
		}
		else
		{
			$this->message->set('notice','Data guru gagal dibuat');
		}

		redirect('guru/daftar');
	}

	function update_guru($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');
			redirect('guru/daftar');
		}

		$this->mguru->updateGuru($id);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data guru berhasil diupdate');
		}
		else
		{
			$this->message->set('notice','Data guru gagal diupdate');
		}
		redirect('guru/daftar');
	}

	function hapus_guru($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');
			redirect('guru/daftar');
		}

		if($this->mguru->deleteGuru($id))
		{
			$this->message->set('succes','Data guru berhasil dihapus');
		}
		else
		{
			$this->message->set('notice','Data guru gagal dihapus');
		}
		redirect('guru/daftar');
	}

	function all_sekolah()
	{
		$cek = $this->input->post('check');
		if(!is_array($cek))
		{
			$this->message->set('notice','Tidak ada data guru yang dipilih');
			redirect('guru/daftar');
		}
		foreach($cek as $dt_cek)
		{
			$this->mguru->deleteGuru($dt_cek);
		}
		$this->message->set('succes','Data guru berhasil dihapus');
		redirect('guru/daftar');
	}
}