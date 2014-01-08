<?php 
class fbsession{
	public $loader;
	public $session_key;
	public $facebook;
	public $user;
	public $my_session;
	
    function fbsession()
    {
		//start the session
		session_start();	
		header('P3P: CP=\"IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA\"');
		
		$this->loader =& get_instance();
		$me = '';

		$params = array('appId' =>APP_ID,'secret' =>APP_SECRET,'cookie' => true);
		$this->loader->load->library('facebook',$params);
		
		$loginparams = array('canvas' => 1,'fbconnect' => 1,'redirect_uri' =>RETURN_URL,'response_type' => 'code token','scope' => array('user_about_me,user_birthday,email,publish_stream'));
		$loginUrl = $this->loader->facebook->getLoginUrl($loginparams);
		
		
		$signed_request = $this->loader->facebook->getSignedRequest();
		$user = $this->loader->facebook->getUser();
		$access_token = $this->loader->facebook->getAccessToken();
		
		if ($user) {
			try {
				$uid = $this->loader->facebook->getUser();
				$me = $this->loader->facebook->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
			}
		}
		
		if ($me):
			$this->session_key = $access_token;
		else:
			$this->redirectjs($loginUrl);
			exit;
		endif;
	}
	
		
	function getUser_id(){
		$user_id = $this->loader->facebook->getUser();
		return $user_id;
	}
	
	function access_token(){
		$accesstoken=$this->loader->facebook->getAccessToken();
		return $accesstoken;
	}
			
	function redirectjs($url){
		echo "<script type='text/javascript'>window.top.location.href = '$url';</script>";
		exit;
	}
	
	function getUserFeed($user_id){
		$query = $this->loader->facebook->api("/".$user_id."/feed");
		return $query;	
	}
	
	function getFeedPhoto($id){
		$query = $this->loader->facebook->api("/".$id);
		return $query;	
	}
		
	
		
	
}
?>