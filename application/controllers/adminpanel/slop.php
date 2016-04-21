<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	class Slop extends MY_Admin_Controller {
		function __construct() {
			parent::__construct();			
		}
		
		function add_slop($project_id='0'){
			
			$this->view ( 'add_slop', array (
					'require_js' => true,
					'show_sidemenu' => true,
					'project_id' => $project_id
			) );
		}
		
		function add_slop_r($project_id){
			
		}
		
		function modify_slop($slop_id){
			$this->view ( 'modify_slop', array (
					'require_js' => true,
					'show_sidemenu' => true,
			) );
		}
		
		function delete_slop(){
			
		}
	}