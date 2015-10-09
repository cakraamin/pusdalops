<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mberita','',TRUE);
		$this->load->library(array('page','SimpleLoginSecure','arey'));

		$this->load->library('acl',$this->session->userdata('user_id'));

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index()
	{
		redirect('berita/daftar');
	}

	function unread($arey)
	{							
		$data = array(
			'kueri' 		=> $this->mberita->getBeritaUnread($arey),
			'main'			=> 'unread',
			'berita'		=> 'select'			
		);
		$this->load->view('template',$data);
	}

	function daftar($short_by='a.id_berita',$short_order='desc',$page=0)
	{
		$per_page = 20;
		$total_page = $this->db->count_all('berita');
		$url = 'berita/daftar/'.$short_by.'/'.$short_order.'/';
		
		$query = $this->mberita->getBerita($per_page,$page,$short_by,$short_order);
		if(count($query) == 0 && $page != 0)
		{
			redirect('berita/daftar/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}
				
		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),
			'main'			=> 'berita',
			'berita'		=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page
		);
		$this->load->view('template',$data);
	}

	function tambah_berita()
	{		
		$data = array(	  		
			'main'			=> 'form_berita',			
			'berita'		=> 'select',
			'link'			=> 'simpan_berita/'.$this->session->userdata('user_id'),
			'ket'			=> 'Tambah Berita',
			'jenis'			=> 'Tambah'
		);		
			
		$this->load->view('template',$data);
	}	

	function simpan_berita($id)
	{		
		if($_FILES["userfile"]["name"] == "")
		{
			$this->mberita->addBerita($id);
		}
		else
		{
			$config['upload_path'] = './uploads/gambar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '100000';
			$config['max_width']  = '3024';
			$config['max_height'] = '2068';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$this->message->set('notice',$this->upload->display_errors());
			}
			else
			{
				$data = $this->upload->data();

				$this->mberita->addBerita($id,$data['file_name']);				
			}
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Berita berhasil dibuat');
		}
		else
		{
			$this->message->set('notice','Berita gagal dibuat');
		}

		redirect('berita/daftar');
	}

	function hapus_berita($id,$short_by,$short_order,$page)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');
			redirect('berita/daftar');
		}

		if($this->mberita->deleteBerita($id))
		{
			$this->message->set('succes','Berita berhasil dihapus');
		}
		else
		{
			$this->message->set('notice','Berita gagal dihapus');
		}
		redirect('berita/daftar/'.$short_by.'/'.$short_order.'/'.$page);
	}

	function edit_berita($id,$short_by,$short_order,$page)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');
			redirect('berita/daftar/'.$short_by.'/'.$short_order.'/'.$page);
		}

		$data = array(	  	
			'main'			=> 'form_berita',
			'ket'			=> 'Form Data Guru',
			'jenis'			=> 'Edit',
			'berita'		=> 'select',
			'link'			=> 'update_berita/'.$id.'/'.$short_by.'/'.$short_order.'/'.$page,
			'kueri'			=> $this->mberita->getBeritaId($id)			
		);
			
		$this->load->view('template',$data);
	}

	function update_berita($id,$short_by,$short_order,$page)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');
			redirect('berita/daftar/'.$short_by.'/'.$short_order.'/'.$page);
		}

		if($_FILES["userfile"]["name"] == "")
		{
			$this->mberita->updateBerita($id);
		}
		else
		{
			$config['upload_path'] = './uploads/gambar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '100000';
			$config['max_width']  = '3024';
			$config['max_height'] = '2068';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$this->message->set('notice',$this->upload->display_errors());
			}
			else
			{
				$data = $this->upload->data();

				$this->mberita->updateBerita($id,$data['file_name']);			
			}
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Berita berhasil diupdate');
		}
		else
		{
			$this->message->set('notice','Berita gagal diupdate');
		}		
		
		redirect('berita/daftar/'.$short_by.'/'.$short_order.'/'.$page);
	}	

	function all_berita($short_by,$short_order,$page)
	{
		$cek = $this->input->post('check');
		if(!is_array($cek))
		{
			$this->message->set('notice','Tidak ada berita yang dipilih');
			redirect('berita/daftar/'.$short_by.'/'.$short_order.'/'.$page);
		}
		foreach($cek as $dt_cek)
		{
			$this->mberita->deleteBerita($dt_cek);
		}
		$this->message->set('succes','Data guru berhasil dihapus');
		redirect('berita/daftar/'.$short_by.'/'.$short_order.'/'.$page);
	}
}