<?php
	class FBModel extends CI_Model{
		private $fb_config = ""; 
		function __construct() {
		   parent::__construct();  	
	       $this->load->database();
	       $this->fb_config = array(
			  'appId'  => $this->config->item('fb_app_id'),
			  'secret' => $this->config->item('fb_app_secret')
		    );
		   $this->load->library('facebook', $this->fb_config,'facebook');
   		}

   		function getFbLoginUrl($personId) {
   			$params = array(
			  'scope' =>'read_stream,email,user_birthday,user_likes,user_about_me,user_education_history,user_hometown,user_relationship_details,user_location,user_religion_politics,user_about_me,user_relationships,user_work_history,user_website,user_interests,user_videos,user_activities',
			  'redirect_uri' => base_url("patient/saveFacebookData/{$personId}")
			);
			return $this->facebook->getLoginUrl($params);
   		}

   		function saveFacebookUserData($personId) {
   			$fields = array('id','name','first_name','last_name'

			,'gender','languages','link','username','age_range',

			'bio','birthday','cover','currency','devices','education',

			'email','hometown','interested_in','location','political',

			'favorite_athletes','favorite_teams','quotes','relationship_status',

			'religion','significant_other','video_upload_limits','website','work'

			);
			$fieldsString = implode(",",$fields);
			$fbAccessToken = $this->session->userdata('fbAccessToken');
			$this->facebook->setAccessToken($fbAccessToken);

			$batch = array();
			
			$req = array(
		    	'method'       => 'GET',
		    	'relative_url' => "/me?fields={$fieldsString}"
			);
			$batch[] = json_encode($req);
			$fbObjects = array('music','movies','games','interests','television','likes','activities');
			foreach ($fbObjects as $key => $value) {
				$req = array(
		    		'method'       => 'GET',
		    		'relative_url' => "/me/{$value}?limit=5000"
				);
				$batch[] = json_encode($req);
			}
		    $params = array(
			    'batch' => '[' . implode(',',$batch) . ']'
			);
			
			try {
				$info = $this->facebook->api('/','POST',$params);				
				$user_details = json_decode($info[0]['body']);

			    $this->db->delete('fbbooks', array('fbId' => $user_details->id)); 
			    $this->db->delete('fbmusic', array('fbId' => $user_details->id)); 
			    $this->db->delete('fbmovies', array('fbId' => $user_details->id)); 
			    $this->db->delete('fbinterests', array('fbId' => $user_details->id)); 
			    $this->db->delete('fbtelevision', array('fbId' => $user_details->id)); 
			    $this->db->delete('fblikes', array('fbId' => $user_details->id)); 
			    $this->db->delete('fbactivities', array('fbId' => $user_details->id)); 
			    $this->db->delete('fbgames', array('fbId' => $user_details->id)); 
				foreach ($info as $key => $value) {
					if($key == 0) {
						continue;
					}
					$itemData = json_decode($value['body']); 	
					if(count($itemData->data)>0){
						$this->storeFbObjectsToDB($itemData,$personId,$user_details->id,'fb'.$fbObjects[$key-1]);
					}
				}
				
			}catch(FacebookApiException $e) {
			    print_r($e);
			    $info = null;
			}
		    $query = "INSERT INTO fbuser (`userId`, `fbId`, `firstName`, `lastName`, `username`, `sex`, `birthDate`, `website`, `email`, `quotes`, `interested_in`,`cover`) VALUES ('',?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE firstName=?";
		    $queryValArr = @array($user_details->id,$user_details->first_name, $user_details->last_name,$user_details->username,$user_details->gender,$user_details->birthday,$user_details->website,$user_details->email,$user_details->quotes,$user_details->interested_in,$coverImg,$user_details->first_name); 
		    $this->db->query($query,$queryValArr);
   		}

   		public function storeFbObjectsToDB($input,$personId,$fbId,$tablename) {
   			$data = array();
   			foreach ($input->data as $key => $value) {
   				$data[] = array('personId'=>$personId,'fbId'=>$fbId,'name'=>$value->name);
			}
			$this->db->insert_batch($tablename, $data); 
   		}

   		public function getFacebookAccessToken($personId) {   			
			try {
   				$token_url = "https://graph.facebook.com/oauth/access_token?client_id=".$this->fb_config['appId']."&redirect_uri=".urlencode(base_url("patient/saveFacebookData/{$personId}"))."&client_secret=".$this->fb_config['secret']."&code=".$_REQUEST['code'];
		    	$response = @file_get_contents($token_url);      
		    	if ($response === FALSE) {
         		  return true;
        		}
		    	$params = null;
     			parse_str($response, $params);
     			$this->session->set_userdata('fbAccessToken',$params['access_token']);
     		}catch(FacebookApiException $e) {

			}	
   		}

   		public function fetchUserFacebookData($personId) {
   			$limit = 10;
   			$offset = 0;
   			$response = array();

   			$query = $this->db->select('name')->get_where('fbmusic', array('personId' => $personId), $limit, $offset);
   			$response['Music'] = $query->result();

   			$query = $this->db->select('name')->get_where('fbmovies', array('personId' => $personId), $limit, $offset);
   			$response['Movies'] = $query->result();

   			$query = $this->db->select('name')->get_where('fbbooks', array('personId' => $personId), $limit, $offset);
   			$response['Books'] = $query->result();

   			$query = $this->db->select('name')->get_where('fblikes', array('personId' => $personId), $limit, $offset);
   			$response['Likes'] = $query->result();

   			$query = $this->db->select('name')->get_where('fbtelevision', array('personId' => $personId), $limit, $offset);
   			$response['Television'] = $query->result();

   			$query = $this->db->select('name')->get_where('fbinterests', array('personId' => $personId), $limit, $offset);
   			$response['Interests'] = $query->result();

   			$query = $this->db->select('name')->get_where('fbactivities', array('personId' => $personId), $limit, $offset);
   			$response['Activities'] = $query->result();

   			$query = $this->db->select('name')->get_where('fbgames', array('personId' => $personId), $limit, $offset);
   			$response['Games'] = $query->result();

   			return $response;
   		}   		
	}
?>