<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member_model extends Base_Model {

	var $page_size = 10;
	public function __construct() {
		$this->table_name = 'tb_operator_info';
		parent::__construct();
	}
	
	function check_username_exists($username)
	{
		$count = $this->count(' operator_name = '.$username."'");
		return $count;
	}
	
	function default_info(){
		return array(
					'user_id'=>0,
					'username'=>'',
					'email'=>'',
					'password'=>'',
					'mobile'=>'',
					'fullname'=>'',
					'avatar'=>'nopic.gif',
					'group_id'=>0,
					'operator_name' => '',
					'operator_displayname' => '',
					'is_lock'=>false,
					);
	}
	
	public function getall()
	{
		$data = $this->query("select * from tb_operator_info");
		
		return $data;
	}
	
}
