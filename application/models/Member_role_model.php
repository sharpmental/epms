<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_role_model extends My_Model {
	
    var $page_size = 10;
    function __construct()
	{
    	$this->db_tablepre = 'tb_';
    	$this->table_name = 'member_role';
		parent::__construct();
	}
    
    /**
     * 安装SQL表
     * @return void
     */
    function init()
    {
    }

    function default_info(){
        return array('role_id'=>0,'role_name'=>'','description'=>'');
    }
}

// END role_model class

/* End of file role_model.php */
/* Location: ./role_model.php */
?>