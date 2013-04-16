<?php
include_once ('user.php');
class UserSession extends CI_Model{
	
	function __construct() {
	   parent::__construct();  	
       $this->load->library('session');
   	}

   	function createUserSession($userObj) {
   		$this->session->set_userdata('loggedInUserObject',base64_encode(serialize($userObj)));
   	}

   	function checkIfSessionExists() {
         
   	} 

      function getLoggedInUserID() {
         $userObj = $this->getLoggedInUserObject();
         if(!is_object($userObj)){
            header("Location:".base_url());
         }
         return $userObj->getPersonId();
      }

      function getLoggedInUserRole() {
         $userObj = $this->getLoggedInUserObject();
         
         if(!is_object($userObj)){
            header("Location:".base_url());
         }

         return $userObj->getRole();
      }

      function getLoggedInUserObject() {
         return unserialize(base64_decode($this->session->userdata('loggedInUserObject')));
      }

   	function getUserSessionData($key='') {
         if(empty($key)) {
   			return $this->session->all_userdata();
   		}else{
   			return $this->session->userdata($key);
   		}
   	}
}

?>