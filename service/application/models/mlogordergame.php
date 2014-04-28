<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('ICrud.php');

class Mlogordergame extends CI_Model implements ICrud {
	private $accountTable = 'log_order_game';
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
		return $this->currentdb->count_all_results($this->accountTable);
	}
	
	public function create($row)
	{
		if(!empty($row))
		{
			if($this->currentdb->insert($this->accountTable, $row))
			{
				return $this->currentdb->insert_id();
			}
			else
			{
				return false;
			}
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
			if(!empty($extension['order_by']))
			{
				$this->currentdb->order_by($extension['order_by'][0], $extension['order_by'][1]);
			}
		}
		if($limit==0 && $offset==0) {
			$query = $this->currentdb->get($this->accountTable);
		} else {
			$query = $this->currentdb->get($this->accountTable, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function update($id, $row)
	{
		if(!empty($id) && !empty($row))
		{
			if(is_array($id))
			{
				foreach($id as $key=>$value)
				{
					$this->currentdb->where($key, $value);
				}
			}
			elseif(is_numeric($id))
			{
				$this->currentdb->where('id', $id);
			}
			return $this->currentdb->update($this->accountTable, $row);
		}
		else
		{
			return false;
		}
	}
	
	public function delete($id)
	{
		if(!empty($id))
		{
			if(is_array($id))
			{
				foreach($id as $key=>$value)
				{
					$this->currentdb->where($key, $value);
				}
			}
			elseif(is_numeric($id))
			{
				$this->currentdb->where('id', $id);
			}
			return $this->currentdb->delete($this->accountTable);
		}
		else
		{
			return false;
		}
	}
}

?>