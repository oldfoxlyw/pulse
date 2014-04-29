<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_consume extends CI_Controller
{
	/**
	 * 
	 * 统计
	 * 
	 * @author johnnyEven
	 * @version Pulse/service account.php - 1.0.1.20130409 10:52
	 */
	
	public function __construct()
	{
		parent::__construct();
		$this->currentdb = $this->load->database('logdb', TRUE);
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
		$preDate = date ( 'Y-m-d', $lastTimeStart - 86400 );

		$this->load->model('product');
		$product_result = $this->product->read();

		$this->load->model('mlogordergame');
		$this->load->model('mrole');
		$this->load->model('mserver');
		$this->load->model('mpartner');
		$this->load->model('mproductconsume');
		$partner_result = $this->mpartner->read();
		$order_type = array(1, 999, 0);

		$common_result = array();
		$this->load->model('mproductcommon');
		$parameter = array(
			'log_date'		=>	$date
		);
		$result = $this->mproductcommon->read($parameter);
		foreach($i = 0; $i < count($common_result); $i++)
		{
			if($common->terminal_type == 0)
			{
				$common = $common_result[$i];
				$common_result[$common->product_id][$common->server_id][$common->partner] = $common;
			}
		}

		$db = $this->logordergame->db();
		foreach($product_result as $product)
		{
			$server_result = $this->mserver->read(array(
				'product_id'	=>	$product->product_id
			));
			foreach($server_result as $server)
			{
				foreach($partner_result as $partner)
				{
					foreach($order_type as $type)
					{
						//订单总额
						$db->select_sum('order_cash');
						$db->where('product_id', $product->product_id);
						$db->where('server_id', $server->server_id);
						$db->where('partner', $partner->id);
						if($type != 0)
						{
							$db->where('order_type', $type);
						}
						else
						{
							$db->where('order_type !=', 999);
						}
						$query = $db->get('log_order_game');
						$sum_order = $query->num_rows();
						$query->free_result();

						//日付费用户数(去重)
						$db->select('role_id');
						$db->where('product_id', $product->product_id);
						$db->where('server_id', $server->server_id);
						$db->where('partner', $partner->id);
						if($type != 0)
						{
							$db->where('order_type', $type);
						}
						else
						{
							$db->where('order_type !=', 999);
						}
						$db->group_by('role_id');
						$query = $db->get('log_order_game');
						$count_upaid = $query->num_rows();
						$query->free_result();

						//付费用户ARPU（分为单位）
						$arpu = round($sum_order / $count_upaid);

						//登录用户付费转化率，单位为万分之一
						$login_count = $common_result[$product->product_id][$server->server_id][$partner->id]->count_ulogin;
						if(!empty($login_count))
						{
							$login_arpu = round(($count_upaid / $login_count) * 10000);
						}
						else
						{
							$login_arpu = -1;
						}

						//注册用户付费转化率，单位为万分之一
						$register_count = $common_result[$product->product_id][$server->server_id][$partner->id]->count_register_new;
						if(!empty($register_count))
						{
							$register_arpu = round(($count_upaid / $register_count) * 10000);
						}
						else
						{
							$register_arpu = -1;
						}

						//总注册用户付费转化率，单位为万分之一
						$role_db = $this->mrole->db();
						$role_db->where('product_id', $product->product_id);
						$role_db->where('server_id', $server->server_id);
						$role_db->where('partner', $partner->id);
						$register_all = $role_db->count_all_results('pulse_role');

						$role_db = $this->mrole->db();
						$role_db->where('product_id', $product->product_id);
						$role_db->where('server_id', $server->server_id);
						$role_db->where('partner', $partner->id);
						$role_db->where('order_count >', 0);
						$paid_all = $role_db->count_all_results('pulse_role');

						$all_arpu = round(($paid_all / $register_all) * 10000);

						$parameter = array(
							'log_date'				=>	$date,
							'product_id'			=>	$product->product_id,
							'server_id'				=>	$server->server_id,
							'order_type'			=>	$type,
							'partner'				=>	$partner->id,
							'sum_order'				=>	$sum_order,
							'count_upaid'			=>	$count_upaid,
							'arpu'					=>	$arpu,
							'login_arpu'			=>	$login_arpu,
							'register_arpu'			=>	$register_arpu,
							'all_arpu'				=>	$all_arpu
						);
						$this->mproductconsume->create($parameter);
					}
				}
			}
		}
	}
}