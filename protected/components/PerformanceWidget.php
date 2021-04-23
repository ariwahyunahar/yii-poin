<?php
	class PerformanceWidget extends CWidget
	{
		public $title = 'Performance';
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			$vars= array(
				'title'=> $this->title,
			);
			$this->render('performancewidget', $vars);
		}
	}
?>