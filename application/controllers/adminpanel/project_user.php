<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	class Project_user extends MY_Admin_Controller {
		function __construct() {
			parent::__construct();			
		}
		
		function index(){
			$this->check_priv ();
			
			$this->load->model ( array (
					'Project_model',
					'Project_user_model',
					'Member_model'
			) );
			
			$user=$this->Member_model->getall();
			
			$content="";
			
			foreach ($user->result_array() as $k => $v){
				$p = $this->Project_user_model->select(array(
						'user_id' => $v['operator_id']
				));
				
				$content = $content.'<div class="panel panel-info">'.
							'<div class="panel-heading">'.
							'<a class="btn btn-sm btn-default" href=# >用户名称:'.$v['operator_name'].'</a>'.
							'</div>';
				$content = $content.'<div class="panel-body">';
				
				foreach ($p as $kk => $vv){
					$pp = $this->Project_model->get_one(array('project_id' => $vv['project_id']));
					
					if(!isset($pp) || !$pp)
						continue;
					
					$content = $content.'<div class="checkbox"><label><input type="checkbox" checked="checked" disabled="disabled"> '.$pp['project_name'].' </label></div>';
				}
				$content = $content."</div></div>";
			}
			
			
			$this->view ( 'index', array (
					'require_js' => true,
					'show_sidemenu' => true,
					'content' => $content
					
			) );
		}
		
		function update(){
			
		}
		
	}