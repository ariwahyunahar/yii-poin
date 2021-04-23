<?php
class Model_hris_employee extends Model_ariwa_MyModelSqlServer
{
	protected $_name    = 'dbo.employee';
	
	public function getEmployeeByNIK($emp_id = ''){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		
		$select->joinLeft(array("G"=>new Zend_Db_Expr("dbo.vi_dept")), "G.dept_id = R.dept_id", "G.dept_name as dept_id2");
		$select->joinLeft(array("H"=>new Zend_Db_Expr("dbo.vi_dept_position")), "H.position_id = R.position_latest_id", "H.position_desc as position_latest_id2");
		$select->joinLeft(array("I"=>new Zend_Db_Expr("dbo.dept_lokasi")), "G.dept_lok_id = I.deptlok_id", "I.deptlok_desc as dept_lokasi");
		
		$select->where("emp_id = '$emp_id'");
		$results = $this->getAdapter()->fetchRow($select);
		return $results;
	}
}
