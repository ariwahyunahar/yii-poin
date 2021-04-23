<?php

Yii::import('application.vendors.*');
require_once 'magpierss/rss_fetch.inc';


	class MediaWidget extends CWidget
	{
		
		public $title = array();
		public $rss = array();
		
		
		public function run() {
			
			$url = "http://rss.detik.com";
			$rss = fetch_rss( $url );
			
			$title = 'Media Release';
			
			$vars= array(
				'title'=> $title,
				'rss' => $rss
				
			);
			
			$this->render('mediawidget', $vars);
			
		
		}
		
	}
?>