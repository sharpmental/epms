<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
class Alarm extends MY_Admin_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->check_priv ();
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => true
		) );
	}
	
	function add(){
		$this->check_priv ();
		$this->view ( 'add', array (
				'require_js' => true,
				'show_sidemenu' => true));
	}
	
	function modify(){
		$this->check_priv ();
		$this->view ( 'modify', array (
				'require_js' => true,
				'show_sidemenu' => true));
	}
	
	function delete(){
		
	}
}