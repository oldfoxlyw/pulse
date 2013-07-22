<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends \CI_Controller
{
	private $pageName = 'index';
	private $user = null;
	
	public function __construct()
	{
		parent::__construct ();
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function index()
	{
		$this->load->model('maccount');
		$this->load->model('mappeal');
		$this->load->model('morder');
		
		$accountCount = $this->maccount->count();
		$appealCount = $this->mappeal->count(array(
			'appeal_status'		=>	0
		));
		$orderCount = $this->morder->count();
		
		$data = array(
			'admin'					=>	$this->user,
			'page_name'			=>	$this->pageName,
			'account_count'	=>	$accountCount,
			'appeal_count'		=>	$appealCount,
			'order_count'		=>	$orderCount
		);
		$this->render->render('index', $data);
	}
}

?>