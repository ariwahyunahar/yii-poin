<?php
	class ArticleWidget extends CWidget
	{
		public $title = array();
		public $article = array();
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'content_type_id = 6 AND publish = 1';
			$criteria->order = 'update_time DESC';
			$criteria->limit = 4;
			$article = Content::model()->findAll($criteria);
			
			$title = 'Artikel Transformasi';
			
			$vars= array(
				'title'=> $title,
				'article' => $article
				
			);
			
			$this->render('articlewidget', $vars);
		}
	}
?>