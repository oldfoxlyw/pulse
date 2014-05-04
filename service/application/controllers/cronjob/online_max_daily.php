<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Online_max_daily extends CI_Controller
{
	/**
	 * 
	 * 统计（每整点执行）
	 * 
	 * @author johnnyEven
	 * @version Pulse/service account.php - 1.0.1.20130409 10:52
	 */
	
	public function __construct()
	{
		parent::__construct();
		$this->currentdb = $this->load->database('logdb', TRUE);
	}

	public function process()
	{
		$time = strtotime('-1 hour');
		$date = date('H-i-s', $time);
		$hour = date('G', $time);

		$this->load->model('monlinedetail');
		$this->load->model('monlinemax');
		$db = $this->monlinedetail->db();

		$this->load->model('product');
		$product_result = $this->product->read();

		foreach($product_result as $product)
		{
			$server_result = $this->mserver->read(array(
				'product_id'	=>	$product->product_id
			));
			foreach($server_result as $server)
			{
				$parameter = array(
					'product_id'		=>	$product->product_id,
					'server_id'			=>	$server->server_id,
					'date'				=>	$date,
					'hour'				=>	$hour
				);
				$db->select_max('count', 'count');
				$db->where('product_id', $product->product_id);
				$db->where('server_id', $server->server_id);
				$db->where('date', $date);
				$db->where('hour', $hour);
				$query = $db->get('log_online_count_detail');
				$result = $query->row();
				$query->free_result();

				$count = $result->count;

				$parameter = array(
					'date'			=>	$date,
					'product_id'	=>	$product->product_id,
					'server_id'		=>	$server->server_id,
					'hour'			=>	$hour,
					'count'			=>	$count
				);
				$this->monlinemax->create($parameter);
			}
		}
	}
}