<?php
class Model_poin_member extends Model_ariwa_MyModel
{
	protected $_name = 'member';
	
	public function getData1WeekBeforeBirthDay()
	{
		$select = $this->_db->select()
		->from(array('R'=>$this->_name),"R.*");
		$select->where( new Zend_Db_Expr("(	concat(YEAR(NOW()) ,'-', DATE_FORMAT(R.born_date,'%m-%d')) >= NOW()
			and concat(YEAR(NOW()) ,'-', DATE_FORMAT(R.born_date,'%m-%d')) <= NOW() + INTERVAL 7 DAY 
		)") );
		$select->where( new Zend_Db_Expr("R.nik not in ('101344')"));
		$select->order(new Zend_Db_Expr("concat(YEAR(NOW()) ,'-', DATE_FORMAT(R.born_date,'%m-%d')) asc"));
		$results = $this->getAdapter()->fetchAll($select);
		return $results;
	}
}
