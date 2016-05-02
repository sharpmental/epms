<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Slop extends MY_Admin_Controller {
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
				'Project_user_model',
				'Slop_model' 
		) );
		
		$r = $this->Slop_model->select ( "", array (
				"slop_id",
				"slop_name",
				"slop_description",
				"start_time",
				"position_char",
				"position_x",
				"position_y",
				"alarm_model",
				"project_id",
				"update_timestamp" 
		) );
		
		$t = array ();
		foreach ( $r as $k => $v ) {
			$p = $this->Project_user_model->get_one ( array (
					"project_id" => $v ['project_id'],
					"user_id" => $this->user_id 
			) );
			
			if (isset ( $p ) && $p) {
				// add action button
				$link1 = base_url ( $this->page_data ['folder_name'] . '/slop/modify_slop/' . $v ['slop_id'] );
				$v [] = '<a class="btn btn-default" href="' . $link1 . '">修改</a>';
				$t [] = $v;
			}
		}
		
		// build table
		$this->load->library ( 'table' );
		$template = array (
				'table_open' => '<table class="table table-hover">' 
		);
		$this->table->set_template ( $template );
		$this->table->set_heading ( '边坡编号', '边坡名称', '边坡描述', '启动时间', '位置描述', '地图X坐标值', '地图X坐标值', '报警模型', '所属项目', '更新时间', '操作' );
		
		$table_data = $this->table->generate ( $t );
		
		// $this->page_config ( count ( $t ) );
		// $pageslink = $this->pagination->create_links ();
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => true,
				'table_data' => $table_data 
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
	function add_slop($project_id = '0') {
		$this->check_priv ();
		
		$this->load->model ( array (
				// 'Project_model',
				'Project_user_model' 
		) );
		
		// $r = $this->Project_user_model->get_one ( array (
		// 'project_id' => $project_id,
		// 'user_id' => $this->user_id
		// ) );
		
		// if (! isset ( $r ) || ! $r) {
		// $this->show_error ( "You are no authorized to change this project!" );
		// }
		
		$p = $this->Project_user_model->select ( array (
				'user_id' => $this->user_id 
		) );
		$project_list = '<option value ="NA">请选择项目</option>';
		
		foreach ( $p as $k => $v ) {
			$project_list = $project_list . '<option value ="' . $v ['project_id'] . '">' . $v ['project_id'] . '</option>';
		}
		
		$this->view ( 'add_slop', array (
				'require_js' => true,
				'show_sidemenu' => true,
				'project_list' => $project_list 
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
	function add_slop_r() {
		$this->check_priv ();
		
		$this->load->helper ( 'file' );
		
		$this->load->model ( array (
				'Project_user_model',
				'Slop_model' 
		) );
		
		$r = $this->Project_user_model->get_one ( array (
				'project_id' => $this->input->post ( 'project_id' ),
				'user_id' => $this->user_id 
		) );
		
		if (! isset ( $r ) || ! $r) {
			$this->show_error ( "You are no authorized to change this project!" );
			exit ();
		}
		
		$s = $this->Slop_model->insert ( array (
				'slop_name' => $this->input->post ( 'slop_name' ),
				'slop_description' => $this->input->post ( 'slop_des' ),
				'start_time' => $this->input->post ( 'start_time' ),
				'position_char' => $this->input->post ( 'address' ),
				'position_x' => $this->input->post ( 'cord-x' ),
				'position_y' => $this->input->post ( 'cord-y' ),
				'alarm_model' => $this->input->post ( 'alarm_model' ),
				'slop_type' => $this->input->post ( 'slop_type' ),
				'env_id' => $this->input->post ( 'env_id' ),
				'disease_id' => $this->input->post ( 'disease_id' ),
				'sub_road_name' => $this->input->post ( 'sub_road_name' ),
				'stake_bg' => $this->input->post ( 'stake_bg' ),
				'stake_end' => $this->input->post ( 'stake_end' ),
				'longtitude' => $this->input->post ( 'longtitude' ),
				'latitude' => $this->input->post ( 'latitude' ),
				'altitude' => $this->input->post ( 'altitude' ),
				'altitude' => $this->input->post ( 'altitude' ),
				'strength_info' => $this->input->post ( 'strength_info' ),
				'project_id' => $this->input->post ( 'project_id' ),
		) );
		
		if (! $s) {
			$this->show_error ( "Failed to insert into slop_info table" );
		}
		
		$slop_id = $this->Slop_model->insert_id ();
		
		// upload picture
		if (isset ( $_FILES ['userfile'] ) && $_FILES ['userfile']) {
			$pic_path = "./upload/slop_info/" . $slop_id;
			$thumb_path = "./upload/slop_info/thumb/" . $slop_id;
			
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
					'd',
// 					's',
// 					'c',
// 					'p',
// 					'i',
// 					'decomp',
					'3d',
					'video' 
			);
			$r = $this->do_upload_ex ( $userfile_data, true, $config, $name_list );
			// var_dump($r);
			
			if (! isset ( $r ['if_error'] ) && $r ['if_error']) {
				$this->show_error ( $r );
			}
			
			// update the picture path information
			$r = $this->Slop_model->update ( array (
					"design_picture_path" => isset ( $r [0] ['file_name'] ) ? $pic_path . '/' . $r [0] ['file_name'] : "",
// 					"solidate_picture_path" => isset ( $r [1] ['file_name'] ) ? $pic_path . '/' . $r [1] ['file_name'] : "",
// 					"conservation_picture_path" => isset ( $r [2] ['file_name'] ) ? $pic_path . '/' . $r [2] ['file_name'] : "",
// 					"panorama_picture_path" => isset ( $r [3] ['file_name'] ) ? $pic_path . '/' . $r [3] ['file_name'] : "",
// 					"install_picture_path" => isset ( $r [4] ['file_name'] ) ? $pic_path . '/' . $r [4] ['file_name'] : "",
// 					"decompose_picture_path" => isset ( $r [5] ['file_name'] ) ? $pic_path . '/' . $r [5] ['file_name'] : "",
					"3d_picture_path" => isset ( $r [1] ['file_name'] ) ? $pic_path . '/' . $r [1] ['file_name'] : "",
					"video_path" => isset ( $r [2] ['file_name'] ) ? $pic_path . '/' . $r [2] ['file_name'] : "" 
			), array (
					"slop_id" => $slop_id 
			) );
			
			if (! isset ( $r ) || ! $r) {
				$this->show_error ( "Update project picture path failed. You may modify the project information again." );
			}
		}
		
		Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/slop/index' ) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function modify_slop($slop_id) {
		$this->load->model ( array (
				"Slop_model",
				'Project_model',
				'Project_user_model' 
		) );
		
		$s = $this->Slop_model->get_one ( array (
				"slop_id" => $slop_id 
		) );
		
		if (! isset ( $s ) || ! $s) {
			$this->show_error ( "Can not find this slop" );
			exit ();
		}
		
		$r = $this->Project_user_model->get_one ( array (
				'project_id' => $s ['project_id'],
				'user_id' => $this->user_id 
		) );
		
		if (! isset ( $r ) || ! $r) {
			$this->show_error ( "You are no authorized to change this project!" );
			exit ();
		}
		
		$p = $this->Project_user_model->select ( array (
				'user_id' => $this->user_id 
		) );
		$project_list = '<option value ="NA">请选择项目</option>';
		
		foreach ( $p as $k => $v ) {
			if ($v ['project_id'] == $s ['project_id'])
				$project_list = $project_list . '<option selected="selected" value ="' . $v ['project_id'] . '">' . $v ['project_id'] . '</option>';
			else
				$project_list = $project_list . '<option value ="' . $v ['project_id'] . '">' . $v ['project_id'] . '</option>';
		}
		
		$this->view ( 'modify_slop', array (
				'require_js' => true,
				'show_sidemenu' => true,
				'slop' => $s,
				'project_list' => $project_list
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
	function modify_slop_r($slop_id) {
		$this->check_priv ();
		
		$this->load->helper ( 'file' );
		
		$this->load->model ( array (
				'Project_user_model',
				'Slop_model' 
		) );
		
		$r = $this->Project_user_model->get_one ( array (
				'project_id' => $this->input->post ( 'project_id' ),
				'user_id' => $this->user_id 
		) );
		
		if (! isset ( $r ) || ! $r) {
			$this->show_error ( "You are no authorized to change this project!" );
			exit ();
		}
		
		$s = $this->Slop_model->update ( array (
				'slop_name' => $this->input->post ( 'slop_name' ),
				'slop_description' => $this->input->post ( 'slop_des' ),
				'start_time' => $this->input->post ( 'start_time' ),
				'position_char' => $this->input->post ( 'address' ),
				'position_x' => $this->input->post ( 'cord-x' ),
				'position_y' => $this->input->post ( 'cord-y' ),
				'alarm_model' => $this->input->post ( 'alarm-model' ),
				'slop_type' => $this->input->post ( 'slop_type' ),
				'env_id' => $this->input->post ( 'env_id' ),
				'disease_id' => $this->input->post ( 'disease_id' ),
				'sub_road_name' => $this->input->post ( 'sub_road_name' ),
				'stake_bg' => $this->input->post ( 'stake_bg' ),
				'stake_end' => $this->input->post ( 'stake_end' ),
				'longtitude' => $this->input->post ( 'longtitude' ),
				'latitude' => $this->input->post ( 'latitude' ),
				'altitude' => $this->input->post ( 'altitude' ),
				'altitude' => $this->input->post ( 'altitude' ),
				'strength_info' => $this->input->post ( 'strength_info' ),
				'project_id' => $this->input->post ( 'project_id' ),
		), array (
				'slop_id' => $slop_id 
		) );
		
		if (! $s) {
			$this->show_error ( "Failed to update the slop_info table" );
		}
		
		// upload picture
		if (isset ( $_FILES ['userfile'] ) && $_FILES ['userfile']) {
			$pic_path = "./upload/slop_info/" . $slop_id;
			$thumb_path = "./upload/slop_info/thumb/" . $slop_id;
			
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
					'd',
// 					's',
// 					'c',
// 					'p',
// 					'i',
// 					'decomp',
					'3d',
					'video' 
			);
			$r = $this->do_upload_ex ( $userfile_data, true, $config, $name_list );
			// var_dump($r);
			
			if (! isset ( $r ['if_error'] ) && $r ['if_error']) {
				$this->show_error ( $r );
			}
			
			// update the picture path information
			$r = $this->Slop_model->update ( array (
					"design_picture_path" => isset ( $r [0] ['file_name'] ) ? $pic_path . '/' . $r [0] ['file_name'] : "",
// 					"solidate_picture_path" => isset ( $r [1] ['file_name'] ) ? $pic_path . '/' . $r [1] ['file_name'] : "",
// 					"conservation_picture_path" => isset ( $r [2] ['file_name'] ) ? $pic_path . '/' . $r [2] ['file_name'] : "",
// 					"panorama_picture_path" => isset ( $r [3] ['file_name'] ) ? $pic_path . '/' . $r [3] ['file_name'] : "",
// 					"install_picture_path" => isset ( $r [4] ['file_name'] ) ? $pic_path . '/' . $r [4] ['file_name'] : "",
// 					"decompose_picture_path" => isset ( $r [5] ['file_name'] ) ? $pic_path . '/' . $r [5] ['file_name'] : "",
					"3d_picture_path" => isset ( $r [1] ['file_name'] ) ? $pic_path . '/' . $r [1] ['file_name'] : "",
					"video_path" => isset ( $r [2] ['file_name'] ) ? $pic_path . '/' . $r [2] ['file_name'] : "" 
			), array (
					"slop_id" => $slop_id 
			) );
			
			if (! isset ( $r ) || ! $r) {
				$this->show_error ( "Update project picture path failed. You may modify the project information again." );
			}
		}
		
		Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/slop/index' ) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function delete_slop($slop_id) {
		$this->check_priv ();
		$this->load->model ( array (
				'Slop_model' 
		) );
		
		$s = $this->Slop_model->delete ( array (
				'slop_id' => $slop_id 
		) );
		
		if (! isset ( $s ) || ! $s)
			$this->show_error ( "Failed to delete this project!" );
		
		Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/slop/index' ) );
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
		exit ();
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
			exit ( 'The upload data is wrong. Sever can not find the file information. Go back and try again.' );
		
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
}