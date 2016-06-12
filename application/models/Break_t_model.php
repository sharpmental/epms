<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Break_t_model extends My_Model {

	public function __construct() {
		$this->table_name = 'tb_break';
		parent::__construct();
	}
	
	public function getall()
	{
		$data = $this->query("select * from ".$this->table_name);
		
		return $data;
	}
	
}
