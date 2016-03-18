<?php

class acl{

	private $group_field;
	private $allowed_maps = array(
		array(
			'class' => 'login',
			'method' => 'index'
		),
		array(
			'class' => 'login',
			'method' => 'masuk'
		),
		array(
			'class' => 'login',
			'method' => 'logout'
		)		
	);

	public function __construct(){
		
		$this->group_field = md5('group_id');
	}

	public function auth(){

		$CI = &get_instance();
		
		if( !isset( $CI->session ) )
		{
			$CI->load->library('session');
		}

		if( !isset( $CI->router ) )
		{
			$CI->load->library('router');
		}

		$class = $CI->router->fetch_class();
		$method = $CI->router->fetch_method();

		$is_allowed_to_all = false;

		foreach ($this->allowed_maps as $rule) {
			if( $rule['class'] == $class && $rule['method'] == $method )
			{
				$is_allowed_to_all =  true;
			}
		}

		if( $is_allowed_to_all == FALSE )
		{
			if( $CI->session->userdata( $this->group_field ) )
			{#if user is logged in

				if( isset( $CI->acl ) == FALSE )
				{
					$CI->load->model('acl_model','acl');
				}

				$is_allowed = $CI->acl->getPerms( $CI->session->userdata( $this->group_field ), $class , $method );

				if( $is_allowed == FALSE )
				{
					show_error("You're not allowed to access this page",403);
				}

				
			}
			else{
				redirect('login');
			}			
		}
		else
		{
			if( $CI->session->userdata( $this->group_field ) )
			{
				if( $class == "login" )
				{
					if( $method == "masuk" || $method == "index" )
					{
						redirect('');
					}
				}
			}
		}
		

	}

}