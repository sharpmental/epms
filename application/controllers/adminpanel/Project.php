<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Project extends MY_Admin_Controller {
	protected $data_column;
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function __construct() {
		parent::__construct ();
		$this->data_column = 10;
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
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
			$map_json = json_encode ( array (), JSON_UNESCAPED_UNICODE );
		;
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'baidumap' => true,
				'mapdata' => $map_json 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
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
		$pic = "";
		$information = "";
		
		if (isset ( $p ) && $p) {
			$id = reset ( $p ) ['project_id'];
			
			foreach ( $p as $k => $v ) {
				$s = $this->Project_model->get_one ( array (
						"project_id" => $v ['project_id'] 
				), array (
						"project_id",
						"project_name",
						"project_description",
						"start_time",
						"position_char",
						"type",
						"customer_id",
						"road_name" 
				) );
				if (isset ( $s ) && $s) {
					$project_data [] = $s;
					if ($s ['project_id'] == $id)
						$information = $s ['project_description'];
				}
			}
			
			$s = $this->Project_model->get_one ( array (
					"project_id" => $id 
			), array (
					"picture_path" 
			) );
			if (isset ( $s ) && $s) {
				$pic = $s ['picture_path'];
			}
		}
		
		// add operation button
		$xi = false;
		foreach ( $project_data as $k => $v ) {
			$num = $project_data [$k] ['project_id'];
			
			// $btnchange = '<a class="btn btn-default" href=' . base_url ( $this->page_data ['folder_name'] . '/project/modify_project/' . $v ['project_id'] ) . '>修改</a>';
			// $btndel = '<a class="btn btn-default" href=' . base_url ( $this->page_data ['folder_name'] . '/project/delete_project/' . $v ['project_id'] ) . '>删除</a>';
			
			// $project_data [$k] ['change'] = $btnchange;
			// $project_data [$k] ['del'] = $btndel;
			if ($xi == false)
				$project_data [$k] ['project_id'] = '<a class="btn btn-warning btn-small" href="' . base_url ( $this->page_data ['folder_name'] . '/project/general_info/' . $num ) . '">' . $num . '</a>';
			else
				$project_data [$k] ['project_id'] = '<a class="btn btn-default btn-small" href="' . base_url ( $this->page_data ['folder_name'] . '/project/general_info/' . $num ) . '">' . $num . '</a>';
			
			$xi = true;
		}
		
		// build table
		$this->load->library ( 'table' );
		$template = array (
				'table_open' => '<table class="table table-hover">' 
		);
		$this->table->set_template ( $template );
		$this->table->set_heading ( '项目编号', '项目名称', '项目描述', '启动时间', '项目地址', '项目类型', "客户编号", "施工高速名称" );
		// $this->table->set_heading ( '项目编号', '项目名称', '项目描述', '启动时间', '项目地址', '操作', '操作' );
		
		$table_data = $this->table->generate ( $project_data );
		
		$this->page_config ( count ( $project_data ) );
		$pageslink = $this->pagination->create_links ();
		
		// display page
		$this->view ( 'general_info', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'table_data' => $table_data,
				'pageslink' => $pageslink,
				'information' => $information,
				'project_id' => $id,
				'pic_path' => $pic 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
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
				$id = $s ['slop_id'];
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
		
		$json_array = array ();
		
		if (isset ( $p ) && $p) {
			// build information table
			$table_data = "";
			
			// $table_data = $table_data . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/slop_info' ) . "/" . $s ['slop_id'] . '" class="list-group-item active">' . "边坡名称:&nbsp" . $s ['slop_name'] . '</a>';
			// $table_data = $table_data . '<a href="" class="list-group-item active">' . "边坡名称:&nbsp" . $s ['slop_name'] . '</a>';
			
			$d = $this->Device_model->select ( array (
					'slop_id' => $id 
			) );
			
			// build json array
			$jsa = array ();
			$jsa ['text'] = '边坡名称：' . $s ['slop_name'];
			$jsa ['href'] = base_url ( $this->page_data ['folder_name'] . '/project/slop_info/' . $s ['slop_id'] );
			$jsa ['tags'] = 0;
			$jsa ['backColor'] = 'lightblue';
			$jsa ['icon'] = "glyphicon glyphicon-road";
			$jsa ['nodes'] = array ();
			
			if (isset ( $d ) && $d) {
				foreach ( $d as $kk => $vv ) {
					// $table_data = $table_data . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/device_info' ) . "/" . $vv ['device_id'] . '" class="list-group-item">' . "设备名称:&nbsp&nbsp&nbsp&nbsp&nbsp" . $vv ['device_name'] . '</a>';
					$node = array (
							'text' => '设备名称: ' . $vv ['device_name'],
							'href' => base_url ( $this->page_data ['folder_name'] . '/project/device_info/' . $vv ['device_id'] ),
							'tags' => 0,
							'icon' => 'glyphicon glyphicon-cog' 
					);
					
					$jsa ['nodes'] [] = $node;
					$jsa ['tags'] ++;
				}
			}
			$json_array [] = $jsa;
		}
		
		$json_table = json_encode ( $json_array );
		
		$this->view ( 'slop_info', array (
				'require_js' => true,
				'show_sidemenu' => false,
				// 'table_data' => $table_data,
				'json_table' => $json_table,
				'slop' => $s 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function construct_info($id = '0') {
		$this->check_priv ();
		$this->load->model ( array (
				'Project_model',
				'Project_user_model',
				'Slop_model' 
		) );
		$project_id = $id;
		
		if ($id == '0') { // if not specify any project, just choose one
			$pu = $this->Project_user_model->get_one ( array (
					'user_id' => $this->user_id 
			) );
		} else {
			$pu = $this->Project_user_model->get_one ( array (
					'user_id' => $this->user_id,
					'project_id' => $id 
			) );
		}
		$pic = "";
		
		// build json array
		$json_array = array ();
		$jsa = array ();
		
		if (isset ( $pu ) && $pu) {
			$project_id = $pu ['project_id'];
			$p = $this->Project_model->get_one ( array (
					"project_id" => $project_id 
			) );
			if (isset ( $p ) && $p) {
				$information = $p ['construction_char'];
				$pic = $p ['construction_picture_path'];
			}
			
			$jsa ['text'] = '项目名称：' . $p ['project_name'];
			$jsa ['href'] = base_url ( $this->page_data ['folder_name'] . '/project/general_info/' . $p ['project_id'] );
			$jsa ['tags'] = 0;
			$jsa ['backColor'] = 'lightblue';
			$jsa ['icon'] = "glyphicon glyphicon-tower";
			$jsa ['nodes'] = array ();
		} else {
			$information = "无法找到对应项目，或者是你无权访问此项目。";
			
			$jsa ['text'] = '项目名称：' . 'NA';
			$jsa ['href'] = base_url ( $this->page_data ['folder_name'] . '/project/general_info/' );
			$jsa ['tags'] = 0;
			$jsa ['backColor'] = 'lightblue';
			$jsa ['icon'] = "glyphicon glyphicon-tower";
			$jsa ['nodes'] = array ();
		}
		
		$slop = $this->Slop_model->select ( array (
				'project_id' => $project_id 
		) );
		
		// build table
		$table_data = "";
		foreach ( $slop as $k => $v ) {
			// $del_link = "javascript:if(confirm('确定要删除吗'))window.location.href='" . base_url ( $this->page_data ['folder_name'] . '/slop/delete_slop' ) . "/" . $v ['slop_id'] . "'";
			// $item = '<li class="list-group-item">' . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/slop_info' ) . "/" . $v ['slop_id'] . '" class="btn btn-default">' . "边坡名称: " . $v ['slop_name'] . '</a>' .
			// // '<a class="btn btn-default pull-right xbtn-delete" href="' . $del_link . '">删除</a>' .
			// '<a class="btn btn-default pull-right" href="' . base_url ( $this->page_data ['folder_name'] . '/slop/modify_slop' ) . "/" . $v ['slop_id'] . '">修改</a>' . '</li>';
			// $table_data = $table_data . $item;
			
			$node = array (
					'text' => '边坡名称: ' . $v ['slop_name'],
					'href' => base_url ( $this->page_data ['folder_name'] . '/project/slop_info/' . $v ['slop_id'] ),
					'tags' => 0,
					'icon' => 'glyphicon glyphicon-road' 
			);
			
			$jsa ['nodes'] [] = $node;
			$jsa ['tags'] ++;
		}
		$json_array [] = $jsa;
		$json_table = json_encode ( $json_array );
		
		// display page
		$this->view ( 'construct_info', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'table_data' => $table_data,
				'information' => $information,
				'project_id' => $project_id,
				'pic_path' => $pic,
				'json_table' => $json_table 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function device_info($device_id = '0') {
		$this->check_priv ();
		$this->load->model ( array (
				"Slop_model",
				"Device_model",
				'Project_user_model' 
		) );
		if ($device_id == '0') {
			$d = $this->Device_model->get_one ();
		} else {
			$d = $this->Device_model->get_one ( array (
					'device_id' => $device_id 
			) );
		}
		if (! isset ( $d ) || ! $d){
			$this->show_error ( "无法找到此设备，或你无权访问此设备所在项目。" );
			return;		
		}
		
		$device_id = $d ['device_id']; // incase we ramdonly choose one device
		
		$s = $this->Slop_model->get_one ( array (
				'slop_id' => $d ['slop_id'] 
		) );
		if (! isset ( $s ) || ! $s) {
			$solo = true;
			$note = "当前设备不属于任何项目。";
		} else {
			$solo = false;
			$note = "";
		}
		// build json array
		$jsa = array ();
		
		if (! $solo) {
			$p = $this->Project_user_model->get_one ( array (
					'project_id' => $s ['project_id'],
					'user_id' => $this->user_id 
			) );
			if (! isset ( $p ) || ! $p){
				$this->show_error ( "你无权访问此设备所在项目！" );
				return ;
			}
			
			$jsa ['text'] = '边坡名称：' . $s ['slop_name'];
			$jsa ['href'] = base_url ( $this->page_data ['folder_name'] . '/project/slop_info/' . $s ['slop_id'] );
			$jsa ['tags'] = 0;
			$jsa ['backColor'] = 'lightblue';
			$jsa ['icon'] = "glyphicon glyphicon-road";
			$jsa ['nodes'] = array ();
			
			$ls = $this->Device_model->select ( array (
					'slop_id' => $s ['slop_id'] 
			) );
			
			foreach ( $ls as $k => $v ) {
				$node = array (
						'text' => '设备名称: ' . $v ['device_name'],
						'href' => base_url ( $this->page_data ['folder_name'] . '/project/device_info/' . $v ['device_id'] ),
						'tags' => 0,
						'icon' => 'glyphicon glyphicon-cog' 
				);
				
				$jsa ['nodes'] [] = $node;
				$jsa ['tags'] ++;
			}
		} else {
			$jsa ['text'] = '边坡名称：' . 'NA';
			$jsa ['href'] = base_url ( $this->page_data ['folder_name'] . '/project/slop_info/' );
			$jsa ['tags'] = 0;
			$jsa ['backColor'] = 'lightblue';
			$jsa ['icon'] = "glyphicon glyphicon-road";
			$jsa ['nodes'] = array ();
			
			$ls = $d;
			
			$node = array (
					'text' => '设备名称: ' . $d ['device_name'],
					'href' => base_url ( $this->page_data ['folder_name'] . '/project/device_info/' . $d ['device_id'] ),
					'tags' => 0,
					'icon' => 'glyphicon glyphicon-cog' 
			);
			
			$jsa ['nodes'] [] = $node;
			$jsa ['tags'] ++;
		}
		$json_array [] = $jsa;
		
		$d_pic = $d ['device_picture_path'];
		$i_pic = $d ['install_picture_path'];
		$json_table = json_encode ( $json_array );
		
		$this->view ( 'device_info', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'solo' => $solo,
				'note' => $note,
				'slop' => $s,
				'device_list' => $ls,
				'd_pic' => $d_pic,
				'i_pic' => $i_pic,
				'device_id' => $device_id,
				'json_table' => $json_table 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function alarm() {
		$this->check_priv ();
		$this->view ( 'alarm', array (
				'require_js' => true,
				'show_sidemenu' => false 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function data_display($device_id = '0') {
		$this->check_priv ();
		$this->load->model ( array (
				'Project_user_model',
				'Slop_model',
				'Device_model',
				'Device_data_model' 
		) );
		if ($device_id == '0') {
			$d = $this->Device_model->get_one ();
		} else {
			$d = $this->Device_model->get_one ( array (
					'device_id' => $device_id 
			) );
		}
		if (! isset ( $d ) || ! $d){
			$this->show_error ( "无法找到此设备，或你无权访问此设备所在项目。" );
			return;
		}
		
		$device_id = $d ['device_id']; // incase we ramdonly choose one device
		$s = $this->Slop_model->get_one ( array (
				'slop_id' => $d ['slop_id'] 
		) );
		if (! isset ( $s ) || ! $s) {
			$solo = true;
			$note = "This device does not belong to any slop.";
		} else {
			$solo = false;
			$note = "";
		}
		
		// build json array
		$jsa = array ();
		
		if (! $solo) { // check permission
			$p = $this->Project_user_model->get_one ( array (
					'project_id' => $s ['project_id'],
					'user_id' => $this->user_id 
			) );
			if (! isset ( $p ) || ! $p){
				$this->show_error ( "你无权访问此设备所在项目。" );
				return;
			}
			
			$jsa ['text'] = '边坡名称：' . $s ['slop_name'];
			$jsa ['href'] = base_url ( $this->page_data ['folder_name'] . '/project/slop_info/' . $s ['slop_id'] );
			$jsa ['tags'] = 0;
			$jsa ['backColor'] = 'lightblue';
			$jsa ['icon'] = "glyphicon glyphicon-road";
			$jsa ['nodes'] = array ();
			
			$ls = $this->Device_model->select ( array (
					'slop_id' => $s ['slop_id'] 
			) );
			
			foreach ( $ls as $k => $v ) {
				$node = array (
						'text' => '设备名称: ' . $v ['device_name'],
						'href' => base_url ( $this->page_data ['folder_name'] . '/project/device_info/' . $v ['device_id'] ),
						'tags' => 0,
						'icon' => 'glyphicon glyphicon-cog' 
				);
				
				$jsa ['nodes'] [] = $node;
				$jsa ['tags'] ++;
			}
		} else {
			$jsa ['text'] = '边坡名称：' . 'NA';
			$jsa ['href'] = base_url ( $this->page_data ['folder_name'] . '/project/slop_info/' );
			$jsa ['tags'] = 0;
			$jsa ['backColor'] = 'lightblue';
			$jsa ['icon'] = "glyphicon glyphicon-road";
			$jsa ['nodes'] = array ();
			
			$ls = $d;
			
			$node = array (
					'text' => '设备名称: ' . $d ['device_name'],
					'href' => base_url ( $this->page_data ['folder_name'] . '/project/device_info/' . $d ['device_id'] ),
					'tags' => 0,
					'icon' => 'glyphicon glyphicon-cog' 
			);
			
			$jsa ['nodes'] [] = $node;
			$jsa ['tags'] ++;
		}
		$json_array [] = $jsa;
		
		// get the file information
		$dd = $this->Device_data_model->get_one ( array (
				'device_id' => $device_id 
		) );
		
		if (! isset ( $dd ) || ! $dd || !file_exists(base_url () . $dd ['path'])){
			$this->show_error ( "此设备没有已经上传的数据文件。" );
			return ;
		}
		
		// read the csv file
		$file = fopen ( base_url () . $dd ['path'], 'r' );
		if (! isset ( $file ) || ! $file){
			$this->show_error ( "打开数据文件出错。" );
			return;
		}
		
		$i = 0;
		$table_data = array ();
		$plot_data = array ();
		while ( $data = fgetcsv ( $file ) ) {
			
			$data_count = count ( $data );
			if ($i == 0) {
				$title = $data;
			} else if ($i == 1) {
				for($x = 0; $x < $data_count; $x ++) {
					$mark = $data;
					$table_data [$x] [$i - 1] = $data [$x];
					$plot_data [$x] [$i - 1] = $data [$x];
				}
			} else if ($i < $this->data_column) {
				for($x = 0; $x < $data_count; $x ++) {
					$table_data [$x] [$i - 1] = $data [$x];
					$plot_data [$x] [$i - 1] = $data [$x];
				}
			} else if ($i == $this->data_column) {
				for($x = 0; $x < $data_count; $x ++) {
					$table_data [$x] [$i - 1] = '...';
					$plot_data [$x] [$i - 1] = $data [$x];
				}
			} else {
				for($x = 0; $x < $data_count; $x ++) {
					$plot_data [$x] [$i - 1] = $data [$x];
				}
			}
			$i ++;
		}
		
		// build table
		$this->load->library ( 'table' );
		$template = array (
				'table_open' => '<table class="table table-hover">' 
		);
		$this->table->set_template ( $template );
		
		$xtitle = array (
				"Data" 
		);
		for($i = 1; $i < $this->data_column; $i ++) {
			$xtitle [] = $i;
		}
		
		$this->table->set_heading ( $xtitle );
		$table = $this->table->generate ( $table_data );
		
		// generate data
		
		$x_axis = "";
		if ($data_count > 0) {
			foreach ( $plot_data [0] as $k => $v ) {
				if ($k == '0')
					continue;
				$x_axis = $x_axis . "' " . $v . " ' ,";
			}
		}
		
		$row1 = "";
		if ($data_count > 1) {
			foreach ( $plot_data [1] as $k => $v ) {
				if ($k == '0')
					continue;
				$row1 = $row1 . " " . $v . "  ,";
			}
		}
		
		$row2 = "";
		if ($data_count > 2) {
			foreach ( $plot_data [2] as $k => $v ) {
				if ($k == '0')
					continue;
				$row2 = $row2 . " " . $v . "  ,";
			}
		}
		
		$title = implode ( ',', $title );
		
		$json_table = json_encode ( $json_array );
		
		$this->view ( 'data_display', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'solo' => $solo,
				'note' => $note,
				'slop' => $s,
				'device_list' => $ls,
				'device_id' => $device_id,
				'table_data' => $table,
				'x_axis' => $x_axis,
				'row1' => $row1,
				'row2' => $row2,
				'title' => $title,
				'mark' => $mark,
				'json_table' => $json_table 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function list_project($id = '0') {
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
			if ($id == '0')
				$id = reset ( $p ) ['project_id'];
			
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
						"type",
						"customer_id",
						"road_name",
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
						"警报",
						"无法找到此项目，或你无权访问此项目。" 
				) 
		);
		
		// set the information table
		$this->load->library ( 'table' );
		$template = array (
				'table_open' => '<table class="table table-hover dataTable">' 
		);
		$this->table->set_template ( $template );
		$this->table->set_heading ( '名称', '描述' );
		$info_table_data = '';
		// $this->table->generate ( $information );
		
		$json_array = array ();
		
		foreach ( $project_data as $k => $v ) {
			// $table_data = $table_data . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/list_project' ) . "/" . $v ['project_id'] . '" class="list-group-item active">' . "项目名称:&nbsp" . $v ['project_name'] . '</a>';
			
			$jsa ['text'] = '项目名称：' . $v ['project_name'];
			$jsa ['href'] = base_url ( $this->page_data ['folder_name'] . '/project/list_project/' . $v ['project_id'] );
			$jsa ['tags'] = 0;
			$jsa ['backColor'] = 'lightblue';
			$jsa ['icon'] = "glyphicon glyphicon-tower";
			$jsa ['nodes'] = array ();
			
			$s = $this->Slop_model->select ( array (
					'project_id' => $v ['project_id'] 
			) );
			if (isset ( $s ) && $s) {
				foreach ( $s as $kk => $vv ) {
					// $table_data = $table_data . '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/slop_info' ) . "/" . $vv ['slop_id'] . '" class="list-group-item">' . "边坡名称:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $vv ['slop_name'] . '</a>';
					
					$node = array (
							'text' => '边坡名称: ' . $vv ['slop_name'],
							'href' => base_url ( $this->page_data ['folder_name'] . '/project/slop_info/' . $vv ['slop_id'] ),
							'tags' => 0,
							'icon' => 'glyphicon glyphicon-road' 
					);
					
					$jsa ['nodes'] [] = $node;
					$jsa ['tags'] ++;
				}
			}
			$json_array [] = $jsa;
			
			if ($v ['project_id'] == $id) {
				
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
								"项目类型",
								$v ['type'] 
						),
						array (
								"客户编号",
								$v ['customer_id'] 
						),
						array (
								"施工高速名称",
								$v ['road_name'] 
						),
						array (
								"更新时间",
								$v ['update_timestamp'] 
						) 
				);
				
				$info_table_data = $this->table->generate ( $information );
			}
		}
		
		$json_table = json_encode ( $json_array );
		// display page
		$this->view ( 'list_project', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'table_data' => $table_data,
				'info_table' => $info_table_data,
				'project_id' => $id,
				'json_table' => $json_table 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function add_project() {
		$this->view ( 'add_project', array (
				'require_js' => true,
				'show_sidemenu' => false 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function add_project_r() {
		$this->load->helper ( 'file' );
		
		$this->load->model ( array (
				'Project_model',
				'Project_user_model',
				'Member_model' 
		) );
		
		$r = $this->Project_model->insert ( array (
				'project_name' => $this->input->post ( 'project_name' ),
				'project_description' => $this->input->post ( 'project_des' ),
				'start_time' => $this->input->post ( 'start_time' ),
				'position_char' => $this->input->post ( 'address' ),
				'construction_char' => $this->input->post ( 'construction' ),
				'general_slop' => $this->input->post ( 'slop' ),
				'type' => $this->input->post ( 'type' ),
				'customer_id' => $this->input->post ( 'customer_id' ),
				'road_name' => $this->input->post ( 'road_name' ) 
		) );
		
		if (! $r) {
			$this->show_error ( "Failed to insert into project_info table" );
			return;
		}
		
		$project_id = $this->Project_model->insert_id ();
		
		// upload picture
		if (isset ( $_FILES ['userfile'] ) && $_FILES ['userfile']) {
			$pic_path = "./upload/project_info/" . $project_id;
			$thumb_path = "./upload/project_info/thumb/" . $project_id;
			
			// check directory access
			if (! is_dir ( $pic_path ))
				mkdir ( $pic_path );
			if (! is_dir ( $thumb_path ))
				mkdir ( $thumb_path );
			
			$userfile_data = $_FILES ['userfile'];
			
			$config ['upload_path'] = $pic_path;
			$config ['thumb_path'] = $thumb_path;
			$config ['allowed_types'] = '*';
			$config ['max_size'] = '1024';
			$config ['max_width'] = '1024';
			$config ['max_heigth'] = '768';
			$config ['encrypt_name'] = 'FALSE';
			
			// $this->show_error ( var_dump($_FILES) );
			
			$name_list = array (
					'pic',
					'const_pic' 
			);
			$r = $this->do_upload_ex ( $userfile_data, true, $config, $name_list );
			// var_dump($r);
			
			if (! isset ( $r ['if_error'] ) && $r ['if_error']) {
				$this->show_error ( $r );
				return;
			}
			
			// update the picture path information
			$r = $this->Project_model->update ( array (
					"picture_path" => isset ( $r [0] ['file_name'] ) ? $pic_path . '/' . $r [0] ['file_name'] : "",
					"construction_picture_path" => isset ( $r [1] ['file_name'] ) ? $pic_path . '/' . $r [1] ['file_name'] : "" 
			), array (
					"project_id" => $project_id 
			) );
			
			if (! isset ( $r ) || ! $r) {
				$this->show_error ( "上传项目图片失败。" );
				return;
			}
		}
		$r = true;
		// automatically add the relation for admin user
		$user = $this->Member_model->select ( array (
				'operator_role' => 1 
		) );
		
		foreach ( $user as $k => $v ) {
			
			$r = $r && $this->Project_user_model->insert ( array (
					"project_id" => $project_id,
					"user_id" => $v ['operator_id'],
					"flag" => 0 
			) );
		}
		if (! $r){
			$this->show_error ( "上传成功，但记录文件路径过程中发生错误。" );
			return;}
		else
			Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/project/list_project' ) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function modify_project($id = '1') {
		$this->load->model ( array (
				'Project_model',
				'Project_user_model' 
		) );
		
		$r = $this->Project_user_model->select ( array (
				'project_id' => $id,
				'user_id' => $this->user_id 
		) );
		
		if (! $r){
			$this->show_error ( "无法找到此项目，或者你无权访问此设备所在项目。" );
			return;
		}
		
		$p = $this->Project_model->get_one ( array (
				'project_id' => $id 
		) );
		
		if (! isset ( $p ) || ! $p){
			$this->show_error ( '无法找到此项目。' );
			return;
		}
		else {
			$p = $this->Project_model->check_data ( $p );
			$this->view ( 'modify_project', array (
					'require_js' => true,
					'show_sidemenu' => false,
					'data' => $p 
			) );
		}
	}
	function modify_project_r($project_id) {
		$this->load->helper ( 'file' );
		
		$this->load->model ( array (
				'Project_model',
				'Project_user_model',
				'Member_model' 
		) );
		
		$r = $this->Project_user_model->get_one ( array (
				'project_id' => $project_id,
				'user_id' => $this->user_id 
		) );
		
		if (! isset ( $r ) || ! $r) {
			$this->show_error ( "你无权修改此项目" );
			return;
		}
		
		$r = $this->Project_model->update ( array (
				'project_name' => $this->input->post ( 'project_name' ),
				'project_description' => $this->input->post ( 'project_des' ),
				'start_time' => $this->input->post ( 'start_time' ),
				'position_char' => $this->input->post ( 'address' ),
				'construction_char' => $this->input->post ( 'construction' ),
				'general_slop' => $this->input->post ( 'slop' ),
				'type' => $this->input->post ( 'type' ),
				'customer_id' => $this->input->post ( 'customer_id' ),
				'road_name' => $this->input->post ( 'road_name' ) 
		), array (
				'project_id' => $project_id 
		) );
		
		if (! $r) {
			$this->show_error ( "Failed to insert into project_info table" );
			return;
		}
		
		// upload picture
		if (isset ( $_FILES ['userfile'] ) && $_FILES ['userfile']) {
			$pic_path = "./upload/project_info/" . $project_id;
			$thumb_path = "./upload/project_info/thumb/" . $project_id;
			
			// check directory access
			if (! is_dir ( $pic_path ))
				mkdir ( $pic_path );
			
			if (! is_dir ( $thumb_path ))
				mkdir ( $thumb_path );
			
			$userfile_data = $_FILES ['userfile'];
			
			$config ['upload_path'] = $pic_path;
			$config ['thumb_path'] = $thumb_path;
			$config ['allowed_types'] = '*';
			$config ['max_size'] = '1024';
			$config ['max_width'] = '1024';
			$config ['max_heigth'] = '768';
			$config ['encrypt_name'] = 'FALSE';
			
			$name_list = array (
					'project_pic',
					'construction_pic' 
			);
			$r = $this->do_upload_ex ( $userfile_data, true, $config, $name_list );
			// var_dump($r);
			
			if (! isset ( $r ['if_error'] ) && $r ['if_error']){
				$this->show_error ( $r );
				return;
			}
				
			// update the picture path information
			$r = $this->Project_model->update ( array (
					"picture_path" => isset ( $r [0] ['file_name'] ) ? $pic_path . '/' . $r [0] ['file_name'] : "",
					"construction_picture_path" => isset ( $r [1] ['file_name'] ) ? $pic_path . '/' . $r [1] ['file_name'] : "" 
			), array (
					"project_id" => $project_id 
			) );
			
			if (! isset ( $r ) || ! $r){
				$this->show_error ( "更新图片信息失败。" );
				return;
			}
		}
		
		$r = true;
		// automatically add the relation for admin user
		$user = $this->Member_model->select ( array (
				'operator_role' => 1 
		) );
		
		foreach ( $user as $k => $v ) {
			
			$r = $r && $this->Project_user_model->insert ( array (
					"project_id" => $project_id,
					"user_id" => $v ['operator_id'],
					"flag" => 0 
			) );
		}
		
		Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/project/list_project' ) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function delete_project($project_id) {
		$this->check_priv ();
		$this->load->model ( array (
				'Project_model',
				'Project_user_model',
				'Slop_model' 
		) );
		$r = $this->Project_user_model->get_one ( array (
				'project_id' => $project_id,
				'user_id' => $this->user_id 
		) );
		if (! isset ( $r ) || ! $r){
			$this->show_error ( "你无权访问此项目" );
			return;}
		
		$p = $this->Project_model->get_one ( array (
				'project_id' => $project_id 
		) );
		
		if (! isset ( $p ) || ! $p){
			$this->show_error ( "无法找到此项目。" );
			return;
		}
			
			// delete from project_info
		$s = $this->Project_model->delete ( array (
				'project_id' => $project_id 
		) );
		if (! isset ( $s ) || ! $s){
			$this->show_error ( "删除项目失败。" );
			return;
		}
			
			// delete all relations and related slop
		$dr = $this->Project_user_model->delete ( array (
				'project_id' => $project_id 
		) );
		// $ds= $this->Slop_model->delete(array('project_id' => $project_id));
		if (! isset ( $dr ) || ! $dr){
			$this->show_error ( "项目已删除。但有一些项目关联关系尚未被删除。" );
			return;
		}
		
		Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/project/list_project' ) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	private function show_error($info) {
		$this->view ( 'show_error', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'info' => $info 
		) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
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
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	private function do_upload_ex($uploaddata, $Multi_file = false, $config, $name_list = "") {
		$this->load->library ( "upload" );
		
		$imgname = array ();
		
		if (! isset ( $uploaddata ['name'] ) || ! $uploaddata ['name'])
			exit ( '上传文件出错。' );
		
		$size = count ( $uploaddata ['name'] );
		
		if ($Multi_file) {
			for($i = 0; $i < $size; $i ++) {
				if (! isset ( $uploaddata ['name'] [$i] ) || ! $uploaddata ['name'] [$i] || $uploaddata ['name'] [$i] == "")
					break;
				
				foreach ( $uploaddata as $k => $v ) {
					$tempdata ['file'] [$k] = $v [$i];
				}
				
				$_FILES = $tempdata;
				// var_dump($tempdata);
				
				$config ['file_name'] = $name_list [$i];
				$this->upload->initialize ( $config );
				$r = $this->upload->do_upload ( 'file' );
				if (! $r) {
					$imgname ['if_error'] = true;
					$imgname [] = $this->upload->display_errors ();
				} else {
					$imgname ['if_error'] = false;
					$imgname [] = $this->upload->data ();
				}
			}
		} else {
			$r = $this->upload->do_upload ( 'file' );
			if (! $r) {
				$imgname ['if_error'] = true;
				$imgname [] = $this->upload->display_errors ();
			} else {
				$imgname ['if_error'] = false;
				$imgname [] = $this->upload->data ();
			}
		}
		return $imgname;
	}
}