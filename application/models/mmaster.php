<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mmaster extends CI_Model{



	function __construct()

	{

		parent::__construct();

	}	

	function getPropinsi($num,$offset,$sort_by,$sort_order)//menu admin

	{

		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('propinsi.id_propinsi');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'propinsi.id_propinsi';

		$sql = "SELECT * FROM propinsi ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		return $query->result();

	}	

	function getKabupaten($num,$offset,$sort_by,$sort_order)//menu admin

	{

		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('kabupaten.id_kabupaten');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'kabupaten.id_kabupaten';

		$sql = "SELECT * FROM kabupaten INNER JOIN propinsi ON kabupaten.id_propinsi=propinsi.id_propinsi ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function getJumKabupaten()
	{
		$sql = "SELECT * FROM kabupaten INNER JOIN propinsi ON kabupaten.id_propinsi=propinsi.id_propinsi";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function getKecamatan($kunci,$num,$offset,$sort_by,$sort_order)//menu admin

	{

		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('kecamatan.id_kecamatan');
		$kunci = ($kunci == 'kosong')?"":" WHERE nama_kecamatan LIKE '%".str_replace("_", " ", $kunci)."%'";
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'kecamatan.id_kecamatan';

		$sql = "SELECT * FROM kecamatan INNER JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten $kunci ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function getJumKecamatan($kunci)
	{
		$kunci = ($kunci == 'kosong')?"":" WHERE nama_kecamatan LIKE '%".str_replace("_", " ", $kunci)."%'";
		$sql = "SELECT * FROM kecamatan INNER JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten $kunci";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function getKelurahan($kunci,$num,$offset,$sort_by,$sort_order)//menu admin

	{

		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('a.id_kelurahan');
		$kunci = ($kunci == 'kosong')?"":" AND a.nama_kelurahan LIKE '%".str_replace("_", " ", $kunci)."%' ";
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.id_kelurahan';

		$sql = "SELECT * FROM kelurahan a,kecamatan b,kabupaten c WHERE a.id_kecamatan=b.id_kecamatan AND b.id_kabupaten=c.id_kabupaten $kunci ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function getJumKelurahan($kunci)

	{
		$kunci = ($kunci == 'kosong')?"":" AND a.nama_kelurahan LIKE '%".str_replace("_", " ", $kunci)."%' ";

		$sql = "SELECT * FROM kelurahan a,kecamatan b,kabupaten c WHERE a.id_kecamatan=b.id_kecamatan AND b.id_kabupaten=c.id_kabupaten";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function getDusun($kunci,$num,$offset,$sort_by,$sort_order)//menu admin

	{

		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('a.id_dusun');
		$kunci = ($kunci == 'kosong')?"":" AND a.nama_dusun LIKE '%".str_replace("_", " ", $kunci)."%' ";
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.id_dusun';

		$sql = "SELECT * FROM dusun a,kelurahan b,kecamatan c WHERE a.id_kelurahan=b.id_kelurahan AND b.id_kecamatan=c.id_kecamatan $kunci ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function getJumDusun($kunci)
	{
		$kunci = ($kunci == 'kosong')?"":" AND a.nama_dusun LIKE '%".str_replace("_", " ", $kunci)."%'";

		$sql = "SELECT * FROM dusun a,kelurahan b,kecamatan c WHERE a.id_kelurahan=b.id_kelurahan AND b.id_kecamatan=c.id_kecamatan $kunci";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function getBencana($num,$offset,$sort_by,$sort_order)//menu admin

	{

		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('id_jenis_bencana');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id_jenis_bencana';

		$sql = "SELECT * FROM jenis_bencana ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function getTa($num,$offset,$sort_by,$sort_order)//menu admin

	{

		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('tahun_ajaran.id_ta');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tahun_ajaran.id_ta';

		$sql = "SELECT * FROM tahun_ajaran ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		return $query->result();

	}



	function getFasilitas($num,$offset,$sort_by,$sort_order)//menu admin

	{

		$nilai = array();



		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('fasilitas.id_fasilitas');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'fasilitas.id_fasilitas';

		$sql = "SELECT * FROM fasilitas ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		$data = $query->result();

		foreach($data as $dt)

		{

			$detil = $this->db->query("SELECT * FROM detail_fasilitas WHERE id_fasilitas='".$dt->id_fasilitas."'");

			$detils = $detil->result();



			$nilai[] = array(

				'id_fasilitas'			=> $dt->id_fasilitas,

				'nama_fasilitas'		=> $dt->nama_fasilitas,

				'jumlah_min_fasilitas'	=> $dt->jumlah_min_fasilitas,

				'detil'					=> $detils

			);

		}



		return $nilai;

	}



	function getKuesioner($num,$offset,$sort_by,$sort_order)//menu admin

	{

		$nilai = array();



		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('kuesioner.id_kuesioner');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'kuesioner.id_kuesioner';

		$sql = "SELECT * FROM kuesioner ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		$data = $query->result();

		foreach($data as $dt)

		{

			$detil = $this->db->query("SELECT * FROM detail_kuesioner WHERE id_kuesioner='".$dt->id_kuesioner."'");

			$detils = $detil->result();



			$nilai[] = array(

				'id_kuesioner'			=> $dt->id_kuesioner,

				'text_kuesioner'		=> $dt->text_kuesioner,

				'detil'					=> $detils

			);

		}



		return $nilai;

	}



	function getUmur($num,$offset,$sort_by,$sort_order)//menu admin

	{

		$nilai = array();



		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('umur.id_umur');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'umur.id_umur';

		$sql = "SELECT * FROM umur ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		$data = $query->result();

		foreach($data as $dt)

		{

			$detil = $this->db->query("SELECT * FROM detail_umur WHERE id_umur='".$dt->id_umur."'");

			$detils = $detil->result();



			if($dt->operasi_umur == 1)

			{

				$batas = "Kurang dari ".$dt->batas_awal." Tahun";

			}

			elseif($dt->operasi_umur == 2)

			{

				$batas = "Antara ".$dt->batas_awal." Tahun sampai ".$dt->batas_akhir." Tahun";

			}

			elseif($dt->operasi_umur == 3)

			{

				$batas = "Lebih dari dari ".$dt->batas_akhir." Tahun";

			}

			else

			{

				$batas = "Sama dengan ".$dt->batas_awal." Tahun";

			}



			$nilai[] = array(

				'id_umur'				=> $dt->id_umur,

				'id_tingkat'			=> $dt->id_tingkat,

				'batas'					=> $batas,

				'detil'					=> $detils

			);

		}



		return $nilai;

	}



	function getMapel($num,$offset,$sort_by,$sort_order)//menu admin

	{

		$nilai = array();



		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('mapel.id_mapel');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mapel.id_mapel';

		$sql = "SELECT * FROM mapel ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		$data = $query->result();

		foreach($data as $dt)

		{

			$detil = $this->db->query("SELECT * FROM detail_mapel WHERE id_mapel='".$dt->id_mapel."'");

			$detils = $detil->result();



			$nilai[] = array(

				'id_mapel'				=> $dt->id_mapel,				

				'nama_mapel'			=> $dt->nama_mapel,	

				'detil'					=> $detils

			);

		}



		return $nilai;		

	}



	function getProdi($num,$offset,$sort_by,$sort_order)//menu admin

	{

		$nilai = array();



		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('prodi.id_prodi');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'prodi.id_prodi';

		$sql = "SELECT * FROM prodi ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		$query = $this->db->query($sql);

		$data = $query->result();

		foreach($data as $dt)

		{

			$detil = $this->db->query("SELECT * FROM detail_prodi WHERE id_prodi='".$dt->id_prodi."'");

			$detils = $detil->result();



			$nilai[] = array(

				'id_prodi'				=> $dt->id_prodi,				

				'nama_prodi'			=> $dt->nama_prodi,	

				'kode_prodi'			=> $dt->kode_prodi,	

				'detil'					=> $detils

			);

		}



		return $nilai;		

	}



	function addSekolah()

	{

		$data = array(

			'id_school'			=> '',

			'nama_school'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),

			'jenjang_school'	=> $this->input->post('jenjang',TRUE)

		);



		$this->db->insert('schools', $data); 

	}



	function addFasilitas()

	{

		$data = array(

			'id_fasilitas'			=> '',

			'jenis_fasilitas'		=> $this->input->post('jenis'),

			'nama_fasilitas'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),

			'jumlah_min_fasilitas'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('jumlah',TRUE)))),

			'jum_penggunaan'		=> $this->input->post('penggunaan',TRUE)

		);



		$this->db->insert('fasilitas', $data); 

		

		$kode = $this->db->insert_id();		

		$jenjang = $this->input->post('jenjang');		

		foreach($jenjang as $dt_jenjang)

		{

			$data = array(

				'id_detail_fasilitas'	=> '',

				'id_fasilitas'			=> $kode,				

				'jenjang_school'		=> $dt_jenjang

			);	



			$this->db->insert('detail_fasilitas', $data);

		}		

	}



	function addKuesioner()

	{

		$keterangan = $this->input->post('keterangan');



		if($this->input->post('pilihan',TRUE) == 1)

		{

			$pembilang = count($keterangan) - 1;

			$penyebut = 1;

		}

		else

		{

			$pembilang = count($keterangan);

			$penyebut = 0;

		}



		$data = array(

			'id_kuesioner'			=> '',

			'jenis_kuesioner'		=> $this->input->post('jenis',TRUE),

			'text_kuesioner'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('kuesioner',TRUE)))),

			'pembilang'				=> $pembilang,

			'penyebut'				=> $penyebut,

			'jawaban'				=> $this->input->post('jawaban',TRUE)

		);



		$this->db->insert('kuesioner', $data);



		$jenjang = $this->input->post('jenjang');

		$kode = $this->db->insert_id();						

				

		$no = 1;	

		foreach($keterangan as $key => $value)

		{

			$keterangan = strip_tags(ascii_to_entities(addslashes($value)));			



			$data = array(

				'id_ket_kuesioner'		=> '',

				'id_kuesioner'			=> $kode,					

				'level_ket_kuesioner'	=> $no,

				'text_ket_kuesioner'	=> $keterangan,

				'jenis_ket_kuesioner'	=> $this->input->post('provider',TRUE),

				'stat_ket_kuesioner'	=> $this->input->post('stat'.$key,TRUE),

				'ket_ket_kuesioner'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('keter',TRUE))))

			);			



			$this->db->insert('ket_kuesioner', $data);

			$kode1 = $this->db->insert_id();						



			if($this->input->post('stat'.$key,TRUE) == 2)

			{

				foreach($jenjang as $dt_jenjang)

				{					

					$detail = $this->arey->getDetailJenjang($dt_jenjang);



					foreach($detail as $kunci => $dt_detail)

					{	

						$data = array(

							'id_detail_kuesioner'			=> '',

							'id_ket_kuesioner'				=> $kode1,

							'id_kuesioner'					=> $kode,

							'jenjang_school'				=> $dt_jenjang,

							'detail_jenjang_kuesioner'		=> $kunci,

							'id_detail_jenjang'				=> $key

						);



						$this->db->insert('detail_kuesioner', $data);

					}

				}				

			}													

			else

			{					

				foreach($jenjang as $dt_jenjang)

				{					

					$detail = $this->arey->getDetailJenjang($dt_jenjang);



					foreach($detail as $kunci => $dt_detail)

					{	

						if(preg_match("/".$dt_detail."/", $keterangan))

						{

							$data = array(

								'id_detail_kuesioner'		=> '',

								'id_ket_kuesioner'			=> $kode1,

								'id_kuesioner'				=> $kode,

								'jenjang_school'			=> $dt_jenjang,

								'detail_jenjang_kuesioner'	=> $kunci,

								'id_detail_jenjang'			=> $key

							);

				

							$this->db->insert('detail_kuesioner', $data);

						}		

					}

				}																										

			}				

			$no++;

		}				

	}



	function addPropinsi()

	{

		$data = array(

			'id_propinsi'			=> '',

			'nama_propinsi'			=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE))))))

		);



		$this->db->insert('propinsi', $data); 

	}	



	function addKabupaten()

	{

		$data = array(

			'id_kabupaten'			=> '',

			'id_propinsi'			=> $this->input->post('propinsi',TRUE),

			'nama_kabupaten'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE))))))

		);



		$this->db->insert('kabupaten', $data); 

	}



	function addKecamatan()

	{

		$data = array(

			'id_kecamatan'			=> '',

			'id_kabupaten'			=> $this->input->post('kabupaten',TRUE),

			'nama_kecamatan'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))))),

			'kode_kecamatan'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('kode',TRUE))))

		);



		$this->db->insert('kecamatan', $data); 

	}

	function addKelurahan()

	{

		$data = array(

			'id_kelurahan'			=> '',

			'id_kecamatan'			=> $this->input->post('kecamatan',TRUE),

			'nama_kelurahan'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))))),			

		);

		$this->db->insert('kelurahan', $data); 

	}

	function addBencana()

	{

		$data = array(

			'id_jenis_bencana'		=> '',			

			'nama_jenis_bencana'	=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))))),			

		);

		$this->db->insert('jenis_bencana', $data); 

	}

	function addDusun()

	{

		$data = array(

			'id_dusun'				=> '',

			'id_kelurahan'			=> $this->input->post('kelurahan',TRUE),

			'nama_dusun'			=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))))),			

		);

		$this->db->insert('dusun', $data); 

	}



	function addTahun()

	{

		if($this->input->post('status',TRUE) == 1)

		{

			$kueri = $this->db->query("UPDATE tahun_ajaran SET status_ta='2'");

		}



		$data = array(

			'id_ta'				=> '',

			'nama_ta'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),

			'status_ta'			=> $this->input->post('status',TRUE)

		);



		$this->db->insert('tahun_ajaran', $data); 

	}



	function addUmur()

	{

		$data = array(

			'id_umur'				=> '',			

			'id_tingkat'			=> $this->input->post('tingkat',TRUE),			

			'batas_awal'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('awal',TRUE)))),

			'batas_akhir'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('akhir',TRUE)))),

			'operasi_umur'			=> $this->input->post('operasi',TRUE),

		);



		$this->db->insert('umur', $data); 	



		$jenjang = $this->input->post('jenjang');

		$kode = $this->db->insert_id();

		foreach($jenjang as $dt_jenjang)

		{

			$data = array(

				'id_detail_umur'		=> '',

				'id_umur'				=> $kode,

				'jenjang_school'		=> $dt_jenjang

			);



			$this->db->insert('detail_umur', $data);

		}	

	}



	function addMapel()

	{

		$data = array(

			'id_mapel'			=> '',

			'nama_mapel'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE))))

		);



		$this->db->insert('mapel', $data); 



		$jenjang = $this->input->post('jenjang');

		$kode = $this->db->insert_id();

		foreach($jenjang as $dt_jenjang)

		{

			$data = array(

				'id_detail_mapel'		=> '',

				'id_mapel'				=> $kode,

				'jenjang_school'		=> $dt_jenjang

			);



			$this->db->insert('detail_mapel', $data);

		}

	}



	function addProdi()

	{

		$data = array(

			'id_prodi'			=> '',

			'nama_prodi'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),

			'kode_prodi'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('kode',TRUE))))

		);



		$this->db->insert('prodi', $data); 



		$jenjang = $this->input->post('jenjang');

		$kode = $this->db->insert_id();

		foreach($jenjang as $dt_jenjang)

		{

			$data = array(

				'id_detail_prodi'		=> '',

				'id_prodi'				=> $kode,

				'jenjang_school'		=> $dt_jenjang

			);



			$this->db->insert('detail_prodi', $data);

		}

	}



	function editSekolah($id)

	{

		$kueri = $this->db->query("SELECT * FROM schools WHERE id_school='$id'");

		return $kueri->row();

	}



	function editPropinsi($id)

	{

		$kueri = $this->db->query("SELECT * FROM propinsi WHERE id_propinsi='$id'");

		return $kueri->row();

	}



	function editFasilitas($id)

	{

		$detail = array();



		$kueri = $this->db->query("SELECT * FROM fasilitas WHERE id_fasilitas='$id'");

		$data = $kueri->row();

		$detil = $this->db->query("SELECT jenjang_school FROM detail_fasilitas WHERE id_fasilitas='".$data->id_fasilitas."'");

		$detils = $detil->result();

		foreach($detils as $dt_detils)

		{

			$detail[] = $dt_detils->jenjang_school;

		}



		$hasil = array(

			'id_fasilitas'			=> $data->id_fasilitas,

			'nama_fasilitas'		=> $data->nama_fasilitas,

			'jumlah_min_fasilitas'	=> $data->jumlah_min_fasilitas,

			'jum_penggunaan'		=> $data->jum_penggunaan,

			'detil'					=> $detail

		);



		return $hasil;

	}



	function editKuesioner($id)

	{

		$detail = array();



		$kueri = $this->db->query("SELECT * FROM kuesioner WHERE id_kuesioner='$id'");

		$data = $kueri->row();

		$detil = $this->db->query("SELECT jenjang_school FROM detail_kuesioner WHERE id_kuesioner='".$data->id_kuesioner."'");

		$detils = $detil->result();

		foreach($detils as $dt_detils)

		{

			$detail[] = $dt_detils->jenjang_school;

		}



		$hasil = array(

			'id_kuesioner'			=> $data->id_kuesioner,

			'text_kuesioner'		=> $data->text_kuesioner,			

			'detil'					=> $detail

		);



		return $hasil;

	}



	function editUmur($id)

	{

		$detail = array();



		$kueri = $this->db->query("SELECT * FROM umur WHERE id_umur='$id'");

		$data = $kueri->row();

		$detil = $this->db->query("SELECT jenjang_school FROM detail_umur WHERE id_umur='".$data->id_umur."'");

		$detils = $detil->result();

		foreach($detils as $dt_detils)

		{

			$detail[] = $dt_detils->jenjang_school;

		}



		$hasil = array(

			'id_umur'			  	=> $data->id_umur,

			'id_tingkat'			=> $data->id_tingkat,

			'batas_awal'			=> $data->batas_awal,

			'batas_akhir'			=> $data->batas_akhir,

			'operasi_umur'			=> $data->operasi_umur,

			'detil'					=> $detail

		);



		return $hasil;

	}



	function editMapel($id)

	{

		$detail = array();



		$kueri = $this->db->query("SELECT * FROM mapel WHERE id_mapel='$id'");

		$data = $kueri->row();

		$detil = $this->db->query("SELECT jenjang_school FROM detail_mapel WHERE id_mapel='".$data->id_mapel."'");

		$detils = $detil->result();

		foreach($detils as $dt_detils)

		{

			$detail[] = $dt_detils->jenjang_school;

		}



		$hasil = array(

			'id_mapel'			  	=> $data->id_mapel,

			'nama_mapel'			=> $data->nama_mapel,

			'detil'					=> $detail

		);



		return $hasil;

	}



	function editProdi($id)

	{

		$detail = array();



		$kueri = $this->db->query("SELECT * FROM prodi WHERE id_prodi='$id'");

		$data = $kueri->row();

		$detil = $this->db->query("SELECT jenjang_school FROM detail_prodi WHERE id_prodi='".$data->id_prodi."'");

		$detils = $detil->result();

		foreach($detils as $dt_detils)

		{

			$detail[] = $dt_detils->jenjang_school;

		}



		$hasil = array(

			'id_prodi'			  	=> $data->id_prodi,

			'nama_prodi'			=> $data->nama_prodi,

			'kode_prodi'			=> $data->kode_prodi,

			'detil'					=> $detail

		);



		return $hasil;

	}



	function editKabupaten($id)

	{

		$kueri = $this->db->query("SELECT * FROM kabupaten WHERE id_kabupaten='$id'");

		return $kueri->row();

	}



	function editKecamatan($id)

	{

		$kueri = $this->db->query("SELECT * FROM kecamatan WHERE id_kecamatan='$id'");

		return $kueri->row();

	}

	function editKelurahan($id)

	{

		$kueri = $this->db->query("SELECT * FROM kelurahan WHERE id_kelurahan='$id'");

		return $kueri->row();

	}

	function editDusun($id)

	{

		$kueri = $this->db->query("SELECT * FROM dusun WHERE id_dusun='$id'");

		return $kueri->row();

	}

	function editBencana($id)

	{

		$kueri = $this->db->query("SELECT * FROM jenis_bencana WHERE id_jenis_bencana='$id'");

		return $kueri->row();

	}

	function editTahun($id)

	{

		$kueri = $this->db->query("SELECT * FROM tahun_ajaran WHERE id_ta='$id'");

		return $kueri->row();

	}



	function updateSekolah($id)

	{

		$data = array(

            'nama_school'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),

            'jenjang_school'	=> $this->input->post('jenjang',TRUE)

       	);



		$this->db->where('id_school', $id);

		$this->db->update('schools', $data); 

	}



	function updateFasilitas($id)

	{

		$data = array(

            'nama_fasilitas'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),

            'jumlah_min_fasilitas'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('jumlah',TRUE)))),

            'jum_penggunaan'		=> $this->input->post('penggunaan',TRUE)

       	);



		$this->db->where('id_fasilitas', $id);

		$this->db->update('fasilitas', $data); 



		$delete = $this->db->query("DELETE FROM detail_fasilitas WHERE id_fasilitas='".$id."'");



		$jenjang = $this->input->post('jenjang');

		foreach($jenjang as $dt_jenjang)

		{

			$data = array(

				'id_detail_fasilitas'	=> '',

				'id_fasilitas'			=> $id,

				'jenjang_school'		=> $dt_jenjang

			);



			$this->db->insert('detail_fasilitas', $data);

		}		

	}



	function updateKuesioner($id)

	{

		$data = array(

            'text_kuesioner'		=> $this->input->post('editor',TRUE)            

       	);



		$this->db->where('id_kuesioner', $id);

		$this->db->update('kuesioner', $data); 



		$delete = $this->db->query("DELETE FROM detail_kuesioner WHERE id_kuesioner='".$id."'");



		$jenjang = $this->input->post('jenjang');

		foreach($jenjang as $dt_jenjang)

		{

			$data = array(

				'id_detail_kuesioner'	=> '',

				'id_kuesioner'			=> $id,

				'jenjang_school'		=> $dt_jenjang

			);



			$this->db->insert('detail_kuesioner', $data);

		}		

	}	



	function updatePropinsi($id)

	{

		$data = array(

            'nama_propinsi'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE))))))

       	);



		$this->db->where('id_propinsi', $id);

		$this->db->update('propinsi', $data); 

	}



	function updateKabupaten($id)

	{

		$data = array(

			'id_propinsi'			=> $this->input->post('propinsi',TRUE),

            'nama_kabupaten'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE))))))

       	);



		$this->db->where('id_kabupaten', $id);

		$this->db->update('kabupaten', $data); 

	}



	function updateKecamatan($id)

	{

		$data = array(

			'id_kabupaten'			=> $this->input->post('kabupaten',TRUE),

            'nama_kecamatan'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))))),

            'kode_kecamatan'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('kode',TRUE))))

       	);



		$this->db->where('id_kecamatan', $id);

		$this->db->update('kecamatan', $data); 

	}

	function updateKelurahan($id)

	{

		$data = array(

			'id_kecamatan'			=> $this->input->post('kecamatan',TRUE),

            'nama_kelurahan'		=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))))),            

       	);



		$this->db->where('id_kelurahan', $id);

		$this->db->update('kelurahan', $data); 

	}

	function updateDusun($id)

	{

		$data = array(

			'id_kelurahan'			=> $this->input->post('kelurahan',TRUE),

            'nama_dusun'			=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))))),            

       	);



		$this->db->where('id_dusun', $id);

		$this->db->update('dusun', $data); 

	}

	function updateBencana($id)

	{

		$data = array(			

            'nama_jenis_bencana'			=> ucwords(strtolower(strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))))),            

       	);



		$this->db->where('id_jenis_bencana', $id);

		$this->db->update('jenis_bencana', $data); 

	}

	function updateTahun($id)

	{

		if($this->input->post('status',TRUE) == 1)

		{

			$this->db->query("UPDATE tahun_ajaran SET status_ta='2'");

		}



		$data = array(

			'nama_ta'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),

            'status_ta'			=> $this->input->post('status',TRUE)

       	);



		$this->db->where('id_ta', $id);

		$this->db->update('tahun_ajaran', $data); 

	}



	function updateUmur($id)

	{

		$data = array(

            'id_tingkat'			=> $this->input->post('tingkat',TRUE),			

			'batas_awal'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('awal',TRUE)))),

			'batas_akhir'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('akhir',TRUE)))),

			'operasi_umur'			=> $this->input->post('operasi',TRUE),

       	);



		$this->db->where('id_umur', $id);

		$this->db->update('umur', $data); 



		$delete = $this->db->query("DELETE FROM detail_umur WHERE id_umur='".$id."'");



		$jenjang = $this->input->post('jenjang');

		foreach($jenjang as $dt_jenjang)

		{

			$data = array(

				'id_detail_umur'		=> '',

				'id_umur'				=> $id,

				'jenjang_school'		=> $dt_jenjang

			);



			$this->db->insert('detail_umur', $data);

		}		

	}



	function updateMapel($id)

	{

		$data = array(       

			'nama_mapel'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE))))

       	);



		$this->db->where('id_mapel', $id);

		$this->db->update('mapel', $data); 



		$delete = $this->db->query("DELETE FROM detail_mapel WHERE id_mapel='".$id."'");



		$jenjang = $this->input->post('jenjang');

		foreach($jenjang as $dt_jenjang)

		{

			$data = array(

				'id_detail_mapel'		=> '',

				'id_mapel'				=> $id,

				'jenjang_school'		=> $dt_jenjang

			);



			$this->db->insert('detail_mapel', $data);

		}

	}



	function updateProdi($id)

	{

		$data = array(       

			'nama_prodi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),

			'kode_prodi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('kode',TRUE))))

       	);



		$this->db->where('id_prodi', $id);

		$this->db->update('prodi', $data); 



		$delete = $this->db->query("DELETE FROM detail_prodi WHERE id_prodi='".$id."'");



		$jenjang = $this->input->post('jenjang');

		foreach($jenjang as $dt_jenjang)

		{

			$data = array(

				'id_detail_prodi'		=> '',

				'id_prodi'				=> $id,

				'jenjang_school'		=> $dt_jenjang

			);



			$this->db->insert('detail_prodi', $data);

		}

	}



	function setTahun($id,$val)

	{

		if($val == 1)

		{

			$this->db->query("UPDATE tahun_ajaran SET status_ta='2'");

		}



		$sql = "UPDATE tahun_ajaran SET status_ta='$val' WHERE id_ta='$id'";

		$this->db->query($sql);

	}



	function deleteSchool($id)

	{

		$kueri = $this->db->query("DELETE FROM schools WHERE id_school='$id'");

		return $kueri;

	}



	function deletePropinsi($id)

	{

		$kueri = $this->db->query("DELETE FROM propinsi WHERE id_propinsi='$id'");

		return $kueri;

	}



	function deleteKabupaten($id)

	{

		$kueri = $this->db->query("DELETE FROM kabupaten WHERE id_kabupaten='$id'");

		return $kueri;

	}



	function deleteKecamatan($id)

	{

		$kueri = $this->db->query("DELETE FROM kecamatan WHERE id_kecamatan='$id'");

		return $kueri;

	}

	function deleteKelurahan($id)

	{
		$sql = "DELETE FROM kelurahan WHERE id_kelurahan='$id'";		
		$kueri = $this->db->query($sql);

		return $kueri;

	}

	function deleteDusun($id)

	{

		$kueri = $this->db->query("DELETE FROM dusun WHERE id_dusun='$id'");

		return $kueri;

	}

	function deleteBencana($id)

	{

		$kueri = $this->db->query("DELETE FROM jenis_bencana WHERE id_jenis_bencana='$id'");

		return $kueri;

	}

	function deleteTahun($id)

	{

		$kueri = $this->db->query("DELETE FROM tahun_ajaran WHERE id_ta='$id'");

		return $kueri;

	}



	function deleteFasilitas($id)

	{

		$kueri = $this->db->query("DELETE FROM fasilitas WHERE id_fasilitas='$id'");

		$kueri1 = $this->db->query("DELETE FROM detail_fasilitas WHERE id_fasilitas='$id'");

		return $kueri1;

	}



	function deleteKuesioner($id)

	{

		$kueri = $this->db->query("DELETE FROM kuesioner WHERE id_kuesioner='$id'");

		$kueri1 = $this->db->query("DELETE FROM detail_kuesioner WHERE id_kuesioner='$id'");

		$kueri2 = $this->db->query("DELETE FROM ket_kuesioner WHERE id_kuesioner='$id'");

		return $kueri2;

	}



	function deleteUmur($id)

	{

		$kueri = $this->db->query("DELETE FROM umur WHERE id_umur='$id'");

		$kueri1 = $this->db->query("DELETE FROM detail_umur WHERE id_umur='$id'");

		return $kueri1;

	}



	function deleteMapel($id)

	{

		$kueri = $this->db->query("DELETE FROM mapel WHERE id_mapel='$id'");

		$kueri1 = $this->db->query("DELETE FROM detail_mapel WHERE id_mapel='$id'");

		return $kueri1;

	}



	function deleteProdi($id)

	{

		$kueri = $this->db->query("DELETE FROM prodi WHERE id_prodi='$id'");

		$kueri1 = $this->db->query("DELETE FROM detail_prodi WHERE id_prodi='$id'");

		return $kueri1;

	}



	function getSelekProp()

	{

		$query = $this->db->query("SELECT * FROM propinsi ORDER BY id_propinsi ASC");



		if ($query->num_rows()> 0)

		{			

			foreach ($query->result_array() as $row)

			{

				$data[$row['id_propinsi']] = $row['nama_propinsi'];

			}

		}

		else

		{

			$data[''] = "";

		}

		$query->free_result();

		return $data;

	}



	function getSelekKab()

	{

		$query = $this->db->query("SELECT * FROM kabupaten ORDER BY id_kabupaten ASC");



		if ($query->num_rows()> 0)

		{			
			$data[0] = "Pilih Kebupaten";

			foreach ($query->result_array() as $row)

			{

				$data[$row['id_kabupaten']] = $row['nama_kabupaten'];

			}

		}

		else

		{

			$data[''] = "";

		}

		$query->free_result();

		return $data;

	}

	function getSelekKecataman()

	{

		$query = $this->db->query("SELECT * FROM kecamatan a,kabupaten b WHERE a.id_kabupaten=b.id_kabupaten ORDER BY a.id_kecamatan ASC");



		if ($query->num_rows()> 0)

		{			

			foreach ($query->result_array() as $row)

			{

				$data[$row['id_kecamatan']] = "Kecamatan ".$row['nama_kecamatan']." Kabupaten ".$row['nama_kabupaten'];

			}

		}

		else

		{

			$data[''] = "";

		}

		$query->free_result();

		return $data;

	}

	function getSelekDusun()

	{

		$query = $this->db->query("SELECT * FROM kelurahan a,kecamatan b,kabupaten c WHERE a.id_kecamatan=b.id_kecamatan AND b.id_kabupaten=c.id_kabupaten ORDER BY a.id_kelurahan ASC");



		if ($query->num_rows()> 0)

		{			

			foreach ($query->result_array() as $row)

			{

				$data[$row['id_kelurahan']] = "Kelurahan ".$row['nama_kelurahan']." Kecamatan ".$row['nama_kecamatan']." Kabupaten ".$row['nama_kabupaten'];

			}

		}

		else

		{

			$data[''] = "";

		}

		$query->free_result();

		return $data;

	}

	function addImport($kec,$kel,$dusun)
	{
		$que_kec = $this->db->query("SELECT * FROM kecamatan WHERE nama_kecamatan='$kec'");
		if($que_kec->num_rows() > 0)
		{
			$data = $que_kec->row();
			$kecamatan = isset($data->id_kecamatan)?$data->id_kecamatan:0;
		}
		else
		{
			$data = array(
			   'id_kecamatan' 	=> '',
			   'id_kabupaten' 	=> 1,
			   'nama_kecamatan' => $kec
			);

			$this->db->insert('kecamatan', $data); 
			$kecamatan = $this->db->insert_id();
		}

		$que_kel = $this->db->query("SELECT * FROM kelurahan WHERE nama_kelurahan='$kel'");
		if($que_kel->num_rows() > 0)
		{
			$data = $que_kel->row();
			$kelurahan = isset($data->id_kelurahan)?$data->id_kelurahan:0;
		}
		else
		{
			$data = array(
			   'id_kelurahan' 	=> '',
			   'nama_kelurahan' => $kel,
			   'id_kecamatan' 	=> $kecamatan
			);

			$this->db->insert('kelurahan', $data); 
			$kelurahan = $this->db->insert_id();
		}

		$que_dusun = $this->db->query("SELECT * FROM dusun WHERE nama_dusun='$dusun'");
		if($que_dusun->num_rows() > 0)
		{
			$data = $que_dusun->row();
			$dusun = isset($data->id_dusun)?$data->id_dusun:0;
		}
		else
		{
			$data = array(
			   'id_dusun' 		=> '',
			   'nama_dusun' 	=> $dusun,
			   'id_kelurahan' 	=> $kelurahan
			);

			$this->db->insert('dusun', $data); 			
		}
	}
}

?>