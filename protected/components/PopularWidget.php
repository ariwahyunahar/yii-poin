<?php
class PopularWidget extends CWidget
{
	public $title = array();
	public $ishome = 0;
	public $popularnews = array();

	protected function registerClientScript()

	{
		// ...publish CSS or JavaScript file here...
		/*$cs=Yii::app()->clientScript;
		$cs->registerCssFile($cssFile);
		$cs->registerScriptFile($jsFile);*/
	}


	public function run() {
		$criteria = new CDbCriteria;
		$criteria->condition = 'content_type_id = 3 AND is_popular = 1  AND publish = 1';
		$criteria->order = 'update_time DESC';
		$criteria->limit = 5;
		$popularnews = Content::model()->findAll($criteria);

		$title = 'Berita Populer';

		$vars= array(
			'title'=> $title,
			'popularnews' => $popularnews
		);
		
		if($this->ishome){
			$this->render('popularwidgetooh', $vars);
		}else{
			$this->render('popularwidget', $vars);
		}
	}

}?>