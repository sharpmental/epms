<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );

class MY_Controller extends CI_Controller {
	public $aci_config;
	public $aci_status;
	public $all_module_menu;
	protected $page_data = array ();
	function __construct() {
		parent::__construct ();
		$this->load->driver ( 'cache', array (
				'adapter' => 'file' 
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
		$this->load->vars ( $this->page_data );
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
		exit ( $msg );
	}
	protected function view($view_file, $sub_page_data = NULL, $autoload_header_footer_view = true) {
		$view_file = $this->page_data ['folder_name'] . DIRECTORY_SEPARATOR . $this->page_data ['controller_name'] . DIRECTORY_SEPARATOR . $view_file;
		
		$this->load->view ( reduce_double_slashes ( $view_file ), $sub_page_data );
	}
}
