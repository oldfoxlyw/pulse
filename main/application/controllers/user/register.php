<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller
{
	/**
	 * 
	 * 用户注册页面
	 * 
	 * 提供用户中心注册的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse user/register.php - 1.0.1.20130129 10:08
	 */
	private $rootPath;
	private $pageName = 'user/register';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view($this->pageName);
	}
	
	public function submit()
	{
		$accountName = $this->input->post('accountName', TRUE);
		$accountPass = $this->input->post('accountPass', TRUE);
		$accountSex = $this->input->post('accountSex', TRUE);
		$accountEmail = $this->input->post('accountEmail', TRUE);
		$accountRealName = $this->input->post('accountRealName', TRUE);
		$accountIdentity = $this->input->post('accountIdentity', TRUE);
		
		$accountEmail = empty($accountEmail) ? '' : $accountEmail;
		$this->load->model('account');
		
		if(!empty($accountName) && !empty($accountPass))
		{
			$result = $this->account->read(array(
				'account_name'	=>	$accountName
			));
			if(!empty($result))
			{
				$redirect = urlencode(site_url('user/register'));
				redirect("/message?type=0&info=USER_REGISTER_ERROR_EXIST&redirect={$redirect}&auto_redirect=1&auto_delay=5");
			}
			else
			{
				$this->load->helper('security');
				if($this->config->item('enabled_ucenter_sync'))
				{
					$this->load->library('UcenterSync');
					$result = $this->ucentersync->registerUser($accountName, $accountPass);
					if($result == UC_USER_CHECK_USERNAME_FAILED || $result == UC_USER_USERNAME_BADWORD)
					{
						$redirect = urlencode(site_url('user/register'));
						redirect("/message?type=0&info=USER_REGISTER_ERROR&redirect={$redirect}&auto_redirect=1&auto_delay=5");
					}
					elseif ($result == UC_USER_USERNAME_EXISTS)
					{
						//ucenter里存在，则直接注册成功
						$result = $this->ucentersync->getUser($accountName);
						$row = array(
							'account_name'		=>	$accountName,
							'account_pass'		=>	do_hash(do_hash($accountPass, 'md5')),
							'account_email'		=>	$accountEmail,
							'account_sex'		=>	intval($accountSex),
							'account_regtime'	=>	time(),
							'ucenter_uid'		=>	$result[0]
						);
						$this->account->create($row);
						$redirect = urlencode(site_url('user/index'));
						redirect("/message?type=1&info=USER_REGISTER_ACTIVE&redirect={$redirect}&auto_redirect=1&auto_delay=5");
					}
					else
					{
						//ucenter里不存在，并且已注册，需要同步
						$row = array(
							'account_name'		=>	$accountName,
							'account_pass'		=>	do_hash(do_hash($accountPass, 'md5')),
							'account_email'		=>	$accountEmail,
							'account_sex'		=>	intval($accountSex),
							'account_regtime'	=>	time(),
							'ucenter_uid'		=>	$result
						);
						$this->account->create($row);
						$redirect = urlencode(site_url('user/index'));
						redirect("/message?type=1&info=USER_REGISTER_SUCCESS&redirect={$redirect}&auto_redirect=1&auto_delay=5");
					}
				}
				else
				{
					$row = array(
						'account_name'		=>	$accountName,
						'account_pass'		=>	do_hash(do_hash($accountPass, 'md5')),
						'account_email'		=>	$accountEmail,
						'account_sex'		=>	intval($accountSex),
						'account_regtime'	=>	time()
					);
					$this->account->create($row);
					$redirect = urlencode(site_url('user/index'));
					redirect("/message?type=1&info=USER_REGISTER_SUCCESS&redirect={$redirect}&auto_redirect=1&auto_delay=5");
				}
			}
		}
		else
		{
			$redirect = urlencode(site_url('user/register'));
			redirect("/message?type=0&info=USER_REGISTER_ERROR_NO_PARAM&redirect={$redirect}&auto_redirect=1&auto_delay=5");
		}
	}
}
?>