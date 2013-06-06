<?php
	include_once 'concept.php';
	include_once 'user.php';
	class MedicationModel extends CI_Model{

		private $medicationId='';
		private $personId='';
		private $conceptId='';
		private $activeStatus='1';
		private $startDate='';
		private $endDate='';
		private $orderId='';
		private $notes='';
		private $isApproved = '0';
		private $startedBy = '';
		private $conceptObject = '';
		private $personObject = '';


		function __construct() {
		   parent::__construct();  	
	       $this->load->database();
	       $this->conceptObject = new Concept;
	       $this->personObject = new User;
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
   		 * Getter for medicationId
   		 *
   		 * @return mixed
   		 */
   		public function getMedicationId()
   		{
   		    return $this->medicationId;
   		}
   		
   		/**
   		 * Setter for medicationId
   		 *
   		 * @param mixed $medicationId Value to set
   		
   		 * @return self
   		 */
   		public function setMedicationId($medicationId)
   		{
   		    $this->medicationId = $medicationId;
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
		* Getter for orderId
		*
		* @return mixed
		*/
		public function getOrderId()
		{
		return $this->orderId;
		}

		/**
		* Setter for orderId
		*
		* @param mixed $orderId Value to set

		* @return self
		*/
		public function setOrderId($orderId)
		{
		$this->orderId = $orderId;
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
		 * Getter for startedBy
		 *
		 * @return mixed
		 */
		public function getStartedBy()
		{
		    return $this->startedBy;
		}
		
		/**
		 * Setter for startedBy
		 *
		 * @param mixed $startedBy Value to set
		
		 * @return self
		 */
		public function setStartedBy($startedBy)
		{
		    $this->startedBy = $startedBy;
		    return $this;
		}
		
		

		public function convertFormDataToObject($inputList){
			$conceptClassVar = array('term');
			foreach ($inputList as $key => $value) {
				if(in_array($key, $conceptClassVar)){
					$this->conceptObject->setTerm($value);
				}else{
					$func = "set".ucfirst($key);
					$this->$func($value);
				}				
			}
		}

		private function setModelObjectToDbObject($inputList) {
			$this->convertFormDataToObject($inputList['medication']);
			foreach($this as $key => $value) {
				if(!is_object($value)) {
					$this->db->set($key,$value);
				}				
		    }
		}


		public function insertMedication($inputList,$id) {			
			$this->personId = $id;
			$this->setModelObjectToDbObject($inputList);
			$this->db->insert('medications');  		
			return $this->db->insert_id();	
		}

		public function updateMedication($inputList,$id) {			
			$this->personId = $id;
			$this->setModelObjectToDbObject($inputList);
			$this->db->where('medicationId', $this->getMedicationId());
			$this->db->update('medications');  		
		}

		public function deleteMedication($medicationId) {	

			$this->db->where('medicationId', $medicationId);
			$this->db->delete('problemmedications'); 

			$this->db->where('medicationId', $medicationId);
			$this->db->delete('medications'); 			
		}

		public function saveMedicationForProblem($medicationId,$problemId) {
			$this->db->set("problemId",$problemId);
			$this->db->set("medicationId",$medicationId);
			$this->db->insert('problemmedications');
		}

		public function approveMedication($medicationId) {			
			$this->db->set('isApproved','1');
			$this->db->where('medicationId', $medicationId);
			$this->db->update('medications');
		}

		public function getMedicationDetails($id) {
			$this->db->select('medicationId,person.personId,birthDate,givenName,avatarFilename,familyName,medications.conceptId,activeStatus,startDate,endDate,lastUpdate,notes,term,startedBy');
			$this->db->join('sct2_description', 'medications.conceptId = sct2_description.conceptId','left');
			$this->db->join('person', 'medications.personId = person.personId','left');
			$this->db->where('medications.medicationId', $id);
			$query = $this->db->get('medications');
			$result = $query->result();				
			return $this->parseDbObjects($result);
		}

		public function getMedicationRelatedToProblem($id,$isApproved='1') {
			$this->db->select('medications.medicationId,medications.conceptId,activeStatus,startDate,endDate,notes,term,startedBy');	
			$this->db->join('sct2_description', 'medications.conceptId = sct2_description.conceptId','left');
			$this->db->join('problemmedications', 'problemmedications.medicationId = medications.medicationId','left');
			$this->db->where('problemmedications.problemId',$id)->where('isApproved',$isApproved);
			$this->db->where('sct2_description.active',1);
			$query = $this->db->get('medications');
			$result = $query->result();
			return $this->parseDbObjects($result);
		}

		public function parseDbObjects($result) {
			$conceptClassVar = array('term');
			$userClassVar = array('personId','birthDate','givenName','familyName','avatarFilename');
			$dataObjects = array();
			if(isset($result[0])) {
				foreach ($result as $rindex => $row) {
				  $object = new MedicationModel();	
				  foreach ($row as $key => $value) {				
					if(in_array($key, $conceptClassVar)){
						$object->conceptObject->setTerm($value);
					}else if(in_array($key, $userClassVar)){
						$func = "set".ucfirst($key);
						$object->personObject->$func($value);
					}else{
						$object->$key = $value;	
					}					
				}
				$dataObjects[] = $object;
			 }
			}
			return $dataObjects;
		}	
	}
?>	