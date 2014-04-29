<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_paid_count extends CI_Controller
{
	/**
	 * 
	 * 统计
	 * 
	 * @author johnnyEven
	 * @version Pulse/service account.php - 1.0.1.20130409 10:52
	 */

	private $currentdb = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->currentdb = $this->database->load('logdb', TRUE);
	}

	public function sts_common()
	{
		set_time_limit(1800);

		$lastDate = $this->input->get('date', TRUE);
		
		if(!empty($lastDate))
		{
			$lastTimeStart = strtotime ( $lastDate . ' 00:00:00' );
			$lastTimeEnd = strtotime ( $lastDate . ' 23:59:59' );
		}
		else
		{
			$currentTimeStamp = time ();
			$currentDate = date ( 'Y-m-d', $currentTimeStamp );
			$lastTimeStart = strtotime ( $currentDate . ' 00:00:00' ) - 86400;
			$lastTimeEnd = strtotime ( $currentDate . ' 23:59:59' ) - 86400;
		}
		$date = date ( 'Y-m-d', $lastTimeStart );

		$this->load->model('mrole');
		$db = $this->mrole->db();
		$db->select('product_id, server_id, partner, account_id, role_id, order_count, order_sum');
		$db->where('order_count >', 0);
		$query = $db->get('pulse_role');
		$result = $query->result();
		$query->free_result();

		$role_id_data = array();
		$data = array();
		for($i=0; $i<count($result); $i++)
		{
			$item = array(
				'log_date'		=>	$date,
				'account_id'	=>	$result[$i]->account_id,
				'product_id'	=>	$result[$i]->product_id,
				'server_id'		=>	$result[$i]->server_id,
				'partner'		=>	$result[$i]->partner,
				'role_id'		=>	$result[$i]->role_id,
				'count'			=>	$result[$i]->order_count,
				'sum'			=>	$result[$i]->order_sum
			);
			array_push($data, $item);
			array_push($role_id_data, $result[$i]->role_id);
		}
		$db->insert_batch('log_product_paid_count', $data);

		$db->where_in('role_id', $role_id_data);
		$db->set('order_count', 0);
		$db->set('order_sum', 0);
		$db->update('pulse_role');
	}
}