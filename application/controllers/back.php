<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Kebencanaan extends CI_Controller {



	function __construct()

	{

		parent::__construct();

		$this->load->model('mbencana','',TRUE);

		$this->load->library(array('page','SimpleLoginSecure','arey'));



		$this->load->library('acl',$this->session->userdata('user_id'));



		if(!$this->session->userdata('logged_in')) 

		{

			redirect('home');

		}

	}



	function index()

	{

		redirect('kebencanaan/daftar');

	}



	function daftar($short_by='id_school',$short_order='desc',$page=0)

	{
		$this->load->helper('tanggal');

		$per_page = 20;

		$total_page = $this->db->count_all('bencana');

		$url = 'kebencanaan/daftar/'.$short_by.'/'.$short_order.'/';

		

		$query = $this->mbencana->getBencana($per_page,$page,$short_by,$short_order);

		if(count($query) == 0 && $page != 0)

		{

			redirect('kebencanaan/daftar/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		

		}

				

		$data = array(

			'kueri' 		=> $query,

			'page'			=> $page,

			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),

			'main'			=> 'bencana',

			'bencana'		=> 'select',

			'sort_by' 		=> $short_by,

			'sort_order' 	=> $short_order,			

			'page'			=> $page

		);

		$this->load->view('template',$data);

	}



	function tambah()

	{		

		$data = array(	  		

			'main'			=> 'formBencana',

			'ket'			=> 'Form Penambahan Kebencanaan',

			'jenis'			=> 'Tambah',

			'bencana'		=> 'select',

			'link'			=> 'simpan',

			'jenis_ben'		=> $this->arey->getJenisBencana(),

			'lokasi'		=> $this->mbencana->getSelekLokasi()

		);		

			

		$this->load->view('template',$data);

	}



	function simpan()

	{		
		$config['upload_path'] = './uploads/excel/';
		$config['allowed_types'] = 'xls|xlsx';
		$config['max_size']	= '10000';		
		$config['encrypt_name']	= TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{			
			//$this->message->set('notice',$this->upload->display_errors());
			echo $this->upload->display_errors();
		}
		else
		{
			$hasil = $this->upload->data();
			
			$this->load->library('excel');
			$uploadpath = "./uploads/excel/".$hasil['file_name'];
								
			$objPHPExcel = PHPExcel_IOFactory::load($uploadpath);										
			
			$worksheetList = $objPHPExcel->listWorksheetNames($uploadpath);
			$sheetname = $worksheetList[0]; 			

			echo "okelah";
					 					
			/*foreach ($cell_collection as $cell) 
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
				if($no > 6)
				{
					echo $value['A'];
				}
				if($value['A'] != "")	
				{						
														
				}
				$no++;				
				$no++;
			}			
			unlink($uploadpath);*/
			//$this->message->set('succes','Import Data PAUD Berhasil');			
		}
		//redirect('paud/sekolah/daftar');


		//$this->mbencana->addBencana();

		//$kode = $this->db->insert_id();

		//$this->mbencana->addDetail($kode);

		//$this->mbencana->addRusak($kode);

		/*if($this->db->affected_rows() > 0)

		{

			$this->message->set('succes','Data kebencanaan berhasil dibuat');

		}

		else

		{

			$this->message->set('notice','Data kebencanaan gagal dibuat');

		}

		redirect('kebencanaan/daftar');*/

	}



	function hapus_bencana($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('kebencanaan/daftar');

		}



		if($this->mbencana->deleteBencana($id))

		{

			$this->message->set('succes','Data data bencana berhasil dihapus');

		}

		else

		{

			$this->message->set('notice','Data data bencana gagal dihapus');

		}

		redirect('kebencanaan/daftar');

	}



	function all_bencana()

	{

		$cek = $this->input->post('check');

		if(!is_array($cek))

		{

			$this->message->set('notice','Tidak ada data bencana yang dipilih');

			redirect('bencana/daftar');

		}

		foreach($cek as $dt_cek)

		{

			$this->mbencana->deleteBencana($dt_cek);

		}

		$this->message->set('succes','Data data bencana berhasil dihapus');

		redirect('kebencanaan/daftar');

	}



	function edit_bencana($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('kebencanaan/daftar');

		}



		$data = array(	  	

			'main'			=> 'formBencana',

			'ket'			=> 'Form Penambahan Kebencanaan',

			'jenis'			=> 'Edit',

			'bencana'		=> 'select',

			'link'			=> 'update_bencana/'.$id,

			'kueri'			=> $this->mbencana->editBencana($id),

			'detile'		=> $this->mbencana->editDetailBencana($id),

			'rusake'		=> $this->mbencana->editRusakBencana($id),

			'jenis_ben'		=> $this->arey->getJenisBencana(),

			'lokasi'		=> $this->mbencana->getSelekLokasi()

		);

			

		$this->load->view('template',$data);

	}	



	function update_bencana($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('kebencanaan/daftar');

		}



		$this->mbencana->updateBencana($id);

		//$this->mbencana->updateDetailBencana($id);

		//$this->mbencana->updateRusakBencana($id);



		if($this->db->affected_rows() > 0)

		{

			$this->message->set('succes','Data kebencanaan berhasil diupdate');

		}

		else

		{

			$this->message->set('notice','Data kebencanaan gagal diupdate');

		}

		redirect('kebencanaan/daftar');

	}	

}