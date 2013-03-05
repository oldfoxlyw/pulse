<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function send_email($parameter) {
		if(!empty($parameter)) {
			$this->load->model('tools/mail_template');
			$this->load->helper('template');
			$result = $this->mail_template->read(array(
				'template_id'		=>	$parameter['template_id']
			));
			if($result != FALSE) {
				$row = $result[0];
				$mailSubject = $row->template_subject;
				$templateContent = $row->template_content;
				$templateContent = parseTemplate($templateContent, $parameter['template_parser']);
				$config = array(
					'protocol'		=>	'smtp',
					'smtp_host'		=>	$row->smtp_host,
					'smtp_user'		=>	$row->smtp_user,
					'smtp_pass'		=>	$row->smtp_pass,
					'mailtype'		=>	'html',
					'validate'		=>	TRUE
				);
				$this->load->library('email');
				$this->email->initialize($config);
				
				foreach($parameter['mail_list'] as $accountName => $accountMail) {
					if($this->filter_email($accountMail))
					{
						$this->email->clear();
						$this->email->from($row->smtp_from, $row->smtp_fromName);
						$this->email->to($accountMail);
						$this->email->subject($mailSubject);
						$this->email->message($templateContent);
						if(!$this->email->send()) {
							return false;
						} else {
							return true;
						}
					}
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	private function filter_email($email)
	{
		$this->load->helper('email');
		$filter = $this->config->item('mail_filter');
		if(valid_email($email) && !preg_match($filter, $email))
		{
			return true;
		}
		return false;
	}
}
?>