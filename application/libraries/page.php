<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Page
{
	function Page()
	{
		$this->SG =& get_instance();
		$this->SG->load->library(array('pagination'));
	}
	
	function getPagination($total_page,$per_page,$url,$uri=5)
	{
		$config['base_url'] = base_url().$url;
		$config['total_rows'] = $total_page;
		$config['per_page'] = $per_page;
		$config['first_link'] = 'Pertama';
		$config['uri_segment'] = $uri;	
		$config['last_link'] = 'Terakhir';
		$config['next_link'] = 'Berikutnya';
		$config['prev_link'] = 'Sebelumnya';
		$config['anchor_class'] = 'class="paginate_button"';
		$config['cur_tag_open'] = '<a class="paginate_active" tabindex="0">';
		$config['cur_tag_close'] = '</a>';
	    $config['full_tag_open'] = '<div id="DataTables_Table_0_paginate" class="dataTables_paginate paging_full_numbers"><span>';
    	$config['full_tag_close'] = '</span></div>';
		
		$this->SG->pagination->initialize($config);
		
		return $this->SG->pagination->create_links();
	}	
}
