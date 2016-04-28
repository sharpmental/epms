<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	class Device extends MY_Admin_Controller {
		function __construct() {
			parent::__construct();			
		}
		
		function index(){
			$this->check_priv ();
			
			$this->load->model ( array (
					'Project_user_model',
					'Slop_model',
					'Device_model'
			) );
			
			$r = $this->Device_model->select ( "", array (
					"device_id",
					"device_name",
					"device_description",
					"device_type",
					"formular",
					"slop_id",
					"update_timestamp"
			) );
			
			$t = array ();
			foreach ( $r as $k => $v ) {
				$s = $this->Slop_model->get_one ( array (
						"slop_id" => $v ['slop_id']
				) );
				
				if(!isset($s) || !$s)
					continue;
					
				$p = $this->Project_user_model->get_one(array(
						'project_id' => $s['project_id'],
						'user_id' => $this->user_id
				));
				
				if (isset ( $p ) && $p){
					//add action button
					$link1 = base_url ( $this->page_data ['folder_name'] . '/device/modify/' . $v ['device_id'] );
					$v[] = '<a class="btn btn-default" href="'.$link1.'">修改</a>';
					$t [] = $v;
				}
			}
			
			// build table
			$this->load->library ( 'table' );
			$template = array (
					'table_open' => '<table class="table table-hover">'
			);
			$this->table->set_template ( $template );
			$this->table->set_heading ( '设备编号', '设备名称', '设备描述', '设备类型', '计算公式', '边坡ID', '更新时间', '操作'  );
			
			$table_data = $this->table->generate ( $t );
			
			// $this->page_config ( count ( $t ) );
			// $pageslink = $this->pagination->create_links ();
			
			$this->view ( 'index', array (
					'require_js' => true,
					'show_sidemenu' => true,
					'table_data' => $table_data
			) );
		}
		
		function add(){
			$this->check_priv ();
			
			$this->view ( 'add', array (
					'require_js' => true,
					'show_sidemenu' => true
			) );
		}
		
		function modify(){
			$this->check_priv ();
			
			$this->view ( 'modify', array (
					'require_js' => true,
					'show_sidemenu' => true
			) );
		}
		
		function delete(){
			
		}
	}