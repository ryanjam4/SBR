<?php if (!defined('BASEPATH')) die();
	class Patient extends CI_Controller{

		function __construct() {
	  		parent::__construct();  	
            $this->load->model('PatientModel','patient');
            $this->load->model('UserSession');
            $this->load->model('permission');
   	    }

 		function index($patientid="") {     
            $this->load->model('fbmodel'); 
            $this->load->model('GoalModel','goal');
			if($patientid=="") {
				$query_string = explode("/",uri_string());	
				if(isset($query_string['2'])) {
				  $viewObject['personId'] = $query_string['2'];              
				}else{
				  $viewObject['personId'] = $this->UserSession->getLoggedInUserID();
				} 

				$viewObject['permissionObject'] = $this->permission;
				
				$viewObject['personsubrole'] = $this->permission->getSubRoleID();//added by athena esolutions
				$viewObject['personRole'] = $this->UserSession->getLoggedInUserRole();
				$patientDetails = $this->patient->getPatientDetails($viewObject['personId']);     
				$unApprovedProblems = $this->patient->getUnApprovedProblems($viewObject['personId']);     
				$viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
				$viewObject['patientDetails'] = $patientDetails;
				$viewObject['unApprovedProblems'] = $unApprovedProblems;
				$viewObject['facebookLoginUrl'] = $this->fbmodel->getFbLoginUrl($viewObject['personId']);
				$viewObject['facebookData'] = $this->fbmodel->fetchUserFacebookData($viewObject['personId']);
				$viewObject['personGoals'] = $this->goal->getPersonGoals($viewObject['personId']);
			}
			else {
				$viewObject['personId'] = $patientid;
				$viewObject['permissionObject'] = $this->permission;
				
				$viewObject['personsubrole'] = $this->permission->getSubRoleID();//added by athena esolutions
				$viewObject['personRole'] = $this->UserSession->getLoggedInUserRole();
				$patientDetails = $this->patient->getPatientDetails($patientid);     
				$unApprovedProblems = $this->patient->getUnApprovedProblems($patientid);     
				$viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
				$viewObject['patientDetails'] = $patientDetails;
				$viewObject['unApprovedProblems'] = $unApprovedProblems;
				$viewObject['facebookLoginUrl'] = $this->fbmodel->getFbLoginUrl($patientid);
				$viewObject['facebookData'] = $this->fbmodel->fetchUserFacebookData($patientid);
				$viewObject['personGoals'] = $this->goal->getPersonGoals($patientid); 
			}
            $this->load->view('include/header',$viewObject);
            $this->load->view('templates/patientView',$viewObject);
            $this->load->view('include/footer');     
 		}

        function saveFacebookData() {
            $this->load->model('fbmodel'); 
            $this->fbmodel->getFacebookAccessToken($this->uri->segment(3));
            $this->fbmodel->saveFacebookUserData($this->uri->segment(3));
            header("Location:".base_url("/patient/index/".$this->uri->segment(3)."/"));
        }

        function savePatientData() {
            if(isset($_REQUEST['needToKnow'])){
                $this->patient->savePersonNarrative($_REQUEST);    
            }else{
                $this->patient->savePatientImage($_REQUEST);    
            }
            
            echo json_encode(array('status'=>'success'));
        }
		function editData() {
            $this->patient->savePatientImage($_REQUEST);
			$this->patient->saveeditPersonNarrative($_REQUEST);


            echo json_encode(array('status'=>'success'));
        }
		function edit($patientid){
/*			 $this->load->model('fbmodel');
            $this->load->model('GoalModel','goal');
            $query_string = explode("/",uri_string());
            if(isset($query_string['2'])) {
              $viewObject['personId'] = $query_string['2'];
            }else{
              $viewObject['personId'] = $this->UserSession->getLoggedInUserID();
            }

            $viewObject['permissionObject'] = $this->permission;


            $viewObject['personRole'] = $this->UserSession->getLoggedInUserRole();
            $patientDetails = $this->patient->getPatientDetails($viewObject['personId']);
            $unApprovedProblems = $this->patient->getUnApprovedProblems($viewObject['personId']);
            $viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
            $viewObject['patientDetails'] = $patientDetails;
            $viewObject['unApprovedProblems'] = $unApprovedProblems;
            $viewObject['facebookLoginUrl'] = $this->fbmodel->getFbLoginUrl($viewObject['personId']);
            $viewObject['facebookData'] = $this->fbmodel->fetchUserFacebookData($viewObject['personId']);
            $viewObject['personGoals'] = $this->goal->getPersonGoals($viewObject['personId']);*/
			$this->load->model('fbmodel');
            $this->load->model('GoalModel','goal');
             $viewObject['personId'] = $patientid;

            $viewObject['permissionObject'] = $this->permission;


            $viewObject['personRole'] = $this->UserSession->getLoggedInUserRole();
            $patientDetails = $this->patient->getPatientDetails($patientid);
            $unApprovedProblems = $this->patient->getUnApprovedProblems($patientid);
            $viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
            $viewObject['patientDetails'] = $patientDetails;
            $viewObject['unApprovedProblems'] = $unApprovedProblems;
            $viewObject['facebookLoginUrl'] = $this->fbmodel->getFbLoginUrl($patientid);
            $viewObject['facebookData'] = $this->fbmodel->fetchUserFacebookData($patientid);
            $viewObject['personGoals'] = $this->goal->getPersonGoals($patientid);
		    $this->load->view('include/header',$viewObject);
            $this->load->view('templates/edit',$viewObject);
            $this->load->view('include/footer');
		}
		function aboutme($patientid){
			$this->load->model('fbmodel');
            $viewObject['personId'] = $patientid/*$this->UserSession->getLoggedInUserID()*/;
            $viewObject['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
            $viewObject['facebookLoginUrl'] = $this->fbmodel->getFbLoginUrl($patientid);
            $viewObject['facebookData'] = $this->fbmodel->fetchUserFacebookData($patientid);
			$patientDetails = $this->patient->getPatientDetails($patientid); 
			$viewObject['patientDetails'] = $patientDetails;
            $this->load->view('include/header',$viewObject);
            $this->load->view('templates/aboutme',$viewObject);
            $this->load->view('include/footer');
		}
	}
?>