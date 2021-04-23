<?php
class Model_Survey_PollStepUser extends Model_ariwa_MyModel
{
	protected $_name = 'poll_step_user';

	public function getAll($limit, $offset, $filter_par){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));

		if($filter_par['squen']){
			$select->where("R.squen like '%".$filter_par['squen']."%'");
		}
		
		$select->limit($limit, $offset);
		
		$results = $this->getAdapter()->fetchAll($select);
		$count = $this->getTotalFromObjectSelect($select);
		return array('count'=>$count, 'results'=>$results);
	}

	public function getEdit($pars = array()){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		$select->where("poll_id = ".$pars['poll_id']." and step_id = '".$pars['step_id']."' and user_id = '".$pars['user_id']."'");

		return $this->getAdapter()->fetchRow($select);
	}

	public function insert_record($pars = array()){
		$data = array(
			"poll_id"=>$pars['poll_id']
			,"step_id"=>$pars['step_id']
			,"user_id"=>$pars['user_id']
			,"squen"=>$pars['squen']
			,"created_at"=> new Zend_Db_Expr("NOW()")
			,"ket"=> $pars['ket']
		);
		$insert = $this->insert($data);
		if($insert)
		{
			return true;
		}
		return false;
	}

	public function update_record($pars = array()){
		$data = array(
			"poll_id"=>$pars['poll_id']
			,"step_id"=>$pars['step_id']
			,"user_id"=>$pars['user_id']
			,"squen"=>$pars['squen']
		);
		$insert = $this->update($data, "poll_id = '".$pars['poll_id']."' and step_id = '".$pars['step_id']."' and user_id = '".$pars['user_id']."'");
		if($insert)
		{
			echo json_encode(array('success'=>true, 'msg' => $this->getMsgUpdate(1)));exit();
		}
		echo "'".$this->getMsgUpdate(0)."'";exit();
	}

	public function delete_record($pars = array()){
		$delete = $this->delete("poll_id = '".$pars['poll_id']."' and step_id = '".$pars['step_id']."' and user_id = '".$pars['user_id']."'");
		if($delete)
		{
			echo json_encode(array('success'=>true, 'msg' => $this->getMsgDelete(1)));exit();
		}
		echo "'".$this->getMsgDelete(0)."'";exit();
	}

	/*
	 * ==== ====
	 */
	public function getForCombo()
	{
		$select = $this->_db->select()
		->from(array('R'=>$this->_name),"R.*");

		$results = $this->getAdapter()->fetchAll($select);
		return $results;
	}

	public static function getField()
	{
		return array(
			"poll_id" => array("label" => "Poll Id", "type"=>"string", "wl"=>100, "hidden"=>false)
			,"step_id" => array("label" => "Step Id", "type"=>"string", "wl"=>75, "hidden"=>false)
			,"user_id" => array("label" => "User Id", "type"=>"string", "wl"=>75, "hidden"=>false)
			,"squen" => array("label" => "Squen", "type"=>"int", "wl"=>100, "hidden"=>false)
		);
	}
	public static function getFieldList()
	{
		return  array("poll_id" ,"step_id" ,"user_id" ,"squen" );
	}
	
	public function getForCek($pars = array()){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		$select->where("poll_id = ".$pars['poll_id']." and user_id = '".$pars['user_id']."'");
		$select->order("R.squen desc");

		return $this->getAdapter()->fetchRow($select);
	}
	
	
}
