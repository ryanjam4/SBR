<?php
	class ActivityLogModel extends CI_Model{
		private $personId=-1;
		private $actionOn=-1;
		private $actiontoId=-1;
		private $action=-1;
		private $beforeactionData='';
		private $afteractionData='';
		function __construct() {
		   parent::__construct();  	
	       $this->load->database();       
   		}
		public function getPersonId(){
			return $this->personId;
		}
		public function setPersonId($personId){
			$this->personId=$personId;
		}
		public function getActionOn(){
			return $this->actionOn;
		}
		public function setActionOn($actionOn){
			$this->actionOn=$actionOn;
		}
		public function getActiontoId(){
			return $this->actiontoId;
		}
		public function setActiontoId($actiontoId){
			$this->actiontoId=$actiontoId;
		}
		public function getAction(){
			return $this->action;
		}
		public function setAction($action){
			$this->action=$action;
		}
		public function getBeforeActionData(){
			return $this->beforeActionData;
		}
		public function setBeforeActionData($beforeActionData){
			$this->beforeActionData=$beforeActionData;
		}
		public function getAfterActionData(){
			return $this->afterActionData;
		}
		public function setAfterActionData($afterActionData){
			$this->afterActionData=$afterActionData;
		}
		public function convertFormDataToObject($inputList){
			foreach ($inputList as $key => $value) {
				$func = "set".ucfirst($key);
				$this->$func($value);
			}
		}

		public function setModelObjectToDbObject($inputList) {
			$this->convertFormDataToObject($inputList);
			foreach($this as $key => $value) {
				if(!is_object($value)) {
					$this->db->set($key,$value);
				}				
		    }
		}
		
		public function save($inputList){	
			$this->setModelObjectToDbObject($inputList);
			$this->db->insert('activitylog');  			
			return $this->db->insert_id();
		}
		
		public function edit($inputList){
			$this->setModelObjectToDbObject($inputList);
			
		}
		
		public function approve($inputList){
			$this->setModelObjectToDbObject($inputList);
			
		}
		
		public function delete($inputList){
			$this->setModelObjectToDbObject($inputList);
			
		}
	}
?>