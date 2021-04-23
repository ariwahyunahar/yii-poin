<?php
	class LoginasWidget extends CWidget
	{
		public $title = array();
		public $userLogin = array();
		
		protected function registerClientScript()
		{

			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
		public function run() {
			
			$criteria = new CDbCriteria;
			if(Yii::app()->user->name == 'administrator'){
				$userLogin = 'Administrator';
			} else {
				/*
				$criteria->condition = 'nik ='.Yii::app()->user->name;
				$userLogin = Member::model()->findAll($criteria);
				*/
				$userLogin = Member::model()->findByNik(Yii::app()->user->name);
			}
			
			
			$vars= array(
				'title'=> $this->title,
				'userLogin' => $userLogin
				
			);
			
			$this->render('loginaswidget', $vars);
		}
		
	}
?>