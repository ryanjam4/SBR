<?php if (!defined('BASEPATH')) die();
	class Problem extends CI_Controller{

	function __construct() {
	  	parent::__construct();  	
        $this->load->model('Concept','concept');
        $this->load->model('UserSession');
        $this->load->model('ProblemModel','problem');
        $this->load->model('medicationModel','medication');
        $this->load->model('GoalModel','goal');
        if($this->UserSession->getLoggedInUserRole() == '1') {
            $this->problem->setIsApproved('1');
        }
        $this->viewObject = array();
        $this->load->model('permission');
   	}

    function add() {     
        $this->viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
        $this->viewObject['personId'] = end($this->uri->segments);
        $this->viewObject['problemId'] = "";
        $this->load->view('include/header',$this->viewObject);
        $this->load->view('templates/addProblem',$this->viewObject);
        $this->load->view('include/footer');
    }

    function edit() {  
        $this->viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();   
        $this->viewObject['personId'] = $this->uri->segment(3);
        $this->viewObject['problemId'] = $this->uri->segment(4);
        $this->problem->getProblemDetails($this->viewObject['problemId']);        
        $this->viewObject['problemDetails'] = $this->problem;
        $this->load->view('include/header',$this->viewObject);
        $this->load->view('templates/addProblem',$this->viewObject);
        $this->load->view('include/footer');
    }

    function delete() {
        $this->problem->deleteProblem($this->uri->segment(3));
        echo json_encode(array('status'=>'success'));
    }

    function saveProblem() {         
         $personId = end($this->uri->segments);
         parse_str($_REQUEST['form_data'],$inputList);
         if(!empty($inputList['problem']['problemId'])) {
            $this->problem->updateProblem($inputList,$personId);
         }else{
            $this->problem->insertProblem($inputList,$personId);
         }
         
         echo json_encode(array('status'=>'success','personId'=>$personId));
    }    

    function searchProblem() {
        $result = $this->concept->fetchProblems($_REQUEST['term'],false);
        print(json_encode($result,JSON_FORCE_OBJECT));
    }

    function detail() {   

        $this->load->model('ProblemMetaData','problemmetadata');
        
        $this->viewObject['permissionObject'] = $this->permission;

        $this->viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();   
        $this->viewObject['personRole'] = $this->UserSession->getLoggedInUserRole();   
        $problemId = end($this->uri->segments);                
        $this->problem->getProblemDetails($problemId);
        $this->viewObject['problemDetails'] = $this->problem;
        $this->viewObject['medicationDetails'] = $this->medication->getMedicationRelatedToProblem($problemId);
        $this->viewObject['unApprovedMedications'] = $this->medication->getMedicationRelatedToProblem($problemId,0);
        $this->viewObject['problemGuidelines'] = $this->problemmetadata->getProblemGuidelines($this->problem);
        $this->viewObject['problemGoals'] = $this->goal->fetchGoals($problemId); 
        $this->load->view('include/header',$this->viewObject);
        $this->load->view('templates/problemDetail',$this->viewObject);
        $this->load->view('include/footer');    
    }

    function approve() {
        $this->problem->approveProblem($this->uri->segment(3));
        echo json_encode(array('status'=>'success'));
	}
}
?>