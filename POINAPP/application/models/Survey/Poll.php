<?php
class Model_Survey_Poll extends Model_ariwa_MyModel
{
	protected $_name = 'poll';

	public function getAll($limit, $offset, $filter_par){
		$select = $this->_db->select()
		->from(array('R'=>$this->_name));

		if($filter_par['poll_name']){
			$select->where("R.poll_name like '%".$filter_par['poll_name']."%'");
		}

		if($filter_par['ket']){
			$select->where("R.ket like '%".$filter_par['ket']."%'");
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
		$select->where("poll_id = '".$pars['poll_id']."'");

		return $this->getAdapter()->fetchRow($select);
	}

	public function insert_record($pars = array()){
		$data = array(
			"poll_id"=>$pars['poll_id']
		,"poll_name"=>$pars['poll_name']
		,"ket"=>$pars['ket']
			
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
			"poll_id"=>$pars['poll_id']
		,"poll_name"=>$pars['poll_name']
		,"ket"=>$pars['ket']
			
		);
		$insert = $this->update($data, "poll_id = '".$pars['poll_id']."'");
		if($insert)
		{
			echo json_encode(array('success'=>true, 'msg' => $this->getMsgUpdate(1)));exit();
		}
		echo "'".$this->getMsgUpdate(0)."'";exit();
	}

	public function delete_record($pars = array()){
		$delete = $this->delete("poll_id = '".$pars['poll_id']."'");
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
		,"poll_name" => array("label" => "Poll Name", "type"=>"string", "wl"=>150, "hidden"=>false)
		,"ket" => array("label" => "Ket", "type"=>"string", "wl"=>305, "hidden"=>false)
		,"created_at" => array("label" => "Created At", "type"=>"string", "wl"=>100, "hidden"=>true)
		,"created_by" => array("label" => "Created By", "type"=>"string", "wl"=>75, "hidden"=>true)
			
		);
	}
	public static function getFieldList()
	{
		return  array("poll_id" ,"poll_name" ,"ket" ,"created_at" ,"created_by"
		);
	}
}
