<?php
	class ThemeactiveWidget extends CWidget {
		
		public $title = array();
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run()
		{
			$criteria = new CDbCriteria;
			$theme = Sites::model()->find($criteria);
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'slug ="'.$theme->themes->slug.'"';
			$activeTheme = Themes::model()->find($criteria);
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'content_type_id = 10 and publish = 1';
			$splash_login = Content::model()->find($criteria);
			
			//var_dump($theme->id);
			
			$vars = array(
				'activeTheme' => $activeTheme,
				'splash_login' => $splash_login,
			);
			
			$this->render('themeactivewidget', $vars);
		}
	}
?>