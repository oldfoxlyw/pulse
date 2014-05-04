<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Controller
{
	/**
	 * 
	 * 用户平台接收通知
	 * 
	 * @author johnnyEven
	 * @version Pulse/service account.php - 1.0.1.20130409 10:52
	 */
	
	public function __construct()
	{
		parent::__construct();
	}

	public function func_click()
	{
		$name = $this->input->post('name');

		if(!empty($name))
		{
			$this->load->model('mfunctioncount');
			$db = $this->mfunctioncount->db();
			$db->where('func_name', $name);
			$db->set('count', 'count + 1', FALSE);
			$db->update('log_function_click_count');
			
			echo 'success';
		}
	}

	public function online_count()
	{
		$product_id = $this->input->post('product_id');
		$server_id = $this->input->post('server_id');
		$timestamp = $this->input->post('timestamp');
		$count = $this->input->post('count');

		if(!empty($product_id) && !empty($server_id) && $timestamp > 0 && $count >= 0)
		{
			$this->load->model('monlinedetail');

			$date = date('Y-m-d', $timestamp);
			$hour = intval(date('G', $timestamp));
			$minutes = intval(date('i', $timestamp));

			$parameter = array(
				'product_id'	=>	$product_id,
				'server_id'		=>	$server_id,
				'date'			=>	$date,
				'hour'			=>	$hour,
				'minutes'		=>	$minutes,
				'count'			=>	$count
			);
			$this->monlinedetail->create($parameter);

			echo 'success';
		}
	}
}