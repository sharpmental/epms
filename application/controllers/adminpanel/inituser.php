<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

//delete or unmark all line after initilize
class Inituser extends CI_Controller{
	function index(){
		$this->db->truncate("tb_operator_info");
		
		$this->load->model("Member_model");
		
		$data=array(
				'operator_name' => 'admin',
				'operator_pwd' => md5(md5("0002")),
				'operator_role' => 1,
				'operator_displayname' => '超级管理员',
				'reg_ip' => '127.0.0.1',
				'reg_time' => date('Y-m-d H:i:s'),
				'encrypt' => '',
				'last_login_ip' => '127.0.0.1',
				'last_login_time' => date('Y-m-d H:i:s'),
				'update_timestamp' => date('Y-m-d H:i:s'),
				'company' => '',
				'address' => '',
				'phone' => '',
				'email' => '',
		);
		$this->Member_model->insert($data);
		
		$data=array(
				'operator_name' => 'projectadmin',
				'operator_pwd' => md5(md5("0002")),
				'operator_role' => 2,
				'operator_displayname' => '项目管理员',
				'reg_ip' => '127.0.0.1',
				'reg_time' => date('Y-m-d H:i:s'),
				'encrypt' => '',
				'last_login_ip' => '127.0.0.1',
				'last_login_time' => date('Y-m-d H:i:s'),
				'update_timestamp' => date('Y-m-d H:i:s'),
				'company' => '',
				'address' => '',
				'phone' => '',
				'email' => '',
		);
		$this->Member_model->insert($data);
		
		$data=array(
				'operator_name' => 'marketadmin',
				'operator_pwd' => md5(md5("0002")),
				'operator_role' => 3,
				'operator_displayname' => '业务员',
				'reg_ip' => '127.0.0.1',
				'reg_time' => date('Y-m-d H:i:s'),
				'encrypt' => '',
				'last_login_ip' => '127.0.0.1',
				'last_login_time' => date('Y-m-d H:i:s'),
				'update_timestamp' => date('Y-m-d H:i:s'),
				'company' => '',
				'address' => '',
				'phone' => '',
				'email' => '',
		);
		$this->Member_model->insert($data);
		
		$data=array(
				'operator_name' => 'marketadmin',
				'operator_pwd' => md5(md5("0002")),
				'operator_role' => 4,
				'operator_displayname' => '客户管理员',
				'reg_ip' => '127.0.0.1',
				'reg_time' => date('Y-m-d H:i:s'),
				'encrypt' => '',
				'last_login_ip' => '127.0.0.1',
				'last_login_time' => date('Y-m-d H:i:s'),
				'update_timestamp' => date('Y-m-d H:i:s'),
				'company' => '',
				'address' => '',
				'phone' => '',
				'email' => '',
		);
		$this->Member_model->insert($data);
		
		$data=array(
				'operator_name' => 'user',
				'operator_pwd' => md5(md5("0002")),
				'operator_role' => 5,
				'operator_displayname' => '客户',
				'reg_ip' => '127.0.0.1',
				'reg_time' => date('Y-m-d H:i:s'),
				'encrypt' => '',
				'last_login_ip' => '127.0.0.1',
				'last_login_time' => date('Y-m-d H:i:s'),
				'update_timestamp' => date('Y-m-d H:i:s'),
				'company' => '',
				'address' => '',
				'phone' => '',
				'email' => '',
		);
		$this->Member_model->insert($data);
		
		$data=array(
				'operator_name' => 'guest',
				'operator_pwd' => md5(md5("0002")),
				'operator_role' => 6,
				'operator_displayname' => '访客',
				'reg_ip' => '127.0.0.1',
				'reg_time' => date('Y-m-d H:i:s'),
				'encrypt' => '',
				'last_login_ip' => '127.0.0.1',
				'last_login_time' => date('Y-m-d H:i:s'),
				'update_timestamp' => date('Y-m-d H:i:s'),
				'company' => '',
				'address' => '',
				'phone' => '',
				'email' => '',
		);
		$this->Member_model->insert($data);
		
		$data=array(
				'operator_name' => 'sysadmin',
				'operator_pwd' => md5(md5("9999")),
				'operator_role' => 1,
				'operator_displayname' => '超级管理员',
				'reg_ip' => '127.0.0.1',
				'reg_time' => date('Y-m-d H:i:s'),
				'encrypt' => '',
				'last_login_ip' => '127.0.0.1',
				'last_login_time' => date('Y-m-d H:i:s'),
				'update_timestamp' => date('Y-m-d H:i:s'),
				'company' => '',
				'address' => '',
				'phone' => '',
				'email' => '',
		);
		$this->Member_model->insert($data);
		
		echo "Database updated! Please erase all content in /application/controllers/adminpanel/inituser.php";
	}
}


