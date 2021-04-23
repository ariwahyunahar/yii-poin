<?php
	class NewsWidget extends CWidget
	{
		public $title = array();
		public $latestnews = array();
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'content_type_id = 3 AND publish = 1';
			$criteria->order = 'update_time DESC';
			$criteria->limit = 5;
			$latestnews = Content::model()->findAll($criteria);
			
			$vars= array(
				'title'=> $this->title,
				'latestnews' => $latestnews
				
			);
			
			$this->render('newswidget', $vars);
		}
		
	}
?>