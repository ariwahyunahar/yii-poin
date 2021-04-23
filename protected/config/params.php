<?php
	return array(
		'ldap' => array(
			// 'wsdl' => 'http://wsldap.mdmedia.co.id/LDAP/Service.asmx?wsdl',
			// 'domain' => 'LDAP://jkta01.mdmedia.co.id:389/o=mdmedia',
			'wsdl' => 'http://172.19.28.237/index.php/index?wsdl',
			// 'domain' => 'LDAP://mdldap.mdmedia.co.id:389/o=mdmedi',
			'domain' => 'ldap://notadinas.mdmedia.co.id:389/o=mdmedia',
			'dominoUrl' => 'https://notadinas.mdmedia.co.id/names.nsf?Login',
		),
		'listPerPage' => 20,
		'docBrowser' => array(
			'root' => 'assets/doc/',
			'url' => 'assets/doc/'
		),
		'docBrowsergm' => array(
			'root' => 'assets/kh/bod/',
			'url' => 'assets/kh/bod/'
		),
	);
