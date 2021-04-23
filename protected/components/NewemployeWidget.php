<?php

Yii::import('application.vendors.*');
require_once ("SqlServer/SqlServerAdapter.php");
	class NewemployeWidget extends CWidget
	{
		public $title = array();
		public $rss = array();
		
		public function run() {
			// $q = "select top 10 emp_name, CONVERT(VARCHAR(11), hire_date, 106) AS hire_date_out from employee where hire_date > (GETDATE() - 60) order by hire_date desc";
			// $q = "select top 10 emp_name, CONVERT(VARCHAR(11), hire_date, 106) AS hire_date_out from employee order by hire_date desc";
			
			$q = "select top 4 x.emp_name, y.dept_name, z.position_desc
				, CONVERT(VARCHAR(11), x.hire_date, 106) AS hire_date_out 
				from employee x
				left join vi_dept y on x.dept_id = y.dept_id
				left join vi_dept_position z on x.position_latest_id = z.position_id
				where x.termination_status = '1' and x.dept_id != ''
				and 
				RIGHT(CONVERT(VARCHAR(10), x.hire_date, 105), 7) = RIGHT(CONVERT(VARCHAR(10), GETDATE(), 105), 7) 
				order by x.hire_date desc";
				
			$con = new Model_SqlServer_SqlServerAdapter();
			$results = $con->fetchAll($q);
			$vars['all']  = $results;
		
			$this->render('newemployewidget', $vars);
		}
	}
?>
