<?php
class Member_Controller extends Front_Controller {
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
					if ($this->$all_module_menu) {
						$found = false;
						foreach ( $this->$all_module_menu as $k => $v ) {
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
			echo $this->load->view ( 'member/header', NULL, true );
			echo $this->load->view ( 'member/message', $datainfo, true );
			echo $this->load->view ( 'member/footer', NULL, true );
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
					$result [] = $v;
				}
			}

			if ($with_self) {
				if (isset ( $this->all_module_menu [$parent_id] )) {
					$result = array_merge ( $this->all_module_menu [$parent_id], $result );
				}
			}

			if ($this->group_id == SUPERADMIN_GROUP_ID)
				return $result;

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