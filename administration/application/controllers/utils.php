<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils extends CI_Controller
{
	public function __construct()
	{
		parent::__construct ();
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function doPicUpload() {
		$uploadDir = $this->config->item('upload_dir');
		$fileElementName = 'fileUpload';
		$el = $this->input->get('el', TRUE);
		if($el) {
			$fileElementName = $el;
		}
		$uploadStorePath = $uploadDir;
		$error = "";
		$msg = "";
	
		$config['upload_path'] = $uploadStorePath;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;
	
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($fileElementName)) {
			$error = $this->upload->display_errors('', '');
		} else {
			$data = $this->upload->data();
			$msg = '上传成功！';
			$error = 'null';
			$fileName = base_url($uploadDir . '/' . $data['file_name']);
		}
	
		$ret = '{';
		$ret .= "	error:\"{$error}\",";
		$ret .= "	msg:\"{$msg}\",";
		$ret .= "	data:\"{$fileName}\"";
		$ret .= '}';
		echo $ret;
	}
}

?>