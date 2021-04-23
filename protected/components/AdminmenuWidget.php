<?php
	class AdminmenuWidget extends CWidget
	{
		public $title = array();
		public $corporate = array();
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			
			$criteria = new CDbCriteria;
			//$criteria->condition = 'content_type_id = 9 AND publish = 1';
			//$criteria->order = 'update_time DESC';
			$contentType = ContentType::model()->findAll($criteria);
			
			$title = 'Admin Menu';
			
			$vars= array(
				'title'=> $title,
				'contentType' => $contentType
				
			);
			
			$this->render('adminmenuwidget', $vars);
		}
	}
?>