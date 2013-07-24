<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Screenshot extends CI_Controller
{
	private $pageName = 'screenshot';
	private $user = null;
	
	public function __construct()
	{
		parent::__construct ();
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function lists($offset = 0)
	{
		$this->load->model('product');
		$this->load->model('mscreenshot');
		$this->load->library('pagination');
		
		$this->pageName = 'screenshot';
		
		$count = $this->mscreenshot->count();
		$result = $this->mscreenshot->read(null, array(
			'screenshot_posttime',
			'desc'
		), 30, $offset);
		
		$page_config['base_url'] = site_url('screenshot/lists');
		$page_config['total_rows'] = $count;
		$page_config['per_page'] = 30;
		$page_config['first_link'] = '首页';
		$page_config['last_link'] = '末页';
		
		$this->pagination->initialize($page_config);
		$pagination = $this->pagination->create_links();
		$pagination = empty($pagination) ? '&nbsp;' : $pagination;

		$productResult = $this->product->read();
		
		$data = array(
			'admin'					=>	$this->user,
			'page_name'			=>	$this->pageName,
			'result'					=>	$result,
			'pagination'			=>	$pagination,
			'product_result'	=>	$productResult
		);
		$this->render->render('screenshot', $data);
	}
	
	public function edit($id)
	{
		if(!empty($id) && is_numeric($id))
		{
			$this->load->model('product');
			$this->load->model('mscreenshot');
			$this->load->library('pagination');
			
			$this->pageName = 'screenshot';
			
			$count = $this->mscreenshot->count();
			$result = $this->mscreenshot->read(null, array(
					'screenshot_posttime',
					'desc'
			), 30, 0);
			
			$page_config['base_url'] = site_url('screenshot/lists');
			$page_config['total_rows'] = $count;
			$page_config['per_page'] = 30;
			$page_config['first_link'] = '首页';
			$page_config['last_link'] = '末页';
			
			$this->pagination->initialize($page_config);
			$pagination = $this->pagination->create_links();
			$pagination = empty($pagination) ? '&nbsp;' : $pagination;
			
			$productResult = $this->product->read();
			$row = $this->mscreenshot->read(array(
				'screenshot_id'		=>	$id
			));
			if($row !== FALSE)
			{
				$row = $row[0];
			}
			
			$data = array(
					'admin'					=>	$this->user,
					'page_name'			=>	$this->pageName,
					'result'					=>	$result,
					'pagination'			=>	$pagination,
					'edit'					=>	'1',
					'screenshot_id'		=>	$id,
					'product_result'	=>	$productResult,
					'row'						=>	$row
			);
			$this->render->render('screenshot', $data);
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的编号', 'screenshot/lists', true, 5);
		}
	}
	
	public function submit()
	{
		$this->load->model('mscreenshot');
		$this->load->model('product');
		
		$edit = $this->input->post('edit', TRUE);
		$screenshotId = $this->input->post('screenshotId', TRUE);
		$screenshotTitle = $this->input->post('screenshotTitle', TRUE);
		$productId = $this->input->post('productId', TRUE);
		$screenshotContent = $this->input->post('wysiwyg');
		$screenshotPicUrl = $this->input->post('screenshotPicUrl', TRUE);
		
		if(empty($screenshotTitle) || empty($productId) || empty($screenshotPicUrl))
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'screenshot/lists', true, 5);
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
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '产品编号不存在', 'screenshot/lists', true, 5);
		}
		
		$row = array(
			'product_id'					=>	$productId,
			'product_name'				=>	$productName,
			'screenshot_title'			=>	$screenshotTitle,
			'screenshot_content'		=>	$screenshotContent,
			'screenshot_posttime'	=>	time(),
			'screenshot_pic_url'		=>	$screenshotPicUrl
		);
		
		if(!empty($edit))
		{
			$this->mscreenshot->update($screenshotId, $row);
		}
		else
		{
			$this->mscreenshot->create($row);
		}
		redirect('screenshot/lists');
	}
	
	public function delete($id)
	{
		if(!empty($id) && is_numeric($id))
		{
			$this->load->model('mscreenshot');
			$this->mscreenshot->delete($id);
			redirect('screenshot/lists');
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的编号', 'screenshot/lists', true, 5);
		}
	}
}

?>