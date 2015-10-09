<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msetting extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function addSetting()
	{
		$data = array(
		   'id_direktori' 		=> '',
		   'dir_direktori' 		=> $this->input->post('path')
		);

		$this->db->insert('direktori', $data); 
	}	

	function getDirektori()
	{
		$kueri = $this->db->query("SELECT * FROM direktori");
		return $kueri->row();
	}

	function updateSetting($id)
	{
		$data = array(
        	'dir_direktori' 	=> $this->input->post('path')
        );

		$this->db->where('id_direktori', $id);
		$this->db->update('direktori', $data); 
	}
}
?>