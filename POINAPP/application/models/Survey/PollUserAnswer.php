<?php
class Model_Survey_PollUserAnswer extends Model_ariwa_MyModel
{
	protected $_name = 'poll_user_answer';
	
	public function getAll($limit, $offset, $filter_par){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));

		if($filter_par['answers']){
			$select->where("R.answers like '%".$filter_par['answers']."%'");
		}
		
		if($filter_par['created_at']){
			$select->where("R.created_at like '%".$filter_par['created_at']."%'");
		}
		
		$select->limit($limit, $offset);
		
		$results = $this->getAdapter()->fetchAll($select);
		$count = $this->getTotalFromObjectSelect($select);
		return array('count'=>$count, 'results'=>$results);
	}
	
	public function getEdit($pars = array()){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		$select->where("q_id = '".$pars['q_id']."' and poll_id = '".$pars['poll_id']."' and user_id = '".$pars['user_id']."'");
		
		return $this->getAdapter()->fetchRow($select);
	}
	
	public function insert_record($pars = array()){
		$data = array(
			"q_id"=>$pars['q_id']
			,"poll_id"=>$pars['poll_id']
			,"answers"=>$pars['answers']
			,"user_id"=>$pars['user_id']
			,"created_at"=>new Zend_Db_Expr("NOW()")
		);
		$insert = $this->insert($data);
		return true;
	}
	
	public function update_record($pars = array()){
		$data = array(
			"q_id"=>$pars['q_id']
			,"poll_id"=>$pars['poll_id']
			,"answers"=>$pars['answers']
			,"user_id"=>$pars['user_id']
					
		);
		$insert = $this->update($data, "q_id = '".$pars['q_id']."' and poll_id = '".$pars['poll_id']."' and user_id = '".$pars['user_id']."'");
		if($insert)
		{
			echo json_encode(array('success'=>true, 'msg' => $this->getMsgUpdate(1)));exit();
		}
		echo "'".$this->getMsgUpdate(0)."'";exit();
	}
	
	public function delete_record($pars = array()){
		$delete = $this->delete("q_id = '".$pars['q_id']."' and poll_id = '".$pars['poll_id']."' and user_id = '".$pars['user_id']."'");
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
			"q_id" => array("label" => "Q Id", "type"=>"string", "wl"=>100, "hidden"=>false)
					,"poll_id" => array("label" => "Poll Id", "type"=>"string", "wl"=>100, "hidden"=>false)
					,"answers" => array("label" => "Answers", "type"=>"string", "wl"=>150, "hidden"=>false)
					,"user_id" => array("label" => "User Id", "type"=>"string", "wl"=>75, "hidden"=>false)
					,"created_at" => array("label" => "Created At", "type"=>"string", "wl"=>100, "hidden"=>true)
					
		);
	}
	
	public static function getFieldList()
	{
		return  array("q_id" ,"poll_id" ,"answers" ,"user_id" ,"created_at"
					);
	}
	
	public function getByUserId($user_id = '', $poll_id = 0){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		$select->where("R.user_id = '".$user_id."'");
		$select->where("R.poll_id = $poll_id");
		
		return $this->getAdapter()->fetchRow($select);
	}
}
		