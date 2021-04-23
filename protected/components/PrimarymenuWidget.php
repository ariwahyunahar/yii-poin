<?php
	class PrimarymenuWidget extends CWidget
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
			$criteria->condition = 'menu_type_id = 1 AND publish = 1';
			//$criteria->order = 'update_time DESC';
			$primarymenu = Menu::model()->findAll($criteria);
			
			$title = 'Primarymenu';
			$pageTitle = '';
			
			$vars= array(
				'title'=> $title,
				'pageTitle'=> $pageTitle,
				'primarymenu' => $primarymenu
				
			);
			
			$this->render('primarymenuwidget', $vars);
		}
	}
?>