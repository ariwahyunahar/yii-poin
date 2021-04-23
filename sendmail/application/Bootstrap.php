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
	
//	public function _initDbRegistry()
//    {
//        $this->bootstrap('multidb');
//        $multidb = $this->getPluginResource('multidb');
//        Zend_Registry::set('db_remote', $multidb->getDb('remote')); //db_remote is going to be the name of the remote adapter
//    }
}
