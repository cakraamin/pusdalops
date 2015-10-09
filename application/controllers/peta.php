<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peta extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mpeta','',TRUE);		
	}

	function index()
	{
		$peta = $this->mpeta->getLokasi();

		echo $peta;
	}

	function getPeta($id="")
	{
		$peta = $this->mpeta->getLokasi($id);

		echo $peta;
	}
}