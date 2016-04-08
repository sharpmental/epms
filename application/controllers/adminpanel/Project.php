<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
class Project extends MY_Admin_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->check_priv ();
		
		$this->load->model(array('Project_model', 'Project_user_model', 'Slop_model'));
		
		$p = $this->Project_user_model->select(array('user_id' => $this->user_id));
		
		$map_data = array();
		
		if (isset($p) && $p){
			foreach ($p as $k => $v){
				$s = $this->Slop_model->select(array("project_id" => $v['project_id']));
				
				if (isset($s) && $s)
					$map_data = array_merge($map_data, $s);
			}
		}
		
		if ($map_data)
			$map_json = json_encode($map_data, JSON_UNESCAPED_UNICODE);
		else
			$map_json = "{}";
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'mapdata' => $map_json,
		) );
	}
	
	function general_info(){
		$this->check_priv();
		$this->load->model(array('Project_model', 'Project_user_model', 'Slop_model'));
		$p = $this->Project_user_model->select(array('user_id' => $this->user_id));
		
		$project_data = array();
		
		if (isset($p) && $p){
			foreach ($p as $k => $v){
				$s = $this->Project_model->select(
                    array("project_id" => $v['project_id']),
                    array("project_id", "project_name", "project_description", "start_time", "position_char", "construction_char", "general_slop", "update_timestamp")
				);
				if (isset($s) && $s)
					$project_data = array_merge($project_data, $s);
			}
		}
        
		//build table
		$this->load->library('table');
		$template = array(
				'table_open' => '<table class="table table-hover dataTable">'
		);
		$this->table->set_template($template);
		$this->table->set_heading('项目编号', '项目名称', '项目描述', '启动时间', '项目地址', '建造地址', '总体边坡状况', '更新时间');
		
		$table_data = $this->table->generate($project_data);
		
		// create pageination
		$this->load->library('pagination');
		
		$pconfig['base_url'] = base_url().$this->page_data['folder_name']. 'project/general_info';
		$pconfig['total_rows'] = count($project_data);
		$pconfig['per_page'] = 20;
		$pconfig['attributes'] = array('class' => 'pagination');
		$pconfig['full_tag_open'] = '<ul class="pagination">';
		$pconfig['full_tag_close'] = '</ul>';
		$pconfig['first_tag_open'] = '<li>';
		$pconfig['first_tag_close'] = '</li>';
		$pconfig['last_tag_open'] = '<li>';
		$pconfig['last_tag_close'] = '</li>';
		$pconfig['next_tag_open'] = '<li>';
		$pconfig['next_tag_close'] = '</li>';
		$pconfig['prev_tag_open'] = '<li>';
		$pconfig['prev_tag_close'] = '</li>';
		$pconfig['cur_tag_open'] = '<li><a href="#" class="pagination">';
		$pconfig['cur_tag_close'] = '</a></li>';
		$pconfig['num_tag_open'] = '<li>';
		$pconfig['num_tag_close'] = '</li>';
		$pconfig['uri_segment'] = 5;
		
		$this->pagination->initialize($pconfig);
		
		$pageslink = $this->pagination->create_links();
		
		//display page
		$this->view ( 'general_info', array (
				'require_js' => true,
				'show_sidemenu' => true,
                'table_data' => $table_data,
                'pageslink' => $pageslink
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