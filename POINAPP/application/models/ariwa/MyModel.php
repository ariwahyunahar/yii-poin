<?php
class Model_ariwa_MyModel extends Zend_Db_Table
{
	var $sessions = null;

	public function __construct($config = array(), $definition = null)
	{
		$this->sessions = Model_AuthAdapter::getAllSession();
		parent::__construct($config, $definition);
	}

	public function getTotalFromObjectSelect($select = null)
	{
		if(!$select){
			return 0;
		}
		
		$select->reset(Zend_Db_Select::COLUMNS);
		$select->limit();
		$select->columns("*");
		
		$select = $this->_db->select()
		->from(array('R'=>$select));
		
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
		"created_by" => $this->sessions['USERNAME']
		,"created_at" => date('Y-m-d H:i:s')//new Zend_Db_Expr('SYSDATE')
		/*,"UPDATED_BY" => $this->sessions['USERNAME']
		,"UPDATED_AT" => date('Y-m-d H:i:s')*/
		);
		return $add_info;
	}
	public function getsetAutomaticDateEdit(){
		$add_info = array(
		"updated_by" => $this->sessions['USERNAME']
		,"updated_at" => date('Y-m-d H:i:s')
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
	
	/*
	 * ANOTHER FORM
	 */
	public function getAutomaticDateAddImn(){
		$add_info = array(
		"created_by" => $this->sessions['USERNAME']
		,"created_at" => date('Y-m-d H:i:s')//new Zend_Db_Expr('SYSDATE')
		/*,"UPDATED_BY" => $this->sessions['USERNAME']
		,"UPDATED_AT" => date('Y-m-d H:i:s')*/
		);
		return $add_info;
	}
	public function getsetAutomaticDateEditImn(){
		$add_info = array(
		"updated_by" => $this->sessions['USERNAME']
		,"updated_at" => date('Y-m-d H:i:s')
		);
		return $add_info;
	}
}