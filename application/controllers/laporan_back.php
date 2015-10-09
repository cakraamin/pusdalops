<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library(array('arey','excel'));
		$this->load->helper(array('tanggal','terbilang'));
		$this->load->model('mlaporan','',TRUE);		

		if(!$this->session->userdata('logged_in')) 
		{
			redirect('home');
		}
	}

	function index()
	{
		$data = array(
			'main'			=> 'laporan',
			'laporan'		=> 'select',	
			'jenis'			=> $this->arey->getJenisLap(),
			'bulan'			=> $this->arey->getBulanLap(),
			'tahun'			=> $this->arey->getTahunLap()
		);

		$this->load->view('template',$data);
	}

	function generate()
	{
		if($this->input->post('jenis') == 1)
		{
			$this->generate_harian();
		}
		elseif($this->input->post('jenis') == 2)
		{
			$this->generate_bulanan();
		}
		elseif($this->input->post('jenis') == 3)
		{
			$this->generate_tahunan();
		}
		elseif($this->input->post('jenis') == 4)
		{
			$this->generate_custom();
		}
		elseif($this->input->post('jenis') == 5)
		{
			$this->generate_history();
		}
		else
		{
			echo "belum";
		}
	}

	function generate_harian()
	{
		$kolomsss = array();
		$huruf = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','F','W','X','Y','Z');
		$abjad = array('I','II','III','IV','V');		

		/*$tanggal = $this->input->post('daily',TRUE);
		$pecah = explode("-", $tanggal);
		$tanggal = $pecah[2]." ".$this->arey->getBulanLap(intval($pecah[1]))." ".$pecah[0];

		$barang = $this->mlaporan->getBarang($this->input->post('daily',TRUE),0,1);*/

		//$tanggal = date('Y-m-d');
		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(0);		
		$objWorksheet = $this->excel->getActiveSheet();
		$tgl1 = $this->input->post('lawal',TRUE);
		$tgl2 = $this->input->post('lakhir',TRUE);
		$lapMinggu = $this->mlaporan->getGraphHarian($tgl1,$tgl2);
		$jumLapMinggu = count($lapMinggu);
		$objWorksheet->fromArray($lapMinggu);
	
		//laporan fly ash 1#2
		$dataseriesLabels1 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues1 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues1 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$2:$B$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$2:$C$'.$jumLapMinggu, NULL, 4),						
		);

		$series1 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues1)-1),			// plotOrder
			$dataseriesLabels1,								// plotLabel
			$xAxisTickValues1,								// plotCategory
			$dataSeriesValues1								// plotValues
		);
		
		$series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea1 = new PHPExcel_Chart_PlotArea(NULL, array($series1));
	
		$legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title1 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN FLY ASH 1#2');
		$yAxisLabel1 = new PHPExcel_Chart_Title('Jumlah');

		$chart1 = new PHPExcel_Chart(
			'chart1',		// name
			$title1,			// title
			$legend1,		// legend
			$plotarea1,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel1		// yAxisLabel
		);

		$chart1->setTopLeftPosition('A1');
		$chart1->setBottomRightPosition('H25');

		$objWorksheet->addChart($chart1);

		//laporan fly ash 3#4
		$dataseriesLabels2 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues2 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues2 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$2:$E$'.$jumLapMinggu, NULL, 4),						
		);

		$series2 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues2)-1),			// plotOrder
			$dataseriesLabels2,								// plotLabel
			$xAxisTickValues2,								// plotCategory
			$dataSeriesValues2								// plotValues
		);
		
		$series2->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea2 = new PHPExcel_Chart_PlotArea(NULL, array($series2));
	
		$legend2 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title2 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN FLY ASH 3#4');
		$yAxisLabel2 = new PHPExcel_Chart_Title('Jumlah');

		$chart2 = new PHPExcel_Chart(
			'chart2',		// name
			$title2,			// title
			$legend2,		// legend
			$plotarea2,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel2		// yAxisLabel
		);

		$chart2->setTopLeftPosition('H1');
		$chart2->setBottomRightPosition('O25');

		$objWorksheet->addChart($chart2);

		//laporan bottom ash 1#2
		$dataseriesLabels3 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues3 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues3 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$F$2:$F$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$G$2:$G$'.$jumLapMinggu, NULL, 4),						
		);

		$series3 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues3)-1),			// plotOrder
			$dataseriesLabels3,								// plotLabel
			$xAxisTickValues3,								// plotCategory
			$dataSeriesValues3								// plotValues
		);
		
		$series3->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea3 = new PHPExcel_Chart_PlotArea(NULL, array($series3));
	
		$legend3 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title3 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN BOTTOM ASH 1#2');
		$yAxisLabel3 = new PHPExcel_Chart_Title('Jumlah');

		$chart3 = new PHPExcel_Chart(
			'chart3',		// name
			$title3,			// title
			$legend3,		// legend
			$plotarea3,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel3		// yAxisLabel
		);

		$chart3->setTopLeftPosition('A26');
		$chart3->setBottomRightPosition('H50');

		$objWorksheet->addChart($chart3);

		//laporan bottom ash 3#4
		$dataseriesLabels4 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues4 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues4 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$2:$E$'.$jumLapMinggu, NULL, 4),						
		);

		$series4 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues4)-1),			// plotOrder
			$dataseriesLabels4,								// plotLabel
			$xAxisTickValues4,								// plotCategory
			$dataSeriesValues4								// plotValues
		);
		
		$series4->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea4 = new PHPExcel_Chart_PlotArea(NULL, array($series4));
	
		$legend4 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title4 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN BOTTOM ASH 3#4');
		$yAxisLabel4 = new PHPExcel_Chart_Title('Jumlah');

		$chart4 = new PHPExcel_Chart(
			'chart4',		// name
			$title4,			// title
			$legend4,		// legend
			$plotarea4,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel4		// yAxisLabel
		);

		$chart4->setTopLeftPosition('H26');
		$chart4->setBottomRightPosition('O50');

		$objWorksheet->addChart($chart4);

		//laporan gypsum 1#2
		$dataseriesLabels5 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues5 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues5 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$H$2:$H$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$I$2:$I$'.$jumLapMinggu, NULL, 4),						
		);

		$series5 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues5)-1),			// plotOrder
			$dataseriesLabels5,								// plotLabel
			$xAxisTickValues5,								// plotCategory
			$dataSeriesValues5								// plotValues
		);
		
		$series5->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea5 = new PHPExcel_Chart_PlotArea(NULL, array($series5));
	
		$legend5 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title5 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN GYPSUM 1#2');
		$yAxisLabel5 = new PHPExcel_Chart_Title('Jumlah');

		$chart5 = new PHPExcel_Chart(
			'chart5',		// name
			$title5,			// title
			$legend5,		// legend
			$plotarea5,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel5		// yAxisLabel
		);

		$chart5->setTopLeftPosition('A51');
		$chart5->setBottomRightPosition('H75');

		$objWorksheet->addChart($chart5);

		//laporan gypsum 3#4
		$dataseriesLabels6 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues6 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues6 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$2:$E$'.$jumLapMinggu, NULL, 4),						
		);

		$series6 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues6)-1),			// plotOrder
			$dataseriesLabels6,								// plotLabel
			$xAxisTickValues6,								// plotCategory
			$dataSeriesValues6								// plotValues
		);
		
		$series6->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea6 = new PHPExcel_Chart_PlotArea(NULL, array($series6));
	
		$legend6 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title6 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN GYPSUM 3#4');
		$yAxisLabel6 = new PHPExcel_Chart_Title('Jumlah');

		$chart6 = new PHPExcel_Chart(
			'chart6',		// name
			$title6,			// title
			$legend6,		// legend
			$plotarea6,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel6		// yAxisLabel
		);

		$chart6->setTopLeftPosition('H51');
		$chart6->setBottomRightPosition('O75');

		$objWorksheet->addChart($chart6);

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(1);
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(7);
		
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
		$objDrawings->setCoordinates('T1');
		$objDrawings->setWorksheet($this->excel->getActiveSheet());
				
		$this->excel->getActiveSheet()->mergeCells('C1:S1');				
		$this->excel->getActiveSheet()->setCellValue('C1', 'LAPORAN HARIAN PLTU TANGGAL');
		$this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);		
		$this->excel->getActiveSheet()->mergeCells('A3:A6');		
		$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('B3:B6');		
		$this->excel->getActiveSheet()->setCellValue('B3', 'MATERIAL TYPE');
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('C3:I3');		
		$this->excel->getActiveSheet()->setCellValue('C3', 'LAGOON');
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('C4:C6');		
		$this->excel->getActiveSheet()->setCellValue('C4', 'TYPE EQUIPMENT');
		$this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('D4:D6');		
		$this->excel->getActiveSheet()->setCellValue('D4', 'OPERATOR NAME');
		$this->excel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D4')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('E4:I4');
		$this->excel->getActiveSheet()->setCellValue('E4', 'VOLUME(kg)');
		$this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('E5:F5');
		$this->excel->getActiveSheet()->setCellValue('E5', 'EMPTY');
		$this->excel->getActiveSheet()->getStyle('E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('E6', 'VOL');
		$this->excel->getActiveSheet()->getStyle('E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('F6', 'TIME');
		$this->excel->getActiveSheet()->getStyle('F6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('G5:H5');
		$this->excel->getActiveSheet()->setCellValue('G5', 'GROSS');
		$this->excel->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('G6', 'VOL');
		$this->excel->getActiveSheet()->getStyle('G6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('H6', 'TIME');
		$this->excel->getActiveSheet()->getStyle('H6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('I5:I6');		
		$this->excel->getActiveSheet()->setCellValue('I5', 'NETT');
		$this->excel->getActiveSheet()->getStyle('I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('I5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells('J3:V3');		
		$this->excel->getActiveSheet()->setCellValue('J3', 'OFF TAKING');
		$this->excel->getActiveSheet()->getStyle('J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('J4:J6');		
		$this->excel->getActiveSheet()->setCellValue('J4', 'NO');
		$this->excel->getActiveSheet()->getStyle('J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('J4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('K4:K6');		
		$this->excel->getActiveSheet()->setCellValue('K4', 'SURAT JALAN');
		$this->excel->getActiveSheet()->getStyle('K4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('K4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('K4')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('L4:L6');		
		$this->excel->getActiveSheet()->setCellValue('L4', 'NO MANIFEST');
		$this->excel->getActiveSheet()->getStyle('L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('L4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('L4')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('M4:M6');		
		$this->excel->getActiveSheet()->setCellValue('M4', 'NO MGP');
		$this->excel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('M4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('M4')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('N4:N6');		
		$this->excel->getActiveSheet()->setCellValue('N4', 'POLICE NO');
		$this->excel->getActiveSheet()->getStyle('N4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('N4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('N4')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('O4:O6');		
		$this->excel->getActiveSheet()->setCellValue('O4', 'TRANSPORTER');
		$this->excel->getActiveSheet()->getStyle('O4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('O4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('O4')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('P4:P6');		
		$this->excel->getActiveSheet()->setCellValue('P4', 'DRIVER NAME');
		$this->excel->getActiveSheet()->getStyle('P4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('P4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('P4')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('Q4:Q6');		
		$this->excel->getActiveSheet()->setCellValue('Q4', 'USER NAME');
		$this->excel->getActiveSheet()->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('Q4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('Q4')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('R4:V4');		
		$this->excel->getActiveSheet()->setCellValue('R4', 'VOLUME(kg)');
		$this->excel->getActiveSheet()->getStyle('R4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('R5:S5');		
		$this->excel->getActiveSheet()->setCellValue('R5', 'EMPTY');
		$this->excel->getActiveSheet()->getStyle('R5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('R6', 'VOL');
		$this->excel->getActiveSheet()->getStyle('R6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('S6', 'TIME');
		$this->excel->getActiveSheet()->getStyle('S6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('T5:U5');		
		$this->excel->getActiveSheet()->setCellValue('T5', 'GROSS');
		$this->excel->getActiveSheet()->getStyle('T5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('T6', 'VOL');
		$this->excel->getActiveSheet()->getStyle('T6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('U6', 'TIME');
		$this->excel->getActiveSheet()->getStyle('U6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('V5:V6');		
		$this->excel->getActiveSheet()->setCellValue('V5', 'NETT');
		$this->excel->getActiveSheet()->getStyle('V5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('V5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('W3:W6');		
		$this->excel->getActiveSheet()->setCellValue('W3', 'REMARK');
		$this->excel->getActiveSheet()->getStyle('W3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('W3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$baris = 7;				
		$awal = $this->input->post('lawal',TRUE);
		$akhir = $this->input->post('lakhir',TRUE);
		$lawal = strtotime($awal);
		$lakhir = strtotime($akhir);
		$barang = $this->arey->getLimbah();
		for($o=$lawal;$o<=$lakhir;$o+=86400)
		{
			$no = 1;
			$tanggalt = date('Y-m-d', $o);
			$pecah = explode("-", $tanggalt);
			$this->excel->getActiveSheet()->mergeCells('A'.$baris.':W'.$baris);
			$this->excel->getActiveSheet()->setCellValue('A'.$baris, $pecah[2]." ".$this->arey->getBulanLap(intval($pecah['1']))." ".$pecah[0]);
			foreach($barang as $key => $dt_barang)
			{
				$baris++;				
				foreach($dt_barang as $kunci => $barangs)
				{
					$baris++;
					$this->excel->getActiveSheet()->setCellValue('A'.$baris, $no);
					$this->excel->getActiveSheet()->setCellValue('B'.$baris, $key." Unit ".$kunci);
					$no++;
					foreach($barangs as $barangt)
					{						
						$j = 1;
						$harian = $this->mlaporan->getHarian($barangt,$tanggalt);						
						if(count($harian) > 0)
						{
							foreach($harian as $dt_harian)
							{		
								$baris++;		
								//lagoon								
								$this->excel->getActiveSheet()->setCellValue('C'.$baris, ($dt_harian->jamtb1 == '')?$dt_harian->nopol:'-');
								$this->excel->getActiveSheet()->setCellValue('D'.$baris, ($dt_harian->jamtb1 == '')?$dt_harian->namacust:'-');
								$this->excel->getActiveSheet()->setCellValue('E'.$baris, ($dt_harian->jamtb1 == '')?$dt_harian->timbang1:'-');
								$this->excel->getActiveSheet()->setCellValue('F'.$baris, ($dt_harian->jamtb1 == '')?$dt_harian->jamtb1:'-');
								$this->excel->getActiveSheet()->setCellValue('G'.$baris, ($dt_harian->jamtb1 == '')?$dt_harian->timbang2:'-');
								$this->excel->getActiveSheet()->setCellValue('H'.$baris, ($dt_harian->jamtb1 == '')?$dt_harian->jamtb2:'-');
								$this->excel->getActiveSheet()->setCellValue('I'.$baris, ($dt_harian->jamtb1 == '')?$dt_harian->netto:'-');

								//sold
								$this->excel->getActiveSheet()->setCellValue('J'.$baris, ($dt_harian->jamtb1 == '')?'-':$j);								
							
				                $do = isset($dt_harian->nomorspk)?$dt_harian->nomorspk:"//";
				                $pecahdo = explode("/", $do);
				                $jalan = (isset($pecahdo[0]) && $pecahdo[0] != "")?$pecahdo[0]:"";
				                $manifest = (isset($pecahdo[1]) && $pecahdo[1] != "")?$pecahdo[1]:"";
				                $mgp = (isset($pecahdo[2]) && $pecahdo[2] != "")?$pecahdo[2]:"";
				            
								$this->excel->getActiveSheet()->setCellValue('K'.$baris, ($dt_harian->jamtb1 == '')?'-':$jalan);
								$this->excel->getActiveSheet()->setCellValue('L'.$baris, ($dt_harian->jamtb1 == '')?'-':$manifest);
								$this->excel->getActiveSheet()->setCellValue('M'.$baris, ($dt_harian->jamtb1 == '')?'-':$mgp);
								$this->excel->getActiveSheet()->setCellValue('N'.$baris, ($dt_harian->jamtb1 == '')?'-':$dt_harian->nopol);
								$this->excel->getActiveSheet()->setCellValue('O'.$baris, ($dt_harian->jamtb1 == '')?'-':$dt_harian->namacust);
								$this->excel->getActiveSheet()->setCellValue('P'.$baris, ($dt_harian->jamtb1 == '')?'-':$dt_harian->sopir);
								$this->excel->getActiveSheet()->setCellValue('Q'.$baris, ($dt_harian->jamtb1 == '')?'-':$dt_harian->user2);
								$this->excel->getActiveSheet()->setCellValue('R'.$baris, ($dt_harian->jamtb1 == '')?'-':$dt_harian->timbang1);
								$this->excel->getActiveSheet()->setCellValue('S'.$baris, ($dt_harian->jamtb1 == '')?'-':$dt_harian->jamtb1);
								$this->excel->getActiveSheet()->setCellValue('T'.$baris, ($dt_harian->jamtb1 == '')?'-':$dt_harian->timbang2);
								$this->excel->getActiveSheet()->setCellValue('U'.$baris, ($dt_harian->jamtb1 == '')?'-':$dt_harian->jamtb2);
								$this->excel->getActiveSheet()->setCellValue('V'.$baris, ($dt_harian->jamtb1 == '')?'-':$dt_harian->netto);
								$this->excel->getActiveSheet()->setCellValue('W'.$baris, '-');
								$j++;							
							}
						}						
					}
				}				
			}
			$baris++;			
		}

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$filename='Laporan_harian_'.date('Y-m-d').'.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
	}

	function generate_history()
	{
		$kolomsss = array();
		$huruf = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','F','W','X','Y','Z');
		$abjad = array('I','II','III','IV','V');

		//$tanggal = $this->input->post('daily',TRUE);
		//$pecah = explode("-", $tanggal);
		//$tanggal = $pecah[2]." ".$this->arey->getBulanLap(intval($pecah[1]))." ".$pecah[0];
		$tanggal = $this->arey->getBulanLap($this->input->post('bulan',TRUE))." TAHUN ".$this->input->post('thn',TRUE);
		$bulanss = $this->arey->getBulanLap($this->input->post('bulan',TRUE));	

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);	

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(11);		
		
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
		$objDrawings->setCoordinates('N1');
		$objDrawings->setWorksheet($this->excel->getActiveSheet());
				
		$this->excel->getActiveSheet()->mergeCells('B1:M1');				
		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN HARIAN PLTU BULAN '.strtoupper($tanggal));
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);		
		$this->excel->getActiveSheet()->mergeCells('A3:A4');		
		$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('B3:B4');		
		$this->excel->getActiveSheet()->setCellValue('B3', 'TANGGAL');
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$jns = array('LAGOON','OFF TAKING');
		$kolom = 2;
		foreach($jns as $jenis_out)
		{			
			$sampah = $this->arey->getLimbah();
			foreach($sampah as $key => $dt_sampah)
			{
				$nkolom = $huruf[$kolom];
				$nkolom1 = $huruf[$kolom+1];
				$this->excel->getActiveSheet()->mergeCells($nkolom.'3:'.$nkolom1.'3');		
				$this->excel->getActiveSheet()->setCellValue($nkolom.'3', $key." ".$jenis_out);
				$this->excel->getActiveSheet()->getStyle($nkolom.'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue($nkolom.'4', '1#2');
				$this->excel->getActiveSheet()->getStyle($nkolom.'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue($nkolom1.'4', '3#4');
				$this->excel->getActiveSheet()->getStyle($nkolom1.'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$kolom+=2;
			}
		}

		$jumlah = array('31','29','31','30','31','30','31','31','30','31','30','31');
		$bulan = $this->input->post('bulan',TRUE);
		$buln = $this->arey->getBulanLap($bulan);
		$tahun = $this->input->post('thn',TRUE);

		$baris = 5;
		$no=1;
		$jml = $jumlah[$bulan-1];
		for($o=1;$o<=$jml;$o++)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$baris, $no);			
			$this->excel->getActiveSheet()->setCellValue('B'.$baris, $o." ".$buln." ".$tahun);
			$kolom = 2;
			foreach($jns as $jenis_out)
			{			
				$sampah = $this->arey->getLimbah();
				foreach($sampah as $key => $dt_sampah)
				{
					$tgl = $tahun."-".$this->setTgl($bulan)."-".$this->setTgl($o);

					$satu = $this->mlaporan->getDetailHarian($tgl,$dt_sampah['1#2']);
					$dua = $this->mlaporan->getDetailHarian($tgl,$dt_sampah['3#4']);
					$nkolom = $huruf[$kolom];
					$nkolom1 = $huruf[$kolom+1];
					$this->excel->getActiveSheet()->setCellValue($nkolom.$baris, $satu);
					$this->excel->getActiveSheet()->getStyle($nkolom.$baris)->getNumberFormat()->setFormatCode('#,##0');
					$this->excel->getActiveSheet()->setCellValue($nkolom1.$baris, $dua);
					$this->excel->getActiveSheet()->getStyle($nkolom1.$baris)->getNumberFormat()->setFormatCode('#,##0');
					$kolom+=2;
				}
			}
			$no++;
			$baris++;
		}		

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$filename='History_laporan_bulan_'.$bulanss.'_'.date('Y-m-d').'.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
	}

	function setTgl($id)
	{
		$tgl = (strlen($id) == 1)?"0".$id:$id;

		return $tgl;
	}

	function generate_bulanan()
	{
		$kolomsss = array();
		$huruf = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','F','W','X','Y','Z');
		$abjad = array('I','II','III','IV','V');

		$kbulan = $this->input->post('bulan',TRUE);
		$bulan = $this->arey->getBulanLap($kbulan);
		$tahun = $this->input->post('thn',TRUE);

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(0);		
		$objWorksheet = $this->excel->getActiveSheet();
		$lapBulan = $this->mlaporan->getGraphBulananan($kbulan,$tahun);
		$jumLapBulan = count($lapBulan);
		$objWorksheet->fromArray($lapBulan);
	
		//laporan fly ash
		$dataseriesLabels1 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011			
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$D$1', NULL, 1),	//	2011			
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$E$1', NULL, 1),	//	2011			
		);
		
		$xAxisTickValues1 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapBulan, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues1 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$2:$B$'.$jumLapBulan, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$2:$C$'.$jumLapBulan, NULL, 4),			
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$'.$jumLapBulan, NULL, 4),			
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$2:$E$'.$jumLapBulan, NULL, 4),			
		);

		$series1 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues1)-1),			// plotOrder
			$dataseriesLabels1,								// plotLabel
			$xAxisTickValues1,								// plotCategory
			$dataSeriesValues1								// plotValues
		);
		
		$series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea1 = new PHPExcel_Chart_PlotArea(NULL, array($series1));
	
		$legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title1 = new PHPExcel_Chart_Title('LAPORAN BULANAN '.$tahun);
		$yAxisLabel1 = new PHPExcel_Chart_Title('Jumlah');

		$chart1 = new PHPExcel_Chart(
			'chart1',		// name
			$title1,			// title
			$legend1,		// legend
			$plotarea1,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel1		// yAxisLabel
		);

		$chart1->setTopLeftPosition('A1');
		$chart1->setBottomRightPosition('H25');

		$objWorksheet->addChart($chart1);

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(1);

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
		$objDrawings->setCoordinates('K1');
		$objDrawings->setWorksheet($this->excel->getActiveSheet());

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);		
		$this->excel->getActiveSheet()->mergeCells('B1:J1');		
		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN BULANAN PLTU '.$bulan.' '.$tahun);
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);		
		$this->excel->getActiveSheet()->mergeCells('A3:A6');		
		$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('B3:B6');		
		$this->excel->getActiveSheet()->setCellValue('B3', 'MATERIAL TYPE');
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('C3:F3');
		$this->excel->getActiveSheet()->setCellValue('C3', 'LAGOON');
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('G3:J3');
		$this->excel->getActiveSheet()->setCellValue('G3', 'OFF TAKING');
		$this->excel->getActiveSheet()->getStyle('G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('C4:D4');
		$this->excel->getActiveSheet()->setCellValue('C4', 'LAST MONTH');
		$this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('E4:F4');
		$this->excel->getActiveSheet()->setCellValue('E4', 'THIS MONTH');
		$this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				
		$this->excel->getActiveSheet()->mergeCells('E5:F5');
		$this->excel->getActiveSheet()->setCellValue('E5', 'UNTIL');
		$this->excel->getActiveSheet()->getStyle('E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('C6', '1&2');
		$this->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('D6', '3&4');
		$this->excel->getActiveSheet()->getStyle('D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('E6', '1&2');
		$this->excel->getActiveSheet()->getStyle('E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('F6', '3&4');
		$this->excel->getActiveSheet()->getStyle('F6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('G4:H4');
		$this->excel->getActiveSheet()->setCellValue('G4', 'LAST MONTH');
		$this->excel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('I4:J4');
		$this->excel->getActiveSheet()->setCellValue('I4', 'THIS MONTH');
		$this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('G5:H5');
		$this->excel->getActiveSheet()->setCellValue('G5', 'UNTIL');
		$this->excel->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('I5:J5');
		$this->excel->getActiveSheet()->setCellValue('I5', 'UNTIL');
		$this->excel->getActiveSheet()->getStyle('I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('G6', '1&2');
		$this->excel->getActiveSheet()->getStyle('G6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('H6', '3&4');
		$this->excel->getActiveSheet()->getStyle('H6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('I6', '1&2');
		$this->excel->getActiveSheet()->getStyle('I6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('J6', '3&4');
		$this->excel->getActiveSheet()->getStyle('J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('K3:K6');		
		$this->excel->getActiveSheet()->setCellValue('K3', 'REMARK');
		$this->excel->getActiveSheet()->getStyle('K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('K3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$bulan = $this->input->post('bulan',TRUE);		
		$tahun = $this->input->post('thn',TRUE);		
		if($bulan == 1)
		{
			$bulan1 = 12;
			$tahun1 = $tahun-1;
			$bulan = $bulan;
			$tahun = $tahun;
			$awal = $tahun1."-12-01";
			$akhir = $tahun."-01-31";			
		}
		else
		{
			$bulan1 = $bulan-1;
			$tahun1 = $tahun;
			$bulan = $bulan;
			$tahun = $tahun;
			$awal = $tahun."-".$bulan1."-01";
			$akhir = $tahun."-".$bulan."-31";			
		}

		//$barang = $this->mlaporan->getBarang($awal,$akhir,2);
		$baris = 7;
		$no = 1;
		
		$barang = $this->arey->getLimbah();
		foreach($barang as $key => $dt_barang)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$baris, $no);			
			$this->excel->getActiveSheet()->setCellValue('B'.$baris, $key);

			$this->excel->getActiveSheet()->setCellValue('C'.$baris, $this->mlaporan->getBulan($bulan1,$tahun1,$dt_barang['1#2'],1));
			$this->excel->getActiveSheet()->getStyle('C'.$baris)->getNumberFormat()->setFormatCode('#,##');
			$this->excel->getActiveSheet()->setCellValue('D'.$baris, $this->mlaporan->getBulan($bulan1,$tahun1,$dt_barang['3#4'],1));
			$this->excel->getActiveSheet()->getStyle('D'.$baris)->getNumberFormat()->setFormatCode('#,##');
			$this->excel->getActiveSheet()->setCellValue('E'.$baris, $this->mlaporan->getBulan($bulan,$tahun,$dt_barang['1#2'],1));
			$this->excel->getActiveSheet()->getStyle('E'.$baris)->getNumberFormat()->setFormatCode('#,##');
			$this->excel->getActiveSheet()->setCellValue('F'.$baris, $this->mlaporan->getBulan($bulan,$tahun,$dt_barang['3#4'],1));			
			$this->excel->getActiveSheet()->getStyle('F'.$baris)->getNumberFormat()->setFormatCode('#,##');
			$this->excel->getActiveSheet()->setCellValue('G'.$baris, $this->mlaporan->getBulan($bulan1,$tahun1,$dt_barang['1#2'],2));
			$this->excel->getActiveSheet()->getStyle('G'.$baris)->getNumberFormat()->setFormatCode('#,##');
			$this->excel->getActiveSheet()->setCellValue('H'.$baris, $this->mlaporan->getBulan($bulan1,$tahun1,$dt_barang['3#4'],2));
			$this->excel->getActiveSheet()->getStyle('H'.$baris)->getNumberFormat()->setFormatCode('#,##');
			$this->excel->getActiveSheet()->setCellValue('I'.$baris, $this->mlaporan->getBulan($bulan,$tahun,$dt_barang['1#2'],2));
			$this->excel->getActiveSheet()->getStyle('I'.$baris)->getNumberFormat()->setFormatCode('#,##');
			$this->excel->getActiveSheet()->setCellValue('J'.$baris, $this->mlaporan->getBulan($bulan,$tahun,$dt_barang['3#4'],2));			
			$this->excel->getActiveSheet()->getStyle('J'.$baris)->getNumberFormat()->setFormatCode('#,##');
			$this->excel->getActiveSheet()->setCellValue('K'.$baris, "-");

			$baris+=2;
			$no++;
		}

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$filename='Laporan_bulanan_'.date('Y-m-d').'.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
	}

	function generate_tahunan()
	{
		$kolomsss = array();
		$huruf = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','F','W','X','Y','Z');
		$abjad = array('I','II','III','IV','V');

		$tahun = $this->input->post('tahun',TRUE);

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(0);		
		$objWorksheet = $this->excel->getActiveSheet();
		$lapTahun = $this->mlaporan->getGraphTahunan($tahun);
		$jumLapTahun = count($lapTahun);
		$objWorksheet->fromArray($lapTahun);

		//laporan fly ash
		$dataseriesLabels1 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011			
		);
		
		$xAxisTickValues1 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapTahun, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues1 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$2:$B$'.$jumLapTahun, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$2:$C$'.$jumLapTahun, NULL, 4),			
		);

		$series1 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues1)-1),			// plotOrder
			$dataseriesLabels1,								// plotLabel
			$xAxisTickValues1,								// plotCategory
			$dataSeriesValues1								// plotValues
		);
		
		$series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea1 = new PHPExcel_Chart_PlotArea(NULL, array($series1));
	
		$legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title1 = new PHPExcel_Chart_Title('LAPORAN TAHUNAN '.$tahun.' FLY ASH');
		$yAxisLabel1 = new PHPExcel_Chart_Title('Jumlah');

		$chart1 = new PHPExcel_Chart(
			'chart1',		// name
			$title1,			// title
			$legend1,		// legend
			$plotarea1,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel1		// yAxisLabel
		);

		$chart1->setTopLeftPosition('A1');
		$chart1->setBottomRightPosition('H25');

		$objWorksheet->addChart($chart1);


		//laporan bottom ash
		$dataseriesLabels2 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011			
		);
		
		$xAxisTickValues2 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapTahun, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues2 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$'.$jumLapTahun, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$2:$E$'.$jumLapTahun, NULL, 4),			
		);

		$series2 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues2)-1),			// plotOrder
			$dataseriesLabels2,								// plotLabel
			$xAxisTickValues2,								// plotCategory
			$dataSeriesValues2								// plotValues
		);
		
		$series2->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea2 = new PHPExcel_Chart_PlotArea(NULL, array($series2));
	
		$legend2 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title2 = new PHPExcel_Chart_Title('LAPORAN TAHUNAN '.$tahun.' BOTTOM ASH');
		$yAxisLabel2 = new PHPExcel_Chart_Title('Jumlah');

		$chart2 = new PHPExcel_Chart(
			'chart2',		// name
			$title2,			// title
			$legend2,		// legend
			$plotarea2,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel2		// yAxisLabel
		);

		$chart2->setTopLeftPosition('H1');
		$chart2->setBottomRightPosition('O25');

		$objWorksheet->addChart($chart2);

		//laporan gypsum
		$dataseriesLabels3 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$D$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$E$1', NULL, 1),	//	2011			
		);
		
		$xAxisTickValues3 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapTahun, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues3 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$F$2:$F$'.$jumLapTahun, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$G$2:$G$'.$jumLapTahun, NULL, 4),			
		);

		$series3 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues3)-1),			// plotOrder
			$dataseriesLabels3,								// plotLabel
			$xAxisTickValues3,								// plotCategory
			$dataSeriesValues3								// plotValues
		);
		
		$series3->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea3 = new PHPExcel_Chart_PlotArea(NULL, array($series3));
	
		$legend3 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title3 = new PHPExcel_Chart_Title('LAPORAN TAHUNAN '.$tahun.' GYPSUM');
		$yAxisLabel3 = new PHPExcel_Chart_Title('Jumlah');

		$chart3 = new PHPExcel_Chart(
			'chart3',		// name
			$title3,			// title
			$legend3,		// legend
			$plotarea3,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel3		// yAxisLabel
		);

		$chart3->setTopLeftPosition('A26');
		$chart3->setBottomRightPosition('H50');

		$objWorksheet->addChart($chart3);

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(1);

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
		$objDrawings->setCoordinates('AE1');
		$objDrawings->setWorksheet($this->excel->getActiveSheet());

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(5);		
		$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('AC')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('AD')->setWidth(4);		
		$this->excel->getActiveSheet()->getColumnDimension('AE')->setWidth(5);		
		$this->excel->getActiveSheet()->getColumnDimension('AF')->setWidth(6);				
		$this->excel->getActiveSheet()->mergeCells('B1:AF1');		
		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN TAHUNAN PLTU '.$tahun);
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);		
		$this->excel->getActiveSheet()->mergeCells('F3:Q3');		
		$this->excel->getActiveSheet()->setCellValue('F3', 'THIS YEAR LAGUN');
		$this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('S3:AD3');		
		$this->excel->getActiveSheet()->setCellValue('S3', 'THIS YEAR OFF TAKING');
		$this->excel->getActiveSheet()->getStyle('S3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('A3:A4');		
		$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('B3:B4');		
		$this->excel->getActiveSheet()->setCellValue('B3', 'MATERIAL TYPE');
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);				
		$this->excel->getActiveSheet()->mergeCells('C3:C4');		
		$this->excel->getActiveSheet()->setCellValue('C3', 'UNIT');
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('D3:E3');		
		$this->excel->getActiveSheet()->setCellValue('D3', 'LAST YEAR');
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('D4', 'LAGUN');
		$this->excel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('E4', 'OFF TAKING');
		$this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('F4', 'JAN');
		$this->excel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('G4', 'FEB');
		$this->excel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('H4', 'MAR');
		$this->excel->getActiveSheet()->getStyle('H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('I4', 'APR');
		$this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('J4', 'MEI');
		$this->excel->getActiveSheet()->getStyle('J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('K4', 'JUN');
		$this->excel->getActiveSheet()->getStyle('K4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('L4', 'JUL');
		$this->excel->getActiveSheet()->getStyle('L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('M4', 'AUG');
		$this->excel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('N4', 'SEP');
		$this->excel->getActiveSheet()->getStyle('N4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('O4', 'OKT');
		$this->excel->getActiveSheet()->getStyle('O4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('P4', 'NOP');
		$this->excel->getActiveSheet()->getStyle('P4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('Q4', 'DES');
		$this->excel->getActiveSheet()->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('R3:R4');		
		$this->excel->getActiveSheet()->setCellValue('R3', 'TO TAL');
		$this->excel->getActiveSheet()->getStyle('R3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('R3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('R3')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('S4', 'JAN');
		$this->excel->getActiveSheet()->getStyle('S4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('T4', 'FEB');
		$this->excel->getActiveSheet()->getStyle('T4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('U4', 'MAR');
		$this->excel->getActiveSheet()->getStyle('U4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('V4', 'APR');
		$this->excel->getActiveSheet()->getStyle('V4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('W4', 'MEI');
		$this->excel->getActiveSheet()->getStyle('W4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('X4', 'JUN');
		$this->excel->getActiveSheet()->getStyle('X4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('Y4', 'JUL');
		$this->excel->getActiveSheet()->getStyle('Y4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('Z4', 'AUG');
		$this->excel->getActiveSheet()->getStyle('Z4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('AA4', 'SEP');
		$this->excel->getActiveSheet()->getStyle('AA4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('AB4', 'OKT');
		$this->excel->getActiveSheet()->getStyle('AB4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('AC4', 'NOP');
		$this->excel->getActiveSheet()->getStyle('AC4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('AD4', 'DES');
		$this->excel->getActiveSheet()->getStyle('AD4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('AE3:AE4');		
		$this->excel->getActiveSheet()->setCellValue('AE3', 'TO TAL');
		$this->excel->getActiveSheet()->getStyle('AE3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('AE3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('AE3')->getAlignment()->setWrapText(true);
		
		$this->excel->getActiveSheet()->mergeCells('AF3:AF4');		
		$this->excel->getActiveSheet()->setCellValue('AF3', 'REMARK');
		$this->excel->getActiveSheet()->getStyle('AF3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('AF3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		

		$baris = 5;
		$tahun = $this->input->post('tahun',TRUE);
		$tahun1 = $tahun - 1;
		//$barang = $this->mlaporan->getBarang($tahun,$tahun1,4);
		$no = 1;
		$barang = $this->arey->getLimbah();
		foreach($barang as $key => $dt_barang)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$baris, $no);			
			$this->excel->getActiveSheet()->setCellValue('B'.$baris, $key);

			foreach($dt_barang as $kunci => $barangs)
			{
				$this->excel->getActiveSheet()->setCellValue('C'.$baris, $kunci);				
				$this->excel->getActiveSheet()->setCellValue('D'.$baris, $this->mlaporan->getTahunan($barangs,$tahun1,0,1,1));
				$this->excel->getActiveSheet()->getStyle('D'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('E'.$baris, $this->mlaporan->getTahunan($barangs,$tahun1,0,1,2));
				$this->excel->getActiveSheet()->getStyle('E'.$baris)->getNumberFormat()->setFormatCode('#,##');

				$this->excel->getActiveSheet()->setCellValue('F'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,1,2,2));
				$this->excel->getActiveSheet()->getStyle('F'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('G'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,2,2,2));
				$this->excel->getActiveSheet()->getStyle('G'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('H'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,3,2,2));
				$this->excel->getActiveSheet()->getStyle('H'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('I'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,4,2,2));
				$this->excel->getActiveSheet()->getStyle('I'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('J'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,5,2,2));
				$this->excel->getActiveSheet()->getStyle('J'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('K'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,6,2,2));
				$this->excel->getActiveSheet()->getStyle('K'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('L'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,7,2,2));
				$this->excel->getActiveSheet()->getStyle('L'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('M'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,8,2,2));
				$this->excel->getActiveSheet()->getStyle('M'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('N'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,9,2,2));
				$this->excel->getActiveSheet()->getStyle('N'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('O'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,10,2,2));
				$this->excel->getActiveSheet()->getStyle('O'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('P'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,11,2,2));
				$this->excel->getActiveSheet()->getStyle('P'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('Q'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,12,2,2));				
				$this->excel->getActiveSheet()->getStyle('Q'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('R'.$baris, "=SUM(F".$baris.":Q".$baris.")");
				$this->excel->getActiveSheet()->getStyle('R'.$baris)->getNumberFormat()->setFormatCode('#,##');

				$this->excel->getActiveSheet()->setCellValue('S'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,1,2,1));
				$this->excel->getActiveSheet()->getStyle('S'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('T'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,2,2,1));
				$this->excel->getActiveSheet()->getStyle('T'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('U'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,3,2,1));
				$this->excel->getActiveSheet()->getStyle('U'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('V'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,4,2,1));
				$this->excel->getActiveSheet()->getStyle('V'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('W'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,5,2,1));
				$this->excel->getActiveSheet()->getStyle('W'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('X'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,6,2,1));
				$this->excel->getActiveSheet()->getStyle('X'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('Y'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,7,2,1));
				$this->excel->getActiveSheet()->getStyle('Y'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('Z'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,8,2,1));
				$this->excel->getActiveSheet()->getStyle('Z'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('AA'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,9,2,1));
				$this->excel->getActiveSheet()->getStyle('AA'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('AB'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,10,2,1));
				$this->excel->getActiveSheet()->getStyle('AB'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('AC'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,11,2,1));
				$this->excel->getActiveSheet()->getStyle('AC'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('AD'.$baris, $this->mlaporan->getTahunan($barangs,$tahun,12,2,1));				
				$this->excel->getActiveSheet()->getStyle('AD'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('AE'.$baris, "=SUM(S".$baris.":AD".$baris.")");
				$this->excel->getActiveSheet()->getStyle('AE'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$baris++;
			}

			$baris++;
			$no++;
		}

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$filename='Laporan_tahunan_'.date('Y-m-d').'.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
	}

	function pecahs($barangs)
	{
		$nilai = "";
		foreach($barangs as $barang)	
		{
			$nilai = $nilai."-".$barang;
		}
		return $nilai;
	}

	function generate_custom()
	{
		$tgls = array();

		$kolomsss = array();
		$huruf = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','F','W','X','Y','Z');
		$abjad = array('I','II','III','IV','V');

		//$tanggal = date('Y-m-d');
		$tanggal = $this->input->post('rawal');
		$seminggu = abs(7*86400);
		$awal = strtotime($tanggal)-$seminggu;
		$akhir = strtotime($tanggal)+$seminggu;
		for($i=$awal;$i<=$akhir;$i+=86400)
		{
			$tgls[] = date('Y-m-d', $i);
		}

		$tglss = $tanggal;
		$pecahss = explode("-", $tglss);
		$tglsa = $pecahss[2]." ".$this->arey->getBulanLap(intval($pecahss[1]))." ".$pecahss[0];

		$tanggal1 = $tgls[0];
		$pecah1 = explode("-", $tanggal1);
		$tanggal1 = $pecah1[2]." ".$this->arey->getBulanLap(intval($pecah1[1]))." ".$pecah1[0];

		$tanggal2 = $tgls[13];
		$pecah2 = explode("-", $tanggal2);
		$tanggal2 = $pecah2[2]." ".$this->arey->getBulanLap(intval($pecah2[1]))." ".$pecah2[0];

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(0);		
		$objWorksheet = $this->excel->getActiveSheet();
		$lapMinggu = $this->mlaporan->getGraphMingguan($tanggal);
		$jumLapMinggu = count($lapMinggu);
		$objWorksheet->fromArray($lapMinggu);
	
		//laporan fly ash 1#2
		$dataseriesLabels1 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues1 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues1 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$2:$B$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$2:$C$'.$jumLapMinggu, NULL, 4),						
		);

		$series1 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues1)-1),			// plotOrder
			$dataseriesLabels1,								// plotLabel
			$xAxisTickValues1,								// plotCategory
			$dataSeriesValues1								// plotValues
		);
		
		$series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea1 = new PHPExcel_Chart_PlotArea(NULL, array($series1));
	
		$legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title1 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN FLY ASH 1#2');
		$yAxisLabel1 = new PHPExcel_Chart_Title('Jumlah');

		$chart1 = new PHPExcel_Chart(
			'chart1',		// name
			$title1,			// title
			$legend1,		// legend
			$plotarea1,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel1		// yAxisLabel
		);

		$chart1->setTopLeftPosition('A1');
		$chart1->setBottomRightPosition('H25');

		$objWorksheet->addChart($chart1);

		//laporan fly ash 3#4
		$dataseriesLabels2 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues2 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues2 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$2:$E$'.$jumLapMinggu, NULL, 4),						
		);

		$series2 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues2)-1),			// plotOrder
			$dataseriesLabels2,								// plotLabel
			$xAxisTickValues2,								// plotCategory
			$dataSeriesValues2								// plotValues
		);
		
		$series2->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea2 = new PHPExcel_Chart_PlotArea(NULL, array($series2));
	
		$legend2 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title2 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN FLY ASH 3#4');
		$yAxisLabel2 = new PHPExcel_Chart_Title('Jumlah');

		$chart2 = new PHPExcel_Chart(
			'chart2',		// name
			$title2,			// title
			$legend2,		// legend
			$plotarea2,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel2		// yAxisLabel
		);

		$chart2->setTopLeftPosition('H1');
		$chart2->setBottomRightPosition('O25');

		$objWorksheet->addChart($chart2);

		//laporan bottom ash 1#2
		$dataseriesLabels3 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues3 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues3 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$F$2:$F$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$G$2:$G$'.$jumLapMinggu, NULL, 4),						
		);

		$series3 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues3)-1),			// plotOrder
			$dataseriesLabels3,								// plotLabel
			$xAxisTickValues3,								// plotCategory
			$dataSeriesValues3								// plotValues
		);
		
		$series3->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea3 = new PHPExcel_Chart_PlotArea(NULL, array($series3));
	
		$legend3 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title3 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN BOTTOM ASH 1#2');
		$yAxisLabel3 = new PHPExcel_Chart_Title('Jumlah');

		$chart3 = new PHPExcel_Chart(
			'chart3',		// name
			$title3,			// title
			$legend3,		// legend
			$plotarea3,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel3		// yAxisLabel
		);

		$chart3->setTopLeftPosition('A26');
		$chart3->setBottomRightPosition('H50');

		$objWorksheet->addChart($chart3);

		//laporan bottom ash 3#4
		$dataseriesLabels4 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues4 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues4 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$2:$E$'.$jumLapMinggu, NULL, 4),						
		);

		$series4 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues4)-1),			// plotOrder
			$dataseriesLabels4,								// plotLabel
			$xAxisTickValues4,								// plotCategory
			$dataSeriesValues4								// plotValues
		);
		
		$series4->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea4 = new PHPExcel_Chart_PlotArea(NULL, array($series4));
	
		$legend4 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title4 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN BOTTOM ASH 3#4');
		$yAxisLabel4 = new PHPExcel_Chart_Title('Jumlah');

		$chart4 = new PHPExcel_Chart(
			'chart4',		// name
			$title4,			// title
			$legend4,		// legend
			$plotarea4,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel4		// yAxisLabel
		);

		$chart4->setTopLeftPosition('H26');
		$chart4->setBottomRightPosition('O50');

		$objWorksheet->addChart($chart4);

		//laporan gypsum 1#2
		$dataseriesLabels5 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues5 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues5 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$H$2:$H$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$I$2:$I$'.$jumLapMinggu, NULL, 4),						
		);

		$series5 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues5)-1),			// plotOrder
			$dataseriesLabels5,								// plotLabel
			$xAxisTickValues5,								// plotCategory
			$dataSeriesValues5								// plotValues
		);
		
		$series5->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea5 = new PHPExcel_Chart_PlotArea(NULL, array($series5));
	
		$legend5 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title5 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN GYPSUM 1#2');
		$yAxisLabel5 = new PHPExcel_Chart_Title('Jumlah');

		$chart5 = new PHPExcel_Chart(
			'chart5',		// name
			$title5,			// title
			$legend5,		// legend
			$plotarea5,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel5		// yAxisLabel
		);

		$chart5->setTopLeftPosition('A51');
		$chart5->setBottomRightPosition('H75');

		$objWorksheet->addChart($chart5);

		//laporan gypsum 3#4
		$dataseriesLabels6 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1),	//	2010
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1),	//	2011						
		);
		
		$xAxisTickValues6 = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$jumLapMinggu, NULL, 4),	//	Q1 to Q4
		);
		
		$dataSeriesValues6 = array(
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$'.$jumLapMinggu, NULL, 4),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$2:$E$'.$jumLapMinggu, NULL, 4),						
		);

		$series6 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues6)-1),			// plotOrder
			$dataseriesLabels6,								// plotLabel
			$xAxisTickValues6,								// plotCategory
			$dataSeriesValues6								// plotValues
		);
		
		$series6->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

		$plotarea6 = new PHPExcel_Chart_PlotArea(NULL, array($series6));
	
		$legend6 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

		$title6 = new PHPExcel_Chart_Title('LAPORAN MINGGUAN GYPSUM 3#4');
		$yAxisLabel6 = new PHPExcel_Chart_Title('Jumlah');

		$chart6 = new PHPExcel_Chart(
			'chart6',		// name
			$title6,			// title
			$legend6,		// legend
			$plotarea6,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel6		// yAxisLabel
		);

		$chart6->setTopLeftPosition('H51');
		$chart6->setBottomRightPosition('O75');

		$objWorksheet->addChart($chart6);

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(1);
		
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
		$objDrawings->setCoordinates('U1');
		$objDrawings->setWorksheet($this->excel->getActiveSheet());

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(8);		
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8);		
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(8);		
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(8);		
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(8);		
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(8);		
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(8);		
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(7);		
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(7);		
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(7);		
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(7);		
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(7);		
		$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(7);		
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(7);		
		$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(8);		
		$this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(7);				

		$this->excel->getActiveSheet()->mergeCells('A1:X1');		
		$this->excel->getActiveSheet()->setCellValue('A1', 'LAPORAN MINGGUAN PLTU '.$tglsa.' - '.$tanggal2);
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);		
		$this->excel->getActiveSheet()->mergeCells('F3:L3');		
		$this->excel->getActiveSheet()->setCellValue('F3', 'THIS WEEK LAGUN');
		$this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('N3:T3');		
		$this->excel->getActiveSheet()->setCellValue('N3', 'THIS WEEK OFF TAKING');
		$this->excel->getActiveSheet()->getStyle('N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('A3:A4');		
		$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells('B3:B4');		
		$this->excel->getActiveSheet()->setCellValue('B3', 'MATERIAL TYPE');
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);				
		$this->excel->getActiveSheet()->mergeCells('C3:C4');		
		$this->excel->getActiveSheet()->setCellValue('C3', 'UNIT');
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		
		$this->excel->getActiveSheet()->mergeCells('D3:E3');		
		$this->excel->getActiveSheet()->setCellValue('D3', 'LAST WEEK');
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('D4', 'LAGUN');
		$this->excel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('E4', 'OFF TAKING');
		$this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('F4', $this->tanggals($tgls[7]));
		$this->excel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('G4', $this->tanggals($tgls[8]));
		$this->excel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('H4', $this->tanggals($tgls[9]));
		$this->excel->getActiveSheet()->getStyle('H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('I4', $this->tanggals($tgls[10]));
		$this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('J4', $this->tanggals($tgls[11]));
		$this->excel->getActiveSheet()->getStyle('J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('K4', $this->tanggals($tgls[12]));
		$this->excel->getActiveSheet()->getStyle('K4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('L4', $this->tanggals($tgls[13]));
		$this->excel->getActiveSheet()->getStyle('L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				
		$this->excel->getActiveSheet()->mergeCells('M3:M4');		
		$this->excel->getActiveSheet()->setCellValue('M3', 'TOTAL');
		$this->excel->getActiveSheet()->getStyle('M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('M3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('M3')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('N4', $this->tanggals($tgls[7]));
		$this->excel->getActiveSheet()->getStyle('N4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('O4', $this->tanggals($tgls[8]));
		$this->excel->getActiveSheet()->getStyle('O4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('P4', $this->tanggals($tgls[9]));
		$this->excel->getActiveSheet()->getStyle('P4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('Q4', $this->tanggals($tgls[10]));
		$this->excel->getActiveSheet()->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('R4', $this->tanggals($tgls[10]));
		$this->excel->getActiveSheet()->getStyle('R4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('S4', $this->tanggals($tgls[11]));
		$this->excel->getActiveSheet()->getStyle('S4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->setCellValue('T4', $this->tanggals($tgls[12]));
		$this->excel->getActiveSheet()->getStyle('T4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				
		$this->excel->getActiveSheet()->mergeCells('U3:U4');		
		$this->excel->getActiveSheet()->setCellValue('U3', 'TO TAL');
		$this->excel->getActiveSheet()->getStyle('U3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('U3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('U3')->getAlignment()->setWrapText(true);		
		$this->excel->getActiveSheet()->mergeCells('V3:V4');		
		$this->excel->getActiveSheet()->setCellValue('V3', 'REMARK');
		$this->excel->getActiveSheet()->getStyle('V3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		$this->excel->getActiveSheet()->getStyle('V3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		

		$baris = 5;
		//$barang = $this->mlaporan->getBarang($tgls[0],$tgls[13],2);
		$no = 1;
		$barang = $this->arey->getLimbah();
		foreach($barang as $key => $dt_barang)
		{
			$this->excel->getActiveSheet()->setCellValue('A'.$baris, $no);			
			$this->excel->getActiveSheet()->setCellValue('B'.$baris, $key);

			foreach($dt_barang as $kunci => $barangs)
			{
				$this->excel->getActiveSheet()->setCellValue('C'.$baris, $kunci);
				$this->excel->getActiveSheet()->setCellValue('D'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[0],$tgls[6],1,1));
				$this->excel->getActiveSheet()->getStyle('D'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('E'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[0],$tgls[6],1,2));
				$this->excel->getActiveSheet()->getStyle('E'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('F'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[0],0,2,1));
				$this->excel->getActiveSheet()->getStyle('F'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('G'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[1],0,2,1));
				$this->excel->getActiveSheet()->getStyle('G'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('H'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[2],0,2,1));
				$this->excel->getActiveSheet()->getStyle('H'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('I'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[3],0,2,1));
				$this->excel->getActiveSheet()->getStyle('I'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('J'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[4],0,2,1));
				$this->excel->getActiveSheet()->getStyle('J'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('K'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[5],0,2,1));
				$this->excel->getActiveSheet()->getStyle('K'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('L'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[6],0,2,1));
				$this->excel->getActiveSheet()->getStyle('L'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('M'.$baris, "=SUM(D".$baris.":L".$baris.")");
				$this->excel->getActiveSheet()->getStyle('M'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('N'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[0],0,2,2));
				$this->excel->getActiveSheet()->getStyle('N'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('O'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[1],0,2,2));
				$this->excel->getActiveSheet()->getStyle('O'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('P'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[2],0,2,2));
				$this->excel->getActiveSheet()->getStyle('P'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('Q'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[3],0,2,2));
				$this->excel->getActiveSheet()->getStyle('Q'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('R'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[4],0,2,2));
				$this->excel->getActiveSheet()->getStyle('R'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('S'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[5],0,2,2));
				$this->excel->getActiveSheet()->getStyle('S'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('T'.$baris, $this->mlaporan->getBulanan($barangs,$tgls[6],0,2,2));
				$this->excel->getActiveSheet()->getStyle('T'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('U'.$baris, "=SUM(N".$baris.":T".$baris.")");
				$this->excel->getActiveSheet()->getStyle('U'.$baris)->getNumberFormat()->setFormatCode('#,##');
				$this->excel->getActiveSheet()->setCellValue('V'.$baris, '-');
				$baris++;
			}

			$baris++;
			$no++;
		}
		

		$margin = 0.5 / 2.54;

		$this->excel->getActiveSheet()->getPageMargins()->setTop($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft($margin);
		$this->excel->getActiveSheet()->getPageMargins()->setRight($margin);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$filename='Laporan_mingguan_'.date('Y-m-d').'.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
	}

	function tanggals($id)
	{
		$bulan = array('JAN','FEB','MAR','APR','MEI','JUN','JUL','AUG','SEP','OKT','NOV','DES');
		$pecah = explode("-", $id);
		return $pecah[2]." ".$bulan[$pecah[1]-1]." ".$pecah[0];
	}
}