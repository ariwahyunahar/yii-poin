<?php
class Model_SqlServer_SqlServerAdapterClassic
{
	var $conn;
	public function __construct()
	{
		try {
			$hostname = "172.19.28.18";            //host
			$dbname = "HRIS";            //db name
			$username = "sa";            // username like 'sa'
			$pw = "1nf0nusa@2012";                // password for the user		
			$dbhandle = mssql_connect($hostname, $username, $pw)
			or die("Couldn't connect to SQL Server on $hostname");
			mssql_select_db($dbname)
			or die('Could not select a database.');
			$this->setConn($dbhandle);
		} catch (PDOException $e) {
			echo "Failed to get DB handle: " . $e->getMessage() . "\n";
			exit;
		}
	}
	
	public function setConn($v)
	{
		$this->conn = $v;
	}

	public function getConn()
	{
		return $this->conn;
	}

	public function fetchAll($query = '')
	{
		$result = mssql_query($query, $this->getConn())
		or die('A error occured: ' . mssql_error());
		
		// Fetch rows:
		$results = array();
		while ($row = mssql_fetch_assoc($result)) {
			$results[] = $row;
		}
		mssql_close($this->getConn());
		return $results;
	}

}

