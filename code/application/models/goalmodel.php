<?php
	class GoalModel extends CI_Model{

		private $goalId='';
		private $conceptId;
		private $goal;
		private $motivation;
    private $problemId='';
    private $activeStatus;
    private $controlStatus;

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
          * Getter for goalId
          *
          * @return mixed
          */
         public function getGoalId()
         {
             return $this->goalId;
         }
         
         /**
          * Setter for goalId
          *
          * @param mixed $goalId Value to set
         
          * @return self
          */
         public function setGoalId($goalId)
         {
             $this->goalId = $goalId;
             return $this;
         }
         
         /**
          * Getter for goal
          *
          * @return mixed
          */
         public function getGoal()
         {
             return $this->goal;
         }
         
         /**
          * Setter for goal
          *
          * @param mixed $goal Value to set
         
          * @return self
          */
         public function setGoal($goal)
         {
             $this->goal = $goal;
             return $this;
         }

         /**
          * Getter for motivation
          *
          * @return mixed
          */
         public function getMotivation()
         {
             return $this->motivation;
         }
         
         /**
          * Setter for motivation
          *
          * @param mixed $motivation Value to set
         
          * @return self
          */
         public function setMotivation($motivation)
         {
             $this->motivation = $motivation;
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
                  

         public function convertFormDataToObject($inputList){
            foreach ($inputList as $key => $value) {
               $func = "set".ucfirst($key);
               if(method_exists($this,$func)){
                  $this->$func($value);
               }               
            }
         }

         public function setModelObjectToDbObject($inputList) {
            $this->convertFormDataToObject($inputList['goal']);
            foreach($this as $key => $value) {
               if(!is_object($value) && $key!='problemId') {
                  $this->db->set($key,$value);
               }           
             }
         }

         
         
   		
   		public function fetchGoals($problemId,$convertToObject=true) {
      		$this->db->select('goals.goalId,goal,conceptId,motivation,goals.activeStatus,goals.controlStatus');
          $this->db->join('problemgoals','problemgoals.goalId=goals.goalId');
          $this->db->where('problemId',$problemId);
     			$query = $this->db->get('goals');
     			$result = $query->result();
  				$returnList = "";
  				if(isset($result[0])) {
  				foreach ($result as $rindex => $row) {
                 $object = new GoalModel();
              	foreach ($row as $key => $value) {				
                    $func = "set".ucfirst($key);
  						$object->$func($value);	
  					}
                 $returnList[] = $object;
  				}
     			return $returnList;	   						
     		}
      }

      public function getPersonGoals($personId,$convertToObject=true) {
          $this->db->select('goals.goalId,goal,goals.conceptId,motivation,goals.activeStatus,goals.controlStatus');
          $this->db->join('problemgoals','problemgoals.goalId=goals.goalId');
          $this->db->join('problems','problemgoals.problemId=problems.problemId');
          $this->db->where('personId',$personId);
          $query = $this->db->get('goals');
          $result = $query->result();
          $returnList = "";
          if(isset($result[0])) {
          foreach ($result as $rindex => $row) {
                 $object = new GoalModel();
                foreach ($row as $key => $value) {        
                    $func = "set".ucfirst($key);
              $object->$func($value); 
            }
                 $returnList[] = $object;
          }
          return $returnList;               
        }
      }

      public function getGoalDetails($goalId){
         $this->db->select('goals.goalId,goal,conceptId,motivation,problemId,goals.activeStatus,goals.controlStatus');
         $this->db->join('problemgoals','problemgoals.goalId=goals.goalId');
         $this->db->where('goals.goalId',$goalId);
         $query = $this->db->get('goals');
         $result = $query->result();
         foreach ($result[0] as $key => $value) {           
            $func = "set".ucfirst($key);
            $this->$func($value); 
         }
      }

      public function saveGoal($input){
         $this->setModelObjectToDbObject($input);
         if(isset($input['goal']['goalId'])){
            $this->db->where('goalId',$input['goal']['goalId']);
            $this->db->update('goals');
         }else{
            $this->db->insert('goals');
            $goalId = $this->db->insert_id();
            $data = array('goalId'=>$goalId,'problemId'=>$input['goal']['problemId']);
            $this->db->insert('problemgoals',$data);
         }         
      }

      public function delete($goalId){
         $this->db->delete('problemgoals', array('goalId' => $goalId)); 
         $this->db->delete('goals', array('goalId' => $goalId)); 
      }
	}
?>