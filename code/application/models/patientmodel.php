<?php
	include_once 'concept.php';
	include_once 'user.php';
	include_once 'problemmodel.php';
	class PatientModel extends CI_Model{
		
		private $personObject;
		private $problemObject;
		private $conceptObject;
		private $needToKnow;
    private $likeToKnow;

		function __construct() {
		   parent::__construct();  	
	       $this->load->database();
	       $this->conceptObject = new Concept;
	       $this->personObject = new User;
	       $this->problemObject = new problemModel();
   		} 

   		/**
   		 * Getter for problemObject
   		 *
   		 * @return mixed
   		 */
   		public function getProblemObject()
   		{
   		    return $this->problemObject;
   		}
   		
   		/**
   		 * Setter for problemObject
   		 *
   		 * @param mixed $problemObject Value to set
   		
   		 * @return self
   		 */
   		public function setProblemObject($problemObject)
   		{
   		    $this->problemObject = $problemObject;
   		    return $this;
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
       * Getter for needToKnow
       *
       * @return mixed
       */
      public function getNeedToKnow()
      {
          return $this->needToKnow;
      }
      
      /**
       * Setter for needToKnow
       *
       * @param mixed $needToKnow Value to set
      
       * @return self
       */
      public function setNeedToKnow($needToKnow)
      {
          $this->needToKnow = $needToKnow;
          return $this;
      }

      /**
       * Getter for likeToKnow
       *
       * @return mixed
       */
      public function getLikeToKnow()
      {
          return $this->likeToKnow;
      }
      
      /**
       * Setter for likeToKnow
       *
       * @param mixed $likeToKnow Value to set
      
       * @return self
       */
      public function setLikeToKnow($likeToKnow)
      {
          $this->likeToKnow = $likeToKnow;
          return $this;
      }
      
      
      
   	
      public function processProblemDetails($result) {

         $returnObject = array();
         $conceptClassVar = array('term');
         $userClassVar = array('personId','birthDate','coverImage','givenName','familyName','avatarFilename');
         $patientClassVar = array('needToKnow','likeToKnow');
         if(isset($result[0])) {
            foreach ($result as $rindex => $row) {
              $patientObject = new PatientModel(); 
              foreach ($row as $key => $value) {            
               if(in_array($key, $conceptClassVar)){
                  $patientObject->conceptObject->setTerm($value);
               }else if(in_array($key, $userClassVar)){
                  $func = "set".ucfirst($key);
                  $patientObject->personObject->$func($value);
               }else if(in_array($key, $patientClassVar)){
                  $func = "set".ucfirst($key);
                  $patientObject->$func($value);
               }else{
                  $func = "set".ucfirst($key);
                  $patientObject->problemObject->$func($value);
               }              
            }
            $returnObject[] = $patientObject;
           }
         }
         return $returnObject;
      }	

		public function getPatientDetails($userId) {

			$this->db->select('person.personId,coverImage,birthDate,givenName,familyName,needToKnow,likeToKnow,avatarFilename,term,controlStatus,problems.problemId,isApproved');
			$this->db->from('person')->join('personnarrative', 'person.personId = personnarrative.personId', 'left');
			$this->db->join('problems','person.personId = problems.personId and problems.activeStatus = 1 and problems.isApproved = 1', 'left');
			$this->db->join('sct2_description','problems.conceptId = sct2_description.conceptId and sct2_description.typeId like "%1"', 'left');
      	$this->db->where('person.personId',$userId);
			$this->db->order_by("controlStatus", "desc"); 
			$query = $this->db->get();

			$result = $query->result();	
			return $this->processProblemDetails($result);
		}

      public function getUnApprovedProblems($userId) {
         $this->db->select('term,controlStatus,problems.problemId,isApproved,problems.personId');
         $this->db->from('problems')->join('sct2_description','problems.conceptId = sct2_description.conceptId and sct2_description.typeId like "%1"', 'left');
         $this->db->where('problems.personId',$userId)->where('problems.isApproved','0');
         $this->db->order_by("controlStatus", "desc"); 
         $query = $this->db->get();

         $result = $query->result();         
         return $this->processProblemDetails($result);
      }

      public function savePersonNarrative($data){
         $data = array(
            'personId' => $data['personId'],
            "needToKnow" => trim(preg_replace('/\s+/', ' ', $data['needToKnow'])),            
            "likeToKnow" => trim(preg_replace('/\s+/', ' ', $data['likeToKnow'])),
            "needToKnow1" => trim(preg_replace('/\s+/', ' ', $data['needToKnow'])),
            "likeToKnow1" => trim(preg_replace('/\s+/', ' ', $data['likeToKnow']))
         );

         $query = "INSERT INTO personnarrative (`id`, `personId`, `needToKnow`,`likeToKnow`) VALUES ('',?,?,?) ON DUPLICATE KEY UPDATE needToKnow=?,likeToKnow=?";

         $this->db->query($query, $data); 
      }

      public function savePatientImage($data){
         $this->db->set('coverimage', trim(preg_replace('/\s+/', ' ', $data['patient_image_file_path'])));         
         $this->db->where('personId', $data['personId']);
         $this->db->update('person'); 
      }
	}
?>