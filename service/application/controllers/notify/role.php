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
		}
	}
}
?>