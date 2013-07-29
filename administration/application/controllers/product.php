<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller
{
	private $pageName = 'product';
	private $user = null;
	
	public function __construct()
	{
		parent::__construct ();
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function lists($offset = 0)
	{
		$this->load->model('mproduct');
		$this->load->library('pagination');
		
		$this->pageName = 'product';
		
		$count = $this->mproduct->count();
		$result = $this->mproduct->read(null, null, 30, $offset);
		
		$page_config['base_url'] = site_url('product/lists');
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
		$this->render->render($this->pageName, $data);
	}
	
	public function edit($id)
	{
		if(!empty($id) && is_numeric($id))
		{
			$this->load->model('mproduct');
			$this->load->library('pagination');
			
			$this->pageName = 'product';
			
			$count = $this->mproduct->count();
			$result = $this->mproduct->read(null, null, 30, 0);
			
			$page_config['base_url'] = site_url('product/lists');
			$page_config['total_rows'] = $count;
			$page_config['per_page'] = 30;
			$page_config['first_link'] = '首页';
			$page_config['last_link'] = '末页';
			
			$this->pagination->initialize($page_config);
			$pagination = $this->pagination->create_links();
			$pagination = empty($pagination) ? '&nbsp;' : $pagination;
			
			$row = $this->mproduct->read(array(
				'product_id'		=>	$id
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
					'product_id'			=>	$id,
					'row'						=>	$row
			);
			$this->render->render($this->pageName, $data);
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的编号', 'product/lists', true, 5);
		}
	}
	
	public function submit()
	{
		$this->load->model('mproduct');
		
		$edit = $this->input->post('edit', TRUE);
		$productId = $this->input->post('productId', TRUE);
		$productName = $this->input->post('productName', TRUE);
		$productCategory = $this->input->post('productCategory', TRUE);
		$productComment = $this->input->post('productComment', TRUE);
		$productUrlWebsite = $this->input->post('productUrlWebsite', TRUE);
		$productUrlEntry = $this->input->post('productUrlEntry', TRUE);
		$productStatus = $this->input->post('productStatus', TRUE);
		$productRecommand = $this->input->post('productRecommand', TRUE);
		$productSort = $this->input->post('productSort', TRUE);
		$productExchangeRate = $this->input->post('productExchangeRate', TRUE);
		$productCurrencyName = $this->input->post('productCurrencyName', TRUE);
		$productServerRole = $this->input->post('productServerRole', TRUE);
		$productServerRecharge = $this->input->post('productServerRecharge', TRUE);
		
		if(empty($productName) || empty($productUrlEntry))
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'product/lists', true, 5);
		}
		
		$row = array(
			'product_name'					=>	$productName,
			'product_category'			=>	$productCategory,
			'product_comment'			=>	$productComment,
			'product_url_website'		=>	$productUrlWebsite,
			'product_url_entry'			=>	$productUrlEntry,
			'product_status'				=>	$productStatus,
			'product_recommand'		=>	$productRecommand,
			'product_sort'					=>	$productSort,
			'product_exchange_rate'	=>	$productExchangeRate,
			'product_currency_name'	=>	$productCurrencyName,
			'product_server_role'			=>	$productServerRole,
			'product_server_recharge'	=>	$productServerRecharge,
		);
		
		if(!empty($edit))
		{
			$this->mproduct->update($productId, $row);
		}
		else
		{
			$this->mproduct->create($row);
		}
		redirect('product/lists');
	}
	
	public function delete($id)
	{
		if(!empty($id) && is_numeric($id))
		{
			$this->load->model('mproduct');
			$this->mproduct->delete($id);
			redirect('product/lists');
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的编号', 'product/lists', true, 5);
		}
	}
}

?>