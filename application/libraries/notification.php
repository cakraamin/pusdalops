<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Notification
{
	function Notification()
	{
		$this->notif =& get_instance();
		$this->notif->load->model('mhome','',TRUE);
	}
	
	function getAvatar($id)
	{
		$gambar = $this->notif->mhome->getAvatar($id);
		if(empty($gambar->gambar))
		{
			$gambar = 'asset/template/admin/sample/p7.jpg';
		}
		else
		{
			$gambar = 'media/crop/'.$gambar->gambar;
		}
		return $gambar;
	}
	
	function getKatMenu()
	{
		$data = array();
		$sub = array();
		$menu = $this->notif->mhome->getMenuAll();
		foreach($menu as $dt_menu)
		{
			unset($sub);
			$subs = $this->notif->mhome->getMenuSub($dt_menu->id_kategori);	
			if(count($subs) > 0)					
			{
				foreach($subs as $dt_sub)
				{
					$sub[] = array('id'=>$dt_sub->id_kategori,'parents'=>$dt_sub->parent,'nama'=>$dt_sub->nama_kategori);
				}
			}
			else
			{
				$sub = "";
			}
			$data[] = array('id'=>$dt_menu->id_kategori,'parents'=>$dt_menu->parent,'nama'=>$dt_menu->nama_kategori,'sub'=>$sub);
		}
		return $data;
	}
	
	function getDropWil()
	{
		$drop = $this->notif->mhome->getDropWil();
		return $drop;
	}
	
	function getDropKat()
	{
		$kategori = $this->notif->mhome->getDropKat();
		return $kategori;
	}
}
