<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Manage extends MY_Admin_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( array (
				'Times_model',
				'Member_model',
				'Module_menu_model' 
		) );
	}
	function cache() {
		$this->reload_all_cache ();
		$this->showmessage ( '全局缓存成功' );
	}
	function go($id = 0) {
		if ($id == 0)
			exit ();
		
		$arr = $this->all_module_menu [$id];
		if (! isset ( $arr ))
			exit ();
		
		$arr_parentid = $arr ['parent_id'];
		
		foreach ( $this->all_module_menu as $k => $v ) {
			if ($v ['parent_id'] == $id) {
				redirect ( base_url ( $this->page_data ['folder_name'] . '/' . $v ['controller'] . '/' . $v ['method'] ) );
				break;
			}
		}
	}
	function index() {
		$this->check_priv ();
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => false,
		) );
	}
	function index_list($startnum = '0') {
		$this->check_priv ();
		
		if (isset ( $_GET ['keyword'] )) {
			$keyword = $_GET ['keyword'];
			$data = $this->Member_model->getall ();
		} else
			$data = $this->Member_model->getall ();
			
			// generate table
		$this->load->library ( 'table' );
		$template = array (
				'table_open' => '<table class="table table-hover dataTable">' 
		);
		$this->table->set_template ( $template );
		$this->table->set_heading ( '#', '编号', '姓名', '出入状态', '部门号码', '腕带编号', '腕带状态', '更新时间', '详情', '定位信息LOC', '定位信息MON', '活动轨迹' );
		
		$table_data = $this->table->generate ( $data );
		
		// create pageination
		$this->load->library ( 'pagination' );
		
		$pconfig ['base_url'] = base_url () . $this->page_data ['folder_name'] . '/manage/index';
		$pconfig ['total_rows'] = $data->num_rows ();
		$pconfig ['per_page'] = 20;
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
		
		$pageslink = $this->pagination->create_links ();
		
		$this->view ( 'index_list', array (
				'require_js' => true,
				'table_data' => $table_data,
				'pagelink' => $pageslink 
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
	public function logout() {
		$this->session->sess_destroy ();
		redirect ( base_url ( '' ) );
	}
	/**
	 * What it do
	 	*
	 	* @param
	 	*
	 	* @return
	 	*
	 	*/
	 
	function login() {
		if (isset ( $_POST ['username'] )) {
			$username = isset ( $_POST ['username'] ) ? trim ( $_POST ['username'] ) : exit ( json_encode ( array (
					'status' => false,
					'tips' => ' 用户名不能为空' 
			) ) );
			if ($username == "")
				exit ( json_encode ( array (
						'status' => false,
						'tips' => ' 用户名不能为空' 
				) ) );
			
			$this->load->model ( 'Times_model' );
			// 密码错误剩余重试次数
			$rtime = $this->Times_model->get_one ( array (
					'username' => $username,
					'is_admin' => 1 
			) );
			$maxloginfailedtimes = 5;
			if ($rtime) {
				if ($rtime ['failure_times'] > $maxloginfailedtimes) {
					$minute = 60 - floor ( (SYS_TIME - $rtime ['logintime']) / 60 );
					exit ( json_encode ( array (
							'status' => false,
							'tips' => ' 密码尝试次数过多，被锁定一个小时' 
					) ) );
				}
			}
			
			// 查询帐号，默认组1为超级管理员
			$r = $this->Member_model->get_one ( array (
					'operator_name' => $username 
			) );
			if (! $r)
				exit ( json_encode ( array (
						'status' => false,
						'tips' => ' 用户名或密码不正确' 
				) ) );
				
//          $password = md5(md5(trim($_POST['password']).$r['encrypt']));
// 			$password = trim ( $_POST ['password'] );
			$password = md5(md5(trim($_POST['password'])));
				
			$ip = $this->input->ip_address ();
			if (isset ( $r ['operator_pwd'] ) && $r ['operator_pwd'] != $password) {
				if ($rtime && $rtime ['failure_times'] < $maxloginfailedtimes) {
					$times = $maxloginfailedtimes - intval ( $rtime ['failure_times'] );
					$this->Times_model->update ( array (
							'login_ip' => $ip,
							'is_admin' => 1,
							'failure_times' => ' +1' 
					), array (
							'username' => $username 
					) );
				} else {
					$this->Times_model->delete ( array (
							'username' => $username,
							'is_admin' => 1 
					) );
					$this->Times_model->insert ( array (
							'username' => $username,
							'login_ip' => $ip,
							'is_admin' => 1,
							'login_time' => SYS_TIME,
							'failure_times' => 1 
					) );
					$times = $maxloginfailedtimes;
				}
				
				exit ( json_encode ( array (
						'status' => false,
						'tips' => ' 密码错误您还有' . $times . '机会' 
				) ) );
			}
			
			$this->Times_model->delete ( array (
					'username' => $username 
			) );
			
			// if($r['is_lock'])
			// exit(json_encode(array('status'=>false,'tips'=>' 您的帐号已被锁定，暂时无法登录')));
			
			$this->Member_model->update ( array (
					'last_login_ip' => $ip,
					'last_login_time' => SYS_DATETIME 
			), array (
					'operator_id' => $r ['operator_id'] 
			) );
			$this->session->set_userdata ( 'user_id', $r ['operator_id'] );
			$this->session->set_userdata ( 'user_fullname', $r ['operator_name'] );
			$this->session->set_userdata ( 'user_name', $username );
			$this->session->set_userdata ( 'group_id', $r ['operator_role'] );
			
			// get the group path
			$this->load->model ( 'Member_role_model' );
			$p = $this->Member_role_model->get_one ( array (
					'role_id' => $r ['operator_role'] 
			) );
			
			if (! isset ( $p ) || ! isset ( $p ['xurl'] ))
				$dir_priv = 'guest';
			else
				$dir_priv = $p ['xurl'];
			
			$this->session->set_userdata ( 'xurl', $dir_priv );
			
			// insert a new login record
			$this->load->model ( "Logging_info_model" );
			$s = array (
					"operator_id" => $r ['operator_id'],
					"name" => $r ['operator_name'],
					"user" => $username,
					"action" => "登录",
					"content" => "登录成功",
					"ip" => $ip,
					'login_time' => SYS_DATETIME 
			);
			$this->Logging_info_model->insert ( $s );
			
			exit ( json_encode ( array (
					'status' => true,
					'tips' => 'successful',
					'next_url' => site_url ( $dir_priv."/project/index" )
// 					'next_url' => site_url ( $dir_priv ) 
			) ) );

// 			redirect ( base_url ( $dir_priv."/project/index" ) );
		} else {
			
			$this->admin_loginview ( 'login', array (
					'require_js' => true 
			) );
		}
	}
}