<?php

class activeAlarm extends CI_Controller{


	public function __construct(){
		parent::__construct();
		//$this->load->helper('url');
		$this->load->model( 'activeAlarmModel');		
	}

	public function getAlarm(){
		
		$hasilGetAlarm =  $this->activeAlarmModel->getActiveAlarm();
		$reTotal = $this->activeAlarmModel->getAffectedRows(); 
		header('Content-Type: application/json');
		echo json_encode(array('draw' => 1, 'recordsTotal'=>$reTotal ,'recordsFiltered'=>$reTotal, 'data'=>$hasilGetAlarm, 
		     JSON_NUMERIC_CHECK));
	}
}

?>

