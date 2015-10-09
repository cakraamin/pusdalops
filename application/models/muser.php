<?php

class Muser extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}

	function getMember($num,$offset,$sort_by,$sort_order)//menu admin
	{
		if (empty($offset))
		{
			$offset=0;
		}
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('user_id');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'user_id';
		$sql = "SELECT * FROM users ORDER BY $sort_by $sort_order LIMIT $offset,$num";		
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getNumMember()
	{		
		$sql = "SELECT * FROM users";		
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function getRoles($num,$offset,$sort_by,$sort_order)//menu admin
	{
		if (empty($offset))
		{
			$offset=0;
		}
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('roleID');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'roleID';
		$sql = "SELECT * FROM roles ORDER BY $sort_by $sort_order LIMIT $offset,$num";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getPermissions($num,$offset,$sort_by,$sort_order)//menu admin
	{
		if (empty($offset))
		{
			$offset=0;
		}
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('permID');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'permID';
		$sql = "SELECT * FROM permissions ORDER BY $sort_by $sort_order LIMIT $offset,$num";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function editUser($id)
	{
		$sql = "SELECT * FROM users WHERE user_id='$id'";
		$kueri = $this->db->query($sql);
		if($kueri->num_rows() > 0)
		{
			$hasil = $kueri->row();
			return $hasil;
		}
	}

	function getSekolah($id)
	{
		$query = $this->db->query("SELECT * FROM schools WHERE jenjang_school='$id' ORDER BY id_school ASC");

		if ($query->num_rows()> 0)
		{
			$data[] = "Pilih salah satu";
			foreach ($query->result_array() as $row)
			{
				$data[$row['id_school']] = $row['nama_school'];
			}
		}
		else
		{
			$data[''] = "";
		}
		$query->free_result();
		return $data;
	}

	function getUserLevel()
	{
		$query = $this->db->query("SELECT * FROM roles ORDER BY roleID ASC");

		if ($query->num_rows()> 0)
		{			
			foreach ($query->result_array() as $row)
			{
				$data[$row['roleID']] = $row['roleName'];
			}
		}
		else
		{
			$data[''] = "";
		}
		$query->free_result();
		return $data;
	}

	function addRole()
	{
		$data = array(
			'roleID'		=> '',
			'roleName'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('role',TRUE))))
		);

		$this->db->insert('roles', $data); 
	}

	function addPermission()
	{
		$perm = strip_tags(ascii_to_entities(addslashes($this->input->post('perm',TRUE))));
		$permKecil = strtolower($perm);
		$noSpace = str_replace(" ", "_", $permKecil);

		$data = array(
			'permID'		=> '',
			'permKey'		=> $noSpace,
			'permName'		=> $perm
		);

		$this->db->insert('permissions', $data); 	
	}

	function editRole($id)
	{
		$query = $this->db->query("SELECT * FROM roles WHERE roleID='$id'");
		return $query->row();
	}

	function updateRole($id)
	{
		$data = array(
            'roleName'		=> strip_tags(ascii_to_entities(addslashes($this->input->post('role',TRUE))))
       	);

		$this->db->where('roleID', $id);
		$this->db->update('roles', $data); 
	}

	function updatePermission($id)
	{
		$perm = strip_tags(ascii_to_entities(addslashes($this->input->post('perm',TRUE))));
		$permKecil = strtolower($perm);
		$noSpace = str_replace(" ", "_", $permKecil);

		$data = array(
			'permKey'		=> $noSpace,
			'permName'		=> $perm
		);

		$this->db->where('permID', $id);
		$this->db->update('permissions', $data);
	}

	function deleteRole($id)
	{
		$kueri = $this->db->query("DELETE FROM roles WHERE roleID='$id'");
		return $kueri;
	}

	function deletePermission($id)
	{
		$kueri = $this->db->query("DELETE FROM permissions WHERE permID='$id'");
		return $kueri;
	}

	function editPermission($id)
	{
		$kueri = $this->db->query("SELECT * FROM permissions WHERE permID='$id'");
		return $kueri->row();
	}

	function addUserRole($id,$role)
	{
		$query_hapus = $this->db->query("DELETE FROM user_roles WHERE userID='$id' AND roleID='$role'");
		if($query_hapus)
		{
			$query = $this->db->query("INSERT INTO user_roles VALUES('$id','$role',NOW())");
			return $query;
		}
	}

	function addRolePerm($id,$perm,$val)
	{
		$query_hapus = $this->db->query("DELETE FROM role_perms WHERE roleID='$id' AND permID='$perm'");
		if($query_hapus)
		{
			$query = $this->db->query("INSERT INTO role_perms(roleID,permID,value,addDate) VALUES('$id','$perm','$val',NOW())");
			return $query;
		}
	}

	function addUserPerm($id,$role)
	{
		$query_hapus = $this->db->query("DELETE FROM user_roles WHERE userID='$id' AND roleID='$role'");
		if($query_hapus)
		{
			$query = $this->db->query("INSERT INTO user_roles VALUES('$id','$role',NOW())");
			return $query;
		}
	}

	function delUserRole($id,$role)
	{
		$query_hapus = $this->db->query("DELETE FROM user_roles WHERE userID='$id' AND roleID='$role'");
		return $query_hapus;
	}

	function delRolePerm($id,$perm)
	{
		$query_hapus = $this->db->query("DELETE FROM role_perms WHERE roleID='$id' AND permID='$perm'");
		return $query_hapus;
	}

	function updateUserPerm($id,$permKode,$input)
	{
		$query_hapus = $this->db->query("DELETE FROM user_perms WHERE userID='$id' AND permID='$permKode'");
		if($query_hapus)
		{
			$query = $this->db->query("INSERT INTO user_perms(userID,permID,value,addDate) VALUES('$id','$permKode','$input',NOW())");
			return $query;
		}
	}

	function delUserPerm($id,$permKode)
	{
		$query_hapus = $this->db->query("DELETE FROM user_perms WHERE userID='$id' AND permID='$permKode'");
		return $query_hapus;
	}
}
?>