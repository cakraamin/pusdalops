<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Transaksi extends CI_Controller {



	function __construct()

	{

		parent::__construct();



		$this->load->model('mtransaksi','',TRUE);

		$this->load->library(array('page','SimpleLoginSecure','arey','excel'));



		$this->load->library('acl',$this->session->userdata('user_id'));



		if(!$this->session->userdata('logged_in')) 

		{

			redirect('home');

		}		

	}



	function index($limbah='all',$unit='all',$user='all',$transporter='all',$tanggal=0,$short_by='a.notrans',$short_order='desc',$page=0)

	{				
		$tanggal = ($tanggal == 0)?date('Y-m-d'):$tanggal;

		$per_page = 20;

		$total_page = $this->mtransaksi->getNumTrans($limbah,$unit,$user,$transporter,$tanggal);

		$url = 'transaksi/index/'.$limbah.'/'.$unit.'/'.$user.'/'.$transporter.'/'.$tanggal.'/'.$short_by.'/'.$short_order.'/';

		

		$query = $this->mtransaksi->getTransaksi($limbah,$unit,$user,$transporter,$tanggal,$per_page,$page,$short_by,$short_order);

		if(count($query) == 0 && $page != 0)

		{

			redirect('transaksi/index/'.$limbah.'/'.$unit.'/'.$user.'/'.$transporter.'/'.$tanggal.'/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		

		}



		$data = array(

			'transaksi'			=> 'select',

			'main'				=> 'transaksi',

			'kueri'				=> $query,

			'paging'	 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=10),

			'sort_by' 			=> $short_by,

			'sort_order' 		=> $short_order,			

			'page'				=> $page,

			'per_page'			=> $per_page,

			'role'				=> $this->mtransaksi->getRole($this->session->userdata('user_id')),

			'tanggal'			=> $tanggal,
			'limbah'			=> $this->arey->getComboLimbah(),
			'unit'				=> $this->arey->getUnit(),
			'user'				=> $this->mtransaksi->getUser(),
			'transporter'		=> $this->mtransaksi->getSopir(),
			'limbahs'			=> urldecode($limbah),
			'units'				=> urldecode($unit),
			'userd'				=> urldecode($user),
			'transporters'		=> urldecode($transporter),
			'total_page'		=> $total_page

		);



		$this->load->view('template',$data);

	}



	function getTable($per_page,$cari,$short_by,$short_order,$page)

	{

		$content = "";



		$per_page = $per_page;		

		

		$kueri = $this->mtransaksi->getTransaksiAjax($cari,$per_page,$page,$short_by,$short_order);	



		foreach($kueri as $dt_kueri)

	    {	        

	        $content .= '<tr class="odd gradeX">';

	          $content .= '<td  width="35" >';

	          $content .= '<div class="custom-checkbox">';			  

	          $content .= '<input type="checkbox" name="check[]" class="chkbox"  id="check'.$dt_kueri->notrans.'" value="'.$dt_kueri->notrans.'"/>';

	          $content .= '<label class="checker" for="check'.$dt_kueri->notrans.'" style="left: 3px;"></label>';

	          $content .= '</td>';

	          $content .= '<td>'.$dt_kueri->notrans.'</td>';

	          $content .= '<td>'.$dt_kueri->nopol.'</td>';

	          $content .= '<td>'.$dt_kueri->namabrg.'</td>';

	          $content .= '<td class="center">'.$dt_kueri->namacust.'</td>';

	          $content .= '<td class="center">'.$dt_kueri->namatrsp.'</td>';

	          $content .= '<td class="center">'.$dt_kueri->nomorspk.'</td>';

	          $content .= '<td class="center">'.$dt_kueri->netto.'</td>';

	          $content .= '<td class="center">';

	            $content .= '<span class="tip" >';

	              $content .= '<a  title="Edit Transaksi" href="'.base_url().'transaksi/edit_transaksi/'.$dt_kueri->notrans.'/'.$cari.'/'.$short_by.'/'.$short_order.'/'.$page.'" >';

	                $content .= '<img src="'.base_url().'assets/template/fingers/images/icon/icon_edit.png" >';

	              $content .= '</a>';

	            $content .= '</span>';

	            $content .= '<span class="tip" >';

	              $content .= '<a id="" class="Delete"  name="Band ring" title="Hapus Transaksi" href="'.base_url().'transaksi/hapus_transaksi/'.$dt_kueri->notrans.'/'.$cari.'/'.$short_by.'/'.$short_order.'/'.$page.'"  >';

	                $content .= '<img src="'.base_url().'assets/template/fingers/images/icon/icon_delete.png" >';

	              $content .= '</a>';

	            $content .= '</span>';

	          $content .= '</td>';

	        $content .= '</tr>';

	    }

	 

	    echo $content;

	}



	function tambah_transaksi()

	{

		$data = array(

			'transaksi'			=> 'select',

			'main'				=> 'edit_transaksi',			

			'ket'				=> 'Data Transaksi',

			'link'				=> 'transaksi/simpan/',									

			'jenis'				=> 'Update',

			'barang'			=> $this->mtransaksi->getBarang(),

			'customer'			=> $this->mtransaksi->getCustomer(),

			'transporter'		=> $this->mtransaksi->getTransporter(),

			'roles'				=> $this->mtransaksi->getRole($this->session->userdata('user_id')),

			'back'				=> '',

			'kode'				=> 1

		);



		$this->load->view('template',$data);

	}



	function edit_transaksi($id,$cari,$tanggal,$short_by,$short_order,$page)

	{		

		$data = array(

			'transaksi'			=> 'select',

			'main'				=> 'edit_transaksi',

			'kueri'				=> $this->mtransaksi->getDetailTransaksi($id),

			'ket'				=> 'Data Transaksi',

			'link'				=> 'transaksi/update/'.$id.'/'.$cari.'/'.$tanggal.'/'.$short_by.'/'.$short_order.'/'.$page,			

			'back'				=> 'transaksi/index/'.$cari.'/'.$tanggal.'/'.$short_by.'/'.$short_order.'/'.$page,

			'kueri'				=> $this->mtransaksi->getDetailTransaksi($id),

			'jenis'				=> 'Update',

			'barang'			=> $this->mtransaksi->getBarang(),

			'customer'			=> $this->mtransaksi->getCustomer(),

			'transporter'		=> $this->mtransaksi->getTransporter(),

			'roles'				=> $this->mtransaksi->getRole($this->session->userdata('user_id')),

			'koment'			=> $this->mtransaksi->getComment($id),

			'kode'				=> 2

		);



		$this->load->view('template',$data);

	}



	function update($id,$cari,$tanggal,$short_by,$short_order,$page)

	{

		$ceksss = $this->mtransaksi->getRole($this->session->userdata('user_id'));

		if($ceksss == 3)

		{

			$this->message->set('notice','Anda tidak berhak melakukan perintah ini');

			redirect('transaksi/index/'.$cari.'/'.$tanggal.'/'.$short_by.'/'.$short_order.'/'.$page);

		}

		elseif($ceksss == 1)

		{

			$this->mtransaksi->updateTransaksi($id);

		}

		else

		{

			$this->mtransaksi->addComment($id);

		}



		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('transaksi/index/'.$cari.'/'.$tanggal.'/'.$short_by.'/'.$short_order.'/'.$page);

		}		



		if($this->db->affected_rows() > 0)

		{

			$this->message->set('succes','Data transaksi berhasil diupdate');

		}

		else

		{

			$this->message->set('notice','Data transaksi gagal diupdate');

		}

		redirect('transaksi/index/'.$cari.'/'.$tanggal.'/'.$short_by.'/'.$short_order.'/'.$page);

	}	



	function simpan()

	{

		$ceksss = $this->mtransaksi->getRole($this->session->userdata('user_id'));

		if($ceksss != 1)

		{

			$this->message->set('notice','Anda tidak berhak melakukan perintah ini');

			redirect('transaksi');

		}				



		$this->mtransaksi->addTransaksi();

		if($this->db->affected_rows() > 0)

		{

			$this->message->set('succes','Data transaksi berhasil ditambah');

		}

		else

		{

			$this->message->set('notice','Data transaksi gagal ditambah');

		}

		redirect('transaksi');

	}



	function hapus_transaksi($id,$cari,$short_by,$short_order,$page)

	{

		$ceksss = $this->mtransaksi->getRole($this->session->userdata('user_id'));

		if($ceksss != 1)

		{

			$this->message->set('notice','Anda tidak berhak melakukan perintah ini');

			redirect('transaksi/index/'.$cari.'/'.$short_by.'/'.$short_order.'/'.$page);

		}



		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('transaksi');

		}



		if($this->mtransaksi->deleteTransaksi($id))

		{

			$this->message->set('succes','Data transaksi berhasil dihapus');

		}

		else

		{

			$this->message->set('notice','Data transaksi gagal dihapus');

		}

		redirect('transaksi/index/'.$cari.'/'.$short_by.'/'.$short_order.'/'.$page);

	}



	function all_transaksi($limbah,$unit,$user,$transporter,$tanggal,$short_by,$short_order,$page)

	{
		if($this->input->post('submit') == 'Cari')
		{
			$limbah = $this->input->post('limbah',TRUE);
			$unit = urlencode($this->input->post('unit',TRUE));
			$user = urlencode($this->input->post('user',TRUE));
			$transporter = urlencode($this->input->post('transporter',TRUE));
			$tanggal = $this->input->post('tanggal',TRUE);

			redirect('transaksi/index/'.$limbah.'/'.$unit.'/'.$user.'/'.$transporter.'/'.$tanggal);	
		}
		else
		{
			$ceksss = $this->mtransaksi->getRole($this->session->userdata('user_id'));

			if($ceksss != 1)

			{

				$this->message->set('notice','Anda tidak berhak melakukan perintah ini');

				redirect('transaksi/index/'.$cari.'/'.$short_by.'/'.$short_order.'/'.$page);

			}

			

			$cek = $this->input->post('check');

			if(!is_array($cek))

			{

				$this->message->set('notice','Tidak ada data transaksi yang dipilih');

				redirect('transaksi');

			}

			foreach($cek as $dt_cek)

			{

				$this->mtransaksi->deleteTransaksi($dt_cek);

			}

			$this->message->set('succes','Data transaksi berhasil dihapus');

			redirect('transaksi/index/'.$cari.'/'.$short_by.'/'.$short_order.'/'.$page);		
		}
	}

	function cetak($limbah='all',$unit='all',$user='all',$transporter='all',$tanggal)
	{
		$query = $this->mtransaksi->getTransaksiCetak($limbah,$unit,$user,$transporter,$tanggal);

		$data = array(
			'kueri'			=> $query
		);
		$this->load->view('cetak',$data);		
	}

	function excel($limbah='all',$unit='all',$user='all',$transporter='all',$tanggal)
	{
		$kolomsss = array();
		$huruf = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','F','W','X','Y','Z');
		$abjad = array('I','II','III','IV','V');				

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(9);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(9);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(9);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(9);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(9);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(9);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(14);		
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(14);		
		
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('PHPExcel logo');
		$objDrawing->setDescription('PHPExcel logo');
		$objDrawing->setPath('./assets/gambar/pln.jpg');
		$objDrawing->setHeight(70);                
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($this->excel->getActiveSheet());

		$objDrawings = new PHPExcel_Worksheet_Drawing();
		$objDrawings->setName('PHPExcel logo');
		$objDrawings->setDescription('PHPExcel logo');
		$objDrawings->setPath('./assets/gambar/pjbs.gif');
		$objDrawings->setHeight(60);                
		$objDrawings->setCoordinates('O1');
		$objDrawings->setWorksheet($this->excel->getActiveSheet());
				
		$this->excel->getActiveSheet()->mergeCells('B1:N1');				
		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN HARIAN PLTU BULAN '.strtoupper($tanggal));
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);		
		
		$this->excel->getActiveSheet()->setCellValue('A5', 'NO');
		$this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('B5', 'NO Tiket');
		$this->excel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('C5', 'No Kend');
		$this->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('D5', 'Jam Masuk');
		$this->excel->getActiveSheet()->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('E5', 'Jenis Limbah');
		$this->excel->getActiveSheet()->getStyle('E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('F5', 'Pemnfaat');
		$this->excel->getActiveSheet()->getStyle('F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('G5', 'Transporter');
		$this->excel->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('H5', 'S. Jalan');
		$this->excel->getActiveSheet()->getStyle('H5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('I5', 'No. Manifest');
		$this->excel->getActiveSheet()->getStyle('I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('J5', 'No. MGP');
		$this->excel->getActiveSheet()->getStyle('J5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('K5', 'Gross');
		$this->excel->getActiveSheet()->getStyle('K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('L5', 'Tarra');
		$this->excel->getActiveSheet()->getStyle('L5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('M5', 'Netto');
		$this->excel->getActiveSheet()->getStyle('M5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('N5', 'Penimbang');
		$this->excel->getActiveSheet()->getStyle('N5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('O5', 'Pengemudi');
		$this->excel->getActiveSheet()->getStyle('O5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		

		$baris = 6;
		$no = 1;
		$query = $this->mtransaksi->getTransaksiCetak($limbah,$unit,$user,$transporter,$tanggal);
		foreach($query as $dt_kueri)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$baris, $no);
			$this->excel->getActiveSheet()->getStyle('A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->setCellValue('B'.$baris, $dt_kueri->notrans);			
			$this->excel->getActiveSheet()->setCellValue('C'.$baris, $dt_kueri->nopol);			
			$this->excel->getActiveSheet()->setCellValue('D'.$baris, $dt_kueri->jamtb1);			
			$this->excel->getActiveSheet()->setCellValue('E'.$baris, $dt_kueri->namabrg);
			$this->excel->getActiveSheet()->setCellValue('F'.$baris, $dt_kueri->namacust);
			$this->excel->getActiveSheet()->setCellValue('G'.$baris, $dt_kueri->namatrsp);
			$do = isset($dt_kueri->nomorspk)?$dt_kueri->nomorspk:"//";
            $pecahdo = explode("/", $do);
            $jalan = (isset($pecahdo[0]) && $pecahdo[0] != "")?$pecahdo[0]:"";
            $manifest = (isset($pecahdo[1]) && $pecahdo[1] != "")?$pecahdo[1]:"";
            $mgp = (isset($pecahdo[2]) && $pecahdo[2] != "")?$pecahdo[2]:"";			
			$this->excel->getActiveSheet()->setCellValue('H'.$baris, $jalan);			
			$this->excel->getActiveSheet()->setCellValue('I'.$baris, $manifest);			
			$this->excel->getActiveSheet()->setCellValue('J'.$baris, $mgp);			
			$this->excel->getActiveSheet()->setCellValue('K'.$baris, $dt_kueri->timbang1);		
			$this->excel->getActiveSheet()->getStyle('K'.$baris)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
			$this->excel->getActiveSheet()->setCellValue('L'.$baris, $dt_kueri->timbang2);			
			$this->excel->getActiveSheet()->getStyle('L'.$baris)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
			$this->excel->getActiveSheet()->setCellValue('M'.$baris, $dt_kueri->netto);			
			$this->excel->getActiveSheet()->getStyle('M'.$baris)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
			$this->excel->getActiveSheet()->setCellValue('N'.$baris, $dt_kueri->user2);			
			$this->excel->getActiveSheet()->setCellValue('O'.$baris, $dt_kueri->sopir);			
			$baris++;
			$no++;
		}
		$this->excel->getActiveSheet()->freezePane('A6');
		$this->excel->getActiveSheet()->freezePane('C6');

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$filename='Rekap_timbangan_'.date('Y-m-d').'.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
	}	

}