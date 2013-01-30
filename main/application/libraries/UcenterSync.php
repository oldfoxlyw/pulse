<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once './config.inc.php';
include_once './uc_client/client.php';

class UcenterSync
{
	/**
	 * 
	 * UCenter同步类
	 * 
	 * 提供UCenter各种操作的接口
	 * 
	 * @author johnnyEven
	 * @version Pulse libraries/UcenterSync.php - 1.0.1.20130129 09:50
	 */
	
	private $userId;
	private $userName;
	CONST COOKIE_NAME = 'UCSync_auth';
	
	public function __construct()
	{
		if(!empty($_COOKIE[COOKIE_NAME])) {
			list($this->userId, $this->userName) = explode("\t", uc_authcode($_COOKIE[COOKIE_NAME], 'DECODE'));
		} else {
			$this->userId = $this->userName = '';
		}
	}
	
	public function getUid()
	{
		return $this->userId;
	}
	
	public function getUserName()
	{
		return $this->userName;
	}
	
	public function getUser($userName)
	{
		return uc_get_user($userName);
	}
	
	public function login($userName, $userPass)
	{
		return uc_user_login($userName, $userPass);
	}
	
	public function syncLogin($uid)
	{
		return uc_user_synlogin($uid);
	}
	
	public function syncLogout()
	{
		return uc_user_synlogout();
	}
	
	public function checkUserName($userName)
	{
		return uc_user_checkname($userName);
	}
	
	public function checkUserEmail($email)
	{
		return uc_user_checkemail($email);
	}
	
	public function registerUser($userName, $userPass, $email = 'xxx@xxx.com')
	{
		return uc_user_register($userName, $userPass, $email);
	}
}

?>