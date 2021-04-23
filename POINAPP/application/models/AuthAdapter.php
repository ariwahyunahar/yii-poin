<?php
class Model_AuthAdapter
{
	protected $username;
	protected $password;
	protected $user;
	
	
	protected $menu_parents;
	
	public function __construct(){
		
	}
	
	public static function getSessionName()
	{
		return 'poinapp';
	}
	
	public function authenticate($user_id, $poll_id)
	{
		$sessionNamespace = new Zend_Session_Namespace(self::getSessionName());
		$sessionNamespace->array['USER_ID'] = $user_id;
        	$sessionNamespace->array['POLL_ID'] = $poll_id;
		return true;
	}
	
	public static function getSession($name = ''){
		$sessionNamespace = new Zend_Session_Namespace(self::getSessionName());
		$sessionNamespace->array;
	}
	
	public static function getAllSession(){
		$sessionNamespace = new Zend_Session_Namespace(self::getSessionName());
		return $sessionNamespace->array;
	}
	
	public static function logoutSession()
	{
		$sessionNamespace = new Zend_Session_Namespace(self::getSessionName());
		$sessionNamespace->unsetAll();
	}
}
