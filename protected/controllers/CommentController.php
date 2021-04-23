<?php

class CommentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	//public $mailer = array();

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				//'actions'=>array('index','view','create','captcha'),
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','post'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	
	
	
	public function actionCreate()
	{
		
		
		$model=new Comment;
		
		
		
		if(isset($_POST['Comment']))
		{
			
			
			//$contenType = $_POST['contenType'];
			
			$model->attributes=$_POST['Comment']; // set all attributes with post values
			$model ->create_time = date('Y-m-d H:i:s');
			
			
			if(empty($_POST['Comment']['body'])){
			
				//$this->redirect(array($contenType.'/'.$slug));
				$this->redirect($_SERVER['HTTP_REFERER']);
			
			} elseif($_POST['Comment']['body'] == 'isi komentar...') {
			
				//$this->redirect(array($contenType.'/'.$slug));
				$this->redirect($_SERVER['HTTP_REFERER']);
				
			} else {
				
				if($model->save()){// save comment
				
					Comment::model()->beforeSave($_POST['Comment']['body']);
					//$this->redirect(array($contenType.'/'.$slug));
					$this->redirect($_SERVER['HTTP_REFERER']);
					
				}
			}
			
		}
		
		
		$vars= array(
			'slug'=> $slug,
			'contenType'=> $contenType,
			'model'=> $model
		);
		
		$this->render('create', $vars);
		
	}
	
}