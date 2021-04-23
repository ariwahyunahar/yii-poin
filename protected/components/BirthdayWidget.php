<?php
	class BirthdayWidget extends CWidget
	{
		public $title = array();
		public $article = array();
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			$query = 'SELECT name, nik, CONCAT_WS("-", MONTH(born_date) , DAY(born_date)) AS born_date, DATEDIFF( CONCAT_WS( "-", YEAR( CURDATE( ) ) , MONTH( born_date ) , DAY( born_date ) ) , curdate( ) ) AS DiffDate
FROM member
WHERE month( born_date ) <>0
AND day( born_date ) <>0
AND DATEDIFF( CONCAT_WS( "-", YEAR( CURDATE( ) ) , MONTH( born_date ) , DAY( born_date ) ) , curdate( ) ) < 7
AND DATEDIFF( CONCAT_WS( "-", YEAR( CURDATE( ) ) , MONTH( born_date ) , DAY( born_date ) ) , curdate( ) ) >= 0
AND nik <> "101344" and nik <> "15D007" and nik <> "030710" and nik <> "030710" and nik <> "960354" and nik <> "900167" and nik <> "010510" and nik <> "900167"
ORDER BY DiffDate ASC
LIMIT 100';
			$command = Yii::app()->db->createCommand($query);
			$birthday = $command->queryAll();
			
			$title = 'Ulang Tahun';
			
			$vars= array(
				'title'=> $title,
				'birthday' => $birthday
				
			);
			
			$this->render('birthdaywidget', $vars);
		}
	}
?>