<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller
{
	/**
	 * 
	 * 用户平台角色相关操作
	 * 
	 * @author johnnyEven
	 * @version Pulse/service account.php - 1.0.1.20130409 10:52
	 */
	private $rootPath;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 *
	 * 角色进入游戏时调用
	 *
	 */
	public function enter($format = 'json')
	{
		$account_id = $this->input->post('account_id');
		$role_id = $this->input->post('role_id');
		$product_id = $this->input->post('product_id');
		$server_id = $this->input->post('server_id');
		$terminal_type = $this->input->post('terminal_type');
		$partner = $this->input->post('partner');

		if(!empty($account_id) && !empty($role_id) &&
			!empty($product_id) && !empty($server_id) &&
			is_numeric($terminal_type))
		{
			$partner = empty($partner) ? 0 : intval($partner);

			$this->load->model('utils/logs');
			$parameter = array(
				'account_id'		=>	$account_id,
				'role_id'			=>	$role_id,
				'product_id'		=>	$product_id,
				'server_id'			=>	$server_id,
				'terminal_type'		=>	$terminal_type,
				'partner'			=>	$partner,
				'action_type'		=>	1
			);
			$this->logs->write_account($parameter);

			$this->load->model('mrole');
			$key = array(
				'product_id'		=>	$product_id,
				'server_id'			=>	$server_id,
				'partner'			=>	$partner,
				'account_id'		=>	$account_id,
				'role_id'			=>	$role_id
			);
			$parameter = array(
				'login_time'		=>	time()
			);
			$this->mrole->update($key, $parameter);
		}
		else
		{
			$json = array(
				'code'	=>	-1
			);
			echo $this->return_format->format($json);
		}
	}

	/**
	 *
	 * 角色创建时调用
	 *
	 */
	public function create($format = 'json')
	{
		$account_id = $this->input->post('account_id');
		$role_id = $this->input->post('role_id');
		$product_id = $this->input->post('product_id');
		$server_id = $this->input->post('server_id');
		$terminal_type = $this->input->post('terminal_type');
		$partner = $this->input->post('partner');
		$nickname = $this->input->post('name');
		$level = $this->input->post('level');
		$last_mission = $this->input->post('mission');

		if(!empty($account_id) && !empty($role_id) &&
			!empty($product_id) && !empty($server_id) &&
			is_numeric($terminal_type))
		{
			$partner = empty($partner) ? 0 : intval($partner);
			$level = empty($level) ? 1 : intval($level);

			$this->load->model('mrole');
			$parameter = array(
				'product_id'		=>	$product_id,
				'server_id'			=>	$server_id,
				'account_id'		=>	$account_id,
				'role_id'			=>	$role_id,
				'partner'			=>	$partner,
				'nickname'			=>	$nickname,
				'level'				=>	$level,
				'last_mission'		=>	$last_mission,
				'login_time'		=>	time()
			);
			$this->mrole->create($parameter);

			$this->load->model('mrolecount');
			$parameter = array(
				'product_id'		=>	$product_id,
				'account_id'		=>	$account_id,
				'server_id'			=>	$server_id	
			);
			$result = $this->mrolecount->read($parameter);
			if(!empty($result))
			{
				$db = $this->mrolecount->db();
				$db->set('count', 'count+1', FALSE);
				$db->where('product_id', $product_id);
				$db->where('account_id', $account_id);
				$db->where('server_id', $server_id);
				$db->update('pulse_role_count');
			}
			else
			{
				$parameter['count'] = 1;
				$this->mrolecount->create($parameter);
			}

			$this->load->model('utils/logs');
			$parameter = array(
				'account_id'		=>	$account_id,
				'role_id'			=>	$role_id,
				'product_id'		=>	$product_id,
				'server_id'			=>	$server_id,
				'terminal_type'		=>	$terminal_type,
				'partner'			=>	$partner,
				'action_type'		=>	2
			);
			$this->logs->write_account($parameter);
		}
		else
		{
			$json = array(
				'code'	=>	-1
			);
			echo $this->return_format->format($json);
		}
	}

	/**
	 *
	 * 角色同步时调用
	 *
	 */
	public function sync($format = 'json')
	{
		$product_id = $this->input->post('product_id');
		$server_id = $this->input->post('server_id');
		$partner = $this->input->post('partner');
		$account_id = $this->input->post('account_id');
		$role_id = $this->input->post('role_id');
		$level = $this->input->post('level');
		$last_mission = $this->input->post('mission');

		if(!empty($product_id) && !empty($server_id) && !empty($account_id) && !empty($role_id))
		{
			$partner = empty($partner) ? 0 : intval($partner);

			$this->load->model('mrole');
			$key = array(
				'product_id'		=>	$product_id,
				'server_id'			=>	$server_id,
				'account_id'		=>	$account_id,
				'role_id'			=>	$role_id,
				'partner'			=>	$partner
			);
			$parameter = array(
				'level'			=>	$level,
				'last_mission'	=>	$last_mission
			);
			$this->mrole->update($key, $parameter);
		}
		else
		{
			$json = array(
				'code'		=>	-1
			);
			echo $this->return_format->format($json);
		}
	}

	/**
	 *
	 * 推送在线人数
	 *
	 */
	public function online_count()
	{
		$product_id = $this->input->post('product_id');
		$server_id = $this->input->post('server_id');
		$count = $this->input->post('count');
		$time = $this->input->post('time');

		if(!empty($product_id) && !empty($server_id))
		{
			$count = intval($count);
			$time = empty($time) ? time() : intval($time);
			$date = date('Y-m-d', $time);
			$hour = date('G', $time);
			$minutes = date('i', $time);

			$this->load->model('monlinedetail');
			$parameter = array(
				'product_id'		=>	$product_id,
				'server_id'			=>	$server_id,
				'date'				=>	$date,
				'hour'				=>	$hour,
				'minutes'			=>	$minutes,
				'count'				=>	$count
			);
			$this->monlinedetail->create($parameter);
		}
	}
}
?>