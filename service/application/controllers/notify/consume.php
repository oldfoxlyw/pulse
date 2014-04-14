<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consume extends CI_Controller
{
	public function __construct()
	{
		parent::__construct ();
	}

	public function log()
	{
		$account_id = $this->input->post('account_id');
		$role_id = $this->input->post('role_id');
		$product_id = $this->input->post('product_id');
		$server_id = $this->input->post('server_id');
		$partner = $this->input->post('partner');
		$currency_type = $this->input->post('currency_type');
		$currency_current = $this->input->post('currency_current');
		$currency_change = $this->input->post('currency_change');
		$item_name = $this->input->post('item_name');
		$item_type = $this->input->post('item_type');
		$time = time();

		if(!empty($account_id) && !empty($role_id) && !empty($product_id) &&
			!empty($server_id) && !empty($item_name))
		{
			$partner = empty($partner) ? 0 : intval($partner);
			$currency_type = is_numeric($currency_type) ? intval($currency_type) : -1;
			$currency_current = intval($currency_current);
			$currency_change = intval($currency_change);
			$item_type = is_numeric($item_type) ? intval($item_type) : -1;

			$this->load->model('mlogconsume');
			$parameter = array(
				'account_id'		=>	$account_id,
				'role_id'			=>	$role_id,
				'product_id'		=>	$product_id,
				'server_id'			=>	$server_id,
				'partner'			=>	$partner,
				'currency_type'		=>	$currency_type,
				'currency_current'	=>	$currency_current,
				'currency_change'	=>	$currency_change,
				'item_name'			=>	$item_name,
				'item_type'			=>	$item_type,
				'time'				=>	$time
			);
			$this->mlogconsume->create($parameter);
		}
		else
		{
			$json = parameter(
				'code'		=>	-1
			);
			$this->return_format->format($json);
		}
	}
}

?>