<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Project extends MY_Admin_Controller {
	function __construct() {
		parent::__construct ();
	}
	function index() {
		$this->check_priv ();
		
		$this->load->model ( array (
				'Project_model',
				'Project_user_model',
				'Slop_model' 
		) );
		
		$p = $this->Project_user_model->select ( array (
				'user_id' => $this->user_id 
		) );
		
		$map_data = array ();
		
		if (isset ( $p ) && $p) {
			foreach ( $p as $k => $v ) {
				$s = $this->Slop_model->select ( array (
						"project_id" => $v ['project_id'] 
				) );
				
				if (isset ( $s ) && $s)
					$map_data = array_merge ( $map_data, $s );
			}
		}
		
		if ($map_data)
			$map_json = json_encode ( $map_data, JSON_UNESCAPED_UNICODE );
		else
			$map_json = "{}";
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'mapdata' => $map_json 
		) );
	}
	function general_info($id = '0') {
		$this->check_priv ();
		$this->load->model ( array (
				'Project_model',
				'Project_user_model',
				'Slop_model' 
		) );
		
		if ($id == '0') {
			$p = $this->Project_user_model->select ( array (
					'user_id' => $this->user_id 
			) );
		} else {
			$p = $this->Project_user_model->select ( array (
					'user_id' => $this->user_id,
					'project_id' => $id 
			) );
		}
		$project_data = array ();
		
		if (isset ( $p ) && $p) {
			foreach ( $p as $k => $v ) {
				$s = $this->Project_model->select ( array (
						"project_id" => $v ['project_id'] 
				), array (
						"project_id",
						"project_name",
						"project_description",
						"start_time",
						"position_char" 
				) );
				if (isset ( $s ) && $s)
					$project_data = array_merge ( $project_data, $s );
			}
		}
		
		// add operation button
		foreach ( $project_data as $k => $v ) {
			$num = $project_data[$k]['project_id'];
			
			$btnchange = '<a class="btn btn-default" href=' . base_url ( $this->page_data ['folder_name'] . '/project/modify_project/' . $v ['project_id'] ) . '>修改</a>';
			$btndel = '<a class="btn btn-default" href=' . base_url ( $this->page_data ['folder_name'] . '/project/delete_project/' . $v ['project_id'] ) . '>删除</a>';
			
			$project_data [$k] ['change'] = $btnchange;
			$project_data [$k] ['del'] = $btndel;
			$project_data [$k] ['project_id'] = '<a class="btn btn-default btn-small" href="'.base_url($this->page_data['folder_name'].'/project/general_info/'.$num).'">'.$num.'</a>';
		}
		
		// build table
		$this->load->library ( 'table' );
		$template = array (
				'table_open' => '<table class="table table-hover">' 
		);
		$this->table->set_template ( $template );
		$this->table->set_heading ( '项目编号', '项目名称', '项目描述', '启动时间', '项目地址', '操作', '操作' );
		
		$table_data = $this->table->generate ( $project_data );
		
		$this->page_config ( count ( $project_data ) );
		$pageslink = $this->pagination->create_links ();
		
		// display page
		$this->view ( 'general_info', array (
				'require_js' => true,
				'show_sidemenu' => true,
				'table_data' => $table_data,
				'pageslink' => $pageslink 
		) );
	}
	function slop_info($id = '0') {
		$this->check_priv ();
		$this->load->model ( array (
				'Project_user_model',
				'Slop_model',
				'Device_model' 
		) );
		
		if ($id == '0') {
			$p = $this->Project_user_model->get_one ( array (
					"user_id" => $this->user_id 
			) );
			if (isset ( $p ) && $p) {
				$s = $this->Slop_model->get_one ( array (
						"project_id" => $p ['project_id'] 
				) );
				if (! isset ( $s ) || ! $s)
					exit ( "Can not find the project, or you are not authorized to access this project!" );
			} else
				exit ( "Can not find the project, or you are not authorized to access this project!" );
		} else {
			$s = $this->Slop_model->get_one ( array (
					'slop_id' => $id 
			) );
		}
		
		$information = array (
				array (
						"Alarm",
						"Can not find the project, or you are not authorized to access this project!" 
				) 
		);
		
		$p = $this->Project_user_model->get_one ( array (
				"project_id" => $s ['project_id'],
				"user_id" => $this->user_id 
		) );
		
		if (isset ( $p ) && $p) {
			// build information table
			$table_data = "";
			
			$table_data = $table_data . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/slop_info' ) . "/" . $s ['slop_id'] . '" class="list-group-item active">' . "边坡名称:&nbsp" . $s ['slop_name'] . '</a>';
			
			$d = $this->Device_model->select ( array (
					'slop_id' => $s ['slop_id'] 
			) );
			if (isset ( $d ) && $d) {
				foreach ( $d as $kk => $vv ) {
					$table_data = $table_data . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/device_info' ) . "/" . $vv ['device_id'] . '" class="list-group-item">' . "设备名称:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $vv ['device_name'] . '</a>';
				}
			}
		}
		
		$project_data = array ();
		
		$this->view ( 'slop_info', array (
				'require_js' => true,
				'show_sidemenu' => true,
				'table_data' => $table_data 
		) );
	}
	function construct_info($id = '0') {
		$this->check_priv ();
		$this->load->model ( array (
				'Project_model',
				'Project_user_model',
				'Slop_model' 
		) );
		$project_id = $id;
		
		if ($id == '0') { // if not specify any project, just choose one
			$p = $this->Project_user_model->get_one ( array (
					'user_id' => $this->user_id 
			) );
		} else {
			$p = $this->Project_user_model->get_one ( array (
					'user_id' => $this->user_id,
					'project_id' => $id 
			) );
		}
		
		if (isset ( $p ) && $p) {
			$project_id = $p ['project_id'];
			$s = $this->Project_model->get_one ( array (
					"project_id" => $project_id 
			) );
			if (isset ( $s ) && $s)
				$information = $s ['construction_char'];
		} else {
			$information = "Can not find the project, or you are not authorized to access!";
		}
		
		$slop = $this->Slop_model->select ( array (
				'project_id' => $project_id 
		) );
		
		// build table
		$table_data = "";
		foreach ( $slop as $k => $v ) {
			$table_data = $table_data . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/slop_info' ) . "/" . $v ['slop_id'] . '" class="list-group-item">' . "边坡名称: " . $v ['slop_name'] . '</a>';
		}
		
		// display page
		$this->view ( 'construct_info', array (
				'require_js' => true,
				'show_sidemenu' => true,
				'table_data' => $table_data,
				'information' => $information 
		) );
	}
	function device_info() {
		$this->check_priv ();
		
		$this->view ( 'device_info', array (
				'require_js' => true,
				'show_sidemenu' => true 
		) );
	}
	function alarm() {
	}
	function data_display() {
		$this->check_priv ();
		
		$this->view ( 'data_display', array (
				'require_js' => true,
				'show_sidemenu' => true 
		) );
	}
	function list_project($id = '1') {
		$this->check_priv ();
		$this->load->model ( array (
				'Project_model',
				'Project_user_model',
				'Slop_model' 
		) );
		$p = $this->Project_user_model->select ( array (
				'user_id' => $this->user_id 
		) );
		
		$project_data = array ();
		
		if (isset ( $p ) && $p) {
			foreach ( $p as $k => $v ) {
				$s = $this->Project_model->select ( array (
						"project_id" => $v ['project_id'] 
				), array (
						"project_id",
						"project_name",
						"project_description",
						"start_time",
						"position_char",
						"construction_char",
						"general_slop",
						"update_timestamp" 
				) );
				if (isset ( $s ) && $s)
					$project_data = array_merge ( $project_data, $s );
			}
		}
		
		// build information table
		$table_data = "";
		$information = array (
				array (
						"Alarm",
						"Can not find the project, or you are not authorized to access this project!" 
				) 
		);
		
		foreach ( $project_data as $k => $v ) {
			$table_data = $table_data . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/list_project' ) . "/" . $v ['project_id'] . '" class="list-group-item active">' . "项目名称:&nbsp" . $v ['project_name'] . '</a>';
			
			$s = $this->Slop_model->select ( array (
					'project_id' => $v ['project_id'] 
			) );
			if (isset ( $s ) && $s) {
				foreach ( $s as $kk => $vv ) {
					$table_data = $table_data . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/slop_info' ) . "/" . $vv ['slop_id'] . '" class="list-group-item">' . "边坡名称:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $vv ['slop_name'] . '</a>';
				}
			}
			
			// set the information table
			if ($v ['project_id'] == $id) {
				unset ( $information );
				$information = array (
						array (
								"项目名称",
								$v ['project_name'] 
						),
						array (
								"项目描述",
								$v ['project_description'] 
						),
						array (
								"开始时间",
								$v ['start_time'] 
						),
						array (
								"地理位置",
								$v ['position_char'] 
						),
						array (
								"建造情况",
								$v ['construction_char'] 
						),
						array (
								"边坡概况",
								$v ['general_slop'] 
						),
						array (
								"更新时间",
								$v ['update_timestamp'] 
						) 
				);
				
				$this->load->library ( 'table' );
				$template = array (
						'table_open' => '<table class="table table-hover dataTable">' 
				);
				$this->table->set_template ( $template );
				$this->table->set_heading ( '名称', '描述' );
				
				$info_table_data = $this->table->generate ( $information );
			}
		}
		
		// display page
		$this->view ( 'list_project', array (
				'require_js' => true,
				'show_sidemenu' => true,
				'table_data' => $table_data,
				'info_table' => $info_table_data,
				'project_id' => $id
		) );
	}
	function add_project() {
		$config ['upload_path'] = './uploads/';
		$config ['allowed_types'] = 'gif|jpg|png';
		$config ['max_size'] = '200';
		$config ['max_width'] = '2048';
		$config ['max_height'] = '1024';
		
		$this->load->library ( 'upload', $config );
		
		$this->view ( 'add_project', array (
				'require_js' => true,
				'show_sidemenu' => true 
		) );
	}
	function modify_project($id = '1') {
		$this->view ( 'modify_project', array (
				'require_js' => true,
				'show_sidemenu' => true 
		) );
	}
	function delete_project() {
	}
	private function page_config($lines = 0) {
		// create pageination
		$this->load->library ( 'pagination' );
		
		$pconfig ['base_url'] = base_url () . $this->page_data ['folder_name'] . 'project/general_info';
		$pconfig ['total_rows'] = $lines;
		$pconfig ['per_page'] = 20;
		$pconfig ['attributes'] = array (
				'class' => 'pagination' 
		);
		$pconfig ['full_tag_open'] = '<ul class="pagination">';
		$pconfig ['full_tag_close'] = '</ul>';
		$pconfig ['first_tag_open'] = '<li>';
		$pconfig ['first_tag_close'] = '</li>';
		$pconfig ['last_tag_open'] = '<li>';
		$pconfig ['last_tag_close'] = '</li>';
		$pconfig ['next_tag_open'] = '<li>';
		$pconfig ['next_tag_close'] = '</li>';
		$pconfig ['prev_tag_open'] = '<li>';
		$pconfig ['prev_tag_close'] = '</li>';
		$pconfig ['cur_tag_open'] = '<li><a href="#" class="pagination">';
		$pconfig ['cur_tag_close'] = '</a></li>';
		$pconfig ['num_tag_open'] = '<li>';
		$pconfig ['num_tag_close'] = '</li>';
		$pconfig ['uri_segment'] = 5;
		
		$this->pagination->initialize ( $pconfig );
	}
}