<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masters extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('mmaster','',TRUE);
		$this->load->library(array('page','SimpleLoginSecure','arey'));
		$this->load->library('acl',$this->session->userdata('user_id'));

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index()
	{
		redirect('masters/propinsi');		
	}	

	function propinsi($short_by='id_propinsi',$short_order='desc',$page=0)
	{
		$per_page = 10;
		$total_page = $this->db->count_all('propinsi');
		$url = 'masters/propinsi/'.$short_by.'/'.$short_order.'/';	

		$query = $this->mmaster->getPropinsi($per_page,$page,$short_by,$short_order);
		if(count($query) == 0 && $page != 0)
		{
			redirect('masters/propinsi/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}	

		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),
			'main'			=> 'propinsi',
			'master'		=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page,
			'totalPage'		=> $total_page
		);

		$this->load->view('template',$data);
	}

	function kabupaten($short_by='id_kabupaten',$short_order='desc',$page=0)
	{
		$per_page = 10;
		$total_page = $this->mmaster->getJumKabupaten();
		$url = 'masters/kabupaten/'.$short_by.'/'.$short_order.'/';

		$query = $this->mmaster->getKabupaten($per_page,$page,$short_by,$short_order);
		if(count($query) == 0 && $page != 0)
		{
			redirect('masters/kabupaten/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}

		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),
			'main'			=> 'kabupaten',
			'master'		=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page,
			'totalPage'		=> $total_page
		);
		$this->load->view('template',$data);
	}

	function kecamatan($kunci='kosong',$short_by='id_kecamatan',$short_order='desc',$page=0)
	{
		$per_page = 10;
		$total_page = $this->mmaster->getJumKecamatan($kunci);
		$url = 'masters/kecamatan/'.$kunci.'/'.$short_by.'/'.$short_order.'/';

		$query = $this->mmaster->getKecamatan($kunci,$per_page,$page,$short_by,$short_order);
		if(count($query) == 0 && $page != 0)
		{
			redirect('masters/kecamatan/'.$kunci.'/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}

		$kunci = ($kunci == 'kosong')?"":str_replace("_", " ", $kunci);

		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=6),
			'main'			=> 'kecamatan',
			'master'		=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page,
			'totalPage'		=> $total_page,
			'kuncine'		=> $kunci
		);

		$this->load->view('template',$data);
	}

	function kelurahan($kunci='kosong',$short_by='id_kelurahan',$short_order='desc',$page=0)
	{
		$per_page = 10;
		$total_page = $this->mmaster->getJumKelurahan($kunci);	
		$url = 'masters/kelurahan/'.$kunci.'/'.$short_by.'/'.$short_order.'/';

		$query = $this->mmaster->getKelurahan($kunci,$per_page,$page,$short_by,$short_order);		
		if(count($query) == 0 && $page != 0)
		{
			redirect('masters/kelurahan/'.$kunci.'/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}	

		$kunci = ($kunci == 'kosong')?"":str_replace("_", " ", $kunci);

		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=6),
			'main'			=> 'kelurahan',
			'master'		=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page,
			'totalPage'		=> $total_page,
			'kuncine'		=> $kunci
		);

		$this->load->view('template',$data);
	}

	function dusun($kunci="kosong",$short_by='id_dusun',$short_order='desc',$page=0)
	{
		$per_page = 10;
		$total_page = $this->mmaster->getJumDusun($kunci);	
		$url = 'masters/dusun/'.$kunci.'/'.$short_by.'/'.$short_order.'/';

		$query = $this->mmaster->getDusun($kunci,$per_page,$page,$short_by,$short_order);		
		if(count($query) == 0 && $page != 0)
		{
			redirect('masters/dusun/'.$kunci.'/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}	

		$kunci = ($kunci == 'kosong')?"":str_replace("_", " ", $kunci);

		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=6),
			'main'			=> 'dusun',
			'master'		=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page,
			'totalPage'		=> $total_page,
			'kuncine'		=> $kunci
		);

		$this->load->view('template',$data);
	}

	function bencana($short_by='id_jenis_bencana',$short_order='desc',$page=0)
	{
		$per_page = 10;
		$total_page = $this->db->count_all('jenis_bencana');	
		$url = 'masters/bencana/'.$short_by.'/'.$short_order.'/';

		$query = $this->mmaster->getBencana($per_page,$page,$short_by,$short_order);		
		if(count($query) == 0 && $page != 0)
		{
			redirect('masters/bencana/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}	

		$data = array(
			'kueri' 		=> $query,
			'page'			=> $page,
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),
			'main'			=> 'bencanas',
			'master'		=> 'select',
			'sort_by' 		=> $short_by,
			'sort_order' 	=> $short_order,			
			'page'			=> $page,
			'totalPage'		=> $total_page
		);

		$this->load->view('template',$data);
	}

	function tambah_propinsi()
	{
		$data = array(	  		
			'main'			=> 'formPropinsi',
			'ket'			=> 'Form Master Propinsi',
			'jenis'			=> 'Tambah',
			'master'		=> 'select',
			'link'			=> 'simpan_propinsi'
		);		

		$this->load->view('template',$data);
	}

	function tambah_kabupaten()
	{
		$data = array(	  		
			'main'			=> 'formKabupaten',
			'ket'			=> 'Form Master Kabupaten',
			'jenis'			=> 'Tambah',
			'master'		=> 'select',
			'link'			=> 'simpan_kabupaten',
			'propinsi'		=> $this->mmaster->getSelekProp()
		);		

		$this->load->view('template',$data);
	}

	function tambah_kecamatan()
	{
		$data = array(	  		
			'main'			=> 'formKecamatan',
			'ket'			=> 'Form Master Kecamatan',
			'jenis'			=> 'Tambah',
			'master'		=> 'select',
			'link'			=> 'simpan_kecamatan',
			'kabupaten'		=> $this->mmaster->getSelekKab()
		);		

		$this->load->view('template',$data);
	}

	function tambah_kelurahan()
	{
		$data = array(	  		
			'main'			=> 'formKelurahan',
			'ket'			=> 'Form Master Kelurahan',
			'jenis'			=> 'Tambah',
			'master'		=> 'select',
			'link'			=> 'simpan_kelurahan',			
			'kecamatan'		=> $this->mmaster->getSelekKecataman()
		);		

		$this->load->view('template',$data);
	}

	function tambah_bencana()
	{
		$data = array(	  		
			'main'			=> 'formAddBencana',
			'ket'			=> 'Form Master Bencana',
			'jenis'			=> 'Tambah',
			'master'		=> 'select',
			'link'			=> 'simpan_bencana'
		);		

		$this->load->view('template',$data);
	}

	function tambah_dusun()
	{
		$data = array(	  		
			'main'			=> 'formDusun',
			'ket'			=> 'Form Master Dusun',
			'jenis'			=> 'Tambah',
			'master'		=> 'select',
			'link'			=> 'simpan_dusun',			
			'kelurahan'		=> $this->mmaster->getSelekDusun()
		);		

		$this->load->view('template',$data);
	}

	function edit_propinsi($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/propinsi');
		}

		$data = array(	  	
			'main'			=> 'formPropinsi',
			'ket'			=> 'Form Master Propinsi',
			'jenis'			=> 'Edit',
			'master'		=> 'select',
			'link'			=> 'update_propinsi/'.$id,
			'kueri'			=> $this->mmaster->editPropinsi($id)
		);		

		$this->load->view('template',$data);
	}

	function edit_kabupaten($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/kabupaten');
		}

		$data = array(	  	
			'main'			=> 'formKabupaten',
			'ket'			=> 'Form Master Kabupaten',
			'jenis'			=> 'Edit',
			'master'		=> 'select',
			'link'			=> 'update_kabupaten/'.$id,
			'kueri'			=> $this->mmaster->editKabupaten($id),
			'propinsi'		=> $this->mmaster->getSelekProp()
		);		

		$this->load->view('template',$data);
	}

	function edit_kecamatan($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/kecamatan');
		}

		$data = array(	  	
			'main'			=> 'formKecamatan',
			'ket'			=> 'Form Master Kecamatan',
			'jenis'			=> 'Edit',
			'master'		=> 'select',
			'link'			=> 'update_kecamatan/'.$id,
			'kueri'			=> $this->mmaster->editKecamatan($id),
			'kabupaten'		=> $this->mmaster->getSelekKab()
		);	

		$this->load->view('template',$data);
	}

	function edit_kelurahan($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/kelurahan');
		}

		$data = array(	  	
			'main'			=> 'formKelurahan',
			'ket'			=> 'Form Master Kelurahan',
			'jenis'			=> 'Edit',
			'master'		=> 'select',
			'link'			=> 'update_kelurahan/'.$id,
			'kueri'			=> $this->mmaster->editKelurahan($id),
			'kecamatan'		=> $this->mmaster->getSelekKecataman()
		);		

		$this->load->view('template',$data);
	}

	function edit_dusun($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/dusun');
		}

		$data = array(	  	
			'main'			=> 'formDusun',
			'ket'			=> 'Form Master Dusun',
			'jenis'			=> 'Edit',
			'master'		=> 'select',
			'link'			=> 'update_dusun/'.$id,
			'kueri'			=> $this->mmaster->editDusun($id),
			'kelurahan'		=> $this->mmaster->getSelekDusun()
		);		

		$this->load->view('template',$data);
	}

	function edit_bencana($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/bencana');
		}

		$data = array(	  	
			'main'			=> 'formAddBencana',
			'ket'			=> 'Form Master Jenis Bencana',
			'jenis'			=> 'Edit',
			'master'		=> 'select',
			'link'			=> 'update_bencana/'.$id,
			'kueri'			=> $this->mmaster->editBencana($id)			
		);		

		$this->load->view('template',$data);
	}

	function simpan_propinsi()
	{
		$this->mmaster->addPropinsi();

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Propinsi berhasil dibuat');
		}
		else
		{
			$this->message->set('notice','Propinsi gagal dibuat');
		}

		redirect('masters/propinsi');
	}

	function simpan_kabupaten()
	{
		$this->mmaster->addKabupaten();

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Kabupaten berhasil dibuat');
		}
		else
		{
			$this->message->set('notice','Kabupaten gagal dibuat');
		}

		redirect('masters/kabupaten');
	}

	function simpan_kecamatan()
	{
		$this->mmaster->addKecamatan();

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Kecamatan berhasil dibuat');
		}
		else
		{
			$this->message->set('notice','Kecamatan gagal dibuat');
		}

		redirect('masters/kecamatan');
	}

	function simpan_kelurahan()
	{
		$this->mmaster->addKelurahan();

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Kelurahan berhasil dibuat');
		}
		else
		{
			$this->message->set('notice','Kelurahan gagal dibuat');
		}

		redirect('masters/kelurahan');
	}

	function simpan_bencana()
	{
		$this->mmaster->addBencana();

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Jenis Bencana berhasil dibuat');
		}
		else
		{
			$this->message->set('notice','Jenis Bencana gagal dibuat');
		}

		redirect('masters/bencana');
	}

	function simpan_dusun()
	{
		$this->mmaster->addDusun();

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Dusun berhasil dibuat');
		}
		else
		{
			$this->message->set('notice','Dusun gagal dibuat');
		}

		redirect('masters/dusun');
	}

	function update_propinsi($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/propinsi');
		}

		$this->mmaster->updatePropinsi($id);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data propinsi berhasil diupdate');
		}
		else
		{
			$this->message->set('notice','Data propinsi gagal diupdate');
		}

		redirect('masters/propinsi');
	}

	function update_kabupaten($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/kabupaten');
		}

		$this->mmaster->updateKabupaten($id);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data kabupaten berhasil diupdate');
		}
		else
		{
			$this->message->set('notice','Data kabupaten gagal diupdate');
		}

		redirect('masters/kabupaten');
	}

	function update_kecamatan($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/kecamatan');
		}

		$this->mmaster->updateKecamatan($id);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data kecamatan berhasil diupdate');
		}
		else
		{
			$this->message->set('notice','Data kecamatan gagal diupdate');
		}

		redirect('masters/kecamatan');
	}

	function update_kelurahan($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/kelurahan');
		}

		$this->mmaster->updateKelurahan($id);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data kelurahan berhasil diupdate');
		}
		else
		{
			$this->message->set('notice','Data kelurahan gagal diupdate');
		}

		redirect('masters/kelurahan');
	}

	function update_dusun($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/dusun');
		}

		$this->mmaster->updateDusun($id);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data dusun berhasil diupdate');
		}
		else
		{
			$this->message->set('notice','Data dusun gagal diupdate');
		}

		redirect('masters/dusun');
	}	

	function update_bencana($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/bencana');
		}

		$this->mmaster->updateBencana($id);

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data jenis bencana berhasil diupdate');
		}
		else
		{
			$this->message->set('notice','Data jenis bencana gagal diupdate');
		}

		redirect('masters/bencana');
	}	

	function hapus_propinsi($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/propinsi');
		}

		if($this->mmaster->deletePropinsi($id))
		{
			$this->message->set('succes','Data propinsi berhasil dihapus');
		}
		else
		{
			$this->message->set('notice','Data propinsi gagal dihapus');
		}

		redirect('masters/propinsi');
	}

	function hapus_kabupaten($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/kabupaten');
		}

		if($this->mmaster->deleteKabupaten($id))
		{
			$this->message->set('succes','Data kabupaten berhasil dihapus');
		}
		else
		{
			$this->message->set('notice','Data kabupaten gagal dihapus');
		}

		redirect('masters/kabupaten');
	}

	function hapus_kecamatan($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/kecamatan');
		}

		if($this->mmaster->deleteKecamatan($id))
		{
			$this->message->set('succes','Data kecamatan berhasil dihapus');
		}
		else
		{
			$this->message->set('notice','Data kecamatan gagal dihapus');
		}

		redirect('masters/kecamatan');
	}

	function hapus_kelurahan($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/kelurahan');
		}

		if($this->mmaster->deleteKelurahan($id))
		{
			$this->message->set('succes','Data kelurahan berhasil dihapus');
		}
		else
		{
			$this->message->set('notice','Data kelurahan gagal dihapus');
		}

		redirect('masters/kelurahan');
	}

	function hapus_dusun($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/dusun');
		}

		if($this->mmaster->deleteDusun($id))
		{
			$this->message->set('succes','Data dusun berhasil dihapus');
		}
		else
		{
			$this->message->set('notice','Data dusun gagal dihapus');
		}

		redirect('masters/dusun');
	}

	function hapus_bencana($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');

			redirect('masters/bencana');
		}

		if($this->mmaster->deleteBencana($id))
		{
			$this->message->set('succes','Data jenis bencana berhasil dihapus');
		}
		else
		{
			$this->message->set('notice','Data jenis bencana gagal dihapus');
		}

		redirect('masters/bencana');
	}	

	function all_propinsi()
	{
		$cek = $this->input->post('check');

		if(!is_array($cek))
		{
			$this->message->set('notice','Tidak ada data propinsi yang dipilih');

			redirect('masters/propinsi');
		}

		foreach($cek as $dt_cek)
		{
			$this->mmaster->deletePropinsi($dt_cek);
		}

		$this->message->set('succes','Data propinsi berhasil dihapus');

		redirect('masters/propinsi');
	}

	function all_kabupaten()
	{
		$cek = $this->input->post('check');

		if(!is_array($cek))
		{
			$this->message->set('notice','Tidak ada data kabupaten yang dipilih');

			redirect('masters/kabupaten');
		}

		foreach($cek as $dt_cek)
		{
			$this->mmaster->deleteKabupaten($dt_cek);
		}

		$this->message->set('succes','Data kabupaten berhasil dihapus');

		redirect('masters/kabupaten');
	}

	function all_kecamatan()
	{
		$cek = $this->input->post('check');

		if(!is_array($cek))
		{
			if($this->input->post('kuncine',TRUE) == "")
			{
				$this->message->set('notice','Tidak ada data kecamatan yang dipilih');

				redirect('masters/kecamatan');				
			}
			else
			{				
				redirect('masters/kecamatan/'.str_replace(" ", "_", $this->input->post('kuncine',TRUE)));
			}			
		}

		foreach($cek as $dt_cek)
		{
			$this->mmaster->deleteKecamatan($dt_cek);
		}

		$this->message->set('succes','Data kecamatan berhasil dihapus');

		redirect('masters/kecamatan');
	}

	function all_kelurahan()
	{
		$cek = $this->input->post('check');

		if(!is_array($cek))
		{
			if($this->input->post('kuncine',TRUE) == "")
			{
				$this->message->set('notice','Tidak ada data kelurahan yang dipilih');

				redirect('masters/kelurahan');
			}
			else
			{				
				redirect('masters/kelurahan/'.str_replace(" ", "_", $this->input->post('kuncine',TRUE)));
			}			
		}

		foreach($cek as $dt_cek)
		{
			$this->mmaster->deleteKelurahan($dt_cek);
		}

		$this->message->set('succes','Data kelurahan berhasil dihapus');

		redirect('masters/kelurahan');
	}

	function all_dusun()
	{
		$cek = $this->input->post('check');

		if(!is_array($cek))
		{
			if($this->input->post('kuncine',TRUE) == "")
			{
				$this->message->set('notice','Tidak ada data dusun yang dipilih');

				redirect('masters/dusun');
			}
			else
			{				
				redirect('masters/dusun/'.str_replace(" ", "_", $this->input->post('kuncine',TRUE)));
			}			
		}

		foreach($cek as $dt_cek)
		{
			$this->mmaster->deleteDusun($dt_cek);
		}

		$this->message->set('succes','Data dusun berhasil dihapus');

		redirect('masters/dusun');
	}

	function all_bencana()
	{
		$cek = $this->input->post('check');

		if(!is_array($cek))
		{
			$this->message->set('notice','Tidak ada data jenis bencana yang dipilih');

			redirect('masters/bencana');
		}

		foreach($cek as $dt_cek)
		{
			$this->mmaster->deleteBencana($dt_cek);
		}

		$this->message->set('succes','Data jenis bencana berhasil dihapus');

		redirect('masters/bencana');
	}

	function import()
	{		
		$data = array(	  		
			'main'			=> 'formImportDusun',
			'ket'			=> 'Form Penambahan Data Dusun',
			'jenis'			=> 'Import',
			'master'		=> 'select',
			'link'			=> 'upload'			
		);				

		$this->load->view('template',$data);
	}

	function upload()
	{
		if($_FILES["userfile"]["name"] != "")
		{
			$config['upload_path'] = './uploads/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			$config['max_size']	= '100000';		
			$config['encrypt_name']	= TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{									
				$this->message->set('notice',$this->upload->display_errors());
			}
			else
			{
				$hasil = $this->upload->data();					

				$this->load->library('excel');
				$uploadpath = "./uploads/excel/".$hasil['file_name'];	

				$objPHPExcel = PHPExcel_IOFactory::load($uploadpath);										
				$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
						 					
				foreach ($cell_collection as $cell) 
				{
				    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
						 					 
				    if ($row == 1) 
				    {
				        $header[$row][$column] = $data_value;
				    } 
				    else 
				    {
				        $arr_data[$row][$column] = $data_value;
				    }
				}
						 			
				$data['header'] = $header;
				$data['values'] = $arr_data;									

				$no = 1;
				foreach($data['values'] as $value)
				{													
					if(isset($value['B']) AND trim($value['B']) != "" AND $no > 1)	
					{	
						$kecamatan = strip_tags(ascii_to_entities(addslashes($value['B'])));		   
						$kelurahan = strip_tags(ascii_to_entities(addslashes($value['D'])));		   
						$dusun = strip_tags(ascii_to_entities(addslashes($value['E'])));		   

						$this->mmaster->addImport($kecamatan,$kelurahan,$dusun);
					}
					$no++;
				}

				unlink($uploadpath);			
			}

			if($this->db->affected_rows() > 0)
			{
				$this->message->set('succes','Data dusun berhasil diimport');
			}
			else
			{
				$this->message->set('notice','Data dusun gagal diimport');
			}
		}
		else
		{
			$this->message->set('notice',"Tidak ada file import");
		}
		redirect('masters/dusun');
	}

	function sample()
	{		
		$url = "./uploads/sample/Daftar-Dusun.xlsx";
		$this->load->helper('download');
		$data = file_get_contents($url);
		$name = "Daftar-Dusun.xlsx";
		
		force_download($name, $data);
	}
}