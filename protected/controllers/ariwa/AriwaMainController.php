<?php
require_once APPLICATION_PATH.'/controllers/MyController.php';
class AriwaController extends MyController {

	var $tablename = '';
	var $field = array();
	var $field_label = array();
	var $field_list = array();
	var $field_setting = array();
	var $field_add = array();
	var $field_procedure = array();
	var $field_edit = array();
	var $field_filter = array(); // Field Filter harus sama dengan parameters di procedur pRead()
	//=================
	var $perpage = 10;
	var $controller_name = null;

	public function init(){ 
		parent::init();

		$this->view->perpage = $this->perpage;
		$this->view->controller_name = $this->controller_name;
		$this->view->tablename  = $this->tablename;
		$this->view->field  = $this->field;
		$this->view->field_label  = $this->field_label;
		$this->view->field_list  = $this->field_list;
		$this->view->field_filter  = $this->field_filter;
		$this->view->sessions  = $this->sessions;
	}

	public function dataAction()
	{
		$filter_par = Model_MyFilter::getData($this->tablename.$this->sessions['USERNAME']);
		$par = ($filter_par = Model_MyFilter::getData('PIMASTER'.$this->usr)) ? $filter_par['NAME'] : null;

		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : ($_GET['start'] ? $_GET['start'] : 0));
		$limit = (integer) (isset($_POST['limit']) ? $_POST['limit'] : ($_GET['limit'] ? $_GET['limit'] : $this->perpage));

		$tbl = new Model_Table_Pimaster();
		$data = $tbl->getBudgetsales($limit,$start,$par,$this->wil);
		$tbl2 = new Model_Table_Pimaster();
		$datatotal = $tbl2->gettotalBudgetsales($par);
		$jsondata = json_encode($data);
		$nbrows=$datatotal;
		echo '({"total":"'.$nbrows.'","results":'.$jsondata.'})';exit();
	}

	public function filterAction()
	{
		if($pars = $_POST)
		{
			Model_MyFilter::saveData($this->tablename.$this->sessions['USERNAME'], $pars);
		}
		echo "{success:true}";exit();
	}
	
	public function setAutomaticDateAdd(){
		$add_info = array(
		"CREATED_BY" => $this->sessions['USERNAME']
		,"CREATED_DATE" => new Zend_Db_Expr('SYSDATE')
		,"MODIFY_BY" => $this->sessions['USERNAME']
		,"MODIFY_DATE" => new Zend_Db_Expr('SYSDATE')
		);
		return $add_info;
	}
	public function setAutomaticDateEdit(){
		$add_info = array(
		"MODIFY_BY" => $this->sessions['USERNAME']
		,"MODIFY_DATE" => new Zend_Db_Expr('SYSDATE')
		);
		return $add_info;
	}
}


