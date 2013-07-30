<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller
{
	private $productId;
	
	public function __construct()
	{
		parent::__construct ();
		$productId = $this->config->item('product_id');
	}
	
	public function index()
	{
		$this->load->model('connector');
		$this->load->driver('cache', array(
			'adapter' => 'apc'
		));
		
		$news = $this->connector->post('web/news/lists', array(
			'productId'	=>	$this->productId
		));
		
		if ( !$cache = $this->cache->get('index_news_list'))
		{
			$this->cache->save('index_news_list', $news, 600);
		}
		
		echo $news;
	}
}

?>