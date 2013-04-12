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
		$gameId = $this->input->post('gameId', TRUE);

		if(!empty($gameId))
		{
			$this->load->model('mserver');
			$result = $this->mserver->read(array(
				'product_id'	=>	$gameId
			));
			$parameter = array();
			foreach ($result as $row)
			{
				$item['serverId'] = $row->server_id;
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

				array_push($parameter, $item);
			}
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
}
?>