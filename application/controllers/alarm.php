<?php

class alarm extends CI_Controller{


	public function __construct(){
		parent::__construct();
		//$this->load->helper('url');
		$this->load->model( 'alarmmodel');		
	}

	public function getAlarm(){
		
		$hasilGetAlarm =  $this->alarmmodel->getActiveAlarm();
		$reTotal = $this->alarmmodel->getAffectedRows(); 
		header('Content-Type: application/json');
		echo json_encode(array('draw' => 1, 'recordsTotal'=>$reTotal ,'recordsFiltered'=>$reTotal, 'data'=>$hasilGetAlarm, 
		     JSON_NUMERIC_CHECK));
	}
	
	function dateParsing($date){
		return date('Y-m-d', strtotime($date));
	}
}

?>

