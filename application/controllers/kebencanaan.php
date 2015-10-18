<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kebencanaan extends CI_Controller 
{
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
		$per_page = 10;
		$total_page = $this->mbencana->getJumBencana();
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
			'page'			=> $page,
			'totalPage'		=> $total_page
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
			'jenis_ben'		=> $this->mbencana->getSelekBencana(),
			'lokasi'		=> $this->mbencana->getSelekLokasi()
		);				

		$this->load->view('template',$data);
	}

	function import()
	{		
		$data = array(	  		
			'main'			=> 'formImport',
			'ket'			=> 'Form Penambahan Kebencanaan',
			'jenis'			=> 'Import',
			'bencana'		=> 'select',
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
						/*if(count($value) == 14)
						{
							$data = array(
							   'id_bencana' 		=> '' ,
							   'id_jenis_bencana'	=> $this->mbencana->getJenisBencanaId(ucwords(strtolower($value['A']))),
							   'tanggal_bencana'	=> PHPExcel_Style_NumberFormat::toFormattedString($value['B'], "YYYY-MM-DD"),
							   'waktu_bencana'		=> PHPExcel_Style_NumberFormat::toFormattedString($value['C'], 'hh:mm:ss'),
							   'id_lokasi' 			=> $this->mbencana->getLokasiId($value['D'],$value['E'],$value['F']),						   
							   'rt_lokasi'			=> strip_tags(ascii_to_entities(addslashes($value['G']))),		   
							   'long_lokasi' 		=> strip_tags(ascii_to_entities(addslashes($value['H']))),
							   'lat_lokasi'			=> strip_tags(ascii_to_entities(addslashes($value['I']))),		   
							   'sebab_bencana'		=> strip_tags(ascii_to_entities(addslashes($value['K']))),
							   'cakup_bencana'		=> strip_tags(ascii_to_entities(addslashes($value['L']))),
							   'deskripsi_bencana'	=> strip_tags(ascii_to_entities(addslashes($value['M']))),
							   'kondisi_bencana'	=> strip_tags(ascii_to_entities(addslashes($value['N']))),
							   'excel_bencana'		=> 0,
							   'user_id'			=> $this->session->userdata('user_id')
							);							
						}
						elseif(count($value) == 15)
						{
							$data = array(
							   'id_bencana' 		=> '' ,
							   'id_jenis_bencana'	=> $this->mbencana->getJenisBencanaId(ucwords(strtolower($value['B']))),
							   'tanggal_bencana'	=> PHPExcel_Style_NumberFormat::toFormattedString($value['C'], "YYYY-MM-DD"),
							   'waktu_bencana'		=> PHPExcel_Style_NumberFormat::toFormattedString($value['D'], 'hh:mm:ss'),
							   'id_lokasi' 			=> $this->mbencana->getLokasiId($value['E'],$value['F'],$value['G']),						   
							   'rt_lokasi'			=> strip_tags(ascii_to_entities(addslashes($value['H']))),		   
							   'long_lokasi' 		=> strip_tags(ascii_to_entities(addslashes($value['I']))),
							   'lat_lokasi'			=> strip_tags(ascii_to_entities(addslashes($value['J']))),		   
							   'sebab_bencana'		=> strip_tags(ascii_to_entities(addslashes($value['L']))),
							   'cakup_bencana'		=> strip_tags(ascii_to_entities(addslashes($value['K']))),
							   'deskripsi_bencana'	=> strip_tags(ascii_to_entities(addslashes($value['M']))),
							   'kondisi_bencana'	=> strip_tags(ascii_to_entities(addslashes($value['O']))),
							   'excel_bencana'		=> 0,
							   'user_id'			=> $this->session->userdata('user_id')							   
							);							
						}*/

						$data = array(
						   'id_bencana' 		=> '' ,
						   'id_jenis_bencana'		=> $this->mbencana->getJenisBencanaId(ucwords(strtolower($value['B']))),
						   'tanggal_bencana'		=> PHPExcel_Style_NumberFormat::toFormattedString($value['C'], "YYYY-MM-DD"),
						   'waktu_bencana'		=> PHPExcel_Style_NumberFormat::toFormattedString($value['D'], 'hh:mm:ss'),
						   'id_lokasi' 			=> $this->mbencana->getLokasiId($value['E'],$value['F'],$value['G']),						   
						   'rt_lokasi'			=> strip_tags(ascii_to_entities(addslashes($value['H']))),		   
						   'long_lokasi' 		=> strip_tags(ascii_to_entities(addslashes($value['I']))),
						   'lat_lokasi'			=> strip_tags(ascii_to_entities(addslashes($value['J']))),		   
						   'sebab_bencana'		=> strip_tags(ascii_to_entities(addslashes($value['L']))),
						   'cakup_bencana'		=> strip_tags(ascii_to_entities(addslashes($value['K']))),
						   'deskripsi_bencana'		=> strip_tags(ascii_to_entities(addslashes($value['M']))),
						   'kondisi_bencana'		=> (isset($value['O']))?strip_tags(ascii_to_entities(addslashes($value['O']))):"",
						   'excel_bencana'		=> 0,
						   'user_id'			=> $this->session->userdata('user_id'),
						   'date_bencana'		=> date('Y-m-d')
						);

						$this->mbencana->addImport($data);
					}
					$no++;
				}
					
			}

			if($this->db->affected_rows() > 0)
			{
				$this->message->set('succes','Data kebencanaan berhasil diimport');
			}
			else
			{
				$this->message->set('notice','Data kebencanaan gagal diimport');
			}
		}
		else
		{
			$this->message->set('notice',"Tidak ada file import");
		}
		redirect('kebencanaan/daftar');
	}

	function simpan()
	{		
		$huruf = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		
		$eksel = ($_FILES["userfile"]["name"] != "")?1:0;
		$this->mbencana->addBencana($eksel);
		$kode = $this->db->insert_id();

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
				
				$this->mbencana->updateFile($hasil['file_name'],$this->db->insert_id());
				
				$this->load->library('excel');
				$uploadpath = "./uploads/excel/".$hasil['file_name'];
									
				$objPHPExcel = PHPExcel_IOFactory::load($uploadpath);
				$total_sheets = $objPHPExcel->getSheetCount(); 
				$allSheetName = $objPHPExcel->getSheetNames(); 
	 			
				foreach($allSheetName as $key => $nama_sheet)
				{
					unset($value);
					$value = array();


					$objWorksheet = $objPHPExcel->setActiveSheetIndex($key);                 
	                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
	                
	                unset($header);
	                $header = array();
	                unset($arr_data);
	                $arr_data = array();

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
						if(isset($value['B']) AND trim($value['B']) != "" AND $no > 2)	
						{															
							if($key == 0)
							{
								$this->mbencana->addMeninggal($kode,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F'],$value['G']);
							}
							elseif($key == 1)
							{
								$this->mbencana->addHilang($kode,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F'],$value['G'],$value['H']);
							}
							elseif($key == 2)
							{
								$this->mbencana->addLr($kode,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F']);
							}
							elseif($key ==3)
							{
								$this->mbencana->addLb($kode,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F']);
							}						
							elseif($key ==4)
							{
								$awal = 4;
								$no = 0;
								for($i=1;$i<=14;$i++)
								{
									$kolom = $huruf[$awal+$i];
									$this->mbencana->addNgungsi($kode,$value['B'],$value['C'],$value['D'],$value['E'],$value['T'],$no,$value[$kolom]);
									$no++;
								}
							}
							elseif($key == 5)
							{
								$awal = 0;
								$no = 14;
								for($i=1;$i<=14;$i++)
								{
									$kolom = $huruf[$awal+$i];
									$this->mbencana->addMenderita($kode,$value['T'],$no,$value[$kolom]);
									$no++;
								}
							}
							else
							{
								$awal = 0;
								for($i=1;$i<=23;$i++)
								{
									$kolom = $huruf[$awal+$i];
									$this->mbencana->addRusak($kode,$i,$value[$kolom],$value['Y']);
								}
							}
						}
						$no++;
					}				
				}					
			}
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Data kebencanaan berhasil dibuat');
		}
		else
		{
			$this->message->set('notice','Data kebencanaan gagal dibuat');
		}

		redirect('kebencanaan/daftar');
	}

	function hapus_bencana($id)
	{
		if($this->session->userdata('user_email') != 'admin')
		{
			$this->message->set('notice',"Maaf anda tidak berhak mengakses");
			redirect('kebencanaan/daftar');
		}

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
		if($this->session->userdata('user_email') != 'admin')
		{
			$this->message->set('notice',"Maaf anda tidak berhak mengakses");
			redirect('kebencanaan/daftar');
		}
		
		$cek = $this->input->post('check');

		if(!is_array($cek))
		{
			$this->message->set('notice','Tidak ada data bencana yang dipilih');

			redirect('kebencanaan/daftar');
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
			'main'			=> 'formEditBencana',
			'ket'			=> 'Form Penambahan Kebencanaan',
			'jenis'			=> 'Edit',
			'bencana'		=> 'select',
			'link'			=> 'update_bencana/'.$id,
			'kueri'			=> $this->mbencana->editBencana($id),			
			'jenis_ben'		=> $this->mbencana->getSelekBencana(),
			'lokasi'		=> $this->mbencana->getSelekLokasi(),
			'id'			=> $id
		);			

		$this->load->view('template',$data);
	}	

	public function update_form($id)
	{
		$this->load->view('form_update');
	}

	function update_bencana($id)
	{
		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');
			redirect('kebencanaan/daftar');
		}

		$eksel = ($_FILES["userfile"]["name"] != "" OR $this->input->post('excel',TRUE) == 1)?1:0;
		$this->mbencana->updateBencana($id,$eksel);

		if($_FILES["userfile"]["name"] != "")
		{
			//echo "ada file";
		
			$this->mbencana->delAll($id);

			$huruf = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

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
				
				$this->mbencana->updateFile($hasil['file_name'],$id);
				
				$this->load->library('excel');
				$uploadpath = "./uploads/excel/".$hasil['file_name'];
									
				$objPHPExcel = PHPExcel_IOFactory::load($uploadpath);
				$total_sheets = $objPHPExcel->getSheetCount(); 
				$allSheetName = $objPHPExcel->getSheetNames(); 
	 			
				foreach($allSheetName as $key => $nama_sheet)
				{
					unset($value);
					$value = array();


					$objWorksheet = $objPHPExcel->setActiveSheetIndex($key);                 
	                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
	                
	                unset($header);
	                $header = array();
	                unset($arr_data);
	                $arr_data = array();

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
						if(isset($value['B']) AND trim($value['B']) != "" AND $no > 2)	
						{															
							if($key == 0)
							{
								$this->mbencana->addMeninggal($id,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F'],$value['G']);
							}
							elseif($key == 1)
							{
								$this->mbencana->addHilang($id,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F'],$value['G'],$value['H']);
							}
							elseif($key == 2)
							{
								$this->mbencana->addLr($id,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F']);
							}
							elseif($key ==3)
							{
								$this->mbencana->addLb($id,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F']);
							}						
							elseif($key ==4)
							{
								$awal = 4;
								for($i=1;$i<=14;$i++)
								{
									$kolom = $huruf[$awal+$i];
									$this->mbencana->addNgungsi($id,$value['B'],$value['C'],$value['D'],$value['E'],$value['T'],$i,$value[$kolom]);
								}
							}
							elseif($key == 5)
							{
								$awal = 0;
								for($i=1;$i<=14;$i++)
								{
									$kolom = $huruf[$awal+$i];
									$this->mbencana->addMenderita($id,$value['T'],$i,$value[$kolom]);
								}
							}
							else
							{
								$awal = 0;
								for($i=1;$i<=23;$i++)
								{
									$kolom = $huruf[$awal+$i];
									$this->mbencana->addRusak($id,$i,$value[$kolom],$value['Y']);
								}
							}
						}
						$no++;
					}				
				}					
			}
		}

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

	function download()
	{		
		$url = "./uploads/sample/sample.xlsx";
		$this->load->helper('download');
		$data = file_get_contents($url);
		$name = "sample.xlsx";
		
		force_download($name, $data);
	}
	
	function download_import($id)
	{	
		$kueri = $this->mbencana->getFileImport($id);
	
		$url = "./uploads/excel/".$kueri->name_excel;
		$this->load->helper('download');
		$data = file_get_contents($url);
		$name = $id.".xlsx";
		
		force_download($name, $data);
	}

	function sample()
	{		
		$url = "./uploads/sample/bencana.xlsx";
		$this->load->helper('download');
		$data = file_get_contents($url);
		$name = "bencana.xlsx";
		
		force_download($name, $data);
	}

	function getLokasi($id)
	{
		$cari = $this->mbencana->getLokasine($id);

		return $cari;
	}
}