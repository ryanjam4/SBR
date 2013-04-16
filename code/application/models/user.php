<?php
class user extends CI_Model{
		
		private $personId;
		private $login;
		private $password;
		private $DGPassword;
		private $OVPassword;
		private $role;
		private $givenName;
		private $familyName;
		private $middleName;
		private $avatarFilename;
		private $coverImage;
		private $birthDate;
		private $addressLine1;
		private $city;
		private $county;
		private $state;
		private $zip4;
		private $country;
		private $sex;
		private $contactNumber;
		private $emailAddress;
		private $areaCode;
		private $exchangeCode;
		private $localNumber;
		private $localExtension;
	 
		function __construct() {
		   parent::__construct();  	
	       $this->load->database();
   		} 

		public function setPersonId( $personId )
		{
			$this->personId = $personId;
		}

		public function setLogin( $login )
		{
			$this->login = $login;
		}

		public function setPassword( $password )
		{
			$this->password = $password;
		}

		public function setRole( $role )
		{
			$this->role = $role;
		}

		public function getPersonId()
		{
			return $this->personId;
		}

		public function getLogin()
		{
		 	return $this->login;
		}

		public function getPassword()
		{
		 	return $this->password;
		}

		public function getRole()
		{
		 	return $this->role;
		}


		public function setGivenName( $givenName )
		{
			$this->givenName = $givenName;
		}

		public function setFamilyName( $familyName )
		{
			$this->familyName = $familyName;
		}

		public function setMiddleName( $middleName )
		{
			$this->middleName = $middleName;
		}

		public function setBirthDate( $birthDate )
		{
			$this->birthDate = date('Y-m-d',strtotime($birthDate));
		}

		public function setAddressLine1( $addressLine1 )
		{
			$this->addressLine1 = $addressLine1;
		}

		public function setCity( $city )
		{
			$this->city = $city;
		}

		public function setCounty( $county )
		{
			$this->county = $county;
		}

		public function setState( $state )
		{
			$this->state = $state;
		}

		public function setZip4( $zip4 )
		{
			$this->zip4 = $zip4;
		}

		public function setCountry( $country )
		{
			$this->country = $country;
		}

		public function setSex( $sex )
		{
			$this->sex = $sex;
		}

		public function setContactNumber( $contactNumber )
		{
			$this->contactNumber = $contactNumber;
		}

		public function setEmailAddress( $emailAddress )
		{
			$this->emailAddress = $emailAddress;
		}

		public function getGivenName()
		{
		 	return $this->givenName;
		}

		public function getFamilyName()
		{
		 	return $this->familyName;
		}

		public function getMiddleName()
		{
		 	return $this->middleName;
		}

		public function getBirthDate()
		{
		 	return date('m/d/Y',strtotime($this->birthDate));
		}

		public function getAddressLine1()
		{
		 	return $this->addressLine1;
		}

		public function getCity()
		{
		 	return $this->city;
		}

		public function getCounty()
		{
		 	return $this->county;
		}

		public function getState()
		{
		 	return $this->state;
		}

		public function getZip4()
		{
		 	return $this->zip4;
		}

		public function getCountry()
		{
		 	return $this->country;
		}

		public function getSex()
		{
		 	return $this->sex;
		}

		public function getContactNumber()
		{
		 	return $this->contactNumber;
		}

		public function getEmailAddress()
		{
		 	return $this->emailAddress;
		}

		public function setDGPassword( $DGPassword )
		{
			$this->DGPassword = $DGPassword;
		}

		public function setOVPassword( $OVPassword )
		{
			$this->OVPassword = $OVPassword;
		}

		public function setAvatarFilename( $avatarFilename )
		{
			$this->avatarFilename = $avatarFilename;
		}

		public function getDGPassword()
		{
		 	return $this->DGPassword;
		}

		public function getOVPassword()
		{
		 	return $this->OVPassword;
		}

		public function getAvatarFilename()
		{
		 	return $this->avatarFilename;
		}

		/**
		 * Getter for coverImage
		 *
		 * @return mixed
		 */
		public function getCoverImage()
		{
		    return $this->coverImage;
		}
		
		/**
		 * Setter for coverImage
		 *
		 * @param mixed $coverImage Value to set
		
		 * @return self
		 */
		public function setCoverImage($coverImage)
		{
		    $this->coverImage = $coverImage;
		    return $this;
		}
		


		public function populateClassMembers($inputList) {
			foreach ($inputList as $key => $value) {
				$func = "set".ucfirst($key);
				$this->$func($value);
			}
		}

		/**
		 * Getter for areaCode
		 *
		 * @return mixed
		 */
		public function getAreaCode()
		{
		    return $this->areaCode;
		}
		
		/**
		 * Setter for areaCode
		 *
		 	* @param mixed $areaCode Value to set
		
		 * @return self
		 */
		public function setAreaCode($areaCode)
		{
		    	$this->areaCode = $areaCode;
		    return $this;
		}

