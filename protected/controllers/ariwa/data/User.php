<?php
class ariwa_data_User
{
	public $con = null;
	
	public function __construct(){
		$this->con = new PDO('mysql:host=172.9.4.101;dbname=poinsaver;charset=utf8', 'poinsaver', 'poinsaver1');
		/*$link = mysql_connect('localhost', 'user', 'pass');
		mysql_select_db('testdb', $link);
		mysql_set_charset('UTF-8', $link);*/
		
	}
	
	public function cekData($user_id)
	{
		$stmt = $this->con->query("SELECT * FROM uss where user_id = '$user_id'");
   		$data_is_ada = $stmt->fetchAll(PDO::FETCH_ASSOC);
   		return $data_is_ada;
	}
	
	public function insertData($user_id, $pss)
	{
		$ps = md5($pss);
   		$stmt = $this->con->prepare("INSERT INTO uss(user_id, pss, created_at) values('$user_id', '$ps', NOW())");
		$stmt->execute();
		
		return true;
	}
	
	public function cekDataPasswd($user_id, $pswd)
	{
		$pw = md5($pswd);
		$stmt = $this->con->query("SELECT * FROM uss where user_id = '$user_id' and pss = '$pw'");
   		$data_is_ada = $stmt->fetchAll(PDO::FETCH_ASSOC);
   		return $data_is_ada;
	}
	
	public function ijinGaji($user_id, $pss){
		$data_is_ada = $this->cekData($user_id);
		if(!$data_is_ada){
			$in = $this->insertData($user_id, $pss);
			return array("rslt"=>false, "msg"=> "Data Belm Ada.");
		}
		
		// jika data sudah ada
		$cek_psswd_apakah_sdh_berubah = $this->cekDataPasswd($user_id, $pss);
		if($cek_psswd_apakah_sdh_berubah){ // jika belum berubah
			return array("rslt"=>false, "msg"=> "Data Belm Berubah.");
		}
		
		return array("rslt"=>true, "msg"=> "Data OK");
	}
	
	public function insertJikaBlmInsert($user_id, $pss)
	{
		$data_is_ada = $this->cekData($user_id);
		if(!$data_is_ada){
			$in = $this->insertData($user_id, $pss);
		}
		
		return true;
	}
}
