<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Model implements ICrud {
	private $productTable = 'pulse_activity';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function count($parameter = null)
	{
		if(!empty($parameter))
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
	
	public function read($parameter = null, $limit = 0, $offset = 0)
	{
		if(!empty($parameter))
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
		if(!empty($id) && !empty($row))
		{
			$this->db->where('activity_id', $id);
			return $this->db->update($this->productTable, $row);
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
			$this->db->where('activity_id', $id);
			return $this->db->delete($this->productTable);
		}
		else
		{
			return false;
		}
	}
}

?>