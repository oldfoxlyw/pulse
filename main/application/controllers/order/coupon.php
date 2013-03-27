<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon extends CI_Controller
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
	private $pageName = 'order/coupon';
	private $confirmName = 'order/coupon_confirm';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function index()
	{
		$this->load->model('order/maccount_coupon');
		$this->load->model('order/mcoupon');
		
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
	
	public function confirm()
	{
		$this->load->model('order/mcoupon');
		$this->load->model('product');
		
		$coupon = $this->input->get_post('coupon', TRUE);
		if(!empty($coupon))
		{
			$result = $this->mcoupon->read(array(
				'coupon_content'	=>	$coupon
			));
			$coupon = $result[0];
			$json = json_decode($coupon->coupon_detail);
			if($coupon->coupon_type == '0')
			{
				$rechargeValue = $json->value;
			}
			else if($coupon->coupon_type == '1')
			{

			}

			$productId = $coupon->product_id;
			$result = $this->product->read(array(
				'product_id'	=>	$productId
			));
			$product = $result[0];
			$rechargeUrl = $product->product_server_recharge;

			$parameter = array(
				'account_id'		=>	$this->user->account_id,
				'recharge_value'	=>	$rechargeValue
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $rechargeUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
			$output = curl_exec($ch);
			curl_close($ch);
		}
		$parameter = array(
			'result'	=>	$output
		);
		
		$this->load->view($this->confirmName, $parameter);
	}
}
?>