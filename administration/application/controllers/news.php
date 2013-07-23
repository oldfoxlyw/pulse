<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller
{
	private $pageName = 'news';
	private $user = null;
	
	public function __construct()
	{
		parent::__construct ();
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function lists($offset = 0)
	{
		$this->load->model('mnews');
		$this->load->library('pagination');
		
		$this->pageName = 'news';
		
		$count = $this->mnews->count();
		$result = $this->mnews->read(null, array(
			'news_posttime',
			'desc'
		), 30, $offset);
		
		$page_config['base_url'] = site_url('news/lists');
		$page_config['total_rows'] = $count;
		$page_config['per_page'] = 30;
		$page_config['first_link'] = '首页';
		$page_config['last_link'] = '末页';
		
		$this->pagination->initialize($page_config);
		$pagination = $this->pagination->create_links();
		$pagination = empty($pagination) ? '&nbsp;' : $pagination;
		
		$data = array(
			'admin'					=>	$this->user,
			'page_name'			=>	$this->pageName,
			'result'					=>	$result,
			'pagination'			=>	$pagination
		);
		$this->render->render('news', $data);
	}
	
	public function publish()
	{
		$this->load->model('product');
		
		$this->pageName = 'news_publish';
		
		$productResult = $this->product->read();
		
		$data = array(
			'admin'					=>	$this->user,
			'page_name'			=>	$this->pageName,
			'product_result'	=>	$productResult
		);
		$this->render->render('news_publish', $data);
	}
	
	public function edit($id)
	{
		if(!empty($id) && is_numeric($id))
		{
			$this->load->model('product');
			$this->load->model('mnews');

			$this->pageName = 'news_publish';

			$productResult = $this->product->read();
			$result = $this->mnews->read(array(
				'news_id'		=>	$id
			));
			if($result !== FALSE)
			{
				$result = $result[0];
			}
			
			$data = array(
				'admin'					=>	$this->user,
				'page_name'			=>	$this->pageName,
				'product_result'	=>	$productResult,
				'edit'					=>	'1',
				'news_id'				=>	$id,
				'row'						=>	$result
			);
			$this->render->render('news_publish', $data);
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的新闻编号', 'news/lists', true, 5);
		}
	}
	
	public function submit()
	{
		$this->load->model('mnews');
		$this->load->model('product');
		
		$edit = $this->input->post('edit', TRUE);
		$newsId = $this->input->post('newsId', TRUE);
		$newsTitle = $this->input->post('newsTitle', TRUE);
		$productId = $this->input->post('productId', TRUE);
		$newsCategory = $this->input->post('newsCategory', TRUE);
		$newsContent = $this->input->post('wysiwyg');
		
		if(empty($newsTitle) || empty($productId) || empty($newsContent))
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'news/lists', true, 5);
		}
		
		$productResult = $this->product->read(array(
			'product_id'		=>	$productId
		));
		if(!empty($productResult))
		{
			$productName = $productResult[0]->product_name;
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '产品编号不存在', 'news/lists', true, 5);
		}
		
		$row = array(
			'news_title'				=>	$newsTitle,
			'product_id'				=>	$productId,
			'product_name'			=>	$productName,
			'news_category'		=>	$newsCategory,
			'news_content'			=>	$newsContent,
			'news_posttime'		=>	time(),
		);
		
		if(!empty($edit))
		{
			$this->mnews->update($newsId, $row);
		}
		else
		{
			$this->mnews->create($row);
		}
		redirect('news/lists');
	}
	
	public function delete($id)
	{
		if(!empty($id) && is_numeric($id))
		{
			$this->load->model('mnews');
			$this->mnews->delete($id);
			redirect('news/lists');
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的新闻编号', 'news/lists', true, 5);
		}
	}
}

?>