<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Device extends MY_Admin_Controller {
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
			
			if (! isset ( $s ) || ! $s)
				continue;
			
			$p = $this->Project_user_model->get_one ( array (
					'project_id' => $s ['project_id'],
					'user_id' => $this->user_id 
			) );
			
			if (isset ( $p ) && $p) {
				// add action button
				$link1 = base_url ( $this->page_data ['folder_name'] . '/device/modify/' . $v ['device_id'] );
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
		$this->table->set_heading ( '设备编号', '设备名称', '设备描述', '设备类型', '计算公式', '边坡ID', '更新时间', '操作' );
		
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
	function add() {
		$this->check_priv ();
		
		$this->view ( 'add', array (
				'require_js' => true,
				'show_sidemenu' => true 
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
	function add_r() {
		$this->check_priv ();
		
		$this->load->helper ( 'file' );
		
		$this->load->model ( array (
				'Project_user_model',
				'Slop_model',
				'Device_model' 
		) );
		
		$s = $this->Slop_model->get_one ( array (
				'slop_id' => $this->input->post ( 'slop_id' ) 
		) );
		
		if (! isset ( $s ) || ! $s) {
			$this->show_error ( "Can not find the Slop you assigned!" );
			exit ();
		}
		
		$p = $this->Project_user_model->get_one ( array (
				'project_id' => $s ['project_id'],
				'user_id' => $this->user_id 
		) );
		
		if (! isset ( $p ) || ! $p) {
			$this->show_error ( "You are no authorized to change this project!" );
			exit ();
		}
		
		$d = $this->Device_model->insert ( array (
				'device_name' => $this->input->post ( 'device_name' ),
				'device_description' => $this->input->post ( 'device_des' ),
				'device_type' => $this->input->post ( 'device_type' ),
				'formular' => $this->input->post ( 'formular' ),
				'slop_id' => $this->input->post ( 'slop_id' ) 
		) );
		
		if (! $d) {
			$this->show_error ( "Failed to insert into slop_info table" );
		}
		
		$device_id = $this->Device_model->insert_id ();
		
		// upload picture
		if (isset ( $_FILES ['userfile'] ) && $_FILES ['userfile']) {
			$pic_path = "./upload/device_info/" . $device_id;
			$thumb_path = "./upload/device_info/thumb/" . $device_id;
			
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
					'i' 
			);
			$r = $this->do_upload_ex ( $userfile_data, true, $config, $name_list );
			// var_dump($r);
			
			if (! isset ( $r ['if_error'] ) && $r ['if_error']) {
				$this->show_error ( $r );
			}
			
			// update the picture path information
			$r = $this->Device_model->update ( array (
					"device_picture_path" => isset ( $r [0] ['file_name'] ) ? $pic_path . '/' . $r [0] ['file_name'] : "",
					"install_picture_path" => isset ( $r [1] ['file_name'] ) ? $pic_path . '/' . $r [1] ['file_name'] : "" 
			), array (
					"device_id" => $device_id 
			) );
			
			if (! isset ( $r ) || ! $r) {
				$this->show_error ( "Update project picture path failed. You may modify the project information again." );
			}
		}
		
		Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/device/index' ) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function modify($device_id) {
		$this->check_priv ();
		$this->load->model ( array (
				'Project_user_model',
				'Slop_model',
				'Device_model' 
		) );
		
		$d = $this->Device_model->get_one ( array (
				'device_id' => $device_id 
		) );
		
		if (! isset ( $d ) || ! $d) {
			$this->show_error ( "Can not find the Device!" );
			exit ();
		}
		
		$s = $this->Slop_model->get_one ( array (
				'slop_id' => $d ['slop_id'] 
		) );
		
		// if(!isset($s) || !$s) // we allow a device does not attached to any slop (when slop is deleted)
		// {
		// $this->show_error ( "Can not find the Slop you assigned!" );
		// exit ();
		// }
		
		if (isset ( $s ) && $s) {
			$p = $this->Project_user_model->get_one ( array (
					'project_id' => $s ['project_id'],
					'user_id' => $this->user_id 
			) );
		} else
			$p = true;
		
		if (! isset ( $p ) || ! $p) {
			$this->show_error ( "You are no authorized to change this project!" );
			exit ();
		}
		
		$this->view ( 'modify', array (
				'require_js' => true,
				'show_sidemenu' => true,
				'device' => $d 
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
	function modify_r($device_id) {
		$this->check_priv ();
		
		$this->load->helper ( 'file' );
		
		$this->load->model ( array (
				'Project_user_model',
				'Slop_model',
				'Device_model' 
		) );
		
		$s = $this->Slop_model->get_one ( array (
				'slop_id' => $this->input->post ( 'slop_id' ) 
		) );
		
		if (! isset ( $s ) || ! $s) {
			$this->show_error ( "Can not find the Slop you assigned!" );
			exit ();
		}
		
		$p = $this->Project_user_model->get_one ( array (
				'project_id' => $s ['project_id'],
				'user_id' => $this->user_id 
		) );
		
		if (! isset ( $p ) || ! $p) {
			$this->show_error ( "You are no authorized to change this project!" );
			exit ();
		}
		
		$d = $this->Device_model->update ( array (
				'device_name' => $this->input->post ( 'device_name' ),
				'device_description' => $this->input->post ( 'device_des' ),
				'device_type' => $this->input->post ( 'device_type' ),
				'formular' => $this->input->post ( 'formular' ),
				'slop_id' => $this->input->post ( 'slop_id' ) 
		), array (
				'device_id' => $device_id 
		) );
		
		if (! $d) {
			$this->show_error ( "Failed to insert into slop_info table" );
		}
		
		// upload picture
		if (isset ( $_FILES ['userfile'] ) && $_FILES ['userfile']) {
			$pic_path = "./upload/device_info/" . $device_id;
			$thumb_path = "./upload/device_info/thumb/" . $device_id;
			
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
					'i' 
			);
			$r = $this->do_upload_ex ( $userfile_data, true, $config, $name_list );
			// var_dump($r);
			
			if (! isset ( $r ['if_error'] ) && $r ['if_error']) {
				$this->show_error ( $r );
			}
			
			// update the picture path information
			$r = $this->Device_model->update ( array (
					"device_picture_path" => isset ( $r [0] ['file_name'] ) ? $pic_path . '/' . $r [0] ['file_name'] : "",
					"install_picture_path" => isset ( $r [1] ['file_name'] ) ? $pic_path . '/' . $r [1] ['file_name'] : "" 
			), array (
					"device_id" => $device_id 
			) );
			
			if (! isset ( $r ) || ! $r) {
				$this->show_error ( "Update project picture path failed. You may modify the project information again." );
			}
		}
		
		Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/device/index' ) );
	}
	/**
	 * What it do
	 *
	 * @param        	
	 *
	 * @return
	 *
	 */
	function delete($device_id) {
		$this->check_priv ();
		
		$this->load->model ( array (
				'Project_user_model',
				'Slop_model',
				'Device_model' 
		) );
		
		$d = $this->Device_model->get_one ( array (
				'device_id' => $device_id 
		) );
		
		if (! isset ( $d ) || ! $d) {
			$this->show_error ( "Can not find the Device!" );
			exit ();
		}
		
		$s = $this->Slop_model->get_one ( array (
				'slop_id' => $d ['slop_id'] 
		) );
		
		// if(!isset($s) || !$s) // we allow a device does not attached to any slop (when slop is deleted)
		// {
		// $this->show_error ( "Can not find the Slop you assigned!" );
		// exit ();
		// }
		
		if (isset ( $s ) && $s) {
			$p = $this->Project_user_model->get_one ( array (
					'project_id' => $s ['project_id'],
					'user_id' => $this->user_id 
			) );
		} else
			$p = true;
		
		if (! isset ( $p ) || ! $p) {
			$this->show_error ( "You are no authorized to change this project!" );
			exit ();
		}
		
		$d = $this->Device_model->delete ( array (
				'device_id' => $device_id 
		) );
		if (! isset ( $d ) || ! $d)
			$this->show_error ( "Some error happens when delete this device." );
		
		Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/device/index' ) );
	}
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