<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msekolah extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}

	function getSelekKec()
	{
		$query = $this->db->query("SELECT * FROM kecamatan ORDER BY id_kecamatan ASC");

		if ($query->num_rows()> 0)
		{			
			foreach ($query->result_array() as $row)
			{
				$data[$row['id_kecamatan']] = $row['nama_kecamatan'];
			}
		}
		else
		{
			$data[''] = "";
		}
		$query->free_result();
		return $data;
	}

	function getSekolahDetail($id)
	{
		$sql = "SELECT * FROM users LEFT JOIN schools ON users.id_school=schools.id_school LEFT JOIN kecamatan ON kecamatan.id_kecamatan=schools.id_kecamatan LEFT JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten LEFT JOIN propinsi ON propinsi.id_propinsi=kabupaten.id_propinsi LEFT JOIN detail_schools ON detail_schools.id_school=schools.id_school WHERE users.user_id='$id' ORDER BY detail_schools.id_detail_school DESC LIMIT 0,1";
		$kueri = $this->db->query($sql);
		return $kueri->row();
	}

	function cekNpsn($id)
	{
		$npsn = strip_tags(ascii_to_entities(addslashes($this->input->post('npsn',TRUE))));

		$kueri = $this->db->query("SELECT * FROM schools WHERE npsn_school='$npsn'");
		$kueri1 = $this->db->query("SELECT * FROM schools WHERE npsn_school='$npsn' AND id_school='$id'");
		if($kueri->num_rows() > 0)
		{
			if($kueri1->num_rows() > 0)
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}			
		}		
		else
		{
			return FALSE;
		}
	}

	function cekNss($id)
	{
		$nss = strip_tags(ascii_to_entities(addslashes($this->input->post('nss',TRUE))));

		$kueri = $this->db->query("SELECT * FROM schools WHERE nss_school='$nss'");
		$kueri1 = $this->db->query("SELECT * FROM schools WHERE nss_school='$nss' AND id_school='$id'");
		if($kueri->num_rows() > 0)
		{
			if($kueri1->num_rows() > 0)
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}			
		}		
		else
		{
			return FALSE;
		}
	}

	function updateSekolah($id,$thn)
	{
		$pecah = explode("-", $this->input->post('jenjang'));							

		$data = array(
		    'status_school'			=> $this->input->post('status'),
		    'jenjang_school'		=> $pecah[0],
		    'tingkat_school'		=> $pecah[1],
		    'lintang_school'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('lintang',TRUE)))),
		    'bujur_school'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('bujur',TRUE)))),
		    'id_kecamatan'			=> $kecamatan = $this->input->post('kecamatan'),
		    'nss_school'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nss',TRUE)))),
		    'npsn_school'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('npsn',TRUE)))),
		    'status_school'			=> $this->input->post('status',TRUE),
		    'nama_school'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama',TRUE)))),		    
		    'kelompok_school'		=> $this->input->post('kelompok',TRUE),		   
		    'alamat_school'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('alamat',TRUE)))),
		    'desa_school'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('desa',TRUE)))),
		    'desa_pil'				=> $this->input->post('desa_pil',TRUE),
		    'klasifikasi_school'	=> $this->input->post('klasifikasi',TRUE),
		    'iso_school'			=> $this->input->post('iso',TRUE),
		    'kode_pos'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('kode_pos',TRUE)))),
		    'kode_area_tlp'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('kode_area_tlp',TRUE)))),
		    'kode_area_fax'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('kode_area_fax',TRUE)))),
		    'akses_inet'			=> $this->input->post('akses_inet',TRUE),
		    'provider'				=> $this->input->post('provider',TRUE),
		    'email'					=> strip_tags(ascii_to_entities(addslashes($this->input->post('email',TRUE)))),
		    'website'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('website',TRUE)))),
		    'jarak_school'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('jarak_school',TRUE)))),
		    'nama_y'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('nama_y',TRUE)))),
		    'alamat_y'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('alamat_y',TRUE)))),
		    'id_kecamatan_y'		=> $this->input->post('kecamatan_y',TRUE),
		    'desa_y'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('desa_y',TRUE)))),
		    'telp_y'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('telp_y',TRUE)))),
		    'akte_y'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('no_akte',TRUE))))."&".strip_tags(ascii_to_entities(addslashes($this->input->post('tgl_akte',TRUE)))),
		    'kelompok_y'			=> $this->input->post('kelompok_y',TRUE),
		    'tahun_diri'			=> $this->input->post('tahun',TRUE),
		    'tahun_renov'			=> $this->input->post('tahun_renov',TRUE),
		    'akre_school'			=> $this->input->post('akre_school',TRUE),
		    'akte_akre'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('sk_akre',TRUE))))."&".strip_tags(ascii_to_entities(addslashes($this->input->post('tgl_akre',TRUE)))),
		    'status_mutu'			=> $this->input->post('status_mutu',TRUE),
		    'kategori_school'		=> $this->input->post('kategori_school',TRUE),
		    'waktu_school'			=> $this->input->post('waktu_school',TRUE),
		    'waktu_wp'				=> $this->input->post('waktu_wp',TRUE),
		    'waktu_pra'				=> $this->input->post('waktu_pra',TRUE),		    
		    'sk_status'				=> strip_tags(ascii_to_entities(addslashes($this->input->post('no_akte_ter',TRUE))))."&".strip_tags(ascii_to_entities(addslashes($this->input->post('tgl_akte_ter',TRUE)))),
		    'ket_sk_status'			=> $this->input->post('ket_sk',TRUE),
		    'inklusi'				=> $this->input->post('ket_sk',TRUE),
		    'sk_inklusi'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('no_akte_ink',TRUE))))."&".strip_tags(ascii_to_entities(addslashes($this->input->post('tgl_akte_ink',TRUE)))),
		    'sk_pendirian'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('no_akte_pen',TRUE))))."&".strip_tags(ascii_to_entities(addslashes($this->input->post('tgl_akte_pen',TRUE))))
		);

		$this->db->where('id_school', $id);
		$this->db->update('schools', $data); 

		$data = array(
			'id_detail_school'		=> '',
			'id_school'				=> $id,
			'id_guru'				=> $this->input->post('kepala',TRUE),
			'id_ta_school'			=> $thn,			
			'date_school'			=> date('Y-m-d')
		);

		$this->db->insert('detail_schools', $data);
	}

	function getTaAktif()
	{
		$kueri = $this->db->query("SELECT * FROM tahun_ajaran WHERE status_ta='1'");
		if($kueri->num_rows() > 0)
		{
			$hasil = $kueri->row();

			$data = array(
				'tahun'		=> $hasil->id_ta
			);
		}
		else
		{
			$data = array(
				'tahun'		=> '0'
			);
		}

		return $data;
	}

	function getKepSek($id)
	{
		$query = $this->db->query("SELECT * FROM guru WHERE id_school='$id'");

		if ($query->num_rows()> 0)
		{			
			foreach ($query->result_array() as $row)
			{
				$data[$row['id_guru']] = $row['nama_guru'];
			}
		}
		else
		{
			$data[''] = "";
		}
		$query->free_result();
		return $data;
	}
}
?>