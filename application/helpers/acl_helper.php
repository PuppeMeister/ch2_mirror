<?php


if( !function_exists('check_acl') )
{

	function check_acl( $alias )
	{
		$CI = &get_instance();

		if( isset( $CI->acl_model ) == FALSE )
		{
			$CI->load->model( 'acl_model' );
		}

		return ( $CI->acl_model->getPermByAlias( $alias ) );
	}

}

if( !function_exists('menu_label') )
{
	function menu_label( $alias )
	{

		$CI = &get_instance();

		if( isset( $CI->acl_model ) == FALSE )
		{
			$CI->load->model( 'acl_model' );
		}

		return ( $CI->acl_model->getMenuName( $alias ) );

	}

}