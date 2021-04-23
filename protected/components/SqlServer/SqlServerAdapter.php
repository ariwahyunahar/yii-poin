<?php
require_once ("SqlServerAdapterClassic.php");
class Model_SqlServer_SqlServerAdapter
{
	var $adapter;
	
	public function __construct($adapter = "classic"){
		$this->adapter = $adapter;
	}
	
	public function fetchAll($query = null)
	{
		if(!$query){
			return false;
		}
		switch($this->adapter){
			case "classic":
				$con = new Model_SqlServer_SqlServerAdapterClassic();
				$return = $con->fetchAll($query);
				break;
			case "PdoAdapter":
				$con = new Model_SqlServer_SqlServerAdapterPdoAdapter();
				$return = $con->fetchAll($query);
				break;
			// case "xsc":
				// $con = new Model_SqlServer_SqlServerAdapterPdoAdapterx();
				// break;
				// $return = $con->fetchAll($query);
			default:
				$return = false;
				break;
		}
		return $return;
	}
}
