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
	}
	
	public function index()
	{
		$currentTimeStamp = time();
		$currentTime = strtotime(date('Y-m-d 00:00:00', $currentTimeStamp));
		$startDate = date('w', $currentTime);
		$weekStartTimeStamp = $currentTime - $startDate * 86400;
		$weekEndTimeStamp = $weekStartTimeStamp + 7 * 86400 - 1;
		
		//获取活动列表开始
		$this->load->model('activity');
		$activityResult = array();
		$parameter = array(
			'activity_loop'					=>	0,
			'activity_time_start >='	=>	$weekStartTimeStamp,
			'activity_time_end <='		=>	$weekEndTimeStamp
		);
		$result = $this->activity->read($parameter);

		foreach($result as $row)
		{
			$startDate = date('w', $row->activity_time_start);
			if(empty($activityResult[$row->product_id][$startDate]))
			{
				$activityResult[$row->product_id][$startDate] = array();
			}
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
					for($i=0; $i<7; $i++)
					{
						if(empty($activityResult[$row->product_id][$i]))
						{
							$activityResult[$row->product_id][$i] = array();
						}
						array_push($activityResult[$row->product_id][$i], $row);
					}
					break;
				case '2':
					$startDate = date('w', $row->activity_time_start);
					if(empty($activityResult[$row->product_id][$startDate]))
					{
						$activityResult[$row->product_id][$startDate] = array();
					}
					array_push($activityResult[$row->product_id][$startDate], $row);
					break;
				case '3':
					$month = date('m', $currentTimeStamp);
					$startDay = strtotime(date("Y-{$month}-d H:i:s", $row->activity_time_start));
					$endDay = strtotime(date("Y-{$month}-d H:i:s", $row->activity_time_end));
					if($weekStartTimeStamp <= $startDay && $weekEndTimeStamp >= $endDay)
					{
						$startDate = date('w', $row->activity_time_start);
						if(empty($activityResult[$row->product_id][$startDate]))
						{
							$activityResult[$row->product_id][$startDate] = array();
						}
						array_push($activityResult[$row->product_id][$startDate], $row);
					}
					break;
			}
		}
		//获取活动列表结束
		
		//获取最新服务器
		$this->load->model('server');
		$parameter = array(
			'orderby'	=>	array(
				'server_time_start',
				'desc'
			)
		);
		$serverResult = $this->server->read(null, $parameter, 8);
		//获取最新服务器结束
		
		//获取推荐游戏
		$this->load->model('product');
		$parameter = array(
			'product_recommand'		=>	1
		);
		$extension = array(
			'orderby'	=>	array(
				'product_sort',
				'desc'
			)
		);
		$productResult = $this->product->read($parameter, $extension, 8);
		var_dump($productResult);
		//获取推荐游戏结束
		
		//获取新闻公告
		$this->load->model('news');
		$parameter = array(
				'orderby'	=>	array(
						'news_posttime',
						'desc'
				)
		);
		$newsResult = $this->news->read(null, $parameter, 10);
		//获取新闻公告结束
	}
}