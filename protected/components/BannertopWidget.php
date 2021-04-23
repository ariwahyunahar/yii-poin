<?php
	class BannertopWidget extends CWidget
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
			$criteria->condition = '';
			$sites = Sites::model()->find($criteria);
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'id ='.$sites->id;
			$themes = Themes::model()->find($criteria);
			
			$vars= array(
				'sites' => $sites,
				'themes' => $themes,
				
			);
			
			$this->render('bannertopwidget', $vars);
		}
	}
?>