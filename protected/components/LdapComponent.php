<?php

Yii::import('application.vendors.*');
require_once 'Zend/Soap/Client.php';


class LdapComponent extends CApplicationComponent{ 

	public $config;
		
	public  function init() {
		$this->config = array(
			'wsdl' => Yii::app()->params['ldap']['wsdl'],
			'domain' => Yii::app()->params['ldap']['domain'],
		);
	}
	
	public function authenticate($username,$password) {
	
		$wsdl = $this->config['wsdl'];
		$domain = $this->config['domain'];
		
		$getClient = new Zend_Soap_Client($wsdl,null);
		
		$param = array('parameters' => array('vDomain'=>$domain,'vUsername' => $username,'vPassword' => $password));
		$results = $getClient->__call('Logon2LDAP',$param);
		$statusLogin =  $results->Logon2LDAPResult;
		// die($statusLogin);
		if($statusLogin == 'Success'){
			return true;
		} else {
			return false;
		}
		
	}
	
}