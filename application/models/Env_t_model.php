<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Env_t_model extends My_Model {

	public function __construct() {
		$this->table_name = 'tb_env';
		parent::__construct();
	}
	
	public function getall()
	{
		$data = $this->query("select * from ".$this->table_name);
		
		return $data;
	}
	
}
