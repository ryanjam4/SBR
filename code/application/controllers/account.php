<?php if (!defined('BASEPATH')) die();
class Account extends CI_Controller {

	function __construct() {
	   parent::__construct();  	
       $this->load->model('user');
       $this->load->model('UserSession');
       $this->load->model('permission');
   	} 

	public function registerUser() {
   	  $viewInput = array();
   	  $viewInput['redirectTo'] = $_SERVER['HTTP_REFERER'];
   	  $viewInput['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
   	  $viewInput['error'] = '';
   	  $viewInput['info'] = '';   	  
      $this->load->view('include/header',$viewInput);
      $this->load->view('templates/form',$viewInput);
      $this->load->view('include/footer');
	}

	public function loginUser() {
		$userObj = $this->user->validateUserLogin($_POST);
		$this->UserSession->createUserSession($userObj);
		$responseObject = array();
		if($userObj->getPersonId() != "") {
			$responseObject['status'] = 'success';
			if($userObj->getRole() == 1) {
				$responseObject['redirectUrl'] = "/admin/listUsers";	
			}else if($userObj->getRole() == 2){
				if($this->permission->getSubRoleID() == 3){
					$responseObject['redirectUrl'] = "/demographic/user";
				}else{
					$responseObject['redirectUrl'] = "/patient/";
				}				
			}else{
				$responseObject['redirectUrl'] = "/demographic/listUsers";
			}
			
		}else{
			$responseObject['status'] = 'error';
			$responseObject['message'] = 'invalid login';
		}
		echo json_encode($responseObject);
	}

	public function createNewUser() {
		$this->user->populateClassMembers($_POST);
		$personId = $this->user->saveUser();
		
		if(!empty($_POST['redirectTo'])){
			header("Location: ".$_POST['redirectTo']);
		}else{
			header("Location: ".base_url()."admin/listUsers");	
		}
	}

	public function saveUploadedFile() {
		$config['upload_path'] = "./uploads/{$_REQUEST['type']}";
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000000000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		$this->load->library('upload', $config);
		$this->upload->do_upload("avatar");
		$response = $this->upload->data();		
		if(is_array($this->upload->display_errors())) {
			echo 'error';
		}else{
			echo $response['file_name'];
		}
	}

}
?>