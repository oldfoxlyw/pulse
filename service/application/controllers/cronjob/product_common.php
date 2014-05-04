<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_common extends CI_Controller
{
	/**
	 * 
	 * 统计（每日04:05执行）
	 * 
	 * @author johnnyEven
	 * @version Pulse/service account.php - 1.0.1.20130409 10:52
	 */
	
	public function __construct()
	{
		parent::__construct();
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

		$this->load->model('mlogrole');
		$this->load->model('mserver');
		$this->load->model('mpartner');
		$this->load->model('mproductcommon');
		$partner_result = $this->mpartner->read();
		$terminal_type = array(1, 2, 3, 0);

		$db = $this->mlogrole->db();
		foreach($product_result as $product)
		{
			$server_result = $this->mserver->read(array(
				'product_id'	=>	$product->product_id
			));
			foreach($server_result as $server)
			{
				foreach($partner_result as $partner)
				{
					foreach($terminal_type as $terminal)
					{
						//总注册用户数
						$db->select('role_id');
						$db->where('product_id', $product->product_id);
						$db->where('server_id', $server->server_id);
						$db->where('partner', $partner->id);
						if($terminal != 0)
						{
							$db->where('terminal_type', $terminal);
						}
						$db->where('action_type', 2);
						$db->group_by('role_id');
						$query = $db->get('log_account_role');
						$count_register = $query->num_rows();
						$query->free_result();

						//日新增注册用户数
						$db->select('role_id');
						$db->where('product_id', $product->product_id);
						$db->where('server_id', $server->server_id);
						$db->where('partner', $partner->id);
						if($terminal != 0)
						{
							$db->where('terminal_type', $terminal);
						}
						$db->where('action_type', 2);
						$db->where('log_time >=', $lastTimeStart);
						$db->where('log_time <=', $lastTimeEnd);
						$db->group_by('role_id');
						$query = $db->get('log_account_role');
						$count_register_new = $query->num_rows();
						$query->free_result();

						//日独立登录数
						$db->select('role_id');
						$db->where('product_id', $product->product_id);
						$db->where('server_id', $server->server_id);
						$db->where('partner', $partner->id);
						if($terminal != 0)
						{
							$db->where('terminal_type', $terminal);
						}
						$db->where('action_type', 1);
						$db->where('log_time >=', $lastTimeStart);
						$db->where('log_time <=', $lastTimeEnd);
						$db->group_by('role_id');
						$query = $db->get('log_account_role');
						$count_ulogin = $query->num_rows();
						$query->free_result();

						//日登录次数（有重复）
						$db->select('role_id');
						$db->where('product_id', $product->product_id);
						$db->where('server_id', $server->server_id);
						$db->where('partner', $partner->id);
						if($terminal != 0)
						{
							$db->where('terminal_type', $terminal);
						}
						$db->where('action_type', 1);
						$db->where('log_time >=', $lastTimeStart);
						$db->where('log_time <=', $lastTimeEnd);
						$query = $db->get('log_account_role');
						$count_login = $query->num_rows();
						$query->free_result();

						$parameter = array(
							'log_date'			=>	$date,
							'product_id'		=>	$product->product_id,
							'server_id'			=>	$server->server_id,
							'terminal_type'		=>	$terminal,
							'partner'			=>	$partner->id,
							'count_register'	=>	$count_register,
							'count_register_new'=>	$count_register_new,
							'count_ulogin'		=>	$count_ulogin,
							'count_login'		=>	$count_login
						);
						$this->mproductcommon->create($parameter);
					}
				}
			}
		}
	}
}