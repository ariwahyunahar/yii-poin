<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $_id;
	public $email;
	public $isAdmin = false;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{		
				
		if (Yii::app()->ldap->authenticate($this->username, $this->password)) {
			$this->errorCode = self::ERROR_NONE;
			$this->_id=$this->username;
			$this->setState('username', $this->username);
			$this->setState('password', $this->password);
			$this->setState('isAdmin', false);
			
			
			
			//$cookie = new CHttpCookie('LtpaToken', '123456');
			//$cookie->domain = '.infomedia.web.id';
			
			//Yii::app()->request->cookies['LtpaToken'] = $cookie; // will send the cookie
			
			
			/*$this->id = AMBIL USERNAME;
			$this->email = AMBIL EMAIL;*/
		} else {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		
		return !$this->errorCode;
		
		/*
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
		*/
		
	}
	
	
	public function getId()
	{
		return $this->_id;
	}
	
	
}