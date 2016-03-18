<?php

class core extends CI_Controller{


	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model( 'core_model', 'engine' );
	}

	//dashboard index page
	public function index(){
		$content = $this->load->view('home');	
	}
	
	public function search(){
		$this->load->library('form_validation');
        $this->form_validation->set_rules('kataKunci', 'Kata Kunci', 'required');

        if ($this->form_validation->run())
        {
            // Update user
            $input['kataKunci'] = $this->input->post('kataKunci', true);
			$input['pencarian'] = $this->input->post('pencarian');
			print_r($input);
        }
		
		//$results = $this->engine->doSearch();
		
	}
	public function upload(){
		
		//Call library
		//require_once APPPATH."/libraries/reader.php";
		//$excelReader = new Spreadsheet_Excel_Reader();
		
		$fileName = $_FILES['uploadData']['name'];
		//echo realpath($fileName);
		//echo $fileName;
		//echo $filePath;
	
		$filepath = pathinfo ($fileName);
		print_r($filepath);
		//print_r($filepath);
		
	}



}

