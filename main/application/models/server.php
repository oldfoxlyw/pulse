<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Server extends CI_Model implements ICrud {
	private $productTable = 'pulse_serverlist';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function count($parameter = null, $extension = null)
	{
		if(!empty($parameter))
		{
			foreach($parameter as $key=>$value)
			{
				$this->db->where($key, $value);
			}
		}
		if(!empty($extension))
		{
			
		}
		return $this->db->count_all_results($this->productTable);
	}
	
	public function create($row)
	{
		if(!empty($row))
		{
			return $this->db->insert($this->productTable, $row);
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
				$this->db->where($key, $value);
			}
		}
		if(!empty($extension))
		{
			
		}
		if($limit==0 && $offset==0) {
			$query = $this->db->get($this->accountTable);
		} else {
			$query = $this->db->get($this->accountTable, $limit, $offset);
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
			if(!empty($id['product_id']) && !empty($id['server_id']) && !empty($row))
			{
				$this->db->where('product_id', $id['product_id']);
				$this->db->where('server_id', $id['server_id']);
				return $this->db->update($this->productTable, $row);
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
	
	public function delete($id)
	{
		if(is_array($id))
		{
			if(!empty($id['product_id']) && !empty($id['server_id']))
			{
				$this->db->where('product_id', $id['product_id']);
				$this->db->where('server_id', $id['server_id']);
				return $this->db->delete($this->productTable);
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
}

?>