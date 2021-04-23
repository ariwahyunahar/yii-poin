<?php
class Model_Survey_PollQuetion extends Model_ariwa_MyModel
{
	protected $_name = 'poll_quetion';
	
	public function getAll($limit, $offset, $filter_par){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));

		if($filter_par['poll_id']){
			$select->where("R.poll_id like '%".$filter_par['poll_id']."%'");
		}
		
		if($filter_par['q_text']){
			$select->where("R.q_text like '%".$filter_par['q_text']."%'");
		}
		
		if($filter_par['q_number']){
			$select->where("R.q_number like '%".$filter_par['q_number']."%'");
		}
				
		$select->limit($limit, $offset);
		
		$results = $this->getAdapter()->fetchAll($select);
		$count = $this->getTotalFromObjectSelect($select);
		return array('count'=>$count, 'results'=>$results);
	}
	
	public function getEdit($pars = array()){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		$select->where("q_id = '".$pars['q_id']."'");
		
		return $this->getAdapter()->fetchRow($select);
	}
	
	public function insert_record($pars = array()){
		$data = array(
			"q_id"=>$pars['q_id']
					,"poll_id"=>$pars['poll_id']
					,"q_text"=>$pars['q_text']
					,"q_number"=>$pars['q_number']
					
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
					,"poll_id"=>$pars['poll_id']
					,"q_text"=>$pars['q_text']
					,"q_number"=>$pars['q_number']
					
		);
		$insert = $this->update($data, "q_id = '".$pars['q_id']."'");
		if($insert)
		{
			echo json_encode(array('success'=>true, 'msg' => $this->getMsgUpdate(1)));exit();
		}
		echo "'".$this->getMsgUpdate(0)."'";exit();
	}
	
	public function delete_record($pars = array()){
		$delete = $this->delete("q_id = '".$pars['q_id']."'");
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
					,"q_text" => array("label" => "Q Text", "type"=>"string", "wl"=>305, "hidden"=>false)
					,"q_number" => array("label" => "Q Number", "type"=>"int", "wl"=>100, "hidden"=>false)
					
		);
	}
	public static function getFieldList()
	{
		return  array("q_id" ,"poll_id" ,"q_text" ,"q_number" );
	}
	
	public function getAllData($poll_id = 0){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));
		$select->where("R.poll_id = $poll_id");
		
		return $this->getAdapter()->fetchAll($select);
	}
}
		