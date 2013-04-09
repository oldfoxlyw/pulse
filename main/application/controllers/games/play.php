<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Play extends CI_Controller
{
	/**
	 * 
	 * 礼券
	 * 
	 * 提供礼券的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse order/coupon.php - 1.0.1.20130305 17:32
	 */
	
	private $user;
	private $rootPath;
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate(false);
	}
	
	public function index()
	{
		$this->load->model('product');

		$gameId = $this->input->get_post('gameId', TRUE);
		$serverId = $this->input->get_post('serverId', TRUE);

		if(empty($this->user))
		{
			$result = $this->product->read(array(
				'product_id'	=>	$gameId
			));
			$row = $result[0];
			redirect("{$row->product_url_entry}?serverId={$serverId}");
		}
		
		$parameter = array(
			'account_id'		=>	$this->user->account_id
		);
		$result = $this->maccount_coupon->read($parameter);
		if($result !== FALSE)
		{
			$whereinArray = array();
			foreach($result as $value)
			{
				array_push($whereinArray, $value->coupon_content);
			}
			$extension = array(
				'where_in'	=>	array(
					'key'		=>	'coupon_content',
					'value'	=>	$whereinArray
				)
			);
			$result = $this->mcoupon->read(null, $extension);
		}
		$parameter = array(
			'result'		=>	$result
		);
		
		$this->load->view($this->pageName, $parameter);
	}
}
?>