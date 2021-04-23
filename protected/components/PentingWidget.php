<?php
	class PentingWidget extends CWidget
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
			
			$banner = 'banner-side-1.png';
			$bannerAlt = 'banner-side-1';
			$title = 'banner side 1';
			
			$vars= array(
				'title' => $title,
				'banner' => $banner,
				'bannerAlt' => $bannerAlt
			);
			
			$this->render('pentingwidget', $vars);
		}
	}
?>