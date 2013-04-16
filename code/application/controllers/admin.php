<?php if (!defined('BASEPATH')) die();
class Admin extends CI_Controller {

	function __construct() {
	   parent::__construct();  	
       $this->load->model('user');
       $this->load->model('UserSession');
   	} 

	public function listUsers() {
	  $viewInput = array();
	  $viewInput['loggedInUserRole'] = '';	

	  $pageNo = ($this->uri->segment(3) !='' ? $this->uri->segment(3) : 1);
	  $sortBy = ($this->uri->segment(4) !='' ? $this->uri->segment(4) : 'givenName');
	  $sortOrder = ($this->uri->segment(5) !='' ? $this->uri->segment(5) : 'asc');
	  


	  $result = $this->user->listUsers($pageNo,$sortBy,$sortOrder);
	  $viewInput['userList'] = $result['userList'];
	  $viewInput['sortOrder'] = $sortOrder;
	  $viewInput['sortBy'] = $sortBy;

	  /*Pagination */
	  $this->load->library('pagination');
	  $config['base_url'] = base_url().'/admin/listUsers';
	  $config['total_rows'] = $result['totalCnt'];
	  $config['use_page_numbers'] = TRUE;
	  $config['per_page'] = $this->config->item('userPageLimit');
  	  $this->pagination->initialize($config);
	  $viewInput['paginationHTML'] = $this->pagination->create_links();

	  if(isset($_REQUEST['isAjax'])) {
	  	  echo json_encode(array('html'=>$this->load->view('templates/listUsers',$viewInput,true)));
	  }else{
	  	  $this->load->view('include/header',$viewInput);
	      $this->load->view('templates/listUsers',$viewInput);
	      $this->load->view('include/footer');
	  }	  
	
	}

	public function updateUser() {
		$this->user->updateUser($_POST);
		
		if(!empty($_POST['redirectTo'])){
			header("Location: ".$_POST['redirectTo']);
		}else{
			header("Location: ".base_url()."admin/listUsers");	
		}
		
	}

	public function editUser() {		
		$viewInput = array();
		$viewInput['error'] = '';
		$viewInput['info'] = '';
		$viewInput['redirectTo'] = $_SERVER['HTTP_REFERER'];
		$viewInput['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
		$viewInput['user_details'] = $this->user->getUserById($_REQUEST['personId']);   	  
		$this->load->view('include/header',$viewInput);
		$this->load->view('templates/editform',$viewInput);
		$this->load->view('include/footer');
	}

	public function deleteUser() {
		$status = $this->user->deleteUser($_REQUEST);
		echo json_encode(array('status',$status));
	}

} 

?>