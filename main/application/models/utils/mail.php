<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Model {
	private $tableName = 'web_accounts';
	private $fobiddenEmail = array();
	
	public function __construct() {
		parent::__construct();
	}
	
	public function send_email($parameter) {
		if(!empty($parameter)) {
			$this->load->model('web/email_template');
			$this->load->helper('email');
			$this->load->helper('template');
			$row = $this->auto->get($parameter['template_id']);
			if($row!=FALSE) {
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
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	private function filter_email($email)
	{
		
	}
}
?>