<?php if (!defined('BASEPATH')) die();
	class Medication extends CI_Controller{

		function __construct() {
		  	parent::__construct();  	
	        $this->load->model('UserSession');
	        $this->load->model('medicationModel','medication');
	        if($this->UserSession->getLoggedInUserRole() == '1') {
         	   $this->medication->setIsApproved('1');
        	}
   		}

   		function detail() {
   			$viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
   			$medicationId = end($this->uri->segments);
	        $medObject = $this->medication->getMedicationDetails($medicationId);
	        $viewObject['medicationDetails'] = $medObject[0];
	        $this->load->view('include/header',$viewObject);
	        $this->load->view('templates/medicationDetail',$viewObject);
	        $this->load->view('include/footer'); 
   		}

   		function add() {
   			$viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
   			$viewObject['personId'] = $this->uri->segment(3);
	        $viewObject['problemId'] = $this->uri->segment(4);
	        $viewObject['medicationId'] = "";
	        $this->load->view('include/header',$viewObject);
	        $this->load->view('templates/addMedication',$viewObject);
	        $this->load->view('include/footer'); 
   		}

   		function edit() {     
   			$viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
	        $viewObject['personId'] = $this->uri->segment(3);
	        $viewObject['medicationId'] = $this->uri->segment(4);
			$viewObject['problemId'] = $this->uri->segment(5);
	        $viewObject['medicationDetails'] = $this->medication->getMedicationDetails($viewObject['medicationId']);
	        $viewObject['medicationDetails'] = $viewObject['medicationDetails'][0];
	        $this->load->view('include/header',$viewObject);
	        $this->load->view('templates/addMedication',$viewObject);
	        $this->load->view('include/footer'); 
    	}

    	function delete() {
        	$this->medication->deleteMedication($this->uri->segment(3));
        	echo json_encode(array('status'=>'success'));
    	}

    	function approve() {
        	$this->medication->approveMedication($this->uri->segment(3));
        	echo json_encode(array('status'=>'success'));
		}

   		function saveMedication() {         
	         $personId = $_REQUEST['personId'];
	         parse_str($_REQUEST['form_data'],$inputList);
	         $problemId = '';$medicationId='';
	         if(!empty($inputList['medication']['medicationId'])) {
	         	$medicationId = $inputList['medication']['medicationId'];
	            $this->medication->updateMedication($inputList,$personId);
	         }else{
	            $problemId = $_REQUEST['problemId'];	
	            $medicationId = $this->medication->insertMedication($inputList,$personId);	         
	         	$this->medication->saveMedicationForProblem($medicationId,$problemId);
	         }	         
	         echo json_encode(array('status'=>'success','personId'=>$personId,'problemId' => $problemId,'medicationId'=>$medicationId));
    	}
	}
?>	