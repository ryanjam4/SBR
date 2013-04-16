<?php
	class ProblemMetaData extends CI_Model{

		private $guidelineId;
		private $conceptId;
		private $guideline;
		private $problemId;

		function __construct() {
		   parent::__construct();  	
	       $this->load->database();
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
	     * Getter for guideline
	     *
	     * @return mixed
	     */
	    public function getGuideline()
	    {
	        return $this->guideline;
	    }
	    
	    /**
	     * Setter for guideline
	     *
	     * @param mixed $guideline Value to set
	    
	     * @return self
	     */
	    public function setGuideline($guideline)
	    {
	        $this->guideline = $guideline;
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
	    
		
		public function getProblemGuidelines($problemObject) {
			$this->db->select('guidelines.guidelineId,guideline,conceptId,problemId')->from('problemguidelines')->where('problemId',$problemObject->getProblemId());
			$this->db->join('guidelines','guidelines.guidelineId = problemguidelines.guidelineId');
			$query = $this->db->get();
			$result = $query->result();
			$returnObject = array();
			if(isset($result[0])) {				
				foreach ($result as $rindex => $row) {
					$object = new ProblemMetaData();
					foreach ($row as $key => $value) {	
						$func = "set".ucfirst($key);
						$object->$func($value);
					}
					$returnObject[] = $object;
				}
			}
			return $returnObject;
		}
		
		
		
	}

?>