<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mtransaksi extends CI_Model

{

	function __construct()

	{

		parent::__construct();

	}



	function getNumTrans($limbah,$unit,$user,$transporter,$tanggal)

	{
		$kueri = "";		

		$getLimbah = $this->arey->getLimbah();

		if($limbah == 'all' AND $unit == 'all')
		{			
			foreach($getLimbah as $limbah)
			{
				foreach($limbah as $dt_limbah)
				{
					$kueri .= "a.kodebrg='";
					$pecah = implode($dt_limbah,"' OR a.kodebrg='");
					$kueri .= $pecah;
					$kueri .= "' OR ";
				}
			}			
		}
		elseif($limbah != 'all' AND $unit == 'all')
		{			
			$limbah = urldecode($limbah);
			$limbahs = $getLimbah[$limbah];
			foreach($limbahs as $limbah)
			{
				$kueri .= "a.kodebrg='";				
				$pecah = implode($limbah,"' OR a.kodebrg='");
				$kueri .= $pecah;
				$kueri .= "' OR ";
			}			
		}
		elseif($limbah == 'all' AND $unit != 'all')
		{						
			foreach($getLimbah as $limbah)
			{
				$unit = urldecode($unit);
				$limbahs = $limbah[$unit];	
				$kueri .= "a.kodebrg='";				
				$pecah = implode($limbahs,"' OR a.kodebrg='");
				$kueri .= $pecah;
				$kueri .= "' OR ";
			}			
		}
		elseif($limbah != 'all' AND $unit != 'all')
		{						
			$limbah = urldecode($limbah);
			$unit = urldecode($unit);
			$limbahs = $getLimbah[$limbah][$unit];	
			$kueri .= "a.kodebrg='";				
			$pecah = implode($limbahs,"' OR a.kodebrg='");
			$kueri .= $pecah;
			$kueri .= "' OR ";			
		}
		else
		{
			foreach($getLimbah as $limbah)
			{
				foreach($limbah as $dt_limbah)
				{
					$kueri .= "a.kodebrg<>'";
					$pecah = implode($dt_limbah,"' OR a.kodebrg<>'");
					$kueri .= $pecah;
					$kueri .= "' OR ";
				}
			}	
		}		

		$jum_kue = strlen($kueri);
		$kueri = "AND (".substr($kueri, 0, $jum_kue-4).")";		

		$user = ($user == 'all')?"":" AND a.kodecust='$user'";
		$transporter = ($transporter == 'all')?"":" AND a.kodetrsp='$transporter'";

		$sql = "SELECT * FROM datscale a,tabbrg b,tabcust c,tabtrsp d WHERE a.tgltrans='$tanggal' AND a.kodebrg=b.kodebrg AND a.kodecust=c.kodecust AND a.kodetrsp=d.kodetrsp $transporter $kueri";		

		$query = $this->db->query($sql);

		return $query->num_rows();		

	}



	function addComment($id)

	{

		$data = array(

			'id_comment' 		=> '',

		   	'text_comment' 		=> strip_tags(ascii_to_entities(addslashes($this->input->post('editor',TRUE)))),

		   	'status_comment' 	=> 0,

		   	'notrans'			=> $id

		);



		$this->db->insert('comment', $data); 

	}



	function getComment($id)

	{

		$kueri = $this->db->query("SELECT * FROM comment WHERE notrans='$id' ORDER BY id_comment DESC");

		return $kueri->row();

	}



	function getTransaksi($limbah,$unit,$user,$transporter,$tanggal,$num,$offset,$sort_by,$sort_order)

	{
		$kueri = "";

		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('a.notrans');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.notrans';

		$getLimbah = $this->arey->getLimbah();

		if($limbah == 'all' AND $unit == 'all')
		{			
			foreach($getLimbah as $limbah)
			{
				foreach($limbah as $dt_limbah)
				{
					$kueri .= "a.kodebrg='";
					$pecah = implode($dt_limbah,"' OR a.kodebrg='");
					$kueri .= $pecah;
					$kueri .= "' OR ";
				}
			}			
		}
		elseif($limbah != 'all' AND $unit == 'all')
		{			
			$limbah = urldecode($limbah);
			$limbahs = $getLimbah[$limbah];
			foreach($limbahs as $limbah)
			{
				$kueri .= "a.kodebrg='";				
				$pecah = implode($limbah,"' OR a.kodebrg='");
				$kueri .= $pecah;
				$kueri .= "' OR ";
			}			
		}
		elseif($limbah == 'all' AND $unit != 'all')
		{						
			foreach($getLimbah as $limbah)
			{
				$unit = urldecode($unit);
				$limbahs = $limbah[$unit];	
				$kueri .= "a.kodebrg='";				
				$pecah = implode($limbahs,"' OR a.kodebrg='");
				$kueri .= $pecah;
				$kueri .= "' OR ";
			}			
		}
		elseif($limbah != 'all' AND $unit != 'all')
		{						
			$limbah = urldecode($limbah);
			$unit = urldecode($unit);
			$limbahs = $getLimbah[$limbah][$unit];	
			$kueri .= "a.kodebrg='";				
			$pecah = implode($limbahs,"' OR a.kodebrg='");
			$kueri .= $pecah;
			$kueri .= "' OR ";			
		}
		else
		{
			foreach($getLimbah as $limbah)
			{
				foreach($limbah as $dt_limbah)
				{
					$kueri .= "a.kodebrg<>'";
					$pecah = implode($dt_limbah,"' OR a.kodebrg<>'");
					$kueri .= $pecah;
					$kueri .= "' OR ";
				}
			}	
		}		

		$jum_kue = strlen($kueri);
		$kueri = "AND (".substr($kueri, 0, $jum_kue-4).")";		

		$user = ($user == 'all')?"":" AND a.kodecust='$user'";
		$transporter = ($transporter == 'all')?"":" AND a.kodetrsp='$transporter'";

		$sql = "SELECT * FROM datscale a,tabbrg b,tabcust c,tabtrsp d WHERE a.tgltrans='$tanggal' AND a.kodebrg=b.kodebrg AND a.kodecust=c.kodecust AND a.kodetrsp=d.kodetrsp $transporter $kueri ORDER BY $sort_by $sort_order LIMIT $offset,$num";		

		$query = $this->db->query($sql);

		return $query->result();		

	}

	function getTransaksiCetak($limbah,$unit,$user,$transporter,$tanggal)

	{
		$kueri = "";		

		$getLimbah = $this->arey->getLimbah();

		if($limbah == 'all' AND $unit == 'all')
		{			
			foreach($getLimbah as $limbah)
			{
				foreach($limbah as $dt_limbah)
				{
					$kueri .= "a.kodebrg='";
					$pecah = implode($dt_limbah,"' OR a.kodebrg='");
					$kueri .= $pecah;
					$kueri .= "' OR ";
				}
			}			
		}
		elseif($limbah != 'all' AND $unit == 'all')
		{			
			$limbah = urldecode($limbah);
			$limbahs = $getLimbah[$limbah];
			foreach($limbahs as $limbah)
			{
				$kueri .= "a.kodebrg='";				
				$pecah = implode($limbah,"' OR a.kodebrg='");
				$kueri .= $pecah;
				$kueri .= "' OR ";
			}			
		}
		elseif($limbah == 'all' AND $unit != 'all')
		{						
			foreach($getLimbah as $limbah)
			{
				$unit = urldecode($unit);
				$limbahs = $limbah[$unit];	
				$kueri .= "a.kodebrg='";				
				$pecah = implode($limbahs,"' OR a.kodebrg='");
				$kueri .= $pecah;
				$kueri .= "' OR ";
			}			
		}
		elseif($limbah != 'all' AND $unit != 'all')
		{						
			$limbah = urldecode($limbah);
			$unit = urldecode($unit);
			$limbahs = $getLimbah[$limbah][$unit];	
			$kueri .= "a.kodebrg='";				
			$pecah = implode($limbahs,"' OR a.kodebrg='");
			$kueri .= $pecah;
			$kueri .= "' OR ";			
		}
		else
		{
			foreach($getLimbah as $limbah)
			{
				foreach($limbah as $dt_limbah)
				{
					$kueri .= "a.kodebrg<>'";
					$pecah = implode($dt_limbah,"' OR a.kodebrg<>'");
					$kueri .= $pecah;
					$kueri .= "' OR ";
				}
			}	
		}		

		$jum_kue = strlen($kueri);
		$kueri = "AND (".substr($kueri, 0, $jum_kue-4).")";		

		$user = ($user == 'all')?"":" AND a.kodecust='$user'";
		$transporter = ($transporter == 'all')?"":" AND a.kodetrsp='$transporter'";

		$sql = "SELECT * FROM datscale a,tabbrg b,tabcust c,tabtrsp d WHERE a.tgltrans='$tanggal' AND a.kodebrg=b.kodebrg AND a.kodecust=c.kodecust AND a.kodetrsp=d.kodetrsp $transporter $kueri";		

		$query = $this->db->query($sql);

		return $query->result();		

	}

	function getTransaksiAjax($cari,$num,$offset,$sort_by,$sort_order)

	{

		if (empty($offset))

		{

			$offset=0;

		}

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array('a.notrans');

		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.notrans';

		if($cari == 0)

		{

			$sql = "SELECT * FROM datscale a,tabbrg b,tabcust c,tabtrsp d WHERE a.kodebrg=b.kodebrg AND a.kodecust=c.kodecust AND a.kodetrsp=d.kodetrsp ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		}

		else

		{

			$sql = "SELECT * FROM datscale a,tabbrg b,tabcust c,tabtrsp d WHERE a.kodebrg=b.kodebrg AND a.kodecust=c.kodecust AND a.kodetrsp=d.kodetrsp AND a.notrans LIKE '%".$cari."%' ORDER BY $sort_by $sort_order LIMIT $offset,$num";

		}

		

		$query = $this->db->query($sql);

		return $query->result();				

	}	



	function deleteTransaksi($id)

	{

		$kueri = $this->db->query("DELETE FROM datscale WHERE notrans='$id'");

		return $kueri;

	}



	function updateTransaksi($id)

	{

		$jalan = strip_tags(ascii_to_entities(addslashes($this->input->post('jalan',TRUE))));

		$manifest = strip_tags(ascii_to_entities(addslashes($this->input->post('manifest',TRUE))));

		$mgp = strip_tags(ascii_to_entities(addslashes($this->input->post('mgp',TRUE))));

		$do = $jalan.'/'.$manifest.'/'.$mgp;



		$data = array(

            'nopol'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('nopol',TRUE)))),

            'kodebrg'	=> $this->input->post('kodebrg',TRUE),

            'kodecust'	=> $this->input->post('kodecust',TRUE),

            'kodetrsp'	=> $this->input->post('kodetrsp',TRUE),

            'nomorspk'	=> $do,

            'timbang2'	=> str_replace(".", "", strip_tags(ascii_to_entities(addslashes($this->input->post('timbang2',TRUE))))),

            'tgltb2'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('tgltb2',TRUE)))),

            'jamtb2'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('jamtb2',TRUE)))),

            'timbang1'	=> str_replace(".", "", strip_tags(ascii_to_entities(addslashes($this->input->post('timbang1',TRUE))))),

            'tgltb1'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('tgltb1',TRUE)))),

            'jamtb1'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('jamtb1',TRUE)))),

            'netto'		=> str_replace(".", "", strip_tags(ascii_to_entities(addslashes($this->input->post('netto',TRUE))))),

            'user2'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('user2',TRUE)))),

            'sopir'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('sopir',TRUE)))),

       	);



		$this->db->where('notrans', $id);

		$this->db->update('datscale', $data); 

	}



	function addTransaksi()

	{

		$jalan = strip_tags(ascii_to_entities(addslashes($this->input->post('jalan',TRUE))));

		$manifest = strip_tags(ascii_to_entities(addslashes($this->input->post('manifest',TRUE))));

		$mgp = strip_tags(ascii_to_entities(addslashes($this->input->post('mgp',TRUE))));

		$do = $jalan.'/'.$manifest.'/'.$mgp;



		$data = array(

            'notrans'	=> '',

            'nopol'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('nopol',TRUE)))),

            'kodebrg'	=> $this->input->post('kodebrg',TRUE),

            'kodecust'	=> $this->input->post('kodecust',TRUE),

            'kodetrsp'	=> $this->input->post('kodetrsp',TRUE),

            'nomorspk'	=> $do,

            'timbang2'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('timbang2',TRUE)))),

            'tgltb2'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('tgltb2',TRUE)))),

            'jamtb2'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('jamtb2',TRUE)))),

            'timbang1'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('timbang1',TRUE)))),

            'tgltb1'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('tgltb1',TRUE)))),

            'jamtb1'	=> strip_tags(ascii_to_entities(addslashes($this->input->post('jamtb1',TRUE)))),

            'netto'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('netto',TRUE)))),

            'user2'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('user2',TRUE)))),

            'sopir'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('sopir',TRUE)))),

       	);



		$this->db->insert('datscale', $data);	

	}



	function getDetailTransaksi($id)

	{

		$kueri = $this->db->query("SELECT * FROM datscale WHERE notrans='$id'");

		return $kueri->row();

	}



	function getBarang()

	{

		$query = $this->db->query("SELECT * FROM tabbrg ORDER BY kodebrg DESC");



		if ($query->num_rows()> 0)

		{			

			foreach ($query->result_array() as $row)

			{

				$data[$row['kodebrg']] = $row['namabrg'];

			}

		}

		else

		{

			$data[''] = "";

		}

		$query->free_result();

		return $data;

	}



	function getCustomer()

	{

		$query = $this->db->query("SELECT * FROM tabcust ORDER BY kodecust DESC");



		if ($query->num_rows()> 0)

		{			

			foreach ($query->result_array() as $row)

			{

				$data[$row['kodecust']] = $row['namacust'];

			}

		}

		else

		{

			$data[''] = "";

		}

		$query->free_result();

		return $data;

	}

	function getUser()

	{

		$query = $this->db->query("SELECT * FROM tabcust ORDER BY kodecust DESC");



		if ($query->num_rows()> 0)

		{			
			$data['all'] = "ALL";
			foreach ($query->result_array() as $row)

			{

				$data[$row['kodecust']] = $row['namacust'];

			}

		}

		else

		{

			$data[''] = "";

		}

		$query->free_result();

		return $data;

	}



	function getTransporter()

	{

		$query = $this->db->query("SELECT * FROM tabtrsp ORDER BY kodetrsp DESC");



		if ($query->num_rows()> 0)

		{			

			foreach ($query->result_array() as $row)

			{

				$data[$row['kodetrsp']] = $row['namatrsp'];

			}

		}

		else

		{

			$data[''] = "";

		}

		$query->free_result();

		return $data;

	}

	function getSopir()

	{

		$query = $this->db->query("SELECT * FROM tabtrsp ORDER BY kodetrsp DESC");



		if ($query->num_rows()> 0)

		{			
			$data['all'] = 'ALL';
			foreach ($query->result_array() as $row)

			{

				$data[$row['kodetrsp']] = $row['namatrsp'];

			}

		}

		else

		{

			$data[''] = "";

		}

		$query->free_result();

		return $data;

	}

	function getRole($id)

	{

		$kueri = $this->db->query("SELECT * FROM user_roles WHERE userID='$id'");

		$hasil = $kueri->row();

		$data = (isset($hasil->roleID))?$hasil->roleID:0;

		return $data;

	}
}

?>