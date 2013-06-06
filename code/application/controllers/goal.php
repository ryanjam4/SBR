<?php if (!defined('BASEPATH')) die();
	class Goal extends CI_Controller{

	function __construct() {
	  	parent::__construct();  
	  	$this->load->model('GoalModel','goal');
	  	$this->load->model('UserSession');
        $this->load->model('ProblemModel','problem');
        $this->load->model('permission');
	}

	function add(){
		$this->goal->saveGoal($_REQUEST);
		echo json_encode(array('status'=>'success'));
	}

	function create(){
		$this->viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();   
        $this->viewObject['personRole'] = $this->UserSession->getLoggedInUserRole();   
        $problemId = end($this->uri->segments);                
        $this->problem->getProblemDetails($problemId);
        $this->viewObject['goalId'] = "";
        $this->viewObject['problemDetails'] = $this->problem;
		$this->load->view('include/header',$this->viewObject);
        $this->load->view('templates/addGoal',$this->viewObject);
        $this->load->view('include/footer'); 
	}

	function edit(){
		$this->viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();   
        $this->viewObject['personRole'] = $this->UserSession->getLoggedInUserRole();   
        $goalId = end($this->uri->segments);                
 		$this->viewObject['goalId'] = $goalId;
        $this->goal->getGoalDetails($goalId);
        $this->viewObject['goalDetails'] = $this->goal;
		$this->load->view('include/header',$this->viewObject);
        $this->load->view('templates/addGoal',$this->viewObject);
        $this->load->view('include/footer'); 
	}

	function detail(){
		$this->viewObject['permissionObject'] = $this->permission;
		$this->viewObject['personsubrole'] = $this->permission->getSubRoleID();//added by athena esolutions
		$this->viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();   
        $this->viewObject['personRole'] = $this->UserSession->getLoggedInUserRole();   
        $goalId = end($this->uri->segments);                
 		$this->viewObject['goalId'] = $goalId;
        $this->goal->getGoalDetails($goalId);

        if(isset($_SERVER['HTTP_REFERER'])){
        	$this->viewObject['back'] = $_SERVER['HTTP_REFERER'];
        }else{
        	$this->viewObject['back'] = base_url()."/patient/index";
        }
        $this->viewObject['goalDetails'] = $this->goal;
		$this->load->view('include/header',$this->viewObject);
        $this->load->view('templates/goalDetail',$this->viewObject);
        $this->load->view('include/footer'); 
	}

	function delete(){
		$this->goal->delete(end($this->uri->segments));
		echo json_encode(array('status'=>'success'));
	}

}
?>