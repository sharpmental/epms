<?php
class API_Controller extends Front_Controller {
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