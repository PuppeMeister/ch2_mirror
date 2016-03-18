<?php

class Index extends CI_Controller{


	public function __construct(){
		parent::__construct();
		
	}
	//dashboard index page
	public function index(){
		//$this->getAlarm();
		$this->load->view('homeAverage');
	}

}
?>

