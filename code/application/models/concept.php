<?php
	class Concept extends CI_Model{

		private $moduleId;
		private $conceptId;
		private $typeId;
		private $term;
		private $caseSignificanceId;
		private $languageCode;


		function __construct() {
		   parent::__construct();  	
	       $this->load->database();
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
   		 * Getter for moduleId
   		 *
   		 * @return mixed
   		 */
   		public function getModuleId()
   		{
   		    return $this->moduleId;
   		}
   		
   		/**
   		 * Setter for moduleId
   		 *
   		 * @param mixed $moduleId Value to set
   		
   		 * @return self
   		 */
   		public function setModuleId($moduleId)
   		{
   		    $this->moduleId = $moduleId;
   		    return $this;
   		}
   		
   		/**
   		 * Getter for typeId
   		 *
   		 * @return mixed
   		 */
   		public function getTypeId()
   		{
   		    return $this->typeId;
   		}
   		
   		/**
   		 * Setter for typeId
   		 *
   		 * @param mixed $typeId Value to set
   		
   		 * @return self
   		 */
   		public function setTypeId($typeId)
   		{
   		    $this->typeId = $typeId;
   		    return $this;
   		}
   		
   		/**
   		 * Getter for term
   		 *
   		 * @return mixed
   		 */
   		public function getTerm()
   		{
   		    return $this->term;
   		}
   		
   		/**
   		 * Setter for term
   		 *
   		 * @param mixed $term Value to set
   		
   		 * @return self
   		 */
   		public function setTerm($term)
   		{
   		    $this->term = $term;
   		    return $this;
   		}
   		
   		/**
   		 * Getter for languageCode
   		 *
   		 * @return mixed
   		 */
   		public function getLanguageCode()
   		{
   		    return $this->languageCode;
   		}
   		
   		/**
   		 * Setter for languageCode
   		 *
   		 * @param mixed $languageCode Value to set
   		
   		 * @return self
   		 */
   		public function setLanguageCode($languageCode)
   		{
   		    $this->languageCode = $languageCode;
   		    return $this;
   		}
   		
   		/**
   		 * Getter for caseSignificanceId
   		 *
   		 * @return mixed
   		 */
   		public function getCaseSignificanceId()
   		{
   		    return $this->caseSignificanceId;
   		}
   		
   		/**
   		 * Setter for caseSignificanceId
   		 *
   		 * @param mixed $caseSignificanceId Value to set
   		
   		 * @return self
   		 */
   		public function setCaseSignificanceId($caseSignificanceId)
   		{
   		    $this->caseSignificanceId = $caseSignificanceId;
   		    return $this;
   		}
   		
   		public function fetchProblems($term,$convertToObject=true) {
      		$this->db->select()->like('term',$term)->where('sct2_description.typeId like "%1"');
   			$query = $this->db->get('sct2_description',10,0);
   			$result = $query->result();
   			if($convertToObject){
   				$object = new Concept();
   				if(isset($result[0])) {
   					foreach ($result as $key => $value) {				
   						$object->$key = $value;	
   					}
   				}
   				return $object;	
   			}else{
   				$returnList = array();
   				foreach ($result as $key => $value) {	
   					$returnList[$key]['term'] = $value->term;	
                  $returnList[$key]['conceptId'] = $value->conceptId; 
   				}
   				return $returnList;	
   			}			
   		}
	}
?>