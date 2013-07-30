<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller
{
	public function __construct()
	{
		parent::__construct ();
	}
	
	public function lists()
	{
		$productId = $this->input->get_post('productId', TRUE);
		$limit = $this->input->get_post('limit', TRUE);
		$offset = $this->input->get_post('offset', TRUE);
		
		$parameter = array();
		if(!empty($productId) && is_numeric($productId))
		{
			$parameter['product_id'] = intval($productId);
		}
		if(empty($limit) || !is_numeric($limit))
		{
			$limit = 5;
		}
		else
		{
			$limit = intval($limit);
		}
		if(empty($offset) || !is_numeric($offset))
		{
			$offset = 0;
		}
		else
		{
			$offset = intval($offset);
		}
		$this->load->model('mnews');
		
		$result = $this->mnews->read($parameter, array(
			'order_by'		=>	array(
				'news_posttime',
				'desc'
			)
		), $limit, $offset);
		
		echo $this->return_format->format($result);
	}
}

?>