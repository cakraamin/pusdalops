<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msiswa extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}

	function getTingkatSchool($id)
	{
		$sql = "SELECT * FROM schools WHERE id_school='$id'";				
		$kueri = $this->db->query($sql);
		if($kueri->num_rows() > 0)
		{
			$hasil = $kueri->row();
			$data = array(
				'tingkat'		=> $hasil->jenjang_school
			);
		}
		else
		{
			$data = array(
				'tingkat'		=> 0
			);
		}

		return $data;
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

	function updateSekolah($id,$thn)
	{
		$status = $this->input->post('status');
		$jenjang = $this->input->post('jenjang');
		$lintang = strip_tags(ascii_to_entities(addslashes($this->input->post('lintang',TRUE))));
		$bujur = strip_tags(ascii_to_entities(addslashes($this->input->post('bujur',TRUE))));

		$kueri = $this->db->query("UPDATE schools SET status_school='$status',jenjang_school='$jenjang',lintang_school='$lintang',bujur_school='$bujur' WHERE id_school='$id'");

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

	function addDetailSiswa($id)
	{
		$indeks = $this->input->post('jumlah');

		$data = array(
		   'id_siswa' 			=> '',
		   'id_school' 			=> $this->session->userdata('id_school'),
		   'id_ta'				=> $id,
		   'id_tingkat'			=> $indeks,
		   'laki_siswa' 		=> strip_tags(ascii_to_entities(addslashes($this->input->post('laki_'.$indeks)))),
		   'perempuan_siswa'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('pr_'.$indeks))))
		);

		$this->db->insert('siswa', $data); 

		if($this->input->post('detilss') != "")
		{
			$detil = $this->input->post('detilss');
			$kode = $this->db->insert_id();
			foreach($detil as $dt)
			{
				$data = array(
				   'id_detail_siswa'	=> '',
				   'id_siswa' 			=> $kode,
				   'id_detail_umur'		=> $dt,
				   'value_detail_siswa'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('detil_'.$dt))))
				);

				$this->db->insert('detail_siswa', $data); 			
			}
		}		

		if($this->input->post('detilssp') != "")
		{
			$nilai = $this->input->post('detilssp');
			foreach($nilai as $dt_nilai)
			{
				$data = array(
				   'id_prodi_school'	=> '',
				   'id_detail_prodi'	=> $dt_nilai,
				   'id_school'			=> $this->session->userdata('id_school'),
				   'id_ta'				=> $id,
				   'id_tingkat'			=> $indeks,
				   'peserta_l'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('detilp1_'.$dt_nilai)))),
				   'peserta_p'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('detilp2_'.$dt_nilai)))),
				   'lulus_l'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('detilpl1_'.$dt_nilai)))),
				   'lulus_p'			=> strip_tags(ascii_to_entities(addslashes($this->input->post('detilpl2_'.$dt_nilai))))
				);

				$this->db->insert('prodi_school', $data); 	
			}
		}		
	}

	function getDetailSiswa($id,$kelas)
	{
		$nilai = array();

		for($i=1;$i<=$kelas;$i++)
		{
			$sql = "SELECT * FROM siswa WHERE id_ta='$id' AND id_tingkat='$i' AND id_school='".$this->session->userdata('id_school')."' ORDER BY id_siswa DESC LIMIT 0,1";		
			$kueri = $this->db->query($sql);
			if($kueri->num_rows() > 0)
			{
				$data = $kueri->row();
				$nilai[$i] = array(
					'laki'			=> $data->laki_siswa,
					'pr'			=> $data->perempuan_siswa
				);
			}			
		}		

		return $nilai;
	}

	function getUmur($id)
	{
		$data = array();

		$kueri = $this->db->query("SELECT a.id_tingkat FROM umur a,detail_umur b WHERE a.id_umur=b.id_umur AND b.jenjang_school='$id' GROUP BY a.id_tingkat");
		$hasil = $kueri->result();		
		foreach($hasil as $dt_hasil)
		{
			unset($nilai);
			$nilai = array();

			$detail = $this->db->query("SELECT a.batas_awal,a.operasi_umur,a.batas_akhir,b.id_detail_umur FROM umur a,detail_umur b WHERE a.id_umur=b.id_umur AND b.jenjang_school='$id' AND a.id_tingkat='".$dt_hasil->id_tingkat."'");
			$details = $detail->result();			

			foreach($details as $dt_details)
			{
				$sql = "SELECT detail_siswa.value_detail_siswa FROM siswa LEFT JOIN detail_siswa ON siswa.id_siswa=detail_siswa.id_siswa WHERE siswa.id_ta='$id' AND siswa.id_tingkat='".$dt_hasil->id_tingkat."' AND siswa.id_school='".$this->session->userdata('id_school')."' AND detail_siswa.id_detail_umur='".$dt_details->id_detail_umur."' ORDER BY siswa.id_siswa DESC LIMIT 0,1";
				$siswa = $this->db->query($sql);
				$dsiswa = $siswa->row();
				$value = (isset($dsiswa->value_detail_siswa))?$dsiswa->value_detail_siswa:"";

				if($dt_details->operasi_umur == 1)
				{
					$batas = "Kurang dari ".$dt_details->batas_awal." Tahun";
				}
				elseif($dt_details->operasi_umur == 2)
				{
					$batas = "Antara ".$dt_details->batas_awal." Tahun sampai ".$dt_details->batas_akhir." Tahun";
				}
				elseif($dt_details->operasi_umur == 3)
				{
					$batas = "Lebih dari dari ".$dt_details->batas_akhir." Tahun";
				}
				else
				{
					$batas = "Sama dengan ".$dt_details->batas_awal." Tahun";
				}

				$nilai[] = array(
					'batas'				=> $batas,
					'id_detail_umur'	=> $dt_details->id_detail_umur,
					'value'				=> $value
				);				
			}

			$data[$dt_hasil->id_tingkat] = $nilai;
		}

		return $data;
	}

	function getProdi($id,$kelas)
	{
		$data = array();

		for($i=1;$i<=$kelas;$i++)
		{
			unset($nilai);
			$nilai = array();

			$sql = "SELECT b.id_detail_prodi,a.id_prodi,a.nama_prodi,a.kode_prodi FROM prodi a,detail_prodi b WHERE a.id_prodi=b.id_prodi AND b.jenjang_school='$id'";
			$kueri = $this->db->query($sql);
			$hasil = $kueri->result();
			foreach($hasil as $dt_hasil)
			{				
				$sql = "SELECT * FROM detail_prodi a,prodi_school b WHERE a.id_detail_prodi=b.id_detail_prodi AND a.id_detail_prodi='".$dt_hasil->id_detail_prodi."' AND b.id_tingkat='".$i."' ORDER BY b.id_prodi_school DESC";
				$detail = $this->db->query($sql);
				$hasil_detail = $detail->row();
				$peserta = (isset($hasil_detail->peserta))?$hasil_detail->peserta:"";
				$lulus = (isset($hasil_detail->lulus))?$hasil_detail->lulus:"";
				
				$nilai[] = array(
					'id_prodi'			=> $dt_hasil->id_prodi,
					'id_detail_prodi'	=> $dt_hasil->id_detail_prodi,
					'nama_prodi'		=> $dt_hasil->nama_prodi,
					'kode_prodi'		=> $dt_hasil->kode_prodi,
					'peserta'			=> $peserta,
					'lulus'				=> $lulus
				);				
			}
			$data[$i] = $nilai;
		}				
		return $data;
	}

	function getNonProdi($id,$kelas)
	{
		$data = array();

		$school = $this->session->userdata('id_school');
		$kueri = $this->db->query("SELECT * FROM prodi_school WHERE id_ta='$id' AND id_tingkat='$kelas' AND id_school='$school' AND id_detail_prodi='0' ORDER BY id_prodi_school DESC");
		$hasil = $kueri->row();
		$peserta_l = (isset($hasil->peserta_l))?$hasil->peserta_l:"";
		$peserta_p = (isset($hasil->peserta_p))?$hasil->peserta_p:"";
		$lulus_l = (isset($hasil->lulus_l))?$hasil->lulus_l:"";
		$lulus_p = (isset($hasil->lulus_p))?$hasil->lulus_p:"";
		$data = array(
			'peserta_l'		=> $peserta_l,
			'peserta_p'		=> $peserta_p,
			'lulus_l'		=> $lulus_l,
			'lulus_p'		=> $lulus_p
		);

		return $data;
	}
}
?>