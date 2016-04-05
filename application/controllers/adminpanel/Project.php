<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
class Project extends MY_Admin_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->check_priv ();
		
		$this->load->model(array('Project_model', 'Project_user_model', 'Slop_model'));
		
		$p = $this->Project_model->getall();
		
		$s = $this->Slop_model->getall();
		
		if ($s)
			$map_data = json_encode($s);
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'mapdata' => $map_data,
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
		$this->check_priv ();
		
		$this->view ( 'list_project', array (
				'require_js' => true,
				'show_sidemenu' => true
		) );
	}
	
	function add_project(){
		
	}
	
	function modify_project(){
		
	}
	
	function delete_project(){
		
	}
}