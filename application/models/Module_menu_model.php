<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Module_menu_model extends My_Model {
	
	public function __construct() {
		parent::__construct();
		$this->table_name = 'tb_module_menu';
	}

	function default_info(){

		return array(
			'menu_name'=>"",
			'parent_id'=>0,
			'list_order'=>0,
			'is_display'=>1,
			'controller'=>"",
			'folder'=>"",
			'method'=>"",
			'is_works'=>true,
			'is_system'=>false,
			'is_side_menu'=>true,
			'user_id'=>0,
			'menu_id'=>0,
			'css_icon'=>'',
			'show_where'=>1
		);
	}
	
}
