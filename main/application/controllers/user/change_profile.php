<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_profile extends CI_Controller
{
	/**
	 * 
	 * 修改个人资料
	 * 
	 * 提供修改个人资料的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse user/change_profile.php - 1.0.1.20130129 09:50
	 */
	
	private $user;
	private $rootPath;
	private $pageName = 'user_change_profile';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function index()
	{
		
	}
	
	public function submit()
	{
		$accountNickname = $this->input->post('accountNickname', TRUE);
		$accountSex = $this->input->post('accountSex', TRUE);
		$accountBirthday = $this->input->post('accountBirthday', TRUE);
		$accountCountry = $this->input->post('accountCountry', TRUE);
		$accountCity = $this->input->post('accountCity', TRUE);
		$accountJob = $this->input->post('accountJob', TRUE);
		
		$this->load->model('account');
		$row = array();
		if(!empty($accountNickname))
		{
			$row['account_nickname'] = $accountNickname;
		}
		if($accountSex !== FALSE && $accountSex == '1' || $accountSex == '0')
		{
			$row['account_sex'] = intval($accountSex);
		}
		if(!empty($accountBirthday))
		{
			$row['account_birthday'] = strtotime($accountBirthday);
		}
		if(!empty($accountCountry))
		{
			$row['account_country'] = $accountCountry;
		}
		if(!empty($accountCity))
		{
			$row['account_city'] = $accountCity;
		}
		if(!empty($accountJob))
		{
			$row['account_job'] = $accountJob;
		}
		$this->account->update($this->user->account_id, $row);
		
		$redirect = urlencode(site_url('user/change_profile'));
		redirect("/message?type=1&info=USER_CHANGE_PROFILE_SUCCESS&redirect={$redirect}&auto_redirect=1&auto_delay=5");
	}
}
?>