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
			$json = json_decode($cookie);
			$accountId = $json->account_id;
			$parameter = array(
				'account_id'	=>	$accountId
			);
			$result = $this->account->read($parameter);
			if($result != FALSE) {
				$row = $result[0];
				$checkCode = do_hash(do_hash($json->account_name . '#' . $row->account_pass, 'md5'));
				if($checkCode != $json->check_code) {

					$this->resetCookie();
					if($redirect)
					{
						redirect("/message?type=0&info=USER_CHECK_CHECKCODE_INVALID&redirect={$redirectUrl}");
					}
					
				} else {
					return $row;
				}
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