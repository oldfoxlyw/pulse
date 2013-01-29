<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GeneratePass extends CI_Controller
{
	/**
	 * 
	 * 生成登录密码
	 * 
	 * 提供生成登录密码的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse generatePass.php - 1.0.1.20130129 10:08
	 */
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$pass = $this->input->get_post('pass', TRUE);
		
		$this->load->helper('security');
		echo do_hash(do_hash($pass, 'md5'));
	}
}
?>