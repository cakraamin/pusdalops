<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mberita extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}

	function getBerita($num,$offset,$sort_by,$sort_order)//menu admin
	{
		if (empty($offset))
		{
			$offset=0;
		}
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('a.id_berita');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.id_berita';
		$sql = "SELECT * FROM berita a,users b WHERE a.user_id=b.user_id ORDER BY $sort_by $sort_order LIMIT $offset,$num";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function addBerita($id,$gambar="")
	{
		$data = array(
			'id_berita' 		=> '',
		   	'judul_berita' 		=> strip_tags(ascii_to_entities(addslashes($this->input->post('judul',TRUE)))),
		   	'content_berita' 	=> strip_tags(ascii_to_entities(addslashes($this->input->post('content',TRUE)))),
		   	'gambar_berita'		=> $gambar,
		   	'tgl_berita'		=> date('Y-m-d'),
		   	'user_id'			=> $id
		);

		$this->db->insert('berita', $data); 
	}

	function deleteBerita($id)
	{
		$kueri = $this->db->query("DELETE FROM berita WHERE id_berita='$id'");
		return $kueri;
	}

	function getBeritaId($id)
	{
		$kueri = $this->db->query("SELECT * FROM berita WHERE id_berita='$id'");
		return $kueri->row();
	}

	function updateBerita($id,$gambar="")
	{
		if($gambar == "")
		{
			$data = array(
	        	'judul_berita' 		=> strip_tags(ascii_to_entities(addslashes($this->input->post('judul',TRUE)))),
			   	'content_berita' 	=> strip_tags(ascii_to_entities(addslashes($this->input->post('content',TRUE)))),
			   	'tgl_berita'		=> date('Y-m-d'),
	        );
		}
		else
		{
			$data = array(
	        	'judul_berita' 		=> strip_tags(ascii_to_entities(addslashes($this->input->post('judul',TRUE)))),
			   	'content_berita' 	=> strip_tags(ascii_to_entities(addslashes($this->input->post('content',TRUE)))),
			   	'gambar_berita'		=> $gambar,
			   	'tgl_berita'		=> date('Y-m-d'),
	        );
		}		

		$this->db->where('id_berita', $id);
		$this->db->update('berita', $data); 
	}

	function getRole($id)
	{
		$kueri = $this->db->query("SELECT * FROM user_roles WHERE userID='$id'");
		$hasil = $kueri->row();
		$data = (isset($hasil->roleID))?$hasil->roleID:0;
		return $data;
	}	

	function getBeritaDetil($id)
	{
		$kueri = $this->db->query("SELECT * FROM berita WHERE id_berita='$id'");
		return $kueri->result();
	}

	function getBeritaUnread($arey)
	{
		$data = array();

		$pecah = explode("-", $arey);
		foreach($pecah as $dt_pecah)
		{
			if($dt_pecah != "")
			{					
				$query = $this->db->query("SELECT * FROM berita WHERE id_berita='$dt_pecah'");
				$hasil = $query->row();

				$id_berita = (isset($hasil->id_berita))?$hasil->id_berita:"";

				$data[] = array(
					'id_berita' 		=> $id_berita,
					'judul_berita' 		=> (isset($hasil->judul_berita))?$hasil->judul_berita:"",
					'content_berita' 	=> (isset($hasil->content_berita))?$hasil->content_berita:"",
					'gambar_berita' 	=> (isset($hasil->gambar_berita))?$hasil->gambar_berita:"",
					'tgl_berita' 		=> (isset($hasil->tgl_berita))?$hasil->tgl_berita:"",
					'user_id' 			=> (isset($hasil->user_id))?$hasil->user_id:"",
				);
				$baca = (isset($hasil->read_berita))?$hasil->read_berita:"";
				$baca = $baca.",".$this->session->userdata('user_id').",";
				$update = $this->db->query("UPDATE berita SET read_berita='$baca' WHERE id_berita='$id_berita'");
			}			
		}
		return $data;
	}

	function getGrafik()
	{
		$data = array();
		$warna = array('#aed741','#bedd17','#c3e171','#85b501','#aed741','#bedd17','#c3e171','#85b501','#aed741','#bedd17','#c3e171','#85b501','#aed741','#bedd17','#c3e171','#85b501','#aed741','#bedd17','#c3e171','#85b501','#aed741','#bedd17','#c3e171','#85b501','#aed741','#bedd17','#c3e171','#85b501','#aed741','#bedd17','#c3e171','#85b501');

		$kueriBencana = $this->db->query("SELECT * FROM jenis_bencana");
		$hasilBencana = $kueriBencana->result();

		foreach($hasilBencana as $key => $dt_hasil)		
		{
			$kueri = $this->db->query("SELECT * FROM bencana WHERE id_jenis_bencana='".$dt_hasil->id_jenis_bencana."'");

			if($kueri->num_rows() > 2)
			{
				$data[$dt_hasil->nama_jenis_bencana] = array(
					'value'		=> $kueri->num_rows(),
					'color'		=> $warna[$key]
				);
			}			
		}

		return $data;
	}

	/*public function getGrafikBencana()
	{		
		$q_dusun = $this->db->query("SELECT b.id_dusun,b.nama_dusun,c.nama_kelurahan,d.nama_kecamatan,COUNT(a.id_lokasi) as populer FROM bencana a,dusun b,kelurahan c,kecamatan d WHERE a.id_lokasi=b.id_dusun AND b.id_kelurahan=c.id_kelurahan AND c.id_kecamatan=d.id_kecamatan GROUP BY a.id_lokasi ORDER BY populer DESC LIMIT 0,10");
		$data = $q_dusun->result();		

		return $data;
	}*/

	public function getGrafikRusak()
	{		
		$hasil = array();				

		$q_kec = $this->db->query("SELECT * FROM kecamatan");
		$k_kec = $q_kec->result();
		foreach($k_kec as $detail)
		{			
			$jumlah = 0;
			
			$j_bencana = $this->db->query("SELECT * FROM bencana a,dusun b,kelurahan c,kecamatan d WHERE a.id_lokasi=b.id_dusun AND b.id_kelurahan=c.id_kelurahan AND c.id_kecamatan=d.id_kecamatan AND d.id_kecamatan='".$detail->id_kecamatan."'");
			$k_bencana = $j_bencana->result();

			foreach($k_bencana as $d_bencana)
			{
				$j_meninggal = (isset($d_bencana->meninggal))?$d_bencana->meninggal:0;
				$j_hilang = (isset($d_bencana->hilang))?$d_bencana->hilang:0;
				$j_ringan = (isset($d_bencana->ringan))?$d_bencana->ringan:0;
				$j_berat = (isset($d_bencana->berat))?$d_bencana->berat:0;
				$j_pengungsi = (isset($d_bencana->pengungsi))?$d_bencana->pengungsi:0;
				$j_menderita = (isset($d_bencana->menderita))?$d_bencana->menderita:0;
				$j_rusak = (isset($d_bencana->rusak))?$d_bencana->rusak:0;							

				$korban_bencana = $this->db->query("SELECT * FROM korban_bencana WHERE id_bencana='".$d_bencana->id_bencana."'");
				$jum_korban = $korban_bencana->num_rows();

				$jumlah = $jumlah + $jum_korban + $j_meninggal + $j_hilang + $j_ringan + $j_berat + $j_pengungsi + $j_menderita + $j_rusak;
			}			

			if($jumlah > 0)
			{
				$hasil[$detail->nama_kecamatan] = array(
					'value'		=> $jumlah
				);
			}			
		}

		return $hasil;
	}

	public function getGrafikBencana()
	{
		$hasil = array();

		$q_kec = $this->db->query("SELECT * FROM kecamatan");
		$k_kec = $q_kec->result();
		foreach($k_kec as $detail)
		{
			$j_bencana = $this->db->query("SELECT * FROM bencana a,dusun b,kelurahan c,kecamatan d WHERE a.id_lokasi=b.id_dusun AND b.id_kelurahan=c.id_kelurahan AND c.id_kecamatan=d.id_kecamatan AND d.id_kecamatan='".$detail->id_kecamatan."'");

			if($j_bencana->num_rows() > 0)
			{
				$hasil[$detail->nama_kecamatan] = array(
					'value'		=> $j_bencana->num_rows()
				);
			}			
		}

		return $hasil;
	}

	public function getGrafikTahunan($tahun)
	{
		$nilai = array();
		$bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');

		for($i=1;$i<=12;$i++)
		{
			$q_tahun = $this->db->query("SELECT * FROM bencana a,dusun b,kelurahan c,kecamatan d WHERE a.id_lokasi=b.id_dusun AND b.id_kelurahan=c.id_kelurahan AND c.id_kecamatan=d.id_kecamatan AND MONTH(a.tanggal_bencana)='$i' AND YEAR(a.tanggal_bencana)='$tahun'");
			$nilai[$i] = array(
				'bulan'			=> $bulan[$i-1],
				'value'			=> $q_tahun->num_rows()
			);
		}

		return $nilai;
	}
}
?>