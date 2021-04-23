<?php
	class SplashWidget extends CWidget
	{
		public $title = array();
		public $imagesplash = array();
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'splash = 1 AND publish = 1';
			$criteria->order = 'update_time DESC';
			$criteria->limit = 6;
			$imagesplash = Content::model()->findAll($criteria);
			
			$vars= array(
				'title'=> $this->title,
				'imagesplash' => $imagesplash
				
			);
			
			$this->render('splashwidget', $vars);
		}
	}
?>