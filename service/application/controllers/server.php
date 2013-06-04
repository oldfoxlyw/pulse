<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server extends CI_Controller
{
	/**
	 * 
	 * 用户平台服务器相关操作
	 * 
	 * @author johnnyEven
	 * @version Pulse/service server.php - 1.0.1.20130409 10:52
	 */
	private $rootPath;
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->helper('url');
	}

	public function lists($format = 'json')
	{
		$accountId = $this->input->post('accountId', TRUE);
		$gameId = $this->input->post('gameId', TRUE);

		if(!empty($gameId))
		{
			$this->load->model('mserver');
			$result = $this->mserver->read(array(
				'product_id'	=>	$gameId
			));

			if(!empty($accountId))
			{
				$this->load->model('mserverlog');
				$parameter = array(
					'product_id'	=>	$gameId,
					'account_id'	=>	$accountId
				);
				$extension = array(
					'select'		=>	array(
						'server_id',
						'updatetime'
					),
					'orderby'		=>	array(
						'updatetime',
						'desc'
					)
				);
				$logResult = $this->mserverlog->read($parameter, $extension, 5);

				$this->load->model('mrolecount');
				$parameter = array(
					'product_id'	=>	$gameId,
					'account_id'	=>	$accountId
				);
				$countResult = $this->mrolecount->read($parameter);
				$roleCount = array();
				if($countResult !== FALSE)
				{
					foreach ($countResult as $countRow)
					{
						$roleCount[$countRow->server_id] = $countRow->count;
					}
				}
			}
			$parameter = array();
			foreach ($result as $row)
			{
				$item = array();
				$item['serverId'] = $row->server_id;
				if(!empty($roleCount[$item['serverId']]))
				{
					$item['roleCount'] = $roleCount[$item['serverId']];
				}
				$item['serverName'] = $row->server_name;
				if($row->server_status == 'NORMAL')
				{
					$item['serverStatus'] = 1;
				}
				elseif ($row->server_status == 'HOT')
				{
					$item['serverStatus'] = 2;
				}
				else
				{
					$item['serverStatus'] = 0;
				}
				$item['serverServiceUrl'] = $row->server_service_url;
				$item['serverWebUrl'] = $row->server_web_url;
				$item['serverGameIp'] = $row->server_game_ip;
				$item['serverGamePort'] = $row->server_game_port;

				$parameter[$row->server_id] = $item;
			}
			for($i = 0; $i < count($logResult); $i++)
			{
				$updatetime = $logResult[$i]->updatetime;
				$logResult[$i] = $parameter[$logResult[$i]->server_id];
				$logResult[$i]['updatetime'] = $updatetime;
			}
			$parameter['history'] = $logResult;
			echo $this->return_format->format($parameter);
		}
		else
		{
			$parameter = array(
				'errors'	=>	'SERVER_LIST_ERROR_NO_PARAM'
			);
			echo $this->return_format->format($parameter);
		}
	}

	public function log($format = 'json')
	{
		$accountId = $this->input->get_post('accountId', TRUE);
		$productId = $this->input->get_post('gameId', TRUE);
		$serverId = $this->input->get_post('serverId', TRUE);

		if(!empty($accountId) && !empty($productId) && !empty($serverId))
		{
			$this->load->model('mserverlog');
			$parameter = array(
				'product_id'	=>	$productId,
				'account_id'	=>	$accountId,
				'server_id'		=>	$serverId,
				'updatetime'	=>	time()
			);
			$this->mserverlog->create($parameter);
		}
	}
}
?>