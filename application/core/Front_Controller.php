<?php
class Front_Controller extends MY_Controller {
	function __construct() {
		parent::__construct ();
	}

	// 重新加载所有缓存至文件
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
