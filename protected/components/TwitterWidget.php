<?php

class TwitterWidget extends CWidget{

	public $title = array();//public $twit = array();
	protected function registerClientScript(){
		// ...publish CSS or JavaScript file here.../*$cs=Yii::app()->clientScript;$cs->registerCssFile($cssFile);$cs->registerScriptFile($jsFile);*/
	}
	
	public function run() {
		$vars= array('title'=> $this->title,);
		$this->render('twitterwidget', $vars);
	}
}



?>