<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Manajemen extends CI_Controller {



	function __construct()

	{

		parent::__construct();

		$this->load->model('muser','',TRUE);

		$this->load->library(array('page','SimpleLoginSecure','arey','acl'));



		if(!$this->session->userdata('logged_in')) 

		{

			redirect('home');

		}

	}



	function index()

	{

		redirect('manajemen/users');

	}



	function users($short_by='user_id',$short_order='desc',$page=0)

	{

		$per_page = 10;

		$total_page = $this->muser->getNumMember();

		$url = 'manajemen/users/'.$short_by.'/'.$short_order.'/';

		

		$query = $this->muser->getMember($per_page,$page,$short_by,$short_order);

		if(count($query) == 0 && $page != 0)

		{

			redirect('manajemen/users/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		

		}

				

		$data = array(

			'kueri' 		=> $query,

			'page'			=> $page,

			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=3),

			'main'			=> 'users',

			'users'			=> 'select',

			'sort_by' 		=> $short_by,

			'sort_order' 	=> $short_order,			

			'page'			=> $page,

			'totalPage'		=> $total_page

		);

		$this->load->view('template',$data);

	}



	function roles($short_by='roleID',$short_order='desc',$page=0)

	{

		$per_page = 10;

		$total_page = $this->db->count_all('roles');

		$url = 'user/roles/'.$short_by.'/'.$short_order.'/';

		

		$query = $this->muser->getRoles($per_page,$page,$short_by,$short_order);

		if(count($query) == 0 && $page != 0)

		{

			redirect('manajemen/roles/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		

		}

				

		$data = array(

			'kueri' 		=> $query,

			'page'			=> $page,

			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),

			'main'			=> 'roles',

			'manajemen'		=> 'select',

			'sort_by' 		=> $short_by,

			'sort_order' 	=> $short_order,			

			'page'			=> $page

		);

		$this->load->view('template',$data);

	}



	function permissions($short_by='permID',$short_order='desc',$page=0)

	{

		$per_page = 10;

		$total_page = $this->db->count_all('permissions');

		$url = 'manajemen/roles/'.$short_by.'/'.$short_order.'/';

		

		$query = $this->muser->getPermissions($per_page,$page,$short_by,$short_order);

		if(count($query) == 0 && $page != 0)

		{

			redirect('manajemen/roles/'.$short_by.'/'.$short_order.'/'.($page - $per_page));		

		}

				

		$data = array(

			'kueri' 		=> $query,

			'page'			=> $page,

			'paging' 		=> $this->page->getPagination($total_page,$per_page,$url,$uri=5),

			'main'			=> 'permissions',

			'manajemen'		=> 'select',

			'sort_by' 		=> $short_by,

			'sort_order' 	=> $short_order,			

			'page'			=> $page

		);

		$this->load->view('template',$data);

	}



	function tambah_user()

	{

		$data = array(	  

			'users'			=> 'select',

			'main'			=> 'addUser',

			'ket'			=> 'Form User',

			'jenis'			=> 'Tambah',

			'link'			=> 'simpan_user',			

			'level'			=> $this->muser->getUserLevel(),			

		);

			

		$this->load->view('template',$data);

	}



	function set_role($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/roles');

		}



		$this->acl->ACL($id);



		$data = array(	  

			'manajemen'		=> 'select',

			'main'			=> 'setRole',

			'ket'			=> 'Form User',

			'jenis'			=> 'Tambah',

			'link'			=> 'simpan_user_role/'.$id,

			'kueri'			=> $this->acl->getAllRoles('full'),

			'id'			=> $id

		);

			

		$this->load->view('template',$data);

	}



	function set_permission($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/permissions');

		}



		$this->acl->ACL($id);



		$data = array(	  

			'manajemen'		=> 'select',

			'main'			=> 'setPermission',

			'ket'			=> 'Form User',

			'jenis'			=> 'Tambah',

			'link'			=> 'simpan_user_perm/'.$id,			

			'kueri'			=> $this->acl->getAllPerms('full'),

			'akses'			=> $this->arey->getAkses(),

			'rPerms' 		=> $this->acl->perms

		);

			

		$this->load->view('template',$data);

	}



	function set_role_permissions($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/permissions');

		}



		$this->acl->ACL($id);



		$data = array(	  

			'manajemen'		=> 'select',

			'main'			=> 'setRolePerm',

			'ket'			=> 'Form Role Permission',

			'jenis'			=> 'Tambah',

			'link'			=> 'simpan_role_perm/'.$id,

			'aPerms'		=> $this->acl->getAllPerms('full'),				

			'rPerms' 		=> $this->acl->getRolePerms($id),			

			'roleID'		=> $id

		);

			

		$this->load->view('template',$data);

	}



	function simpan_user_role($id)

	{

		$jumlah = $this->input->post('jumlah',TRUE);

		for($i=0;$i<$jumlah;$i++)

		{

			$input = $this->input->post('role'.$i);

			if($input == 1)

			{				

				$kueri = $this->muser->addUserRole($id,$this->input->post('roles'.$i));

			}

			else

			{

				$kueri = $this->muser->delUserRole($id,$this->input->post('roles'.$i));	

			}

		}



		if($kueri)

		{

			$this->message->set('succes','Update roles berhasil');

		}

		else

		{

			$this->message->set('notice','Update roles gagal');

		}



		redirect('manajemen/set_role/'.$id);

	}



	function simpan_user_perm($id)

	{

		$jumlah = $this->input->post('jumlah',TRUE);

		$kode = explode("-", $this->input->post('nilai',TRUE));

		for($i=0;$i<$jumlah;$i++)

		{

			$input = $this->input->post('perm_'.$i);

			$permKode = $kode[$i+1];

			if($input != 'x')

			{				

				$kueri = $this->muser->updateUserPerm($id,$permKode,$input);

			}

			else

			{

				$kueri = $this->muser->delUserPerm($id,$permKode);	

			}

		}



		if($kueri)

		{

			$this->message->set('succes','Update permissions berhasil');

		}

		else

		{

			$this->message->set('notice','Update permissions gagal');

		}



		redirect('manajemen/set_permission/'.$id);

	}



	function simpan_role_perm($id)

	{

		$jumlah = $this->input->post('jumlah',TRUE);

		for($i=0;$i<$jumlah;$i++)

		{

			$input = $this->input->post('role'.$i);

			if($input == '1' || $input == '0')

			{				

				$kueri = $this->muser->addRolePerm($id,$this->input->post('roles'.$i),$input);											

			}

			else

			{		

				$kueri = $this->muser->delRolePerm($id,$this->input->post('roles'.$i));	

			}

		}		



		if($kueri)

		{

			$this->message->set('succes','Update roles berhasil');

		}

		else

		{

			$this->message->set('notice','Update roles gagal');

		}



		redirect('manajemen/set_role_permissions/'.$id);

	}



	function tambah_role()

	{

		$data = array(	  

			'manajemen'		=> 'select',

			'main'			=> 'formRole',

			'ket'			=> 'Form Role',

			'jenis'			=> 'Tambah',

			'link'			=> 'simpan_role'

		);

			

		$this->load->view('template',$data);

	}



	function tambah_permission()

	{

		$data = array(	  

			'manajemen'		=> 'select',

			'main'			=> 'formPermission',

			'ket'			=> 'Form Permission',

			'jenis'			=> 'Tambah',

			'link'			=> 'simpan_permission'

		);

			

		$this->load->view('template',$data);

	}



	function edit_user($id,$jenis="")

	{

		if($id == '')

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/users');

		}



		if($jenis == "")

		{

			$re = "user";

		}

		else

		{

			$re = "dashboard";

		}



		$data = array(	  

			'users'			=> 'select',

			'main'			=> 'editUser',

			'ket'			=> 'Form User',

			'jenis'			=> 'Edit',

			'kueri'			=> $this->muser->editUser($id),

			'link'			=> 'update_user/'.$id,

			're'			=> $re			

		);

			

		$this->load->view('template',$data);

	}



	function edit_role($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/roles');

		}



		$data = array(	  

			'manajemen'		=> 'select',

			'main'			=> 'formRole',

			'ket'			=> 'Form Role',

			'jenis'			=> 'Edit',

			'kueri'			=> $this->muser->editRole($id),

			'link'			=> 'update_role/'.$id

		);

			

		$this->load->view('template',$data);

	}



	function edit_permission($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/permissions');

		}



		$data = array(	  

			'manajemen'		=> 'select',

			'main'			=> 'formPermission',

			'ket'			=> 'Form Permission',

			'jenis'			=> 'Edit',

			'kueri'			=> $this->muser->editPermission($id),

			'link'			=> 'update_permission/'.$id

		);

			

		$this->load->view('template',$data);

	}

	

	function simpan_user()

	{	

		$levels = array();



		$username = $this->input->post('username',TRUE);

		$password = $this->input->post('password',TRUE);

		$level = $this->input->post('level',TRUE);		

		

		if($this->simpleloginsecure->cek($username)) 

		{

			$this->message->set('notice','Nama user sudah digunakan');

		}

		else

		{

			if($this->simpleloginsecure->create($username, $password, $level))

			{

				$terakhir = $this->db->insert_id();				



				$this->muser->addUserRole($terakhir,$level);



				if($this->db->affected_rows() > 0)

				{

					$this->message->set('succes','User berhasil dibuat');

				}				

				else

				{

					$this->message->set('notice','User gagal dibuat dibuat');

				}

			}

			else

			{

				$this->message->set('notice','User gagal dibuat');

			}

		}

		redirect('manajemen/users');

	}



	function simpan_role()

	{		

		$this->muser->addRole();



		if($this->db->affected_rows() > 0)

		{

			$this->message->set('succes','Role berhasil dibuat');

		}

		else

		{

			$this->message->set('notice','Role gagal dibuat');

		}



		redirect('manajemen/roles');

	}



	function simpan_permission()

	{		

		$this->muser->addPermission();



		if($this->db->affected_rows() > 0)

		{

			$this->message->set('succes','Permission berhasil dibuat');

		}

		else

		{

			$this->message->set('notice','Permission gagal dibuat');

		}



		redirect('manajemen/permissions');

	}

	

	function update_user($id,$ids,$nama)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/users/'.$ids.'/'.$nama);

		}



		$username = $this->input->post('username',TRUE);

		$old = $this->input->post('oldpassword',TRUE);

		$new = $this->input->post('password',TRUE);

		$re = $this->input->post('re',TRUE);

		if($this->simpleloginsecure->edit_password($username, $old, $new))

		{

			$this->message->set('succes','Update password user berhasil');

		}

		else

		{

			$this->message->set('notice','Maaf update password user gagal');

		}

		redirect('manajemen/users/'.$ids.'/'.$nama);

	}



	function update_role($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/roles');

		}



		$this->muser->updateRole($id);



		if($this->db->affected_rows() > 0)

		{

			$this->message->set('succes','Role berhasil diupdate');

		}

		else

		{

			$this->message->set('notice','Role gagal diupdate');

		}

		redirect('manajemen/roles');

	}



	function update_permission($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/permissions');

		}



		$this->muser->updatePermission($id);



		if($this->db->affected_rows() > 0)

		{

			$this->message->set('succes','Permission berhasil diupdate');

		}

		else

		{

			$this->message->set('notice','Permission gagal diupdate');

		}

		redirect('manajemen/permissions');

	}

	

	function hapus_user($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/users');

		}



		if($this->simpleloginsecure->delete($id))

		{

			$this->message->set('succes','User berhasil dihapus');

		}

		else

		{

			$this->message->set('notice','User gagal dihapus');

		}

		redirect('manajemen/users');

	}



	function hapus_role($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/roles');

		}



		if($this->muser->deleteRole($id))

		{

			$this->message->set('succes','Role berhasil dihapus');

		}

		else

		{

			$this->message->set('notice','Role gagal dihapus');

		}

		redirect('manajemen/roles');

	}



	function hapus_permission($id)

	{

		if($id == "")

		{

			$this->message->set('notice','Maaf parameter salah');

			redirect('manajemen/permissions');

		}



		if($this->muser->deletePermission($id))

		{

			$this->message->set('succes','Permission berhasil dihapus');

		}

		else

		{

			$this->message->set('notice','Permission gagal dihapus');

		}

		redirect('manajemen/permissions');

	}



	function all_users()

	{

		$cek = $this->input->post('check');

		$link = $this->input->post('links');

		if(!is_array($cek))

		{

			$this->message->set('notice','Tidak ada user yang dipilih');

			redirect('manajemen/users/'.$link);

		}

		foreach($cek as $dt_cek)

		{

			$this->simpleloginsecure->delete($dt_cek);

		}

		$this->message->set('succes','User berhasil dihapus');

		redirect('manajemen/users/'.$link);

	}



	function all_roles()

	{

		$cek = $this->input->post('check');

		if(!is_array($cek))

		{

			$this->message->set('notice','Tidak ada roles yang dipilih');

			redirect('manajemen/roles');

		}

		foreach($cek as $dt_cek)

		{

			$this->muser->deleteRole($dt_cek);

		}

		$this->message->set('succes','Roles berhasil dihapus');

		redirect('manajemen/roles');

	}



	function all_permissions()

	{			

		$cek = $this->input->post('check');

		if(!is_array($cek))

		{

			$this->message->set('notice','Tidak ada permission yang dipilih');

			redirect('manajemen/permissions');

		}

		foreach($cek as $dt_cek)

		{

			$this->muser->deletePermission($dt_cek);

		}

		$this->message->set('succes','Permission berhasil dihapus');

		redirect('manajemen/permissions');

	}

}