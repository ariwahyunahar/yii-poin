<?php
	class ToplinksWidget extends CWidget
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
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'menu_type_id = 2 AND publish = 1';
			//$criteria->order = 'update_time DESC';
			$toplinks = Menu::model()->findAll($criteria);
			
			$title = 'Toplinks';
			
			$vars= array(
				'title'=> $title,
				'toplinks' => $toplinks,
				
			);
			
			$this->render('toplinkswidget', $vars);
		}
	}
?>