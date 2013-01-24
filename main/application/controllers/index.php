<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller
{
	/**
	 * 
	 * 首页
	 * 
	 * 提供首页的逻辑层
	 * 
	 * @author Administrator
	 * @version Pulse index.php - 1.0.1.20130123 17:21
	 */
	private $rootPath;
	private $pageName = 'index';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->model('activity');
		$this->load->model('product');
		$this->load->model('news');
	}
	
	public function index()
	{
		$currentTimeStamp = time();
		//获取活动列表
		$activityResult = array();
		$parameter = array(
			'activity_loop'					=>	0,
			'activity_time_start <='	=>	$currentTimeStamp,
			'activity_time_end >='		=>	$currentTimeStamp
		);
		$result = $this->activity->read($parameter);
		foreach($result as $row)
		{
			$startDate = date('w', $row->activity_time_start);
			$activityResult[$row->product_id][$startDate] = array();
			array_push($activityResult[$row->product_id][$startDate], $row);
		}
		
		$parameter = array(
			'activity_loop'					=>	1
		);
		$result = $this->activity->read($parameter);
		foreach($result as $row)
		{
			switch($row->activity_looptype)
			{
				case '1':
					
					break;
				case '2':
					
					break;
				case '3':
					
					break;
			}
			$activityResult[$row->product_id];
		}
	}
}