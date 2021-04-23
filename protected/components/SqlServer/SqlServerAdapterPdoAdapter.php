<?php
class Model_SqlServer_SqlServerAdapterPdoAdapter
{
	var $pdo_conn;
	public function __construct()
	{
		try {
			$hostname = "172.19.28.18";            //host
			$dbname = "HRIS";            //db name
			$username = "sa";            // username like 'sa'
			$pw = "1nf0nus@2012";                // password for the user
			$dbh = new PDO ("mssql:host=$hostname;dbname=$dbname","$username","$pw");
			$this->setPdoConn($dbh);
		} catch (PDOException $e) {
			echo "Failed to get DB handle: " . $e->getMessage() . "\n";
			exit;
		}
	}
	
	public function setPdoConn($v)
	{
		$this->pdo_conn = $v;
	}
	
	public function getPdoConn()
	{
		return $this->pdo_conn;
	}
	
	 
	public function fetchAll($query = '')
	{
		$results = array();
		$conn = $this->getPdoConn();
		$stmt = $conn->prepare($query);
		
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$hsl = array();
			$hit = 1;
			foreach($row as $rw => $isi){
				// if($hit == 1){
					// $hsl[$rw] = $isi;
					// $hit = 2;
				// }else{
					// $hit = 1;
				// }
				if(!is_int($rw)){$hsl[$rw] = $isi;}
			}
			$results[] = $hsl;
		}
		// print_r($results);exit;
		unset($this->pdo_conn); unset($stmt);
		return $results;
	}
	
	
	/*
	 * fetchAll has modified by Broklak @ 30/04/2011
	 */
	 
	// public function fetchAll($query = '')
	// {
		// $results = array();
		// $conn = $this->getPdoConn();
		// $stmt = $conn->prepare($query);
		// $stmt->execute();
		// $cetak = $stmt->fetch();  
		// unset($results);  
		// foreach($cetak AS $a => $b){if(!is_int($a)){$results[$a] = $b;} } 
		// unset($this->pdo_conn); 
		// unset($stmt); 
		// return $results;
	// }
	
	public function fetchOne($query = '')
	{
		
	}

	public function runProcedure()
	{
		$conn = $this->getPdoConn();
		$stmt = $conn->prepare($query);

		$rs = $stmt->execute();
	}
}
