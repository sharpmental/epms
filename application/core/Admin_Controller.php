<?php
class Admin_Controller extends Member_Controller {
	function __construct() {
		define ( "IN_ADMIN", TRUE );
		parent::__construct ();
	}
	protected function showmessage($msg, $url_forward = '', $ms = 500, $dialog = '', $returnjs = '') {
		if ($url_forward == '')
			$url_forward = isset ( $_SERVER ['HTTP_REFERER'] ) ? $_SERVER ['HTTP_REFERER'] : site_url ();
		
		$datainfo = array (
				"msg" => $msg,
				"url_forward" => $url_forward,
				"ms" => $ms,
				"returnjs" => $returnjs,
				"dialog" => $dialog 
		);
		echo $this->load->view ( 'adminpanel/header', NULL, true );
		echo $this->load->view ( 'adminpanel/message', $datainfo, true );
		echo $this->load->view ( 'adminpanel/footer', NULL, true );
		
		exit ();
	}
	
	/**
	 * 判断用户是否已经登陆
	 */
	protected function check_member() {
		if (! $this->user_id && ! ($this->router->directory == 'adminpanel/' && $this->router->class == 'manage' && $this->router->method == 'login')) {
			$this->showmessage ( '请您重新登录', site_url ( 'adminpanel/manage/login' ) );
			exit ( 0 );
		}
	}
	
	/**
	 * 自动模板调用
	 *
	 * @param
	 *        	$module
	 * @param
	 *        	$template
	 * @param
	 *        	$istag
	 * @return unknown_type
	 */
	protected function admin_loginview($view_file, $page_data = false, $cache = false) {
		$view_file = $this->page_data ['folder_name'] . DIRECTORY_SEPARATOR . $this->page_data ['controller_name'] . DIRECTORY_SEPARATOR . $view_file;
		
		$this->load->view ( 'adminpanel/header', $page_data );
		$this->load->view ( reduce_double_slashes ( $view_file ), $page_data );
		$this->load->view ( 'adminpanel/footer', $page_data );
	}
	
	/**
	 * 自动模板调用
	 *
	 * @param
	 *        	$module
	 * @param
	 *        	$template
	 * @param
	 *        	$istag
	 * @return unknown_type
	 */
	protected function view($view_file, $sub_page_data = NULL, $cache = false) {
		$view_file = $this->page_data ['folder_name'] . DIRECTORY_SEPARATOR . $this->page_data ['controller_name'] . DIRECTORY_SEPARATOR . $view_file;
		
		if (isset ( $this->current_member_info )) {
			$page_data ['current_member_info'] = $this->current_member_info;
		}
		$page_data ['current_member_id'] = $this->user_id; // 当前用户id
		$page_data ['current_member_groupid'] = $this->group_id;
		
		// Load menu
		$menu_data = $this->nav_menu ( 0, 0, 0 );
		
		$page_data ['sub_menu_data'] = NULL;
		$page_data ['current_pos'] = "";
		
		$find_menu = false;
		$menu_id = 0;
		
		foreach ( $this->all_module_menu as $k => $_value ) {
			if (strtolower ( $_value ['folder'] ) == strtolower ( trim ( $this->page_data ['folder_name'] ) ) && strtolower ( $_value ['controller'] ) == strtolower ( trim ( $this->page_data ['controller_name'] ) ) && strtolower ( $_value ['method'] ) == strtolower ( trim ( $this->page_data ['method_name'] ) )) {
				$menu_id = $_value ['menu_id'];
				if (! $find_menu && isset ( $_value ['arr_parentid'] )) {
					$arr_parentid = explode ( ",", $_value ['arr_parentid'] );
					if (count ( $arr_parentid ) >= 2) {
						$parent_id = $arr_parentid [1];
					} else {
						$parent_id = $_value ['menu_id'];
					}
					
					$page_data ['sub_menu_data'] = $this->nav_menu ( $parent_id, 0, 1 );
					
					foreach ( $page_data ['sub_menu_data'] as $kk => $vv ) {
						$page_data ['sub_menu_data'] [$kk] ['sub_array'] = $this->nav_menu ( $vv ['menu_id'], 0, 1 );
					}
					
					$find_menu = true;
				}
			}
			
			$page_data ['menu_data'] = $sub_page_data ['menu_data'] = $menu_data;
			$page_data ['current_pos'] = $this->current_pos ( $menu_id );
			$page_data ['sub_page'] = $this->load->view ( reduce_double_slashes ( $view_file ), $sub_page_data, true );
			
			// Setup notification data menu, wsm
			
			$page_data ['notification'] = array ();
			
			$this->load->view ( 'adminpanel/header', $page_data );
			$this->load->view ( 'adminpanel/index', $page_data );
			$this->load->view ( 'adminpanel/footer', $page_data );
		}
	}
}