<?php
class InfoWidget extends CWidget{
	public $title = array();public $latestinfo = array();protected function registerClientScript(){// ...publish CSS or JavaScript file here.../*$cs=Yii::app()->clientScript;$cs->registerCssFile($cssFile);$cs->registerScriptFile($jsFile);*/
	}public function run() {$criteria = new CDbCriteria;$criteria->condition = 'content_type_id = 3';$criteria->order = 'update_time DESC';$criteria->limit = 10;$latestinfo = Content::model()->findAll($criteria);$title = 'Info Terkini';$vars= array('title'=> $title,'latestinfo' => $latestinfo);$this->render('infowidget', $vars);}
}