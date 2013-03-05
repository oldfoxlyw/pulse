<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bind_email extends CI_Controller
{
	/**
	 * 
	 * 绑定邮箱
	 * 
	 * 提供邮箱绑定的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse user/bind_email.php - 1.0.1.20130305 11:44
	 */
	
	private $user;
	private $rootPath;
	private $pageName = 'user/bind_email';
	
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
		$this->load->library('Guid');
		$this->load->model('utils/mail');
		$this->load->model('tools/mail_bind');
		
		$accountEmail = $this->input->post('accountEmail', TRUE);

		if(!empty($accountEmail))
		{
			$code = md5($this->guid->toString());
			$parameter = array(
				'code'					=>	$code,
				'account_id'			=>	$this->user->account_id,
				'account_email'		=>	$accountEmail,
				'expire_time'			=>	time() + 3600
			);
			$this->mail_bind->create($parameter);
			
			$parameter = array(
				'template_id'			=>	1,
				'template_parser'	=>	array(
					'code'		=>	$code
				),
				'mail_list'				=>	array($accountEmail)
			);
			if($this->mail->send_email($parameter))
			{
				echo 'success';
			}
		}
	}
	
	public function confirm()
	{
		$this->load->model('tools/mail_bind');
		$this->load->model('account');
		
		$code = $this->input->get('code');
		
		if(!empty($code))
		{
			$result = $this->mail_bind->read(array(
				'code'			=>	$code
			));
			
			if($result !== FALSE)
			{
				$row = $result[0];
				if($row->bind_validate == '1')
				{
					echo 'already valid';
					exit();
				}
				if(time() <= $row->expire_time)
				{
					$parameter = array(
						'account_email'		=>	$row->account_email
					);
					if($this->account->update($row->account_id, $parameter))
					{
						$this->mail_bind->update($code, array(
							'bind_validate'	=>	1
						));
						echo 'success';
					}
				}
			}
		}
	}
}
?>