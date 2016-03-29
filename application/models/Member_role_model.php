<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_role_model extends My_Model {
	
    var $page_size = 10;
    function __construct()
	{
    	$this->table_name = 'tb_member_role';
		parent::__construct();
	}

    function default_info(){
        return array('role_id'=>0,'role_name'=>'','description'=>'');
    }
}

?>