		/**
		 * Getter for exchangeCode
		 *
		 * @return mixed
		 */
		public function getExchangeCode()
		{
		    return $this->exchangeCode;
			}
		
		/**
		 * Setter for exchangeCode
		 *
		 * @param mixed $exchangeCode Value to set
		
		 * @return self
		 */
		public function setExchangeCode($exchangeCode)
		{
		    $this->exchangeCode = $exchangeCode;
		    return $this;
		}

		/**
		 * Getter for localNumber
		 *
		 * @return mixed
		 */
		public function getLocalNumber()
		{
		    return $this->localNumber;
		}
		
			/**
		 * Setter for localNumber
		 *
		 * @param mixed $localNumber Value to set
		
		 * @return self
		 */
		public function setLocalNumber($localNumber)
		{
		    $this->localNumber = $localNumber;
		    return $this;
		}
			
			
		/**
		 * Getter for localExtension
		 *
		 * @return mixed
		 */
		public function getLocalExtension()
		{
		    return $this->localExtension;
		}
		
			/**
		 * Setter for localExtension
		 *
		 * @param mixed $localExtension Value to set
		
		 * @return self
		 */
		public function setLocalExtension($localExtension)
		{
		    $this->localExtension = $localExtension;
		    return $this;
		}
							

		public function saveUser() {
			// storing data in user table
		    $data = array();
		    $data['personId'] = $this->personId;
		    $data['login'] = $this->login;
		    $data['password'] = $this->password;
		    $data['role'] = $this->role;
		    $data['DGPassword'] = $this->DGPassword;
		    $data['OVPassword'] = $this->OVPassword;
			$this->db->insert('user',$data);  

			$personId = $this->db->insert_id();

			// storing data in person table
			$data = array();
		    $data['personId'] = $personId;
		    $data['givenName'] = $this->givenName;
		    $data['middleName'] = $this->middleName;
		    $data['familyName'] = $this->familyName;
		    $data['birthDate'] = $this->birthDate;
		    $data['avatarFilename'] = $this->avatarFilename;
		    $data['sex'] = $this->sex;
			$this->db->insert('person',$data);  

			//storing data in  email table
			
			$result = $this->db->select('emailId')->from('email')->where('emailAddress',$this->emailAddress)->get()->result();

			if(isset($result[0]->emailId)){
				$personEmailId = $result[0]->emailId;
			}else{
				$data = array();
			    $data['emailAddress'] = $this->emailAddress;
			    $this->db->insert('email',$data);
			    $personEmailId = $this->db->insert_id();	
			}			
			
			//storing data in person email table
			$data = array();
			$data['personId'] = $personId;
		    $data['emailId'] = $personEmailId;
		    $this->db->insert('personemail',$data);

		    $result = $this->db->select('addressId')->from('address')->where('addressLine1',$this->addressLine1)->where('city',$this->city)->where('state',$this->state)->where('county',$this->county)->where('zip4',$this->zip4)->get()->result();

		    if(!isset($result[0]->addressId)){
			    $data = array();
				$data['addressId'] = '';
			    $data['addressLine1'] = $this->addressLine1;
			    $data['city'] = $this->city;
			    $data['state'] = $this->state;
			    $data['county'] = $this->county;
			    $data['zip4'] = $this->zip4;
			    $this->db->insert('address',$data);  
			    $addressId = $this->db->insert_id();
			}else{
				$addressId = $result[0]->addressId;
			}   

		    $data = array();
		    $data['personId'] = $personId;
			$data['addressId'] = $addressId;
			$this->db->insert('personaddress',$data);


			$result = $this->db->select('phoneId')->from('phone')->where('areaCode',$this->areaCode)->where('exchangeCode',$this->exchangeCode)->where('localNumber',$this->localNumber)->where('localExtension',$this->localExtension)->get()->result();
			
			if(!isset($result[0]->phoneId)){
				$data = array();
				$data['phoneId'] = '';
			    $data['areaCode'] = $this->areaCode;
			    $data['exchangeCode'] = $this->exchangeCode;
			    $data['localNumber'] = $this->localNumber;
			    $data['localExtension'] = $this->localExtension;
			    $this->db->insert('phone',$data);  
			    $phoneId = $this->db->insert_id();
			}else{
				$phoneId = $result[0]->phoneId;
			}   

		    $data = array();
		    $data['personId'] = $personId;
			$data['phoneId'] = $phoneId;
			$this->db->insert('personphone',$data);
			return $personId;
		}

