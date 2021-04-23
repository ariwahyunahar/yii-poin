<?php

class UserController extends Controller
{
	
	public function init(){
        
        if (!Yii::app()->user->isGuest) 
        if (!Yii::app()->user->isAdmin) die('Not admin');
        

        Yii::app()->themeManager->basePath .= '/backend';
        Yii::app()->themeManager->baseUrl .= '/backend';

        Yii::app()->theme = ''; // You can set it there or in config or somewhere else before calling render() method.
	}
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	/* expression defined in all my controllers */
	/*public function accessRules() {
		return array(
			array('allow', // allow all users to perform 'index' and 'view' actions
			'actions' => array('update','admin','create'),
			//'users' => array('@'),
			'expression' => 'Yii::app()->controller->isValidAccess()',
			),
		);
	}*/ 
	
	public function actionIndex(){
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		$this->render('index');
	}
	
	
}

?>