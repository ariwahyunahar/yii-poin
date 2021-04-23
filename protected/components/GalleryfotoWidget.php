<?php
	class GalleryfotoWidget extends CWidget
	{
		public $title = 'Gallery Foto';
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
		
			$criteria = new CDbCriteria;
			$criteria->condition = '' ;
			$criteria->order = 'id DESC';
			$criteria->limit = '2' ;
			$ImgPopular = ContentImage::model()->findAll($criteria);
			
			$vars= array(
				'title'=> $this->title,
				'ImgPopular'=> $ImgPopular
				
			);
			
			$this->render('galleryfotowidget', $vars);
		}
		
	}
?>