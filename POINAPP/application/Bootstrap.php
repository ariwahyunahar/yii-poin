<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
	{
		$moduleLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '', 
            'basePath'  => APPLICATION_PATH));
		return $moduleLoader;
	}

}

