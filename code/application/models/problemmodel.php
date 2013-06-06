<?php

	include_once 'concept.php';
	include_once 'user.php';
	include_once 'problemmetadata.php';

	class ProblemModel extends CI_Model{

		private $problemId='';
		private $personId='';
		private $conceptId='';
		private $activeStatus='1';
		private $startDate='';
		private $endDate='';
		private $controlStatus='0';
		private $guidelineId='0';
		private $notes='';
		private $lastUpdatedBy='-1';
		private $isApproved = '0';
		private $conceptObject = '';
		private $personObject = '';
		private $problemMetaObject = '';	
		
		function __construct() {
		   parent::__construct();  	
	       $this->load->database();
	       $this->conceptObject = new Concept;
	       $this->personObject = new User;
	       $this->problemMetaObject = new ProblemMetaData;	       
   		}

   		/**
   		 * Getter for conceptObject
   		 *
   		 * @return mixed
   		 */
   		public function getConceptObject()
   		{
   		    return $this->conceptObject;
   		}
   		
   		/**
   		 * Setter for conceptObject
   		 *
   		 * @param mixed $conceptObject Value to set
   		
   		 * @return self
   		 */
   		public function setConceptObject($conceptObject)
   		{
   		    $this->conceptObject = $conceptObject;
   		    return $this;
   		}
   		

   		/**
   		 * Getter for personObject
   		 *
   		 * @return mixed
   		 */
   		public function getPersonObject()
   		{
   		    return $this->personObject;
   		}
   		
   		/**
   		 * Setter for personObject
   		 *
   		 * @param mixed $personObject Value to set
   		
   		 * @return self
   		 */
   		public function setPersonObject($personObject)
   		{
   		    $this->personObject = $personObject;
   		    return $this;
   		}
   		

   		/**
   		 * Getter for problemId
   		 *
   		 * @return mixed
   		 */
   		public function getProblemId()
   		{
   		    return $this->problemId;
   		}
   		
   		/**
   		 * Setter for problemId
   		 *
   		 * @param mixed $problemId Value to set
   		
   		 * @return self
   		 */
   		public function setProblemId($problemId)
   		{
   		    $this->problemId = $problemId;
   		    return $this;
   		}
   		
   		/**
   		 * Getter for personId
   		 *
   		 * @return mixed
   		 */
   		public function getPersonId()
   		{
   		    return $this->personId;
   		}
   		
   		/**
   		 * Setter for personId
   		 *
   		 * @param mixed $personId Value to set
   		
   		 * @return self
   		 */
   		public function setPersonId($personId)
   		{
   		    $this->personId = $personId;
   		    return $this;
   		}
   		

   		/**
   		 * Getter for conceptId
   		 *
   		 * @return mixed
   		 */
   		public function getConceptId()
   		{
   		    return $this->conceptId;
   		}
   		
   		/**
   		 * Setter for conceptId
   		 *
   		 * @param mixed $conceptId Value to set
   		
   		 * @return self
   		 */
   		public function setConceptId($conceptId)
   		{
   		    $this->conceptId = $conceptId;
   		    return $this;
   		}
   		
   		/**
   		 * Getter for activeStatus
   		 *
   		 * @return mixed
   		 */
   		public function getActiveStatus()
   		{
   		    return $this->activeStatus;
   		}
   		
   		/**
   		 * Setter for activeStatus
   		 *
   		 * @param mixed $activeStatus Value to set
   		
   		 * @return self
   		 */
   		public function setActiveStatus($activeStatus)
   		{
   		    $this->activeStatus = $activeStatus;
   		    return $this;
   		}
   	
		/**
		* Getter for startDate
		*
		* @return mixed
		*/
		public function getStartDate()
		{
		return date('m/d/Y',strtotime($this->startDate));
		}

		/**
		* Setter for startDate
		*
		* @param mixed $startDate Value to set

		* @return self
		*/
		public function setStartDate($startDate)
		{
		$this->startDate = date('Y-m-d',strtotime($startDate));
		return $this;
		}

		/**
		* Getter for endDate
		*
		* @return mixed
		*/
		public function getEndDate()
		{
		return date('m/d/Y',strtotime($this->endDate));
		}

		/**
		* Setter for endDate
		*
		* @param mixed $endDate Value to set

		* @return self
		*/
		public function setEndDate($endDate)
		{
		$this->endDate = date('Y-m-d',strtotime($endDate));
		return $this;
		}

		/**
		* Getter for controlStatus
		*
		* @return mixed
		*/
		public function getControlStatus()
		{
		return $this->controlStatus;
		}

		/**
		* Setter for controlStatus
		*
		* @param mixed $controlStatus Value to set

		* @return self
		*/
		public function setControlStatus($controlStatus)
		{
		$this->controlStatus = $controlStatus;
		return $this;
		}

		/**
		* Getter for guidelineId
		*
		* @return mixed
		*/
		public function getGuidelineId()
		{
		return $this->guidelineId;
		}

		/**
		* Setter for guidelineId
		*
		* @param mixed $guidelineId Value to set

		* @return self
		*/
		public function setGuidelineId($guidelineId)
		{
		$this->guidelineId = $guidelineId;
		return $this;
		}

		/**
		 * Getter for notes
		 *
		 * @return mixed
		 */
		public function getNotes()
		{
		    return $this->notes;
		}

		/**
		 * Setter for notes
		 *
		 * @param mixed $notes Value to set

		 * @return self
		 */
		public function setNotes($notes)
		{
		    $this->notes = $notes;
		    return $this;
		}

		/**
		 * Getter for isApproved
		 *
		 * @return mixed
		 */
		public function getIsApproved()
		{
		    return $this->isApproved;
		}
		
		/**
		 * Setter for isApproved
		 *
		 * @param mixed $isApproved Value to set
		
		 * @return self
		 */
		public function setIsApproved($isApproved)
		{
		    $this->isApproved = $isApproved;
		    return $this;
		}
		/**
		 * Getter for lastUpdatedBy
		 * @return mixed
		 */
		public function getLastUpdatedBy(){
			return $this->lastUpdatedBy;
		}
		
		/**
		 * Setter for lastUpdatedBy
		 * @param mixed $lastUpdatedBy Value to set
		 * @return self
		 */
		public function setLastUpdatedBy($lastUpdatedBy){
			$this->lastUpdatedBy = $lastUpdatedBy;
		    return $this;
		}

		public function convertFormDataToObject($inputList){
			foreach ($inputList as $key => $value) {
				$func = "set".ucfirst($key);
				$this->$func($value);
			}
		}

		public function setModelObjectToDbObject($inputList) {

			$this->convertFormDataToObject($inputList['problem']);
			foreach($this as $key => $value) {
				if(!is_object($value)) {
					$this->db->set($key,$value);
				}				
		    }
		}

		public function insertProblem($inputList,$id) {			
			$this->personId = $id;
			$this->setModelObjectToDbObject($inputList);
			$this->db->insert('problems');  			
			return $this->db->insert_id();
		}


		public function updateProblem($inputList,$id) {			
			$this->personId = $id;
			$this->setModelObjectToDbObject($inputList);
			$this->db->where('problemId', $this->getProblemId());
			$this->db->update('problems');
		}

		public function approveProblem($problemId) {			
			$this->db->set('isApproved','1');
			$this->db->where('problemId', $problemId);
			$this->db->update('problems');
		}

		public function deleteProblem($problemId) {	

			$this->db->select('medicationId')->where('problemId',$problemId);
			$query = $this->db->from('problemmedications')->get();
			
			$result = $query->result();
			$ids = array();

			foreach ($result as $key => $value) {
				$ids[] = $value->medicationId;	
			}
			
			$this->db->where('problemId', $problemId);
			$this->db->delete('problemmedications'); 

			$this->db->where('problemId', $problemId);
			$this->db->delete('problems'); 

			if(count($ids)>0){
				$this->db->where_in('medicationId', $ids);
				$this->db->delete('medications'); 			
			}			
		}
		public function lastUpdatedBy(){
			$this->db->select('user.login,person.familyName');
			$this->db->from('user');
			$this->db->join('person','user.personId=person.personId','left');
			$this->db->join('problems','problems.lastUpdatedBy=user.personId','left');
			$this->db->where('problems.problemId', $this->problemId);
			$query = $this->db->get();
			$result=$query->result();
			return $result;
		}
		public function getProblemDetails($id) {
			$this->db->select('person.personId,birthDate,givenName,familyName,avatarFilename,problems.conceptId,activeStatus,startDate,endDate,controlStatus,lastUpdate,notes,term,problems.problemId');
			$this->db->join('sct2_description', 'problems.conceptId = sct2_description.conceptId','left');
			$this->db->join('person', 'problems.personId = person.personId','left');
			$this->db->where('problems.problemId', $id);
			$query = $this->db->get('problems');
			$result = $query->result();
			$conceptClassVar = array('term');
			$problemMetaClassVar = array('description');
			$userClassVar = array('personId','birthDate','givenName','familyName','avatarFilename');
			if(isset($result[0])) {
				foreach ($result[0] as $key => $value) {				
					if(in_array($key, $conceptClassVar)){
						$this->conceptObject->setTerm($value);
					}else if(in_array($key, $userClassVar)){
						$func = "set".ucfirst($key);
						$this->personObject->$func($value);
					}else if(in_array($key, $problemMetaClassVar)){
						$func = "set".ucfirst($key);
						$this->problemMetaObject->$func($value);
					}else{
						$this->$key = $value;	
					}					
				}
			}	
		}	
	}
?>