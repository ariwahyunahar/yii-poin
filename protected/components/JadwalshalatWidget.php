<?php
	class JadwalshalatWidget extends CWidget
	{
		public $title = array();
		public $event = array();
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			
			$title = 'Jadwal Sholat';
			
			$vars = array(
				'title' => $title,
			);
			
			$this->render('jadwalshalatwidget', $vars);
		}
		
	}
?>