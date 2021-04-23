<?php
	class SearchcontentWidget extends CWidget
	{
		public $title = array();
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			
			$title = 'Search Content';
			
			$vars= array(
				'title'=> $title,
				
			);
			
			$this->render('searchcontentwidget', $vars);
		}
	}
?>