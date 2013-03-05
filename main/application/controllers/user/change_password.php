<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_password extends CI_Controller
{
	/**
	 * 
	 * 修改密码
	 * 
	 * 提供修改密码的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse user/change_password.php - 1.0.1.20130305 14:00
	 */
	
	private $user;
	private $rootPath;
	private $pageName = 'user/change_password';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function index()
	{
		$this->load->view($this->pageName);
	}
	
	public function submit()
	{
		$this->load->helper('security');
		$this->load->model('account');
		
		$originPass = $this->input->post('originPass', TRUE);
		$newPass = $this->input->post('newPass', TRUE);
		
		$result = $this->account->read(array(
			'account_id'	=>	$this->user->account_id
		));
		if($result[0]->account_pass != encrypt_pass($originPass))
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_CHANGEPASS_ERROR', '', 'user/change_password', true, 5);
		}
		else
		{
			$newPass = encrypt_pass($newPass);
			$row = array(
				'account_pass'					=>	$newPass
			);
			$this->account->update($this->user->account_id, $row);
			showMessage(MESSAGE_TYPE_SUCCESS, 'USER_CHANGEPASS_SUCCESS', '', 'user/change_password', true, 5);
		}
	}
}
?>