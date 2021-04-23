<?php
	class GalleryvideoWidget extends CWidget
	{
		public $title = 'Gallery Video';
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			
			$criteria = new CDbCriteria;
			$criteria->order = 'upload_time DESC';
			$criteria->limit = '2' ;
			$videos = ContentVideo::model()->findAll($criteria);
			
			$vars= array(
				'title'=> $this->title,
				'videos'=> $videos,
				
			);
			
			$this->render('galleryvideowidget', $vars);
		}
		
	}
?>
