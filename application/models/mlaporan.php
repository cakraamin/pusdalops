<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlaporan extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	

	/*function getLaporanAll($bencana,$lokasi,$tanggal,$num,$offset,$sort_by,$sort_order)
	{
		$data = array();

		$bencana = ($bencana == 0)?"":" AND a.id_jenis_bencana='$bencana' ";
		$lokasi = ($lokasi == 0)?"":" AND a.id_lokasi='$lokasi' ";
		$tanggal = ($tanggal == "00-00-0000")?"":" AND tanggal_bencana='".get_formate($tanggal)."' ";

		$kueri = $this->db->query("SELECT * FROM bencana a,dusun b,kelurahan c WHERE a.id_lokasi=b.id_dusun AND b.id_kelurahan=c.id_kelurahan $bencana $lokasi $tanggal ORDER BY $sort_by $sort_order");
		$hasil = $kueri->result();
		foreach($hasil as $dt_hasil)
		{
			$korban = $this->getKorban($dt_hasil->id_bencana);

			$meninggal = ($dt_hasil->excel_bencana == 0)?$dt_hasil->meninggal:$korban['meninggal'];
			$hilang = ($dt_hasil->excel_bencana == 0)?$dt_hasil->hilang:$korban['hilang'];
			$berat = ($dt_hasil->excel_bencana == 0)?$dt_hasil->berat:$korban['berat'];
			$ringan = ($dt_hasil->excel_bencana == 0)?$dt_hasil->ringan:$korban['ringan'];
			$pengungsi = ($dt_hasil->excel_bencana == 0)?$dt_hasil->pengungsi:$korban['pengungsi'];
			$menderita = ($dt_hasil->excel_bencana == 0)?$dt_hasil->menderita:$korban['menderita'];

			$data[] = array(
				'id'				=> $dt_hasil->id_bencana,
				'jenis'				=> $this->getJenisBencanaId($dt_hasil->id_jenis_bencana),
				'lokasi'			=> "Kel. ".$dt_hasil->nama_kelurahan,
				'alamat'			=> "Dusun. ".$dt_hasil->nama_dusun,
				'tanggal'			=> $dt_hasil->tanggal_bencana,				
				'meninggal'			=> $meninggal,
				'hilang'			=> $hilang,
				'berat'				=> $berat,
				'ringan'			=> $ringan,
				'pengungsi'			=> $pengungsi,
				'menderita'			=> $menderita
			);
		}

		return array_slice($data, $offset, $num);
	}*/

	function getLaporanAll($kunci,$laporan,$bencana,$lokasi,$val,$waktu,$tahun,$bulan,$tanggal,$num,$offset,$sort_by,$sort_order)
	{
		$data = array();

		$pecah = explode("-", $tanggal);		
		$tanggal = $pecah[2]."-".$pecah[1]."-".$pecah[0];

		$kunci = str_replace("-", " ", $kunci);
		$kunci = ($kunci != "kosong")?" AND a.deskripsi_bencana LIKE '%".$kunci."%' ":"";

		if($laporan == 1)
		{
			if($waktu == 1)
			{
				$tamb = " AND YEAR(a.tanggal_bencana)='$tahun' ";
			}
			elseif($waktu == 2)
			{
				$tamb = " AND YEAR(a.tanggal_bencana)='$tahun' AND MONTH(a.tanggal_bencana)='$bulan' ";	
			}
			else
			{
				$tamb = " AND a.tanggal_bencana='$tanggal' ";		
			}
		}
		elseif($laporan == 2)
		{
			$tamb = " AND a.id_jenis_bencana='$bencana' ";		
		}
		elseif($laporan == 3)
		{
			if($lokasi == 1)
			{
				$tamb = " AND c.id_kecamatan='$val' ";		
			}
			else
			{
				$tamb = " AND b.id_kelurahan='$val' ";		
			}
		}
		else
		{
			$tamb = " AND a.id_jenis_bencana='$bencana' ";	
			
			if($lokasi == 1)
			{
				$tamb .= " AND c.id_kecamatan='$val' ";		
			}
			else
			{
				$tamb .= " AND b.id_kelurahan='$val' ";		
			}

			if($waktu == 1)
			{
				$tamb .= " AND YEAR(a.tanggal_bencana)='$tahun' ";
			}
			elseif($waktu == 2)
			{
				$tamb .= " AND YEAR(a.tanggal_bencana)='$tahun' AND MONTH(a.tanggal_bencana)='$bulan' ";	
			}
			else
			{
				$tamb .= " AND a.tanggal_bencana='$tanggal' ";		
			}
		}

		$sql = "SELECT * FROM bencana a,kelurahan b,kecamatan c,dusun d WHERE a.id_lokasi=d.id_dusun AND d.id_kelurahan=b.id_kelurahan AND b.id_kecamatan=c.id_kecamatan $kunci $tamb ORDER BY a.tanggal_bencana DESC ";		
		$kueri = $this->db->query($sql);
		$nilai = $kueri->result();

		foreach($nilai as $dt_nilai)
		{
			$meninggal = ($dt_nilai->excel_bencana == 0)?$dt_nilai->meninggal:$this->getNumKorban(0,$dt_nilai->id_bencana);
			$hilang = ($dt_nilai->excel_bencana == 0)?$dt_nilai->hilang:$this->getNumKorban(1,$dt_nilai->id_bencana);
			$berat = ($dt_nilai->excel_bencana == 0)?$dt_nilai->berat:$this->getNumKorban(2,$dt_nilai->id_bencana);
			$ringan = ($dt_nilai->excel_bencana == 0)?$dt_nilai->ringan:$this->getNumKorban(3,$dt_nilai->id_bencana);
			$pengungsi = ($dt_nilai->excel_bencana == 0)?$dt_nilai->pengungsi:$this->getNumPengungsi(1,$dt_nilai->id_bencana);
			$menderita = ($dt_nilai->excel_bencana == 0)?$dt_nilai->menderita:$this->getNumPengungsi(2,$dt_nilai->id_bencana);
			$rusak = ($dt_nilai->excel_bencana == 0)?$dt_nilai->rusak:$this->getNumRusak($dt_nilai->id_bencana);

			$data[] = array(
				'id'			=> $dt_nilai->id_bencana,
				'bencana'		=> $this->getJenisBencanaId($dt_nilai->id_jenis_bencana),
				'tanggal'		=> $dt_nilai->tanggal_bencana,
				'waktu'			=> $dt_nilai->waktu_bencana,
				'kecamatan'		=> $dt_nilai->nama_kecamatan,
				'kelurahan'		=> $dt_nilai->nama_kelurahan,
				'dusun'			=> $dt_nilai->nama_dusun,
				'rt'			=> $dt_nilai->rt_lokasi,
				'long'			=> $dt_nilai->long_lokasi,
				'lat'			=> $dt_nilai->lat_lokasi,
				'cakup'			=> $dt_nilai->cakup_bencana,
				'sebab'			=> $dt_nilai->sebab_bencana,
				'keterangan'	=> $dt_nilai->deskripsi_bencana,
				'sumber'		=> $dt_nilai->sumber_informasi,
				'cuaca'			=> $dt_nilai->kondisi_bencana,
				'meninggal'		=> $meninggal,
				'hilang'		=> $hilang,
				'berat'			=> $berat,
				'ringan'		=> $ringan,
				'pengungsi'		=> $pengungsi,
				'menderita'		=> $menderita,
				'rusak'			=> $rusak
			);
		}

		return array_slice($data, $offset, $num);
	}

	function getNumLaporanAll($kunci,$laporan,$bencana,$lokasi,$val,$waktu,$tahun,$bulan,$tanggal)
	{
		$data = array();

		$pecah = explode("-", $tanggal);
		$tanggal = $pecah[2]."-".$pecah[1]."-".$pecah[0];

		$kunci = str_replace("-", " ", $kunci);
		$kunci = ($kunci != "kosong")?" AND a.deskripsi_bencana LIKE '%".$kunci."%' ":"";

		if($laporan == 1)
		{
			if($waktu == 1)
			{
				$tamb = " AND YEAR(a.tanggal_bencana)='$tahun' ";
			}
			elseif($waktu == 2)
			{
				$tamb = " AND YEAR(a.tanggal_bencana)='$tahun' AND MONTH(a.tanggal_bencana)='$bulan' ";	
			}
			else
			{
				$tamb = " AND a.tanggal_bencana='$tanggal' ";		
			}
		}
		elseif($laporan == 2)
		{
			$tamb = " AND a.id_jenis_bencana='$bencana' ";		
		}
		elseif($laporan == 3)
		{
			if($lokasi == 1)
			{
				$tamb = " AND c.id_kecamatan='$val' ";		
			}
			else
			{
				$tamb = " AND b.id_kelurahan='$val' ";		
			}
		}
		else
		{
			$tamb = " AND a.id_jenis_bencana='$bencana' ";	
			
			if($lokasi == 1)
			{
				$tamb = " AND c.id_kecamatan='$val' ";		
			}
			else
			{
				$tamb = " AND b.id_kelurahan='$val' ";		
			}

			if($waktu == 1)
			{
				$tamb .= " AND YEAR(a.tanggal_bencana)='$tahun' ";
			}
			elseif($waktu == 2)
			{
				$tamb .= " AND YEAR(a.tanggal_bencana)='$tahun' AND MONTH(a.tanggal_bencana)='$bulan' ";	
			}
			else
			{
				$tamb .= " AND a.tanggal_bencana='$tanggal' ";		
			}
		}

		$sql = "SELECT * FROM bencana a,kelurahan b,kecamatan c,dusun d WHERE a.id_lokasi=d.id_dusun AND d.id_kelurahan=b.id_kelurahan AND b.id_kecamatan=c.id_kecamatan $kunci $tamb ";				
		$kueri = $this->db->query($sql);
		return $kueri->num_rows();
	}

	function getSelekLokasi()
	{
		$query = $this->db->query("SELECT * FROM dusun a,kelurahan b,kecamatan c,kabupaten d WHERE a.id_kelurahan=b.id_kelurahan AND b.id_kecamatan=c.id_kecamatan AND c.id_kabupaten=d.id_kabupaten");

		if ($query->num_rows()> 0)
		{			
			foreach ($query->result_array() as $row)
			{
				$data[$row['id_dusun']] = "Dusun ".$row['nama_dusun']." Kelurahan ".$row['nama_kelurahan']." Kecamatan ".$row['nama_kecamatan']." Kabupaten ".$row['nama_kabupaten'];
			}
		}
		else
		{
			$data[''] = "";
		}
		$query->free_result();
		return $data;
	}

	function getKecamatan()
	{
		$query = $this->db->query("SELECT * FROM kecamatan");

		if ($query->num_rows()> 0)
		{			
			foreach ($query->result_array() as $row)
			{
				$data[$row['id_kecamatan']] = "Kecamatan ".$row['nama_kecamatan'];
			}
		}
		else
		{
			$data[''] = "";
		}
		$query->free_result();
		return $data;
	}

	function getKelurahan()
	{
		$query = $this->db->query("SELECT * FROM kelurahan a,kecamatan b WHERE a.id_kecamatan=b.id_kecamatan");

		if ($query->num_rows()> 0)
		{			
			foreach ($query->result_array() as $row)
			{
				$data[$row['id_kelurahan']] = "Kelurahan ".$row['nama_kelurahan']." Kecamatan ".$row['nama_kecamatan'];
			}
		}
		else
		{
			$data[''] = "";
		}
		$query->free_result();
		return $data;
	}

	function getKorban($id)
	{	
		$data = array(
			'meninggal'		=> $this->getNumKorban(0,$id),
			'hilang'		=> $this->getNumKorban(1,$id),
			'berat'			=> $this->getNumKorban(2,$id),
			'ringan'		=> $this->getNumKorban(3,$id),
			'pengungsi'		=> $this->getNumPengungsi(1,$id),
			'menderita'		=> $this->getNumPengungsi(2,$id)
		);

		return $data;
	}

	function getNumKorban($id,$kode)
	{
		$kueri = $this->db->query("SELECT * FROM korban_bencana WHERE id_korban='$id' AND id_bencana='$kode'");
		return $kueri->num_rows();
	}	

	function getNumPengungsi($kode,$id)
	{
		$kode = ($kode == 1)?" AND tingkat_detail BETWEEN 0 AND 13 ":" AND tingkat_detail BETWEEN 14 AND 25 ";
		$kueri = $this->db->query("SELECT SUM(value_detail) as jumlah FROM detail_bencana WHERE id_bencana='$id' $kode");
		$hasil = $kueri->row();
		$nilai = isset($hasil->jumlah)?$hasil->jumlah:0;
		return $nilai;
	}

	function getNumRusak($id)
	{
		$cekJum = $this->db->query("SELECT SUM(value_rusak_bencana) as jumlah FROM rusak_bencana WHERE id_bencana='$id'");
		$hasil = $cekJum->row();
		$nilai = isset($hasil->jumlah)?$hasil->jumlah:0;
		return $nilai;
	}

	function editBencana($id)
	{
		$kueri = $this->db->query("SELECT * FROM bencana a,kelurahan b,kecamatan c,kabupaten d,propinsi e,dusun f,jenis_bencana g WHERE a.id_bencana='$id' AND a.id_lokasi=f.id_dusun AND f.id_kelurahan=b.id_kelurahan AND b.id_kecamatan=c.id_kecamatan AND c.id_kabupaten=d.id_kabupaten AND d.id_propinsi=e.id_propinsi AND a.id_jenis_bencana=g.id_jenis_bencana");
		return $kueri->row();
	}

	function editDetailBencana($id)
	{
		$hasil = array();
		$satu = 0;
		$dua = 0;
		$tiga = 0;
		$empat = 0;

		$kueri = $this->db->query("SELECT * FROM detail_bencana WHERE id_bencana='$id' ORDER BY tingkat_detail ASC");
		$data = $kueri->result();

		foreach($data as $dt)		
		{
			if($dt->tingkat_detail < 14)
			{
				if($dt->tingkat_detail == 2 || $dt->tingkat_detail == 4 || $dt->tingkat_detail == 6 || $dt->tingkat_detail == 8 || $dt->tingkat_detail == 12)
				{
					$satu = $satu + $dt->value_detail;
				}
				elseif($dt->tingkat_detail == 3 || $dt->tingkat_detail == 5 || $dt->tingkat_detail == 7 || $dt->tingkat_detail == 9 || $dt->tingkat_detail == 10 || $dt->tingkat_detail == 11 || $dt->tingkat_detail == 13)
				{
					$dua = $dua + $dt->value_detail;
				}
			}
			else
			{
				if($dt->tingkat_detail == 16 || $dt->tingkat_detail == 18 || $dt->tingkat_detail == 20 || $dt->tingkat_detail == 22 || $dt->tingkat_detail == 26)
				{
					$tiga = $tiga + $dt->value_detail;
				}
				elseif($dt->tingkat_detail == 17 || $dt->tingkat_detail == 19 || $dt->tingkat_detail == 21 || $dt->tingkat_detail == 23 || $dt->tingkat_detail == 24 || $dt->tingkat_detail == 25 || $dt->tingkat_detail == 27)
				{
					$empat = $empat + $dt->value_detail;
				}
			}			
		}

		$hasil = array(
			'satu'		=> $satu,
			'dua'		=> $dua,
			'tiga'		=> $tiga,
			'empat'		=> $empat
		);

		return $hasil;
	}

	function editKorbanBencana($id)
	{
		$hasil = array();
		$detil = array();		

		$jenis = array('meninggal','hilang','ringan','berat');

		foreach($jenis as $key => $dt_jenis)
		{
			$laki = 0;
			$pr =0;

			$kueri = $this->db->query("SELECT * FROM korban_bencana WHERE id_bencana='$id' AND id_korban='$key' ORDER BY id_korban_bencana ASC");
			$nilai = $kueri->result();

			foreach($nilai as $dt_nilai)
			{
				$jk = ($dt_nilai->jk_korban == 'L')?$laki=$laki+1:$pr=$pr+1;
			}

			$hasil[$dt_jenis] = array(
				'l'		=> $laki,
				'p'		=> $pr
			);
		}		

		return $hasil;
	}

	function editRusakBencana($id)
	{
		$hasil = array();

		$kueri = $this->db->query("SELECT * FROM rusak_bencana WHERE id_bencana='$id' ORDER BY tingkat_rusak_bencana ASC");	
		$nilai = $kueri->result();

		foreach($nilai as $key => $dt_nilai)
		{
			if($key == 0)
			{
				$hasil['taksiran'] =  $dt_nilai->taksiran_rusak_bencana;	
			}
			$nilai = (isset($dt_nilai->value_rusak_bencana))?$dt_nilai->value_rusak_bencana:0;
			$hasil[$dt_nilai->tingkat_rusak_bencana] = $nilai;
		}

		return $hasil;
	}

	function getBencana($laporan,$bencana,$lokasi,$waktu,$tahun,$bulan,$tanggal)
	{
		$data = array();		
		$pecah = explode("-", $tanggal);
		$tanggal = $pecah[2]."-".$pecah[1]."-".$pecah[0];

		if($laporan == 1)
		{
			if($waktu == 1)
			{
				$tamb = " AND YEAR(a.tanggal_bencana)='$tahun' ";
			}
			elseif($waktu == 2)
			{
				$tamb = " AND YEAR(a.tanggal_bencana)='$tahun' AND MONTH(a.tanggal_bencana)='$bulan' ";	
			}
			else
			{
				$tamb = " AND a.tanggal_bencana='$tanggal' ";		
			}
		}
		elseif($laporan == 2)
		{
			$tamb = " AND a.id_jenis_bencana='$bencana' ";		
		}
		elseif($laporan == 3)
		{
			$tamb = " AND a.id_lokasi='$lokasi' ";		
		}
		else
		{
			$tamb = " AND a.id_jenis_bencana='$bencana' ";	
			$tamb .= " AND a.id_lokasi='$lokasi' ";
			if($waktu == 1)
			{
				$tamb .= " AND YEAR(a.tanggal_bencana)='$tahun' ";
			}
			elseif($waktu == 2)
			{
				$tamb .= " AND YEAR(a.tanggal_bencana)='$tahun' AND MONTH(a.tanggal_bencana)='$bulan' ";	
			}
			else
			{
				$tamb .= " AND a.tanggal_bencana='$tanggal' ";		
			}
		}

		$kueri = $this->db->query("SELECT * FROM bencana a,kelurahan b,kecamatan c,dusun d WHERE a.id_lokasi=d.id_dusun AND d.id_kelurahan=b.id_kelurahan AND b.id_kecamatan=c.id_kecamatan $tamb ");
		$nilai = $kueri->result();

		foreach($nilai as $dt_nilai)
		{
			$meninggal = ($dt_nilai->excel_bencana == 0)?$dt_nilai->meninggal:$this->getNumKorban(0,$dt_nilai->id_bencana);
			$hilang = ($dt_nilai->excel_bencana == 0)?$dt_nilai->hilang:$this->getNumKorban(1,$dt_nilai->id_bencana);
			$berat = ($dt_nilai->excel_bencana == 0)?$dt_nilai->berat:$this->getNumKorban(2,$dt_nilai->id_bencana);
			$ringan = ($dt_nilai->excel_bencana == 0)?$dt_nilai->ringan:$this->getNumKorban(3,$dt_nilai->id_bencana);
			$pengungsi = ($dt_nilai->excel_bencana == 0)?$dt_nilai->pengungsi:$this->getNumPengungsi(1,$dt_nilai->id_bencana);
			$menderita = ($dt_nilai->excel_bencana == 0)?$dt_nilai->menderita:$this->getNumPengungsi(2,$dt_nilai->id_bencana);
			$rusak = ($dt_nilai->excel_bencana == 0)?$dt_nilai->rusak:$this->getNumRusak($dt_nilai->id_bencana);

			$data[] = array(
				'bencana'		=> $this->getJenisBencanaId($dt_nilai->id_jenis_bencana),
				'tanggal'		=> $dt_nilai->tanggal_bencana,
				'waktu'			=> $dt_nilai->waktu_bencana,
				'kecamatan'		=> $dt_nilai->nama_kecamatan,
				'kelurahan'		=> $dt_nilai->nama_kelurahan,
				'dusun'			=> $dt_nilai->nama_dusun,
				'rt'			=> $dt_nilai->rt_lokasi,
				'long'			=> $dt_nilai->long_lokasi,
				'lat'			=> $dt_nilai->lat_lokasi,
				'cakup'			=> $dt_nilai->cakup_bencana,
				'sebab'			=> $dt_nilai->sebab_bencana,
				'keterangan'	=> $dt_nilai->deskripsi_bencana,
				'sumber'		=> $dt_nilai->sumber_informasi,
				'cuaca'			=> $dt_nilai->kondisi_bencana,
				'meninggal'		=> $meninggal,
				'hilang'		=> $hilang,
				'berat'			=> $berat,
				'ringan'		=> $ringan,
				'pengungsi'		=> $pengungsi,
				'menderita'		=> $menderita,
				'rusak'			=> $rusak
			);
		}

		return $data;
	}

	function getBencanaWord($id)
	{
		$data = array();		

		$kueri = $this->db->query("SELECT * FROM bencana a,kelurahan b,kecamatan c,dusun d WHERE a.id_lokasi=d.id_dusun AND d.id_kelurahan=b.id_kelurahan AND b.id_kecamatan=c.id_kecamatan AND a.id_bencana='$id'");
		$dt_nilai = $kueri->row();

			$meninggal = ($dt_nilai->excel_bencana == 0)?$dt_nilai->meninggal:$this->getNumKorban(0,$dt_nilai->id_bencana);
			$hilang = ($dt_nilai->excel_bencana == 0)?$dt_nilai->hilang:$this->getNumKorban(1,$dt_nilai->id_bencana);
			$berat = ($dt_nilai->excel_bencana == 0)?$dt_nilai->berat:$this->getNumKorban(2,$dt_nilai->id_bencana);
			$ringan = ($dt_nilai->excel_bencana == 0)?$dt_nilai->ringan:$this->getNumKorban(3,$dt_nilai->id_bencana);
			$pengungsi = ($dt_nilai->excel_bencana == 0)?$dt_nilai->pengungsi:$this->getNumPengungsi(1,$dt_nilai->id_bencana);
			$menderita = ($dt_nilai->excel_bencana == 0)?$dt_nilai->menderita:$this->getNumPengungsi(2,$dt_nilai->id_bencana);
			$rusak = ($dt_nilai->excel_bencana == 0)?$dt_nilai->rusak:$this->getNumRusak($dt_nilai->id_bencana);

			$data[] = array(
				'bencana'		=> $this->getJenisBencanaId($dt_nilai->id_jenis_bencana),
				'id_lokasi'		=> $dt_nilai->id_lokasi,
				'tanggal'		=> $dt_nilai->tanggal_bencana,
				'waktu'			=> $dt_nilai->waktu_bencana,
				'kecamatan'		=> $dt_nilai->nama_kecamatan,
				'kelurahan'		=> $dt_nilai->nama_kelurahan,
				'dusun'			=> $dt_nilai->nama_dusun,
				'rt'			=> $dt_nilai->rt_lokasi,
				'long'			=> $dt_nilai->long_lokasi,
				'lat'			=> $dt_nilai->lat_lokasi,
				'cakup'			=> $dt_nilai->cakup_bencana,
				'sebab'			=> $dt_nilai->sebab_bencana,
				'keterangan'	=> $dt_nilai->deskripsi_bencana,
				'sumber'		=> $dt_nilai->sumber_informasi,
				'cuaca'			=> $dt_nilai->kondisi_bencana,
				'meninggal'		=> $meninggal,
				'hilang'		=> $hilang,
				'berat'			=> $berat,
				'ringan'		=> $ringan,
				'pengungsi'		=> $pengungsi,
				'menderita'		=> $menderita,
				'rusak'			=> $rusak
			);

		return $data;
	}

	function getSelekBencana()
	{
		$query = $this->db->query("SELECT * FROM jenis_bencana");

		if ($query->num_rows()> 0)
		{			
			foreach ($query->result_array() as $row)
			{
				$data[$row['id_jenis_bencana']] = $row['nama_jenis_bencana'];
			}
		}
		else
		{
			$data[''] = "";
		}
		$query->free_result();
		return $data;
	}

	function getJenisBencanaId($id)
	{
		$kueri = $this->db->query("SELECT * FROM jenis_bencana WHERE id_jenis_bencana='$id'");
		$data = $kueri->row();
		$nilai = (isset($data->nama_jenis_bencana))?$data->nama_jenis_bencana:0;
		return $nilai;
	}

	function getSelekLokasine()
	{
		$query = $this->db->query("SELECT * FROM kecamatan a,kabupaten b,propinsi c,kelurahan d WHERE a.id_kabupaten=b.id_kabupaten AND b.id_propinsi=c.id_propinsi AND d.id_kecamatan=a.id_kecamatan");

		if ($query->num_rows()> 0)
		{			
			foreach ($query->result_array() as $row)
			{
				$data[$row['id_kelurahan']] = "Kelurahan ".$row['nama_kelurahan']." Kecamatan ".$row['nama_kecamatan']." <b>Kabupaten</b> ".$row['nama_kabupaten'];
			}
		}
		else
		{
			$data[''] = "";
		}
		$query->free_result();
		return $data;
	}

	function updateBencana($id,$eksel)

	{
		$tanggal = $this->input->post('tanggal_bencana',TRUE);
		$tanggal = explode("-", $tanggal);
		$tanggal = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];

		if($this->input->post('lokasine',TRUE) == '')
		{
			$data = array(
			   'id_dusun' 		=> '',
			   'nama_dusun' 	=> strip_tags(ascii_to_entities(addslashes($this->input->post('dusun',TRUE)))),
			   'id_kelurahan' 	=> $this->input->post('lokasi',TRUE)
			);

			$this->db->insert('dusun', $data); 
			$lokasine = $this->db->insert_id();
		}
		else
		{
			$lokasine = $this->input->post('lokasine',TRUE);
		}

		$data = array(
		   'id_jenis_bencana'	=> $this->input->post('jenis',TRUE),
		   'tanggal_bencana'	=> $tanggal,
		   'waktu_bencana'		=> $this->input->post('waktu_bencana',TRUE),
		   'id_lokasi' 			=> $lokasine,
		   'rt_lokasi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('rt_lokasi',TRUE)))),		   
		   'long_lokasi' 		=> strip_tags(ascii_to_entities(addslashes($this->input->post('long',TRUE)))),
		   'lat_lokasi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('lat',TRUE)))),		   
		   'sebab_bencana'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('sebab',TRUE)))),
		   'cakup_bencana'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('cakup_bencana',TRUE)))),
		   'deskripsi_bencana'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('editor',TRUE)))),
		   'kondisi_bencana'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('kondisi',TRUE)))),
		   'sumber_informasi'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('sumber_informasi',TRUE)))),
		   'excel_bencana'		=> $eksel,
		   'meninggal'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('meninggal',TRUE)))),
		   'hilang'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('hilang',TRUE)))),
		   'ringan'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('ringan',TRUE)))),
		   'berat'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('berat',TRUE)))),
		   'pengungsi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('pengungsi',TRUE)))),
		   'menderita'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('menderita',TRUE)))),
		   'rusak'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('rusak',TRUE))))
		);

		$this->db->where('id_bencana', $id);

		$this->db->update('bencana', $data); 

	}

	function delAll($id)
	{
		$this->db->query("DELETE FROM korban_bencana WHERE id_bencana='$id'");
		$this->db->query("DELETE FROM detail_bencana WHERE id_bencana='$id'");
		$this->db->query("DELETE FROM rusak_bencana WHERE id_bencana='$id'");
	}

	function addMeninggal($kode,$id,$nama,$alamat,$jk,$usia,$waris,$ket)
	{
		$data = array(
		   'id_korban_bencana' 	=> '',
		   'id_korban' 			=> $id,
		   'id_bencana' 		=> $kode,
		   'nama_korban'		=> $nama,
		   'alamat_korban'		=> $alamat,
		   'jk_korban'			=> $jk,
		   'usia_korban'		=> $usia,
		   'waris_korban'		=> $waris,
		   'keterangan_korban'	=> $ket
		);

		$this->db->insert('korban_bencana', $data); 
	}

	function addHilang($kode,$id,$nama,$alamat,$jk,$usia,$waris,$lokasi,$ket)
	{
		$data = array(
		   'id_korban_bencana' 	=> '',
		   'id_korban' 			=> $id,
		   'id_bencana' 		=> $kode,
		   'nama_korban'		=> $nama,
		   'alamat_korban'		=> $alamat,
		   'jk_korban'			=> $jk,
		   'usia_korban'		=> $usia,
		   'waris_korban'		=> $waris,
		   'lokasi_kroban'		=> $lokasi,
		   'keterangan_korban'	=> $ket
		);

		$this->db->insert('korban_bencana', $data); 
	}

	function addLr($kode,$id,$nama,$alamat,$jk,$usia,$ket)
	{
		$data = array(
		   'id_korban_bencana' 	=> '',
		   'id_korban' 			=> $id,
		   'id_bencana' 		=> $kode,
		   'nama_korban'		=> $nama,
		   'alamat_korban'		=> $alamat,
		   'jk_korban'			=> $jk,
		   'usia_korban'		=> $usia,		   
		   'keterangan_korban'	=> $ket
		);

		$this->db->insert('korban_bencana', $data); 
	}

	function addLb($kode,$id,$nama,$alamat,$jk,$usia,$ket)
	{
		$data = array(
		   'id_korban_bencana' 	=> '',
		   'id_korban' 			=> $id,
		   'id_bencana' 		=> $kode,
		   'nama_korban'		=> $nama,
		   'alamat_korban'		=> $alamat,
		   'jk_korban'			=> $jk,
		   'usia_korban'		=> $usia,		   
		   'keterangan_korban'	=> $ket
		);

		$this->db->insert('korban_bencana', $data); 
	}

	function addNgungsi($kode,$kd,$lokasi,$kapasitas,$jenis,$ket,$tingkat,$val)
	{
		$data = array(
		   'id_detail_bencana' 	=> '',
		   'id_bencana'			=> $kode,
		   'kode_lokasi' 		=> $kd,
		   'lokasi_detail'		=> $lokasi,
		   'kapasitas_detail'	=> $kapasitas,
		   'jenis_hunian'		=> $jenis,
		   'keterangan_detail'	=> $ket,		   
		   'tingkat_detail'		=> $tingkat,
		   'value_detail'		=> $val
		);

		$this->db->insert('detail_bencana', $data); 
	}

	function addMenderita($kode,$ket,$tingkat,$val)
	{
		$data = array(
			'id_detail_bencana' 	=> '',
			'id_bencana'			=> $kode,		  
			'keterangan_detail'	=> $ket,		   
			'tingkat_detail'		=> $tingkat,
			'value_detail'		=> $val
		);

		$this->db->insert('detail_bencana', $data);
	}

	function addRusak($kode,$in,$val,$taksiran)
	{
		$data = array(
			'id_rusak_bencana' 		=> '',
			'id_bencana'				=> $kode,		  		    
			'tingkat_rusak_bencana'	=> $in,
			'value_rusak_bencana'	=> $val,
			'taksiran_rusak_bencana'=> $taksiran
		);

		$this->db->insert('rusak_bencana', $data);
	}

	function deleteBencana($id)
	{		
		$this->delAll($id);
		$kueri = $this->db->query("DELETE FROM bencana WHERE id_bencana='$id'");

		return $kueri;
	}
}
?>
