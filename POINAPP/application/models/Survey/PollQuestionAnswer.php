<?php
class Model_Survey_PollQuestionAnswer extends Model_ariwa_MyModel
{
	protected $_name = 'poll_question_answer';
	
	public function getAll($limit, $offset, $filter_par){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		
		if($filter_par['answ_text']){
			$select->where("R.answ_text like '%".$filter_par['answ_text']."%'");
		}
		
		$select->limit($limit, $offset);
		
		$results = $this->getAdapter()->fetchAll($select);
		$count = $this->getTotalFromObjectSelect($select);
		return array('count'=>$count, 'results'=>$results);
	}
	
	public function getEdit($pars = array()){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		$select->where("q_id = '".$pars['q_id']."' and answ_id = '".$pars['answ_id']."'");
		
		return $this->getAdapter()->fetchRow($select);
	}
	
	public function insert_record($pars = array()){
		$data = array(
			"q_id"=>$pars['q_id']
			,"answ_id"=>$pars['answ_id']
			,"answ_text"=>$pars['answ_text']
		);
		$insert = $this->insert($data);
		if($insert)
		{
			echo json_encode(array('success'=>true, 'msg' => $this->getMsgInsert(1)));exit();
		}
		echo "'".$this->getMsgInsert(0)."'";exit();
	}
	
	public function update_record($pars = array()){
		$data = array(
			"q_id"=>$pars['q_id']
			,"answ_id"=>$pars['answ_id']
			,"answ_text"=>$pars['answ_text']
		);
		$insert = $this->update($data, "q_id = '".$pars['q_id']."' and answ_id = '".$pars['answ_id']."'");
		if($insert)
		{
			echo json_encode(array('success'=>true, 'msg' => $this->getMsgUpdate(1)));exit();
		}
		echo "'".$this->getMsgUpdate(0)."'";exit();
	}
	
	public function delete_record($pars = array()){
		$delete = $this->delete("q_id = '".$pars['q_id']."' and answ_id = '".$pars['answ_id']."'");
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
					,"answ_id" => array("label" => "Answ Id", "type"=>"string", "wl"=>60, "hidden"=>false)
					,"answ_text" => array("label" => "Answ Text", "type"=>"string", "wl"=>305, "hidden"=>false)
					
		);
	}
	public static function getFieldList()
	{
		return  array("q_id" ,"answ_id" ,"answ_text" );
	}
	
	public function getByQuestionId($q_id = 0){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		$select->where("R.q_id = $q_id");
		
		return $this->getAdapter()->fetchAll($select);
	}
	public static function SgetByQuestionId($q_id = 0){
		$con = new self();
		return $con->getByQuestionId($q_id);
	}
}
		