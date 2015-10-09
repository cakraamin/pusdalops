<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('muser','',TRUE);
		$this->load->library(array('page','SimpleLoginSecure','arey'));

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index($short_by='nameid',$short_order='asc',$page=0)
	{
		$per_page = 20;
		$total_page = $this->db->count_all('users');
		$url = 'user/daftar/'.$short_by.'/'.$short_order.'/';
		
		$query = $this->muser->getMember($per_page,$page,$short_by,$short_order);
		if(count($query) == 0 && $page != 0)
		{
			redirect('user/daftar/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}
				
		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),
			'main'			=> 'users',
			'user'			=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page
		);
		$this->load->view('template',$data);
	}

	function daftar($short_by='nameid',$short_order='asc',$page=0)
	{
		$per_page = 20;
		$total_page = $this->db->count_all('users');
		$url = 'user/daftar/'.$short_by.'/'.$short_order.'/';
		
		$query = $this->muser->getMember($per_page,$page,$short_by,$short_order);
		if(count($query) == 0 && $page != 0)
		{
			redirect('user/daftar/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}
				
		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),
			'main'			=> 'users',
			'user'			=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page
		);
		$this->load->view('template',$data);
	}

	function tambah()
	{
		$data = array(	  
			'user'			=> 'select',
			'main'			=> 'addUser',
			'ket'			=> 'Form User',
			'jenis'			=> 'Tambah',
			'link'			=> 'simpan',
			'level'			=> $this->arey->level(),
			'skpd'			=> $this->muser->getSpkd()
		);
			
		$this->load->view('template',$data);
	}

	function edit($id,$nama="")
	{
		if($id == '')
		{
			$this->message->set('notice','Maaf parameter salah');
			redirect('user');
		}

		if($nama == "")
		{
			$re = "user";
		}
		else
		{
			$re = "dashboard";
		}

		$data = array(	  
			'user'			=> 'select',
			'main'			=> 'editUsers',
			'ket'			=> 'Form User',
			'jenis'			=> 'Edit',
			'kueri'			=> $this->muser->editUser($id),
			'link'			=> 'update/'.$id,
			're'			=> $re,
			'nama'			=> $nama,
			'id'			=> $id
		);
			
		$this->load->view('template',$data);
	}
	
	function simpan()
	{		
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
		$level = $this->input->post('level',TRUE);
		$skpd = $this->input->post('skpd',TRUE);
		if($this->simpleloginsecure->cek($username)) 
		{
			$this->message->set('notice','Nama user sudah digunakan');
		}
		else
		{
			if($this->simpleloginsecure->create($username, $password, $level, $skpd))
			{
				$this->message->set('succes','User berhasil dibuat');
			}
			else
			{
				$this->message->set('notice','User gagal dibuat');
			}
		}
		redirect('user');
	}
	
	function update($id)
	{
		$username = $this->input->post('username',TRUE);
		$old = $this->input->post('oldpassword',TRUE);
		$new = $this->input->post('password',TRUE);
		$re = $this->input->post('re',TRUE);
		if($this->simpleloginsecure->edit_password($username, $old, $new))
		{
			$this->message->set('succes','Update password user berhasil');
		}
		else
		{
			$this->message->set('notice','Maaf update password user gagal');
		}
		redirect($re);
	}
	
	function hapus($id)
	{
		if($this->simpleloginsecure->delete($id))
		{
			$this->message->set('succes','User berhasil dihapus');
		}
		else
		{
			$this->message->set('notice','User gagal dihapus');
		}
		redirect('user');
	}

	function all()
	{
		$cek = $this->input->post('check');
		if(!is_array($cek))
		{
			$this->message->set('notice','Tidak ada user yang dipilih');
			redirect('user');
		}
		foreach($cek as $dt_cek)
		{
			$this->simpleloginsecure->delete($dt_cek);
		}
		$this->message->set('succes','User berhasil dihapus');
		redirect('user');
	}
}