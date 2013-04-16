<?php
	class Permission extends CI_Model{
		var $rolePermisionList = array(
			'1' => 
			array('read_all_user_data','update_all_user_data','delete_all_user_data','create_user'
				,'read_demograph_data','update_demograph_data','delete_demograph_data',
				'add_problem','delete_problem','add_goal','delete_goal','add_medication','update_problem','update_medication','view_content'
				),
			'3' => 
			array('read_demograph_data','update_demograph_data','delete_demograph_data','edit_profile')
		);

		var $subRolePermisionList = array(
			'1' => array('add_problem','add_medication','add_goal','delete_goal','edit_profile','update_problem','update_medication','view_content'),
			'2' => array('view_content'),
			'3' => array('read_demograph_data','edit_profile')
		); 

		public function checkUserPermission($roleId,$permision) {
			if($roleId == '2'){
				return in_array($permision, $this->subRolePermisionList[$this->getSubRoleID()]);
			}else{
				return in_array($permision, $this->rolePermisionList[$roleId]);
			}			
		}

		function getSubRoleID() {
       	  return $this->session->userdata("userSubRole");
      	}	

	}
?>