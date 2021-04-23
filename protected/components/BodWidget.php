<?php class BodWidget extends CWidget {
	public $title = array();
	public $bod = array();
	protected function registerClientScript()  {
		// ...publish CSS or JavaScript file here...   /*$cs=Yii::app()->clientScript;   $cs->registerCssFile($cssFile);   $cs->registerScriptFile($jsFile);*/
	}    public function run() {
		$criteria = new CDbCriteria;
		$criteria->condition = 'content_type_id = 7 and publish=1';
		$criteria->order = 'update_time DESC';
		$criteria->limit = 1;
		$bod = Content::model()->findAll($criteria);
		$vars= array(    'title'=> $this->title,    'bod' => $bod       );
		$this->render('bodwidget', $vars);
	}
}