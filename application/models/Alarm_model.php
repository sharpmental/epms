<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Alarm_model extends My_Model {

	public function __construct() {
		$this->table_name = 'tb_alarm_model';
		parent::__construct();
	}
	
	public function getall()
	{
		$data = $this->query("select * from ".$this->table_name);
		
		return $data;
	}
	
}
