<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
class Project extends MY_Admin_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->check_priv ();
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => false
		) );
	}
	
	function general_info(){
		$this->check_priv ();
		
		$this->view ( 'general_info', array (
				'require_js' => true,
				'show_sidemenu' => true
		) );
	}
	
	function slop_info(){
		$this->check_priv ();
		
		$this->view ( 'slop_info', array (
				'require_js' => true,
				'show_sidemenu' => true
		) );
	}
	
	function construct_info(){
		$this->check_priv ();
		
		$this->view ( 'construct_info', array (
				'require_js' => true,
				'show_sidemenu' => true
		) );
	}
	
	function device_info(){
		$this->check_priv ();
		
		$this->view ( 'device_info', array (
				'require_js' => true,
				'show_sidemenu' => true
		) );
	}
	
	function alarm(){
		
	}
	
	function data_display(){
		$this->check_priv ();
		
		$this->view ( 'data_display', array (
				'require_js' => true,
				'show_sidemenu' => true
		) );
	}
	
	function list_project(){
		
	}
	
	function add_project(){
		
	}
	
	function modify_project(){
		
	}
	
	function delete_project(){
		
	}
}