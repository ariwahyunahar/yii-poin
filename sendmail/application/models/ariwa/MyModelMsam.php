<?php
class Model_ariwa_MyModelMsam extends Zend_Db_Table
{
	var $sessions = null;
	
	public function __construct($config = array())
	{
		$this->sessions = Model_AuthAdapter::getAllSession();
		parent::__construct($config);
	}
	
	protected function _setupDatabaseAdapter()
    {
        $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $multidb = $bootstrap->getPluginResource('multidb');
        $this->_db = $multidb->getDb("isam");
    }
	
	public function getTotalFromObjectSelect($select = null)
	{
		if(!$select){
			return 0;
		}
		
		$select->limit();
		$select->reset(Zend_Db_Select::COLUMNS);
		$select->reset(Zend_Db_Select::ORDER);
		$select->columns("*");
		
		$select = $this->_db->select()
		->from(array('R'=>$select), null);
		
//		$select->reset(Zend_Db_Select::COLUMNS);
//		$select->reset(Zend_Db_Select::GROUP);
		
		$select->columns("COUNT(*) as JML");
		$counts = $this->getAdapter()->fetchRow($select);
		$count = $counts['JML'];

		return $count;
	}

	/*
	 *
	 */
	public function getAutomaticDateAdd(){
		$add_info = array(
		"created_by" => $this->sessions['INITIAL']
		,"created_at" => new Zend_Db_Expr('getdate()')
		);
		return $add_info;
	}
	public function getsetAutomaticDateEdit(){
		$add_info = array(
		"updated_by" => $this->sessions['INITIAL']
		,"updated_at" => new Zend_Db_Expr('getdate()')
		);
		return $add_info;
	}
	public function getMsgInsert($code = 1)
	{
		return ($code ? 'Entry data berhasil.' : 'Entry data gagal!.');
	}
	public function getMsgUpdate($code = 1)
	{
		return ($code ? 'Update data berhasil.' : 'Update data gagal!.');
	}
	public function getMsgDelete($code = 1)
	{
		return ($code ? 'Delete data berhasil.' : 'Delete data gagal!.');
	}
	
}