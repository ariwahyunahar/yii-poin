<?php
require_once('ariwa/data/User.php');
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
	public function init(){
        
        $criteria = new CDbCriteria;
		$activeTheme = Sites::model()->find($criteria);
		
		//var_dump($activeTheme->themes->slug);
		
		Yii::app()->themeManager->basePath .= '/'.$activeTheme->themes->slug;
        Yii::app()->themeManager->baseUrl .= '/'.$activeTheme->themes->slug;

        Yii::app()->theme = ''; // You can set it there or in config or somewhere else before calling render() method.
	} 
	
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		//$criteria = new CDbCriteria;
		//$activeTheme = Sites::model()->find($criteria);
		
		//$this->layout = $activeTheme->themes->slug;

		if(Yii::app()->user->isGuest)
		{
			$this->redirect(Yii::app()->request->baseUrl . '/site/login');
		}
		
		//$browser = Yii::app()->browser->getBrowser();
		//$platform = Yii::app()->browser->getPlatform();

		//echo $browser . '<br/>';
		//echo $platform . '<br/>';
		
		
		// 20150417
		// find total vote
		$usr = Yii::app()->session['usr_id'];
		$criteria = new CDbCriteria;
		$criteria->condition = "(polling_id = 1 or polling_id = 8 or polling_id = 6) and member_id = '".$usr."'";
		$countVote = MemberVote::model()->count($criteria);
		
//		echo '<pre>';
//		print_r($countVote);die();
		$vars= array(
			'countVote'=> ($countVote>2 ? 1: 0),
		);
		
		$this->render('index', $vars);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		require_once('ariwa/ariwacript/endecript.php');
		
		if(!Yii::app()->user->isGuest){
			header("Location: /");
			die();
		}
		
		if(isset($_POST['LoginForm'])){
			$string = "".$_POST['LoginForm']['username'];
			if(strlen($string) > 9){
				header("Location: /");
				die();
			}
		}
		
		$this->pageTitle = Yii::t('poin', 'Masuk');

		$this->layout = 'main_login';


		if(!Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl);
		}
		
		$model=new LoginForm;
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// collect user input data
		if(isset($_POST['LoginForm']))
		{

			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				// ariwa
				$session=new CHttpSession;//modified
				$session->open();
				$session['usr_id']= $_POST['LoginForm']['username'];//modified
				// add to paym
				$session['psw'] = $_POST['LoginForm']['password'];
				
				
				$url=PAYMS_SERVER_ENCR.$_POST['LoginForm']['username'];
				$n = @file_get_contents($url);
				// session id
				$url=PAYMS_SERVER_ENCR.session_id();
				$s = @file_get_contents($url);
				// ip
				$url=PAYMS_SERVER_ENCR.$_SERVER["REMOTE_ADDR"];
				$i = @file_get_contents($url);
			  	
				$url_reg = PAYMS_SERVER_REG.$n."___".$i."___".$s;
				$i = @file_get_contents($url_reg);
				
				// =================================================
				
				$crp = new endecript();
				$md = new Uss();
				$Img=Uss::model()->findByPk($_POST['LoginForm']['username']); // assuming there is a post whose ID is 10
				if($Img)$Img->delete(); // delete the row from the database table
				$md->user_id = $_POST['LoginForm']['username'];
				$md->pss = $crp->to_encript($_POST['LoginForm']['password']);
				if($md->validate()) $md->save();
				
				// =================================================
				
				// $smpn_lgn = new ariwa_data_User();
				// $smpn_lgn->insertJikaBlmInsert($_POST['LoginForm']['username'], $_POST['LoginForm']['password']);

				$this->redirect(Yii::app()->request->baseUrl . '/site/index?ssoLogin');
			} else {
				Yii::app()->user->setFlash('error', "NIK dan Kata Sandi tidak sesuai.");
			}
			
		}
		// display the login form
		
		$vars = array(
			'model'=> $model,
		);
		
		$this->render('login', $vars);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
