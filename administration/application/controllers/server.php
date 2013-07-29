<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server extends CI_Controller
{
	private $pageName = 'server_list';
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
		$this->load->model('mserver');
		$this->load->library('pagination');
		
		$this->pageName = 'server_list';
		
		$count = $this->mserver->count();
		$result = $this->mserver->read(null, null, 30, $offset);
		
		$page_config['base_url'] = site_url('server/lists');
		$page_config['total_rows'] = $count;
		$page_config['per_page'] = 30;
		$page_config['first_link'] = '首页';
		$page_config['last_link'] = '末页';
		
		$this->pagination->initialize($page_config);
		$pagination = $this->pagination->create_links();
		$pagination = empty($pagination) ? '&nbsp;' : $pagination;

		$productResult = $this->mproduct->read();
		
		$data = array(
			'admin'					=>	$this->user,
			'page_name'			=>	$this->pageName,
			'result'					=>	$result,
			'pagination'			=>	$pagination,
			'product_result'	=>	$productResult
		);
		$this->render->render($this->pageName, $data);
	}
	
	public function edit($id)
	{
		if(!empty($id))
		{
			$idArray = explode('_', $id);
			if(!empty($idArray) && is_numeric($idArray[0]) && is_numeric($idArray[1]))
			{
				$this->load->model('mproduct');
				$this->load->model('mserver');
				$this->load->library('pagination');
				
				$this->pageName = 'server_list';
				
				$count = $this->mserver->count();
				$result = $this->mserver->read(null, null, 30, 0);
				
				$page_config['base_url'] = site_url('server/lists');
				$page_config['total_rows'] = $count;
				$page_config['per_page'] = 30;
				$page_config['first_link'] = '首页';
				$page_config['last_link'] = '末页';
				
				$this->pagination->initialize($page_config);
				$pagination = $this->pagination->create_links();
				$pagination = empty($pagination) ? '&nbsp;' : $pagination;

				$productResult = $this->mproduct->read();
				
				$row = $this->mserver->read(array(
					'product_id'	=>	$idArray[0],
					'server_id'		=>	$idArray[1]
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
						'product_result'	=>	$productResult,
						'edit'					=>	'1',
						'old_product_id'	=>	$idArray[0],
						'old_server_id'		=>	$idArray[1],
						'row'						=>	$row
				);
				$this->render->render($this->pageName, $data);
			}
			else
			{
				showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的编号', 'server/lists', true, 5);
			}
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的编号', 'server/lists', true, 5);
		}
	}
	
	public function submit()
	{
		$this->load->model('mproduct');
		$this->load->model('mserver');
		
		$edit = $this->input->post('edit', TRUE);
		$oldServerId = $this->input->post('oldServerId', TRUE);
		$oldProductId = $this->input->post('oldProductId');
		$serverId = $this->input->post('serverId', TRUE);
		$productId = $this->input->post('productId');
		$serverName = $this->input->post('serverName', TRUE);
		$serverTimeStart = $this->input->post('serverTimeStart', TRUE);
		$serverStatus = $this->input->post('serverStatus', TRUE);
		$serverWebUrl = $this->input->post('serverWebUrl', TRUE);
		$serverGameIP = $this->input->post('serverGameIP', TRUE);
		$serverGamePort = $this->input->post('serverGamePort', TRUE);
		$serverServiceUrl = $this->input->post('serverServiceUrl', TRUE);
		$serverType = $this->input->post('serverType', TRUE);
		
		if(empty($serverId) || !is_numeric($serverId) || empty($serverName) || empty($productId))
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '', 'server/lists', true, 5);
		}

		$productResult = $this->mproduct->read(array(
				'product_id'		=>	$productId
		));
		if(!empty($productResult))
		{
			$productName = $productResult[0]->product_name;
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'NO_PARAM', '产品编号不存在', 'server/lists', true, 5);
		}
		
		$row = array(
			'product_id'				=>	$productId,
			'server_id'					=>	$serverId,
			'server_name'			=>	$serverName,
			'server_time_start'		=>	strtotime($serverTimeStart),
			'server_status'			=>	$serverStatus,
			'server_web_url'		=>	$serverWebUrl,
			'server_game_ip'		=>	$serverGameIP,
			'server_game_port'	=>	$serverGamePort,
			'server_service_url'	=>	$serverServiceUrl,
			'product_name'			=>	$productName,
			'server_type'				=>	empty($serverType) ? 1 : 0
		);
		
		if(!empty($edit))
		{
			$this->mserver->update(array(
				'product_id'		=>	$oldProductId,
				'server_id'			=>	$oldServerId
			), $row);
		}
		else
		{
			$this->mserver->create($row);
		}
		redirect('server/lists');
	}
	
	public function delete($id)
	{
		if(!empty($id))
		{
			$idArray = explode('_', $id);
			if(!empty($idArray) && is_numeric($idArray[0]) && is_numeric($idArray[1]))
			{
				$this->load->model('mserver');
				$this->mserver->delete(array(
					'product_id'		=>	$idArray[0],
					'server_id'			=>	$idArray[1]
				));
				redirect('server/lists');
			}
			else
			{
				showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的编号', 'server/lists', true, 5);
			}
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGOUT', '缺少必要的编号', 'server/lists', true, 5);
		}
	}
}

?>