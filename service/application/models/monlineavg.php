<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('ICrud.php');

class Monlineavg extends CI_Model implements ICrud {
	private $serverTable = 'log_online_avg_daily';
	private $currentdb = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->currentdb = $this->database->load('logdb', TRUE);
	}
	
	public function count($parameter = null, $extension = null)
	{
		if(!empty($parameter))
		{
			foreach($parameter as $key=>$value)
			{
				$this->currentdb->where($key, $value);
			}
		}
		if(!empty($extension))
		{
			
		}
		return $this->currentdb->count_all_results($this->serverTable);
	}
	
	public function create($row)
	{
		if(!empty($row))
		{
			return $this->currentdb->insert($this->serverTable, $row);
		}
		else
		{
			return false;
		}
	}
	
	public function read($parameter = null, $extension = null, $limit = 0, $offset = 0)
	{
		if(!empty($parameter))
		{
			foreach($parameter as $key=>$value)
			{
				$this->currentdb->where($key, $value);
			}
		}
		if(!empty($extension))
		{
			if(!empty($extension['orderby']))
			{
				$this->currentdb->order_by($extension['orderby'][0], $extension['orderby'][1]);
			}
		}
		if($limit==0 && $offset==0) {
			$query = $this->currentdb->get($this->serverTable);
		} else {
			$query = $this->currentdb->get($this->serverTable, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function update($id, $row)
	{
		if(is_array($id))
		{
			foreach($id as $key=>$value)
			{
				$this->currentdb->where($key, $value);
			}
			return $this->currentdb->update($this->serverTable, $row);
		}
		else
		{
			return false;
		}
	}
	
	public function delete($id)
	{
		if(is_array($id))
		{
			foreach($id as $key=>$value)
			{
				$this->currentdb->where($key, $value);
			}
			return $this->currentdb->delete($this->serverTable);
		}
		else
		{
			return false;
		}
	}

	public function db()
	{
		return $this->currentdb;
	}
}

?>