<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Check_user extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('account');
	}
	
	public function validate($redirect = true) {
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->helper('cookie');
		$redirectUrl = urlencode($this->config->item('root_path') . 'user/login?redirect=' . urlencode($this->input->server('REQUEST_URI')));
		$cookieName = $this->config->item('cookie_prefix') . 'user';
		if(!$this->input->cookie($cookieName, TRUE)) {

			if($redirect)
				redirect("/message?type=0&info=USER_CHECK_EXPIRED&redirect={$redirectUrl}&auto_redirect=1&auto_delay=5");
			
		} else {
			$cookie = $this->input->cookie($cookieName, TRUE);
			$this->load->helper('ucenter_sync');
			$cookie = _authcode($cookie);
			$json = json_decode($cookie);
			$id = $json->account_id;
			if(!empty($id))
			{
				$parameter = array(
					'account_id'	=>	$id
				);
			}
			else
			{
				$id = $json->uid;
				$parameter = array(
					'ucenter_uid'	=>	$id
				);
			}
			$result = $this->account->read($parameter);
			if($result != FALSE) {
				
				return $result[0];
			} else {

				$this->resetCookie();
				if($redirect)
				{
					redirect("/message?type=0&info=USER_CHECK_INVALID&redirect={$redirectUrl}");
				}
				
			}
		}
	}
	
	private function resetCookie()
	{
		$this->load->helper('cookie');
		$cookie = array(
			'name'		=> 'user',
			'domain'	=> $this->config->item('cookie_domain'),
			'path'		=> $this->config->item('cookie_path'),
			'prefix'		=> $this->config->item('cookie_prefix')
		);
		delete_cookie($cookie);
	}
}
?>