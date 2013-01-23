<?php
/**
 * 
 * CRUD模型的基础接口，所有数据Model必须实现这个接口
 * 
 * 提供creat, read, update, delete, count五个基本数据操作接口
 * 
 * @author Administrator
 * @version Pulse ICrud.php - 1.0.1.20130123 09:10
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

interface ICrud
{
	function count($parameter = null);
	function create($row);
	function read($parameter = null, $limit = 0, $offset = 0);
	function update($id, $row);
	function delete($id);
}

?>