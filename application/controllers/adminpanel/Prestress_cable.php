<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
class Prestress_cable extends MY_Admin_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->check_priv ();
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => false,
		) );
	}
	
	function add(){
		
	}
	
	function modify(){
	}
	
	function delete(){
		
	}
}