		public function listUsers($pageNo,$sortBy,$sortOrder,$allUsers=true) {
			
			$limit = $this->config->item('userPageLimit');
			$offset = (($pageNo-1)*$limit);
			$this->db->select('person.personId,givenName,familyName,middleName,birthDate,login,areaCode,exchangeCode,localNumber,sex')->limit(30,0);
			
			if($allUsers){
				$this->db->join('user','person.personId=user.personId','left');
			}else{
				$this->db->join('user','person.personId=user.personId and user.role != 1','left');
			}			
			
			$this->db->join('personphone', 'person.personId = personphone.personId','left');
			$this->db->join('phone','phone.phoneId=personphone.phoneId','left');
			$this->db->order_by($sortBy, $sortOrder);
			$this->db->limit($limit, $offset);
			$query = $this->db->get('person');
			$userList = array();
			foreach ($query->result() as $key => $value) {
				$userObj = new user();
				foreach ($value as $row => $result) {
					$userObj->$row = $result;	
				}
				$userList[] = $userObj;
			}			

			if($allUsers){
				$totalCnt = $this->db->count_all('person');
			}else{
				$totalCnt = $this->db->where_not_in('role','1')->count_all_results('user');
			}

			$responseObject = array('userList'=>$userList,'totalCnt'=>$totalCnt); 
			return $responseObject;
		}

		public function validateUserLogin($input) {
			$where = "login = '{$input['login']}' AND (password='{$input['password']}' OR DGPassword='{$input['password']}' OR OVPassword='{$input['password']}')";
			$this->db->where($where);
			$query = $this->db->get('user');
			$result = $query->result();
			$userObj = new user();
			if(isset($result[0])) {
				foreach ($result[0] as $key => $value) {				
					$userObj->$key = $value;	
				}

				if($input['password'] == $userObj->getDGPassword()) {
					$this->session->set_userdata('userSubRole','3');
				}else if($input['password'] == $userObj->getOVPassword()){
					$this->session->set_userdata('userSubRole','2');
				}else{
					$this->session->set_userdata('userSubRole','1');
				}
			}
			return $userObj;
		}

		public function deleteUser($inputList) {
			$this->db->delete('user', array('personId' => $inputList['user_id'])); 
			$this->db->delete('person', array('personId' => $inputList['user_id'])); 
		}

		public function updateUser($input) {
			$updateSql = array();$updateInput = array();
			
			if(!empty($input['password'])){
				$updateSql[] = "password = ?"; 
				$updateInput[] = $input['password'];
			}

			if(!empty($input['DGPassword'])){
				$updateSql[] = "DGPassword = ?"; 
				$updateInput[] = $input['DGPassword'];
			}

			if(!empty($input['OVPassword'])){
				$updateSql[] = "OVPassword = ?"; 
				$updateInput[] = $input['OVPassword'];
			}

			if(count($updateInput)>0){
				$sql = "update user set ".implode(",", $updateSql)." where personId=?";
				$updateInput[] = $input['personId'];
				$this->db->query($sql,$updateInput);
			}

			if(isset($input['person']['birthDate'])) {
				$input['person']['birthDate'] = date('Y-m-d',strtotime($input['person']['birthDate']));
			}

			$this->db->where('personId', $input['personId'])->update('person', $input['person']); 
	
			$sql = 'update address set addressLine1 = ?,city=?,county=?,state=?,zip4=? where addressId = (select addressId from personaddress where personId=?)';
			$this->db->query($sql, array($input['personaddress']['addressLine1'],$input['personaddress']['city'],$input['personaddress']['county'],$input['personaddress']['state'],$input['personaddress']['zip4'],$input['personId'] )); 
	
			$sql = 'update phone set areaCode = ?,exchangeCode=?,localNumber=? where phoneId = (select phoneId from personphone where personId=?)';	
			$this->db->query($sql, array($input['personphone']['areaCode'],$input['personphone']['exchangeCode'],$input['personphone']['localNumber'],$input['personId'] )); 
	
			$sql = 'update email set emailAddress = ? where emailId = (select emailId from personemail where personId=?)';	
			$this->db->query($sql, array($input['personemail']['emailAddress'],$input['personId'] )); 
		}

		public function getUserById($userId) {
			$this->db->select('person.personId,user.role,givenName,middleName,familyName,sex,birthDate,addressLine1,addressLine2,city,state,county,zip4,areaCode,exchangeCode,localNumber,emailAddress,avatarFilename')->where('person.personId',$userId);
			$this->db->from('person');			
			
			$this->db->join('user','user.personId = person.personId');

			$this->db->join('personaddress', 'person.personId = personaddress.personId','left');
			$this->db->join('address','personaddress.addressId=address.addressId','left');
			
			$this->db->join('personphone', 'person.personId = personphone.personId','left');
			$this->db->join('phone','phone.phoneId=personphone.phoneId','left');

			$this->db->join('personemail', 'person.personId = personemail.personId','left');
			$this->db->join('email','email.emailId=personemail.emailId','left');



			$query = $this->db->get();
			$result = $query->result();

			$userObj = new user();
			if(isset($result[0])) {
				foreach ($result[0] as $key => $value) {				
					$userObj->$key = $value;	
				}
			}
			return $userObj;
		}

		
}

?>