<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mbencana extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getSelekLokasi()
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

	function addBencana($eksel)
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
		   'id_bencana' 		=> '' ,
		   'id_jenis_bencana'	=> $this->input->post('jenis',TRUE),
		   'tanggal_bencana'	=> $tanggal,
		   'waktu_bencana'		=> $this->input->post('waktu_bencana',TRUE),
		   'id_lokasi' 			=> $lokasine,		   
		   'rt_lokasi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('rt_lokasi',TRUE)))),		   
		   'long_lokasi' 		=> strip_tags(ascii_to_entities(addslashes($this->input->post('long',TRUE)))),
		   'lat_lokasi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('lat',TRUE)))),		   
		   'sebab_bencana'		=> ucwords(strtolower(strtolostrip_tags(ascii_to_entities(addslashes($this->input->post('sebab',TRUE)))))),
		   'cakup_bencana'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('cakup_bencana',TRUE)))))),
		   'deskripsi_bencana'	=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('editor',TRUE)))))),
		   'kondisi_bencana'	=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('kondisi',TRUE)))))),
		   'sumber_informasi'	=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('sumber_informasi',TRUE)))))),
		   'excel_bencana'		=> $eksel,
		   'meninggal'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('meninggal',TRUE)))),
		   'hilang'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('hilang',TRUE)))),
		   'ringan'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('ringan',TRUE)))),
		   'berat'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('berat',TRUE)))),
		   'pengungsi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('pengungsi',TRUE)))),
		   'menderita'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('menderita',TRUE)))),
		   'rusak'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('rusak',TRUE)))),
		   'user_id'			=> $this->session->userdata('user_id'),
		   'date_bencana'		=> date('Y-m-d')
		);

		$this->db->insert('bencana', $data); 
	}

	function addImport($data)
	{		
		$this->db->insert('bencana', $data); 
	}

	function getUserId($id)
	{
		if($id == 0)
		{
			$ket = "User belum ditentukan";
		}
		else
		{
			$kueri = $this->db->query("SELECT * FROM users WHERE user_id='$id'");
			$hasil = $kueri->row();
			$ket = (!empty($hasil->user_email))?$hasil->user_email:"User belum ditentukan";			
		}

		return $ket;
	}

	function getBencana($num,$offset,$sort_by,$sort_order)//menu admin
	{
		if (empty($offset))
		{
			$offset=0;
		}

		$this->db->cache_on();
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('a.id_bencana');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.id_bencana';
		$sql = "SELECT * FROM bencana a,dusun b,jenis_bencana c,kelurahan d WHERE a.id_lokasi=b.id_dusun AND a.id_jenis_bencana=c.id_jenis_bencana AND b.id_kelurahan=d.id_kelurahan ORDER BY $sort_by $sort_order LIMIT $offset,$num";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getJumBencana()
	{		
		$sql = "SELECT * FROM bencana a,dusun b,jenis_bencana c,kelurahan d WHERE a.id_lokasi=b.id_dusun AND a.id_jenis_bencana=c.id_jenis_bencana AND b.id_kelurahan=d.id_kelurahan";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function deleteBencana($id)
	{		
		$this->delAll($id);
		$kueri = $this->db->query("DELETE FROM bencana WHERE id_bencana='$id'");

		return $kueri;
	}

	function delAll($id)
	{
		$this->db->query("DELETE FROM korban_bencana WHERE id_bencana='$id'");
		$this->db->query("DELETE FROM detail_bencana WHERE id_bencana='$id'");
		$this->db->query("DELETE FROM rusak_bencana WHERE id_bencana='$id'");
	}

	function addDetail($id)

	{

		for($j=1;$j<=42;$j++)

		{

			if($this->input->post('inputs'.$j,TRUE) != "")

			{

				$data = array(

				   'id_detail_bencana' 		=> '' ,

				   'id_bencana'				=> $id,

				   'tingkat_detail_bencana' => $j,

				   'value_detail_bencana'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('inputs'.$j,TRUE))))

				);



				$this->db->insert('detail_bencana', $data);

			}			

		}

	}

	function editBencana($id)
	{
		$kueri = $this->db->query("SELECT * FROM bencana a,dusun b WHERE a.id_lokasi=b.id_dusun AND a.id_bencana='$id'");
		return $kueri->row();
	}

	function editDetailBencana($id)

	{

		$hasil = array();



		$kueri = $this->db->query("SELECT * FROM detail_bencana WHERE id_bencana='$id'");

		$data = $kueri->result();

		foreach($data as $dt)

		{

			$hasil[$dt->tingkat_detail_bencana] = $dt->value_detail_bencana;

		}

		return $hasil;

	}

	function editRusakBencana($id)
	{
		$hasil = array();



		$kueri = $this->db->query("SELECT * FROM rusak_bencana WHERE id_bencana='$id'");

		$data = $kueri->result();

		foreach($data as $dt)

		{

			$hasil[$dt->tingkat_rusak_bencana] = $dt->value_rusak_bencana;

		}

		return $hasil;
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
		   'sebab_bencana'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('sebab',TRUE)))))),
		   'cakup_bencana'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('cakup_bencana',TRUE)))))),
		   'deskripsi_bencana'	=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('editor',TRUE)))))),
		   'kondisi_bencana'	=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('kondisi',TRUE)))))),
		   'sumber_informasi'	=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('sumber_informasi',TRUE)))))),
		   'excel_bencana'		=> $eksel,
		   'meninggal'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('meninggal',TRUE)))),
		   'hilang'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('hilang',TRUE)))),
		   'ringan'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('ringan',TRUE)))),
		   'berat'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('berat',TRUE)))),
		   'pengungsi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('pengungsi',TRUE)))),
		   'menderita'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('menderita',TRUE)))),
		   'rusak'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('rusak',TRUE)))),
		   'user_id'			=> $this->session->userdata('user_id')
		);

		$this->db->where('id_bencana', $id);

		$this->db->update('bencana', $data); 

	}	
	
	function updateFile($file,$id)
	{
		$data = array(
		   'name_excel'	=> $file,		   
		);

		$this->db->where('id_bencana', $id);

		$this->db->update('bencana', $data); 
	}
	
	function getFileImport($id)
	{
		$kueri = $this->db->query("SELECT * FROM bencana WHERE id_bencana='$id'");
		return $kueri->row();
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

	function getLokasiId($kec,$id,$dusun)
	{
		$kec = ucwords(strtolower($kec));
		$id = ucwords(strtolower($id));

		$kueriKec = $this->db->query("SELECT * FROM kecamatan WHERE nama_kecamatan='$kec'");
		if($kueriKec->num_rows() > 0)
		{
			$data = $kueriKec->row();
			$kecc = $data->id_kecamatan;
		}
		else
		{
			$data = array(
			   'id_kecamatan' 	=> '',
			   'nama_kecamatan'	=> $kec,
			   'id_kabupaten'	=> 1
			);

			$this->db->insert('kecamatan', $data); 
			$kecc = $this->db->insert_id();
		}

		$kueri = $this->db->query("SELECT * FROM kelurahan WHERE nama_kelurahan='$id' AND id_kecamatan='$kecc'");
		if($kueri->num_rows() > 0)
		{
			$data = $kueri->row();
			$kode = $data->id_kelurahan;
		}
		else
		{
			$data = array(
			   'id_kelurahan' 	=> '',
			   'nama_kelurahan'	=> $id,
			   'id_kecamatan'	=> $kecc
			);

			$this->db->insert('kelurahan', $data); 
			$kode = $this->db->insert_id();
		}

		$kueri = $this->db->query("SELECT * FROM dusun WHERE nama_dusun='$dusun' AND id_kelurahan='$kode'");
		if($kueri->num_rows() > 0)
		{
			$data = $kueri->row();
			$kodene = $data->id_dusun;
		}
		else
		{
			$data = array(
			   'id_dusun'	 	=> '',
			   'nama_dusun'		=> $dusun,
			   'id_kelurahan'	=> $kode
			);

			$this->db->insert('dusun', $data); 
			$kodene = $this->db->insert_id();
		}

		return $kodene;
	}

	function getJenisBencanaId($id)
	{
		$kueriCek = $this->db->query("SELECT * FROM jenis_bencana WHERE nama_jenis_bencana='$id'");
		if($kueriCek->num_rows() > 0)
		{
			$data = $kueriCek->row();
			$kode = $data->id_jenis_bencana;
		}
		else
		{
			$data = array(
			   'id_jenis_bencana'	 	=> '',
			   'nama_jenis_bencana'		=> $id
			);

			$this->db->insert('jenis_bencana', $data); 
			$kode = $this->db->insert_id();
		}

		return $kode;
	}

	function getLokasine($id)
	{
		$kueri = $this->db->query("SELECT * FROM dusun a,kelurahan b WHERE a.id_kelurahan=b.id_kelurahan AND a.nama_dusun LIKE '%".$id."%'");		
		
		if($kueri->num_rows() > 0)
		{
			foreach($kueri->result() as $row)
			{
				$arr['query'] = $id;
				$arr['suggestions'][] = array(
					'value'	=>$row->nama_dusun." kelurahan ".$row->nama_kelurahan,
					'data'	=>$row->id_dusun
				);
			}
		}
		else
		{
			$arr['query'] = 0;
			$arr['suggestions'][] = array(
				'value'	=> "Data Baru Akan Tersimpan",
				'data'	=> 0
			);
		}
		
		echo json_encode($arr);
	}



	/*function updateDetailBencana($id)

	{

		$kueri = $this->db->query("DELETE FROM detail_bencana WHERE id_bencana='$id'");		

		$kueri2 = $this->addDetail($id);

		return $kueri2;

	}

	function updateRusakBencana($id)
	{
		$kueri = $this->db->query("DELETE FROM rusak_bencana WHERE id_bencana='$id'");		

		$kueri2 = $this->addRusak($id);

		return $kueri2;		
	}*/

}

?>