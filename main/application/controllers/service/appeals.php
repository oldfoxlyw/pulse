<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appeals extends CI_Controller
{
	/**
	 * 
	 * 申诉
	 * 
	 * 提供在线申诉的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse service/appeals.php - 1.0.1.20130327 14:55
	 */
	
	private $user;
	private $rootPath;
	private $pageName = 'service/appeal';
	private $addPage = 'service/appeal_add';
	private $checkPage = 'service/appeal_check';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function index()
	{
		$this->load->model('service/mappeal');

		$result = $this->mappeal->read(array(
			'account_id'	=>	$this->user->account_id
		), array(
			'order_by'		=>	array(
				'key'		=>	'appeal_posttime',
				'value'		=>	'desc'
			)
		));

		$parameter = array(
			'result' => $result
		);
		$this->load->view($this->pageName, $parameter);
	}

	public function add()
	{
		$this->load->model('service/mappeal');

		$this->load->view($this->addPage);
	}

	public function submit()
	{
		$this->load->model('service/mappeal');

		$appealCategory = $this->input->post('appeal_category', TRUE);
		$accountName = $this->input->post('account_name', TRUE);
		$appealContent = $this->input->post('appeal_content', TRUE);

		if(!empty($accountName) && !empty($appealContent))
		{
			$parameter = array(
				'appeal_category'	=>	$appealCategory,
				'account_id'		=>	$this->user->account_id,
				'account_name'		=>	$accountName,
				'appeal_content'	=>	$appealContent
			);
			if($this->mappeal->create($parameter))
			{
				
			}
		}
	}
}