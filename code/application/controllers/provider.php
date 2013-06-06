<?php if (!defined('BASEPATH')) die();
	class Provider extends CI_Controller{

		function __construct() {
	  		parent::__construct();  	
        	$this->load->model('user');
        	$this->load->model('UserSession');
        	$this->load->model('permission');
   		}

   	/*	public function user() {
   			$viewInput['loggedInUserRole'] = $this->UserSession->getLoggedInUserRole();
   			$viewInput['permissionObject'] = $this->permission;
   			$query_string = explode("/",uri_string());	
	        if(isset($query_string['2'])) {
	          $viewInput['personId'] = $query_string['2'];
	          $viewInput['user_details'] = $this->user->getUserById($query_string['2']);  
	        }else{
	          $viewInput['personId'] = $this->UserSession->getLoggedInUserID();
	          $viewInput['user_details'] = $this->user->getUserById($this->UserSession->getLoggedInUserID());
	        }
	        $this->load->view('include/header',$viewInput);
			$this->load->view('templates/demographic',$viewInput);
			$this->load->view('include/footer'); 
   		}
*/
   		public function listUsers() {
			$viewInput 	=	array();
			
			$providerArr['userList']= array();
			$viewInput['loggedInUserRole'] = '';	

			$pageNo 		= ($this->uri->segment(3) !='' ? $this->uri->segment(3) : 1);
			$sortBy 		= ($this->uri->segment(4) !='' ? $this->uri->segment(4) : 'givenName');
			$sortOrder 		= ($this->uri->segment(5) !='' ? $this->uri->segment(5) : 'asc');
			
			$providerArr	=	$this->user->listProvidersUsers($pageNo,$sortBy,$sortOrder);
			
			$viewInput['userList']	= $providerArr['userList'];
			$viewInput['sortOrder'] = $sortOrder;
			$viewInput['sortBy'] 	= $sortBy;
			
			/*Pagination */
			$this->load->library('pagination');
			$config['base_url'] 		= base_url().'/provider/listUsers';
			$config['total_rows'] 		= $providerArr['totalCnt'];
			$config['use_page_numbers']	= TRUE;
			$config['per_page'] 		= $this->config->item('userPageLimit');
			
			$this->pagination->initialize($config);
			$viewInput['paginationHTML']	= $this->pagination->create_links();
			
			if(isset($_REQUEST['isAjax'])) {
			  	  echo json_encode(array('html'=>$this->load->view('templates/listUsers',$viewInput,true)));
			  }else{
				  $this->load->view('include/header',$viewInput);
				  $this->load->view('templates/listUsers',$viewInput);
				  $this->load->view('include/footer');
			  }
			
		}
   	}	

?>   	