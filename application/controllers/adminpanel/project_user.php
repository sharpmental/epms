<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Project_user extends MY_Admin_Controller {
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
				'Project_model',
				'Project_user_model',
				'Member_model' 
		) );
		
		$user = $this->Member_model->getall ();
		
		$content = "";
		
		foreach ( $user->result_array () as $k => $v ) {
			$p = $this->Project_user_model->select ( array (
					'user_id' => $v ['operator_id'] 
			) );
			
			$content = $content . '<div class="panel panel-info">' . '<div class="panel-heading">' . '<span>用户名称:' . $v ['operator_name'] . '</span>' . '</div>';
			$content = $content . '<div class="panel-body">';
			
			foreach ( $p as $kk => $vv ) {
				$pp = $this->Project_model->get_one ( array (
						'project_id' => $vv ['project_id'] 
				) );
				
				if (! isset ( $pp ) || ! $pp)
					continue;
				
				$content = $content . '<div class="checkbox"><label><input type="checkbox" checked="checked" disabled="disabled"> ' . $pp ['project_name'] . ' </label></div>';
			}
			$content = $content . '</div><div class="panel-footer">' . '<a class="btn btn-sm btn-default" href="' . base_url ( $this->page_data ['folder_name'] . '/project_user/update/' . $v ['operator_id'] ) . '" >修改关联' . '</a></div>';
			$content = $content . '</div>';
		}
		
		$this->view ( 'index', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'content' => $content 
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
	function update($user_id) {
		$this->check_priv ();
		
		$this->load->model ( array (
				'Member_model',
				'Project_user_model',
				'Project_model' 
		) );
		
		$u = $this->Member_model->get_one ( array (
				'operator_id' => $user_id 
		) );
		
		if (! isset ( $u ) || ! $u) {
			$this->show_error ( "Can not find this user in database!" );
		}
		
		$p = $this->Project_model->getall ();
		
		$pu = $this->Project_user_model->select ( array (
				'user_id' => $user_id 
		) );
		
		$content = "";
		foreach ( $p->result_array() as $k => $v ) {
			$checked = false;
			foreach ( $pu as $kk => $vv ) {
				if ($vv ['project_id'] == $v ['project_id']) {
					$content = $content . '<div class="checkbox"><label><input type="checkbox" checked="checked" name="'.$v['project_id'].'" > ' . $v ['project_name'] . ' </label></div>';
					$checked = true;
				}
			}
			if (! $checked)
				$content = $content . '<div class="checkbox"><label><input type="checkbox" name="'.$v['project_id'].'" > ' . $v ['project_name'] . ' </label></div>';
		}
		
		$this->view ( 'update', array (
				'require_js' => true,
				'show_sidemenu' => false,
				'content' => $content,
				'user_name' => $u ['operator_name'],
				'user_id' => $user_id
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
	 function update_r($user_id){
	 	$this->check_priv ();
	 	
	 	$this->load->model ( array (
	 			'Member_model',
	 			'Project_user_model',
	 			'Project_model'
	 	) );
	 	
	 	$u = $this->Member_model->get_one(array(
	 			'operator_id' => $user_id
	 	));
	 	
	 	if(!isset($u) || !$u){
	 		$this->show_error('Can not find this operator!');
	 	}
	 	
	 	foreach($_POST as $k => $v){
	 		$project_id = $k;
	 		$checked = false;
	 		$p = $this->Project_model->get_one(array(
	 				'project_id' => $project_id
	 		));
	 		
	 		$pu = $this->Project_user_model->select(array(
	 				"user_id" => $user_id
	 		));
	 		
	 		if(!isset($p) || !$p){
	 			continue;
	 		}
	 		else if ($p['type'] < $u['operator_role']){
	 			continue;
	 		}
	 		else{
	 			foreach ($pu as $kk => $vv){
	 				if ($vv['project_id'] == $project_id){
	 					$checked = true;
	 					break;
	 				}
	 			}
	 			if (!$checked)
	 			$pu = $this->Project_user_model->insert(array(
	 					'project_id' => $project_id,
	 					'user_id' => $user_id,
	 					'flag' => 0
	 			));
	 		}
	 	}
	 	
	 	Header ( 'Location:' . base_url ( $this->page_data ['folder_name'] . '/user/index' ) );
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
}