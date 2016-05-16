<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class MY_Controller extends CI_Controller {
	public $aci_config;
	public $aci_status;
	public $all_module_menu;
	public $page_data = array ();
	function __construct() {
		parent::__construct ();
		$this->load->driver ( 'cache', array (
				'adapter' => 'apc',
				'backup' => 'file' 
		) );
		$this->load->helper ( array (
				'global',
				'url',
				'string',
				'text',
				'language',
				'auto_codeIgniter_helper',
				'member' 
		) );
		
		$this->page_data ['folder_name'] = strtolower ( substr ( $this->router->directory, 0, - 1 ) );
		$this->page_data ['controller_name'] = strtolower ( $this->router->class );
		$this->page_data ['method_name'] = strtolower ( $this->router->method );
		$this->page_data ['controller_info'] = $this->config->item ( $this->page_data ['controller_name'], 'module' );
		
		$this->config->load ( 'aci' );
		$this->aci_config = $this->config->item ( 'aci_module' );
		$this->aci_status = $this->config->item ( 'aci_status' );
		
		$_pageseo = $this->config->item ( $this->router->class, 'seo' );
		$_default_pageseo = $this->config->item ( 'default', 'seo' );
		$this->page_data ['title'] = isset ( $_pageseo ['title'] ) ? $_pageseo ['title'] : $_default_pageseo ['title'];
		$this->page_data ['keywords'] = isset ( $_pageseo ['keywords'] ) ? $_pageseo ['keywords'] : $_default_pageseo ['keywords'];
		$this->page_data ['decriptions'] = isset ( $_pageseo ['decriptions'] ) ? $_pageseo ['decriptions'] : $_default_pageseo ['decriptions'];
		unset ( $_pageseo );
		unset ( $_default_pageseo );
		
		// 如果未安装，执行安装
		if (! $this->aci_status ['installED'] && $this->page_data ['folder_name'] != "setup")
			die ( "未安装" );
		
		$this->all_module_menu = getcache ( "cache_module_menu_all" );
		if (! $this->all_module_menu) {
			$datas = $this->Module_menu_model->select ( '', '*', 10000, ' menu_id asc' );
			$array = array ();
			foreach ( $datas as $r ) {
				$r ['url'] = base_url ( $this->page_data ['folder_name'] . '/' . $r ['controller'] . '/' . $r ['method'] );
				$this->all_module_menu [$r ['menu_id']] = $r;
			}
			// setcache ( 'cache_module_menu_all', $menus ); we only allow cache operation in admin priv
		}
		
		$this->load->vars ( $this->page_data );
	}
// 	protected function showmessage($msg, $url_forward = '', $ms = 500, $dialog = '', $returnjs = '') {
// 		if ($url_forward == '')
// 			$url_forward = isset ( $_SERVER ['HTTP_REFERER'] ) ? $_SERVER ['HTTP_REFERER'] : site_url ();
// 		$datainfo = array (
// 				"msg" => $msg,
// 				"url_forward" => $url_forward,
// 				"ms" => $ms,
// 				"returnjs" => $returnjs,
// 				"dialog" => $dialog 
// 		);
// 		exit ( $msg );
// 	}
	protected function view($view_file, $sub_page_data = NULL, $autoload_header_footer_view = true) {
		$view_file = $this->page_data ['folder_name'] . DIRECTORY_SEPARATOR . $this->page_data ['controller_name'] . DIRECTORY_SEPARATOR . $view_file;
		
		$this->load->view ( reduce_double_slashes ( $view_file ), $sub_page_data );
	}
}
class MY_API_Controller extends MY_Controller {
	public $POST, $GET;
	public $current_member_info;
	function __construct() {
		header ( 'Access-Control-Allow-Origin: *' );
		header ( "Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE" );
		if ($_SERVER ['REQUEST_METHOD'] == 'OPTIONS') {
			if (isset ( $_SERVER ['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] ) && (

			$_SERVER ['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'POST' || $_SERVER ['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'DELETE' || $_SERVER ['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'PUT')) {
				header ( 'Access-Control-Allow-Origin: *' );
				header ( "Access-Control-Allow-Credentials: true" );
				header ( 'Access-Control-Allow-Headers: X-Requested-With' );
				header ( 'Access-Control-Allow-Headers: access_token' );
				header ( 'Access-Control-Allow-Headers: Content-Type' );
				header ( 'Access-Control-Allow-Headers: Authorization' );
				
				header ( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
				header ( 'Access-Control-Max-Age: 86400' );
			}
			exit ();
		}
		
		$headers = apache_request_headers ();
		
		parent::__construct ();
		$this->load->library ( array (
				'encrypt' 
		) );
		define ( "IN_API", TRUE );
		
		$this->_check_token ();
	}
	function _check_token() {
		$headers = apache_request_headers ();
		$rawpostdata = file_get_contents ( "php://input" );
		if (isset ( $headers ['access_token'] )) {
			
			if ($rawpostdata)
				$_POST ['token'] = $headers ['access_token'];
			else
				$_GET ['token'] = $headers ['access_token'];
		}
		if (isset ( $_GET ['token'] )) {
			
			$this->GET = $this->POST = $_GET;
			
			if ($this->GET ['token'] == "") {
				exit ( json_encode ( array (
						'status_id' => - 99991,
						'tips' => ' 登录失败，缺少token' 
				) ) );
			}
		} else {
			if (! $rawpostdata)
				exit ( json_encode ( array (
						'status_id' => - 99992,
						'tips' => ' 登录失败，缺少token' 
				) ) );
			
			$post = json_decode ( $rawpostdata, true );
			$this->POST = $post ['params'];
			
			if (! isset ( $_POST ['token'] ) && ! isset ( $this->POST ['token'] )) {
				exit ( json_encode ( array (
						'status_id' => - 9999,
						'tips' => ' 登录失败，缺少token' 
				) ) );
			}
			
			if (isset ( $_POST ['token'] )) {
				$this->POST ['token'] = $_POST ['token'];
			}
		}
		$token = $this->POST ['token'];
		
		$token = str_replace ( "^^", "+", $token );
		$token = str_replace ( "~~", "#", $token );
		
		$decode_token = $this->encrypt->decode ( $token );
		
		if ($decode_token == "")
			exit ( json_encode ( array (
					'status_id' => - 9998,
					'tips' => ' token 无效' 
			) ) );
		$decode_token_arr = explode ( "_", $decode_token );
		if (count ( $decode_token_arr ) != 4)
			exit ( json_encode ( array (
					'status_id' => - 9997,
					'tips' => ' token 无效' 
			) ) );
		$user_id = $decode_token_arr [0];
		$user_name = $decode_token_arr [2];
		$user_password = $decode_token_arr [1];
		$user_login_time = $decode_token_arr [3];
		$this->current_member_info = $this->Member_model->get_one ( array (
				'operator_name' => $user_name,
				'operator_pwd' => $user_password 
		) );
		if (! $this->current_member_info)
			exit ( json_encode ( array (
					'status_id' => - 1000,
					'tips' => ' token 无效' 
			) ) );
	}
}
class MY_Member_Controller extends MY_Controller {
	public $module_info, $user_id, $group_id, $current_member_info, $menu_side_list;
	function __construct() {
		parent::__construct ();
		
		define ( "IN_MEMBER", TRUE );
		$this->module_info = $this->config->item ( 'module' );
		$this->user_id = intval ( $this->session->userdata ( 'user_id' ) );
		$this->user_name = $this->security->xss_clean ( $this->session->userdata ( 'user_name' ) );
		$this->group_id = intval ( $this->session->userdata ( 'group_id' ) );
		
		$this->check_member ();
		// $this->check_priv();
	}
	
	/**
	 * 判断用户是否已经登陆
	 */
	protected function check_member() {
		$_datainfo = $this->Member_model->get_one ( array (
				'operator_id' => $this->user_id,
				'operator_name' => $this->user_name 
		) );
		if (! ($this->page_data ['folder_name'] == 'member' && $this->router->class == 'manage' && $this->router->method == 'login') && ! $_datainfo) {
			$this->showmessage ( '请您重新登录', base_url ( $this->module_info ['php_path'] . '/manage/login' ) );
			exit ( 0 );
		}
		
		$this->current_member_info = $_datainfo;
	}
	protected function check_priv() {
		if ($this->page_data ['controller_name'] == 'manage' && in_array ( $this->page_data ['method_name'], array (
				'login',
				'logout',
				'manage' 
		) ))
			return true;
		
		if ($this->group_id == SUPERADMIN_GROUP_ID)
			return true;
		
		if (preg_match ( '/^public_/', $this->page_data ['method_name'] ))
			return true;
			
			// Load from cache
		if ($this->all_module_menu) {
			$found = false;
			foreach ( $this->all_module_menu as $k => $v ) {
				if ($v ['method'] == $this->page_data ['method_name'] && $v ['controller'] == $this->page_data ['controller_name']) {
					if (intval ( $v ['priv'] ) >= intval ( $this->group_id )) {
						$found = true;
						break;
					}
				}
			}
			if (! $found)
				$this->showmessage ( '您没有权限操作该项', 'blank' );
		} else {
			
			$r = $this->Module_menu_model->get_one ( array (
					'method' => $this->page_data ['method_name'],
					'controller' => $this->page_data ['controller_name'] 
			) );
			if (! $r)
				$this->showmessage ( '您没有权限操作该项', 'blank' );
			
			if (intval ( $r ['priv'] ) < intval ( $this->group_id ))
				$this->showmessage ( '您没有权限操作该项', 'blank' );
		}
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
		echo $this->load->view ( $this->page_data ['folder_name'] . '/header', NULL, true );
		echo $this->load->view ( $this->page_data ['folder_name'] . '/message', $datainfo, true );
		echo $this->load->view ( $this->page_data ['folder_name'] . '/footer', NULL, true );
		
		exit ();
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
		
		// 加截菜单
		$menu_data = $this->nav_menu ( 0, 0, 0 );
		$page_data ['sub_menu_data'] = NULL;
		$page_data ['current_pos'] = "";
		
		$find_menu = false;
		$menu_id = 0;
		
		foreach ( $this->all_module_menu as $k => $_value ) {
			if ($_value ['folder'] == trim ( $this->page_data ['folder_name'] ) && $_value ['controller'] == trim ( $this->page_data ['controller_name'] ) && $_value ['method'] == trim ( $this->page_data ['method_name'] )) {
				
				$menu_id = $_value ['menu_id'];
				if (! $find_menu) {
					$parent_id = $_value ['parent_id'];
					$page_data ['sub_menu_data'] = $this->nav_menu ( $parent_id );
					
					foreach ( $page_data ['sub_menu_data'] as $kk => $vv ) {
						$page_data ['sub_menu_data'] [$kk] ['sub_array'] = $this->nav_menu ( $vv ['menu_id'] );
					}
					
					$find_menu = true;
				}
			}
		}
		
		$page_data ['menu_data'] = $menu_data;
		$page_data ['current_pos'] = $this->current_pos ( $menu_id );
		$page_data ['sub_page'] = $this->load->view ( reduce_double_slashes ( $view_file ), $sub_page_data, true );
		
		$this->load->view ( 'member/header', $page_data );
		$this->load->view ( 'member/index', $page_data );
		$this->load->view ( 'member/footer', $page_data );
	}
	
	/**
	 * 按父ID查找菜单子项
	 *
	 * @param integer $parentid
	 *        	父菜单ID
	 * @param integer $with_self
	 *        	是否包括他自己
	 */
	protected function nav_menu($parent_id, $with_self = 0, $show_where = 0) {
		$parent_id = intval ( $parent_id );
		
		$result = array ();
		// Check menu cache
		if (! $this->all_module_menu)
			return null;
		
		foreach ( $this->all_module_menu as $k => $v ) {
			if ($v ['parent_id'] == $parent_id && $v ['is_display'] == 1) {
				$result [$v ['menu_id']] = $v;
			}
		}
		
		if ($with_self) {
			if (isset ( $this->all_module_menu [$parent_id] )) {
				$result = array_merge ( $this->all_module_menu [$parent_id], $result );
			}
		}
		
		// add submenu
		foreach ( $result as $k => $v ) {
			foreach ( $this->all_module_menu as $kk => $vv ) {
				if ($v ['menu_id'] == $vv ['parent_id'] && $vv ['is_display'] == 1)
					$result [$v ['menu_id']] ['sub_menu'] [] = $vv;
			}
		}
		
		return $result;
	}
	
	/**
	 * 按ID查找菜单子项
	 *
	 * @param integer $id
	 *        	菜单ID
	 *        	
	 */
	final public function current_pos($id) {
		$str = '';
		if (isset ( $this->all_module_menu [$id] )) {
			
			$str = $this->current_pos ( $this->all_module_menu [$id] ['parent_id'] );
			
			if ($this->all_module_menu [$id] ['parent_id'] != 0)
				$str = $str . '<li><a href="' . $this->all_module_menu [$id] ['url'] . '">' . $this->all_module_menu [$id] ['menu_name'] . '</a></li>';
			
			else
				$str = $str . '<li> ' . $this->all_module_menu [$id] ['menu_name'] . ' </li>';
			
			return $str;
		}
	}
}
class MY_Admin_Controller extends MY_Member_Controller {
	function __construct() {
		define ( "IN_ADMIN", TRUE );
		parent::__construct ();
	}
// 	protected function showmessage($msg, $url_forward = '', $ms = 500, $dialog = '', $returnjs = '') {
// 		if ($url_forward == '')
// 			$url_forward = isset ( $_SERVER ['HTTP_REFERER'] ) ? $_SERVER ['HTTP_REFERER'] : site_url ();
		
// 		$datainfo = array (
// 				"msg" => $msg,
// 				"url_forward" => $url_forward,
// 				"ms" => $ms,
// 				"returnjs" => $returnjs,
// 				"dialog" => $dialog 
// 		);
// 		echo $this->load->view ( $this->page_data ['folder_name'] . '/header', NULL, true );
// 		echo $this->load->view ( $this->page_data ['folder_name'] . '/message', $datainfo, true );
// 		echo $this->load->view ( $this->page_data ['folder_name'] . '/footer', NULL, true );
		
// 		exit ();
// 	}
	
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
			$pageview_data ['current_member_info'] = $this->current_member_info;
		}
		$pageview_data ['current_member_id'] = $this->user_id;
		$pageview_data ['current_member_groupid'] = $this->group_id;
		
		// Load menu
		$menu_data = $this->nav_menu ( 0, 0, 0 );
		
		$pageview_data ['sub_menu_data'] = NULL;
		$pageview_data ['current_pos'] = "";
		
		$find_menu = false;
		$menu_id = 0;
		
		foreach ( $this->all_module_menu as $k => $_value ) {
			if (($_value ['controller'] == $this->page_data ['controller_name']) && ($_value ['method'] == $this->page_data ['method_name'])) {
				$menu_id = $_value ['menu_id'];
				if (! $find_menu) {
					$parent_id = $_value ['parent_id'];
					
					$pageview_data ['sub_menu_data'] = $this->nav_menu ( $parent_id, 0, 1 );
					
					foreach ( $pageview_data ['sub_menu_data'] as $kk => $vv ) {
						$pageview_data ['sub_menu_data'] [$kk] ['sub_array'] = $this->nav_menu ( $vv ['menu_id'], 0, 1 );
					}
					
					$find_menu = true;
				}
			}
		}
		$pageview_data ['menu_data'] = $sub_page_data ['menu_data'] = $menu_data;
		
		// $pageview_data ['menu_data'] = $this->all_module_menu;
		$pageview_data ['current_pos'] = $this->current_pos ( $menu_id );
		$pageview_data ['sub_page'] = $this->load->view ( reduce_double_slashes ( $view_file ), $sub_page_data, true );
		
		// Setup notification data menu, wsm
		
		$pageview_data ['notification'] = array ();
		
		$this->load->view ( $this->page_data ['folder_name'] . '/header', $pageview_data );
		
		if (isset ( $sub_page_data ['baidumap'] ) && $sub_page_data ['baidumap'])
			$this->load->view ( $this->page_data ['folder_name'] . '/index_baidumap', $pageview_data );
		elseif (isset ( $sub_page_data ['show_sidemenu'] ) && ! $sub_page_data ['show_sidemenu']) 
			$this->load->view ( $this->page_data ['folder_name'] . '/index_nosidemenu', $pageview_data );
		else
			$this->load->view ( $this->page_data ['folder_name'] . '/index', $pageview_data );
		
		$this->load->view ( $this->page_data ['folder_name'] . '/footer', $pageview_data );
	}
	/**
	 * What it do
	 	*
	 	* @param
	 	*
	 	* @return
	 	*
	 	*/
	final public function reload_all_cache() {
		$menus = array ();
		$datas = $this->Module_menu_model->select ( '', '*', 10000, ' menu_id asc' );
		$array = array ();
		foreach ( $datas as $r ) {
			$r ['url'] = base_url ( $this->page_data ['folder_name'] . '/' . $r ['controller'] . '/' . $r ['method'] );
			$menus [$r ['menu_id']] = $r;
		}
		setcache ( 'cache_module_menu_all', $menus );
		
		$infos = $this->Member_role_model->select ( '', '*', '', 'role_id ASC' );
		
		$groups = array ();
		
		foreach ( $infos as $info ) {
			// $role[$info['role_id']] = $info['role_name'];
			$groups [$info ['role_id']] = $info;
		}
		
		setcache ( 'cache_member_group', $groups );
	}
}
