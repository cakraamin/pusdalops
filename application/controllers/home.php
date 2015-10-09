<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('arey','page','excel','SimpleLoginSecure'));
		$this->load->helper(array('tanggal','terbilang','bilangan'));
		$this->load->model('mlaporan','',TRUE);		
	}

	/*function index($kunci="kosong",$jenis=1,$bencana=0,$lokasi=0,$val=0,$waktu=1,$tahun=0,$bulan=0,$tanggal="00-00-0000",$short_by='id_bencana',$short_order='desc',$page=0)
	{			
		$tahun = ($tahun == 0)?date("Y"):$tahun;

		$this->load->helper('tanggal');
		$per_page = 10;
		$total_page = $this->mlaporan->getNumLaporanAll($kunci,$jenis,$bencana,$lokasi,$val,$waktu,$tahun,$bulan,$tanggal);
		$url = 'home/index/'.$kunci.'/'.$jenis.'/'.$bencana.'/'.$lokasi.'/'.$val.'/'.$waktu.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/'.$short_by.'/'.$short_order.'/';	

		$query = $this->mlaporan->getLaporanAll($kunci,$jenis,$bencana,$lokasi,$val,$waktu,$tahun,$bulan,$tanggal,$per_page,$page,$short_by,$short_order);
		if(count($query) == 0 && $page != 0)
		{
			redirect('home/index/'.$kunci.'/'.$jenis.'/'.$bencana.'/'.$lokasi.'/'.$val.'/'.$waktu.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		
		}
		
		$bencananya = array_merge(array('All'),$this->mlaporan->getSelekBencana());
		$lokasinya = array_merge(array('All'),$this->mlaporan->getSelekLokasi());

		$kunci = str_replace("-", " ", $kunci);		
		$kunci = ($kunci == "kosong")?"":$kunci;

		$data = array(						
			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=14),
			'kueri'			=> $query,
			'lokasi'		=> $lokasinya,
			'bencanane'		=> $bencananya,
			'sort_by' 		=> $short_by,
			'sort_order' 		=> $short_order,			
			'page'			=> $page,			
			'jenis_ben'		=> $this->mlaporan->getSelekBencana(),
			'jlaporan'		=> $this->arey->getJenisLapSelek(),
			//'lokasi'		=> $this->mlaporan->getSelekLokasi(),
			'waktu'			=> $this->arey->getJenisWaktu(),
			'tahun'			=> $this->arey->getTahun(),
			'bulan'			=> $this->arey->getBulanLap(),
			'jenise'		=> $jenis,
			'bencanane'		=> $bencana,
			'lokasine'		=> $lokasi,
			'waktune'		=> $waktu,
			'tahune'		=> $tahun,
			'bulane'		=> $bulan,
			'tanggale'		=> $tanggal,
			'kuncine'		=> $kunci,
			'totalPage'		=> $total_page,
			'val'			=> $val,
			'loks'			=> $this->arey->getLokasiLaporan(),
			'kecamatan'		=> $this->mlaporan->getKecamatan(),
			'kelurahan'		=> $this->mlaporan->getKelurahan()
		);

		$this->load->view('laporan_home',$data);
	}*/

	function index()
	{
		if($this->session->userdata('logged_in')) 
		{			
			redirect('dashboard');
		}

		$this->load->view('login');
	}


	function logon()
	{		
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);

		if($this->simpleloginsecure->cek($username)) 
		{
			if($this->simpleloginsecure->login($username, $password)) 
			{
				echo "ok";
			}
			else
			{
				echo "Maaf Login Gagal";
			}
		}
		else
		{
			echo "Maaf Username Tidak Diketahui";
		}
	}

	function buat()
	{		
		$buat = $this->simpleloginsecure->create('admin', 'admin');

		if($buat)
		{
			echo "selesai";
		}
		else
		{
			echo "gagal";
		}
	}

	function logout()
	{
		//$this->simpleloginsecure->logout();
		$array_items = array(
			'logged_in' 		=> '', 
			'user_id'			=> '',
			'user_email'		=> '',
			'user_pass'			=> '',
			'user_date'			=> '',
			'user_modified'		=> '',
			'user_last_login'	=> '',
			'user_level'		=> '',
			'id_school'			=> ''
		);

		$this->session->unset_userdata($array_items);

		redirect('home');
	}

	function submit()
	{
		$kuncine = ($this->input->post('kuncine',TRUE) == "")?"kosong":$this->input->post('kuncine',TRUE);
		$kunci = strip_tags(ascii_to_entities(addslashes($kuncine)));		
		$kunci = str_replace(" ", "-", $kunci);		
		$laporan = $this->input->post('laporan',TRUE);
		$bencana = $this->input->post('jenis',TRUE);
		$lokasi = $this->input->post('lokasi',TRUE);
		$waktu = $this->input->post('waktu',TRUE);
		$tahun = $this->input->post('tahun',TRUE);
		$bulan = $this->input->post('bulan',TRUE);
		$tanggal = $this->input->post('tanggal',TRUE);
		$tanggal = ($tanggal == "")?"00-00-0000":$tanggal;

		if($lokasi == 1)
		{
			$val = $this->input->post('kecamatan',TRUE);
		}
		else
		{
			$val = $this->input->post('kelurahan',TRUE);
		}

		redirect('home/index/'.$kunci.'/'.$laporan.'/'.$bencana.'/'.$lokasi.'/'.$val.'/'.$waktu.'/'.$tahun.'/'.$bulan.'/'.$tanggal);
	}

	function get_detail($id,$kuncine,$jenise,$bencanane,$lokasine,$val,$waktune,$tahune,$bulane,$tanggale,$sort_by,$sort_order,$page)
	{
		$data = array(			
			'kueri'			=> $this->mlaporan->editBencana($id),
			'detile'		=> $this->mlaporan->editDetailBencana($id),
			'korban'		=> $this->mlaporan->editKorbanBencana($id),
			'rusake'		=> $this->mlaporan->editRusakBencana($id),
			'idne'			=> $id,
			'kuncine'		=> $kuncine,
			'jenise'		=> $jenise,
			'bencanane'		=> $bencanane,
			'lokasine'		=> $lokasine,
			'val'			=> $val,
			'waktune'		=> $waktune,
			'tahune'		=> $tahune,
			'bulane'		=> $bulane,
			'tanggale'		=> $tanggale,
			'sort_by'		=> $sort_by,
			'sort_order'	=> $sort_order,
			'page'			=> $page
		);

		$this->load->view('detail_home_laporan',$data);	
	}	

	function report()
	{
		$data = array(
			'main'			=> 'formGenerate',
			'laporan'		=> 'select',
			'ket'			=> 'Generate Laporan',
			'link'			=> 'generate',
			'jenis'			=> 'Generate',
			'jenis_ben'		=> $this->arey->getJenisBencana(),
			'jlaporan'		=> $this->arey->getJenisLapSelek(),
			'lokasi'		=> $this->mlaporan->getSelekLokasi(),
			'waktu'			=> $this->arey->getJenisWaktu(),
			'tahun'			=> $this->arey->getTahun(),
			'bulan'			=> $this->arey->getBulanLap(),
		);

		$this->load->view('template',$data);	
	}

	function generate($jenis,$bencana,$lokasi,$waktu,$tahun,$bulan,$tanggal)
	{
		$kolomsss = array();
		$huruf = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','F','W','X','Y','Z');		

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(0);

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);		
		
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
		$this->excel->getActiveSheet()->setTitle("Form KB");

		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('PHPExcel logo');
		$objDrawing->setDescription('PHPExcel logo');
		$objDrawing->setPath('./template/bantul.jpg');
		$objDrawing->setWidth(70);				
		$objDrawing->setCoordinates('G1');
		$objDrawing->setWorksheet($this->excel->getActiveSheet());

		$objDrawing1 = new PHPExcel_Worksheet_Drawing();
		$objDrawing1->setName('PHPExcel logo');
		$objDrawing1->setDescription('PHPExcel logo');
		$objDrawing1->setPath('./assets/gambar/bpbd.jpg');
		$objDrawing1->setHeight(50);				
		$objDrawing1->setCoordinates('N1');
		$objDrawing1->setWorksheet($this->excel->getActiveSheet());

		$this->excel->getActiveSheet()->mergeCells('B1:V1');		
		$this->excel->getActiveSheet()->setCellValue('B1', 'PEMERINTAH KABUPATEN BANTUL');
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('B2:V2');		
		$this->excel->getActiveSheet()->setCellValue('B2', 'BADAN PENANGGULANGAN BENCANA DAERAH');
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);		
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('B3:V3');		
		$this->excel->getActiveSheet()->setCellValue('B3', 'Alamat : Jalan KH. Wakhid Hasyim Palbapang  Bantul  Telp dan Fax. (0274) 6462100 Email : bpbd@bantulkab.go.id; www.bpbd.bantulkab.go.id');
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(11);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);		
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		

		$this->excel->getActiveSheet()->mergeCells('A5:A6');		
		$this->excel->getActiveSheet()->setCellValue('A5', 'NO');
		$this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->mergeCells('B5:B6');		
		$this->excel->getActiveSheet()->setCellValue('B5', 'JENIS KEJADIAN');
		$this->excel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->mergeCells('C5:C6');		
		$this->excel->getActiveSheet()->setCellValue('C5', 'TANGGAL');
		$this->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->mergeCells('D5:D6');		
		$this->excel->getActiveSheet()->setCellValue('D5', 'WAKTU');
		$this->excel->getActiveSheet()->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->mergeCells('E5:H5');		
		$this->excel->getActiveSheet()->setCellValue('E5', 'LOKASI KEJADIAN');
		$this->excel->getActiveSheet()->getStyle('E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('E6', 'KEC');
		$this->excel->getActiveSheet()->getStyle('E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('F6', 'DESA');
		$this->excel->getActiveSheet()->getStyle('F6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('G6', 'DUSUN');
		$this->excel->getActiveSheet()->getStyle('G6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('H6', 'RT');
		$this->excel->getActiveSheet()->getStyle('H6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('I5:J5');		
		$this->excel->getActiveSheet()->setCellValue('I5', 'KOORDINAT LOKASI KEJADIAN');
		$this->excel->getActiveSheet()->getStyle('I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('I6', 'LONG(x)');
		$this->excel->getActiveSheet()->getStyle('I6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('J6', 'LAT(Y)');
		$this->excel->getActiveSheet()->getStyle('J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('K5:K6');		
		$this->excel->getActiveSheet()->setCellValue('K5', 'CAKUPAN DAMPAK BENCANA');
		$this->excel->getActiveSheet()->getStyle('K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('K5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->getStyle('K5')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('L5:L6');		
		$this->excel->getActiveSheet()->setCellValue('L5', 'PENYEBAB BENCANA');
		$this->excel->getActiveSheet()->getStyle('L5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('L5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->getStyle('L5')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('M5:M6');		
		$this->excel->getActiveSheet()->setCellValue('M5', 'KETERANGAN LENGKAP');
		$this->excel->getActiveSheet()->getStyle('M5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('M5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->getStyle('M5')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('N5:S5');		
		$this->excel->getActiveSheet()->setCellValue('N5', 'KORBAN');
		$this->excel->getActiveSheet()->getStyle('N5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('N6', 'MD');
		$this->excel->getActiveSheet()->getStyle('N6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('O6', 'HLG');
		$this->excel->getActiveSheet()->getStyle('O6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('P6', 'LR');
		$this->excel->getActiveSheet()->getStyle('P6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('Q6', 'LB');
		$this->excel->getActiveSheet()->getStyle('Q6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('R6', 'PGSI');
		$this->excel->getActiveSheet()->getStyle('R6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('S6', 'MDRT');
		$this->excel->getActiveSheet()->getStyle('S6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('T5:T6');		
		$this->excel->getActiveSheet()->setCellValue('T5', 'JML KERUSAKAN');
		$this->excel->getActiveSheet()->getStyle('T5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('T5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->getStyle('T5')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('U5:U6');		
		$this->excel->getActiveSheet()->setCellValue('U5', 'SUMBER INFORMASI');
		$this->excel->getActiveSheet()->getStyle('U5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('U5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->getStyle('U5')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('V5:V6');		
		$this->excel->getActiveSheet()->setCellValue('V5', 'KONDISI CUACA');
		$this->excel->getActiveSheet()->getStyle('V5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('V5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$this->excel->getActiveSheet()->getStyle('V5')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->getStyle('A5:V6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('5bd4ff');

		$baris = 7;
		$bencana = $this->mlaporan->getBencana($jenis,$bencana,$lokasi,$waktu,$tahun,$bulan,$tanggal);
		$no = 1;
		foreach($bencana as $dt_bencana)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$baris, $no);
			$this->excel->getActiveSheet()->getStyle('A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->setCellValue('B'.$baris, $dt_bencana['bencana']);
			$this->excel->getActiveSheet()->setCellValue('C'.$baris, $dt_bencana['tanggal']);
			$this->excel->getActiveSheet()->setCellValue('D'.$baris, $dt_bencana['waktu']);
			$this->excel->getActiveSheet()->setCellValue('E'.$baris, $dt_bencana['kecamatan']);
			$this->excel->getActiveSheet()->setCellValue('F'.$baris, $dt_bencana['kelurahan']);
			$this->excel->getActiveSheet()->setCellValue('G'.$baris, $dt_bencana['dusun']);
			$this->excel->getActiveSheet()->setCellValue('H'.$baris, $dt_bencana['rt']);
			$this->excel->getActiveSheet()->setCellValue('I'.$baris, $dt_bencana['long']);
			$this->excel->getActiveSheet()->setCellValue('J'.$baris, $dt_bencana['lat']);
			$this->excel->getActiveSheet()->setCellValue('K'.$baris, $dt_bencana['cakup']);
			$this->excel->getActiveSheet()->setCellValue('L'.$baris, $dt_bencana['sebab']);
			$this->excel->getActiveSheet()->setCellValue('M'.$baris, $dt_bencana['keterangan']);
			$this->excel->getActiveSheet()->setCellValue('N'.$baris, $dt_bencana['meninggal']);
			$this->excel->getActiveSheet()->setCellValue('O'.$baris, $dt_bencana['hilang']);
			$this->excel->getActiveSheet()->setCellValue('P'.$baris, $dt_bencana['berat']);
			$this->excel->getActiveSheet()->setCellValue('Q'.$baris, $dt_bencana['ringan']);
			$this->excel->getActiveSheet()->setCellValue('R'.$baris, $dt_bencana['pengungsi']);
			$this->excel->getActiveSheet()->setCellValue('S'.$baris, $dt_bencana['menderita']);
			$this->excel->getActiveSheet()->setCellValue('T'.$baris, $dt_bencana['rusak']);
			$this->excel->getActiveSheet()->setCellValue('U'.$baris, $dt_bencana['sumber']);
			$this->excel->getActiveSheet()->setCellValue('V'.$baris, $dt_bencana['cuaca']);
			$baris++;
			$no++;
		}

		$brs_bwh = $baris-1;
		$this->excel->getActiveSheet()->getStyle('A5:v'.$brs_bwh)->applyFromArray($styleArray);		

		$filename='Rekap Kebencanaan '.date("Y-m-d").'.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
				             
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		$objWriter->save('php://output');
	}

	function exportWord($id)
	{		
		$kueri = $this->mlaporan->editBencana($id);

		$this->load->library('word');

		$document = $this->word->loadTemplate('./template/Template.docx');

		if(isset($kueri->tanggal_bencana) AND $kueri->tanggal_bencana != "00-00-0000")
        { 
        	$tanggal = ganti_tanggal($kueri->tanggal_bencana)." PUKUL ".$kueri->waktu_bencana;
        }
        else
        {
        	$tanggal = "";
        }

        $meninggal = ($kueri->excel_bencana == 0)?$kueri->meninggal:$this->mlaporan->getNumKorban(0,$kueri->id_bencana);
		$hilang = ($kueri->excel_bencana == 0)?$kueri->hilang:$this->mlaporan->getNumKorban(1,$kueri->id_bencana);
		$berat = ($kueri->excel_bencana == 0)?$kueri->berat:$this->mlaporan->getNumKorban(2,$kueri->id_bencana);
		$ringan = ($kueri->excel_bencana == 0)?$kueri->ringan:$this->mlaporan->getNumKorban(3,$kueri->id_bencana);
		$pengungsi = ($kueri->excel_bencana == 0)?$kueri->pengungsi:$this->mlaporan->getNumPengungsi(1,$kueri->id_bencana);
		$menderita = ($kueri->excel_bencana == 0)?$kueri->menderita:$this->mlaporan->getNumPengungsi(2,$kueri->id_bencana);
		$rusak = ($kueri->excel_bencana == 0)?$kueri->rusak:$this->mlaporan->getNumRusak($kueri->id_bencana);

        $lokasi = (isset($kueri->id_lokasi))?"Kec. ".$kueri->nama_kecamatan." Kel. ".$kueri->nama_kelurahan:"";
        $alamat = (isset($kueri->id_lokasi))?"Dusun ".$kueri->nama_dusun." Rt ".$kueri->rt_lokasi:"";

		$document->setValue('nama', isset($kueri->nama_jenis_bencana)?$kueri->nama_jenis_bencana:"");
		$document->setValue('tanggal', $tanggal);
		$document->setValue('lokasi', $lokasi);
		$document->setValue('alamat', $alamat);
		$document->setValue('long', isset($kueri->long_lokasi)?$kueri->long_lokasi:"");
		$document->setValue('lat', isset($kueri->lat_lokasi)?$kueri->lat_lokasi:"");
		$document->setValue('cakup', isset($kueri->nama_jenis_bencana)?$kueri->nama_jenis_bencana:"");
		$document->setValue('sebab', isset($kueri->sebab_bencana)?$kueri->sebab_bencana:"");
		//$document->save_image('deksripsi','./assets/gambar/bpbd.jpg');
		//$document->save_image('deksripsi','./assets/gambar/bpbd.jpg',$document);
		$document->setImageValue('image1.jpg', './assets/gambar/bpbd.jpg');
		//$document->setValue('deksripsi', isset($kueri->deskripsi_bencana)?$kueri->deskripsi_bencana:"");
		$document->setValue('kondisi', isset($kueri->kondisi_bencana)?$kueri->kondisi_bencana:"");		
		$document->setValue('meninggal', $meninggal);
		$document->setValue('hilang', $hilang);
		$document->setValue('ringan', $ringan);
		$document->setValue('berat', $berat);
		$document->setValue('pengungsi', $pengungsi);
		$document->setValue('menderita', $menderita);
		$document->setValue('rusak', $rusak);		

		$filename = 'Detail_Kebencanaan.docx';
		$document->save($filename);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		flush();
		readfile($filename);
		unlink($filename);		
	}

	function update_bencana($id,$kuncine,$jenise,$bencanane,$lokasine,$val,$waktune,$tahune,$bulane,$tanggale,$sort_by,$sort_order,$page)
	{
		if($this->session->userdata('user_email') != 'admin')
		{
			$this->message->set('notice',"Maaf anda tidak berhak mengakses");
			redirect('home/index/'.$kuncine.'/'.$jenise.'/'.$bencanane.'/'.$lokasine.'/'.$val.'/'.$waktune.'/'.$tahune.'/'.$bulane.'/'.$tanggale.'/'.$sort_by.'/'.$sort_order.'/'.$page);
		}

		if($id == "")
		{
			$this->message->set('notice','Maaf parameter salah');
			redirect('home/index/'.$kuncine.'/'.$jenise.'/'.$bencanane.'/'.$lokasine.'/'.$val.'/'.$waktune.'/'.$tahune.'/'.$bulane.'/'.$tanggale.'/'.$sort_by.'/'.$sort_order.'/'.$page);
		}

		$eksel = ($_FILES["userfile"]["name"] != "")?1:0;
		$this->mlaporan->updateBencana($id,$eksel);

		if($_FILES["userfile"]["name"] != "")
		{
			$this->mlaporan->delAll($id);

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
								$this->mlaporan->addMeninggal($id,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F'],$value['G']);
							}
							elseif($key == 1)
							{
								$this->mlaporan->addHilang($id,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F'],$value['G'],$value['H']);
							}
							elseif($key == 2)
							{
								$this->mlaporan->addLr($id,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F']);
							}
							elseif($key ==3)
							{
								$this->mlaporan->addLb($id,$key,$value['B'],$value['C'],$value['D'],$value['E'],$value['F']);
							}						
							elseif($key ==4)
							{
								$awal = 4;
								for($i=1;$i<=14;$i++)
								{
									$kolom = $huruf[$awal+$i];
									$this->mlaporan->addNgungsi($id,$value['B'],$value['C'],$value['D'],$value['E'],$value['T'],$i,$value[$kolom]);
								}
							}
							elseif($key == 5)
							{
								$awal = 0;
								for($i=1;$i<=14;$i++)
								{
									$kolom = $huruf[$awal+$i];
									$this->mlaporan->addMenderita($id,$value['T'],$i,$value[$kolom]);
								}
							}
							else
							{
								$awal = 0;
								for($i=1;$i<=23;$i++)
								{
									$kolom = $huruf[$awal+$i];
									$this->mlaporan->addRusak($id,$i,$value[$kolom],$value['Y']);
								}
							}
						}
						$no++;
					}				
				}
				unlink($uploadpath);			
			}
		}

		if($this->db->affected_rows() > 0)
		{
			$this->message->set('succes','Laporan data kebencanaan berhasil diupdate');
		}
		else
		{
			$this->message->set('notice','Laporan data kebencanaan gagal diupdate');
		}
		redirect('home/index/'.$kuncine.'/'.$jenise.'/'.$bencanane.'/'.$lokasine.'/'.$val.'/'.$waktune.'/'.$tahune.'/'.$bulane.'/'.$tanggale.'/'.$sort_by.'/'.$sort_order.'/'.$page);
	}
}