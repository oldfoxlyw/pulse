<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once '../ICrud.php';

class Mail_bind extends CI_Model implements ICrud {
	private $mailTable = 'pulse_mail_bind';
	
	public function __construct() {
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
		return $this->db->count_all_results($this->mailTable);
	}
	
	public function create($row)
	{
		if(!empty($row))
		{
			return $this->db->insert($this->mailTable, $row);
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
			if(!empty($extension['orderby']))
			{
				$this->db->order_by($extension['orderby'][0], $extension['orderby'][1]);
			}
		}
		if($limit==0 && $offset==0) {
			$query = $this->db->get($this->mailTable);
		} else {
			$query = $this->db->get($this->mailTable, $limit, $offset);
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
			$this->db->where('code', $id);
			return $this->db->update($this->mailTable, $row);
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
			$this->db->where('code', $id);
			return $this->db->delete($this->mailTable);
		}
		else
		{
			return false;
		}
	}
}
?>