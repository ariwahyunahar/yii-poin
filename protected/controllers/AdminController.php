<?php

class AdminController extends Controller
{
	
	public function init(){
        
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
	
	public function actionIndex()
	{
		//$this->render('index');
		
		
		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{if (!Yii::app()->user->isAdmin) die('Not admin');
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validateAdmin() && $model->loginAdmin())	$this->redirect(Yii::app()->request->baseUrl . '/admin');
			//$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('index',array('model'=>$model));
		
	}
	
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
	
	public function actionLogin()
	{
		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validateAdmin() && $model->loginAdmin()) {
				$this->redirect(Yii::app()->request->baseUrl . '/user');
				//$this->redirect(Yii::app()->user->returnUrl);
			} else {
				Yii::app()->user->setFlash('error', "Incorrect username or password.");
			}
		}
		// display the login form
		$this->render('index',array('model'=>$model));
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->request->baseUrl . '/admin');
	}
        
	public function actionContent()
	{
		//if (!Yii::app()->user->isAdmin) die('Not admin');
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$criteria = new CDbCriteria;
		$criteria->condition = '';
		$criteria->order = 'update_time DESC';
		$allcontent = Content::model()->findAll($criteria);

		$titlepage = 'Listing Content';
		$pageid = 'ListingContent';

		$item_count = Content::model()->count($criteria);

		$pages = new CPagination($item_count);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);  // the trick is here!
		
		
		$typeCriteria = new CDbCriteria;
		$typeCriteria->condition ='';
		$Type = ContentType::model()->findAll($typeCriteria);
		
		$TitleSort = Yii::app()->session['title'];
		$TypeSort = Yii::app()->session['type'];
		$CreateTimeSort = Yii::app()->session['create_time'];
		$UpdateTimeTitleSort = Yii::app()->session['update_time'];
		$PublishSort = Yii::app()->session['publish'];
		
		$vars= array(
			'allcontent'=> $allcontent,
			'model'=> Content::model()->findAll($criteria), // must be the same as $item_count
			'item_count'=>$item_count,
			'page_size'=>Yii::app()->params['listPerPage'],
			'items_count'=>$item_count,
			'pages'=>$pages,
			'titlepage' => $titlepage,
			'pageid' => $pageid,
			'Type' => $Type,
			'TitleSort'=>$TitleSort,
			'TypeSort'=>$TypeSort,
			'CreateTimeSort'=>$CreateTimeSort,
			'UpdateTimeTitleSort'=>$UpdateTimeTitleSort,
			'PublishSort'=>$PublishSort,
		);
		
		$this->render('content', $vars);
	}
        
	public function actionContentsort(){
		
		//check user
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$titlepage = 'Listing Content';
		$pageid = 'ListingSortContent';
		
		$criteria = new CDbCriteria;
		
		if(isset($_POST['Content'])){

			//var_dump($_POST['Content']['publish']); die;
		
			//create session
			Yii::app()->session['title'] = $_POST['Content']['title'];
			Yii::app()->session['publish'] = $_POST['Content']['publish'];
			Yii::app()->session['type'] = $_POST['Content']['type'];
			Yii::app()->session['create_time'] = $_POST['Content']['create_time'];
			
			$TitleSort = Yii::app()->session['title'];
			
			if($_POST['Content']['type'] == 1){
				$criteria->condition ='title like "%'.Yii::app()->session['title'].'%" and create_time like "%'.$_POST['Content']['create_time'].'%" and publish ='.Yii::app()->session['publish'] ;
			} else {
				$criteria->condition ='title like "%'.Yii::app()->session['title'].'%" and content_type_id ='.$_POST['Content']['type'].' and create_time like "%'.$_POST['Content']['create_time'].'%" and publish ='.Yii::app()->session['publish'] ;
			}
		
			
		} else {
			
			$criteria->condition ='title like "%'.Yii::app()->session['title'].'%"';
		}
		
		$TitleSort = Yii::app()->session['title'];
		
		$item_count = Content::model()->count($criteria);

		$pages = new CPagination($item_count);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);  // the trick is here!
		
		$typeCriteria = new CDbCriteria;
		$typeCriteria->condition ='';
		$Type = ContentType::model()->findAll($typeCriteria);
		
		$vars= array(
			'model'=> Content::model()->findAll($criteria), // must be the same as $item_count
			'item_count'=>$item_count,
			'page_size'=>Yii::app()->params['listPerPage'],
			'items_count'=>$item_count,
			'pages'=>$pages,
			'TitleSort'=>$TitleSort,
			'Type'=>$Type,
			'pageid' => $pageid,
		);
		
		$this->render('contentsort', $vars);
		
	}
	
	public function actionClearsort() 
	{
		unset(Yii::app()->session['title']);
		unset(Yii::app()->session['type']);
		unset(Yii::app()->session['create_time']);
		unset(Yii::app()->session['update_time']);
		unset(Yii::app()->session['publish']);
		
		$this->redirect($_SERVER['HTTP_REFERER']);
		$this->render('clearsort');
	}
        
	public function actionContentview($slug)
	{
	   // if (!Yii::app()->user->isAdmin) die('Not admin');
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		//$content = Content::model()->findBySlug($slug);
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug = :slug';
		$criteria->params = array(':slug' => $slug);
		$content = Content::model()->find($criteria);
		
		
		$titlepage = 'View Content';
		$pageid = 'ViewContent';
		
		$vars= array(
			'content' => $content,
			'titlepage' => $titlepage,
			'pageid' => $pageid
		);
		$this->render('contentview', $vars);
	}
	
	public function actionContentupdate($slug)
	{
		//if (!Yii::app()->user->isAdmin) die('Not admin');
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$titlepage = 'Edit Content';
		$pageid = 'EditContent';
		
		if (!Yii::app()->user->isAdmin)
			die
		($this->redirect(Yii::app()->request->baseUrl.'/admin/'));
		
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug = :slug';
		$criteria->params = array(':slug' => $slug);
		$model = Content::model()->find($criteria);
		//$model=$this->loadModel();
		
		$contentType = ContentType::model()->findAll();
		
		if(isset($_POST['Content']))
		{
			$model->attributes=$_POST['Content'];
			
			$slug = Yii::app()->util->slugify($_POST['Content']['title']);
			$model->slug= $slug;
			
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				if ($model->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Content has been updated.");
				$this->redirect(Yii::app()->request->baseUrl.'/admin/content/'.$slug);
			} else {
				Yii::app()->user->setFlash('error radius', "Content could not be updated.");
			}
		}
		
		$vars= array(
			'titlepage' => $titlepage,
			'pageid' => $pageid,
			'model' => $model,
			'contentType' => $contentType
		);
	   
		$this->render('contentupdate', $vars);
		
		//$this->redirect('');
	}
		
	public function actionContentupdateimg()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$model = new ContentImage;
		
		if(isset($_POST['ContentImage']))
		{
			$ext = Yii::app()->util->getext(CUploadedFile::getInstance($model,'filename')); //die ($ext);
			
			$allowext = array('png','gif','jpg','jpeg');
			
			if(in_array($ext, $allowext)){
			
				//get recursive data
				$criteria = new CDbCriteria;
				$criteria->condition = 'id ='.$_POST['ContentImage']['content_id1'];
				$imgdata = Content::model()->find($criteria);
				
				$model->attributes=$_POST['ContentImage'];
				$model->filename=CUploadedFile::getInstance($model,'filename');
				$model->title=CUploadedFile::getInstance($model,'filename');
				
				if($model->save())
				{
					$model->filename->saveAs(Yii::app()->basePath.'/../assets/content/'.$model->filename);
					
					if($imgdata->contentType->id == 10){
						Yii::app()->imageapi->createUrl(
							'content_splash_login', // the preset we have configurated
							YiiBase::getPathOfAlias('webroot.assets.content').'/'.$model->filename
						);
					} else {
						Yii::app()->imageapi->createUrl(
							'content_gallery', // the preset we have configurated
							YiiBase::getPathOfAlias('webroot.assets.content').'/'.$model->filename
						);
						
						Yii::app()->imageapi->createUrl(
							'content_thumb', // the preset we have configurated
							YiiBase::getPathOfAlias('webroot.assets.content').'/'.$model->filename
						);
						
						Yii::app()->imageapi->createUrl(
							'content_thumbFront', // the preset we have configurated
							YiiBase::getPathOfAlias('webroot.assets.content').'/'.$model->filename
						);
						
						Yii::app()->imageapi->createUrl(
							'content_splash', // the preset we have configurated
							YiiBase::getPathOfAlias('webroot.assets.content').'/'.$model->filename
						);
					}
					
						
					$this->redirect($_SERVER['HTTP_REFERER']);
					// redirect to success page
				}
				
				$vars = array(
					'model' => $model,
				);
				
			} else {
				
				Yii::app()->user->setFlash('error radius', "Allowed extensions: png gif jpg jpeg.");
				$this->redirect($_SERVER['HTTP_REFERER']);
				
				$vars = array(
				);
				
			}
			
		}
		
		$this->render('contentupdateimg', $vars);
	}
	
	public function actionContentdeleteimg()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$idImg = $_GET['id'];
		$Img=ContentImage::model()->findByPk($idImg); // assuming there is a post whose ID is 10
		$Img->delete(); // delete the row from the database table
		$this->redirect($_SERVER['HTTP_REFERER']);
		$this->render('contentdeleteimg');
	}
	
	public function actionContentcreate()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$titlepage = 'Create Content';
		$pageid = 'CreateContent';
		
		$model = new Content;
		
		$datenow = date('Y').'-'.date('m').'-'.date('d').' '.date('H:i:s');
		
		if(isset($_POST['Content'])){
			$model->attributes=$_POST['Content'];
			
			$slug = Yii::app()->util->slugify($_POST['Content']['title']);
			
			$model->slug= $slug;
			
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				if ($model->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Content has been created.");
				$this->redirect(Yii::app()->request->baseUrl.'/admin/content/'.$slug);
			} else {
				Yii::app()->user->setFlash('error radius', "Content could not be created.");
			}
		}
		
		$contentType = ContentType::model()->findAll();
		
		$vars= array(
			'titlepage' => $titlepage,
			'pageid' => $pageid,
			'contentType' => $contentType,
			'model' => $model,
			'datenow' => $datenow,
		);
		
		$this->render('contentcreate', $vars);
	}
	
	public function actionContenttype()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$criteria = new CDbCriteria;
		$criteria->condition = '';
		$allcontent = ContentType::model()->findAll($criteria);

		$titlepage = 'Content Type';
		$pageid = 'ListingContentType';

		$item_count = ContentType::model()->count($criteria);

		$pages = new CPagination($item_count);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);  // the trick is here!
		
		
		$typeCriteria = new CDbCriteria;
		$typeCriteria->condition ='';
		$Type = ContentType::model()->findAll($typeCriteria);
		
		$vars = array(
			'allcontent'=> $allcontent,
			'model'=> ContentType::model()->findAll($criteria), // must be the same as $item_count
			'item_count'=>$item_count,
			'page_size'=>Yii::app()->params['listPerPage'],
			'items_count'=>$item_count,
			'pages'=>$pages,
			'titlepage' => $titlepage,
			'pageid' => $pageid,
			'Type' => $Type
		);
		
		$this->render('contenttype', $vars);
	}
	
	public function actionContenttypecreate()
	{
		
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$titlepage = 'Create Content Type';
		$pageid = 'CreateContentType';
		
		$model = new ContentType;
		
		if(isset($_POST['ContentType'])){
			$model->attributes=$_POST['ContentType'];
			
			$slug = Yii::app()->util->slugify($_POST['ContentType']['name']);
			
			$model->slug= $slug;
			
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				if ($model->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Content has been created.");
				$this->redirect(Yii::app()->request->baseUrl.'/admin/contenttype/');
			} else {
				Yii::app()->user->setFlash('error radius', "Content could not be created.");
			}
		}
		
		
		$vars = array(
			'titlepage' => $titlepage,
			'pageid' => $pageid,
			'model' => $model,
		);
		
		$this->render('contenttypecreate', $vars);
	}
	
	
	public function actionContentdelete()
	{
		
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		//Content::model()->deleteByPk(169);
		
		if(isset($_POST['Content'])){
			foreach ( $_POST['Content'] as $b):
				Content::model()->deleteByPk($b);
			endforeach;
			Yii::app()->user->setFlash('sucsess radius', "Content has been deleted.");
			$this->redirect($_SERVER['HTTP_REFERER']);
			
			$vars = array(
				'title' => $title,
				'id_content' => $id_content,
			);
			
		} else {
			
			
			Yii::app()->user->setFlash('error radius', "Content not be selected.");
			$this->redirect($_SERVER['HTTP_REFERER']);
			
			$vars = array(
				'title' => $title,
			);
			
		}
		
		$title = 'delete';
		
		
		
		$this->render('contentdelete', $vars);
	}
	
	public function actionContenttypedelete()
	{
		
		
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		//Content::model()->deleteByPk(169);
		
		if(isset($_POST['ContentType'])){
			foreach ( $_POST['ContentType'] as $b):
				ContentType::model()->deleteByPk($b);
			endforeach;
			Yii::app()->user->setFlash('sucsess radius', "Content Type has been deleted.");
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		
		$title = 'delete';
		
		$vars = array(
			'title' => $title,
			'id_content' => $id_content,
		);
		$this->render('contenttypedelete', $vars);
	}
	
	public function actionContenttypeupdate($slug)
	{
	
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		
		$titlepage = 'Edit Content Type';
		$pageid = 'EditContentType';
		
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug = :slug';
		$criteria->params = array(':slug' => $slug);
		$model = ContentType::model()->find($criteria);
		//$model=$this->loadModel();
		
		
		if(isset($_POST['ContentType']))
		{
			$model->attributes=$_POST['ContentType'];
			
			$slug = Yii::app()->util->slugify($_POST['ContentType']['name']);
			$model->slug= $slug;
			
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				if ($model->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Content Type has been updated.");
				$this->redirect(Yii::app()->request->baseUrl.'/admin/contenttype/');
			} else {
				Yii::app()->user->setFlash('error radius', "Content Type could not be updated.");
			}
		}
		
		$vars= array(
			'titlepage' => $titlepage,
			'pageid' => $pageid,
			'model' => $model,
		);
	
		$this->render('contenttypeupdate', $vars);
	}
	
	public function actionMenu()
	{
		
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
	
		$criteria = new CDbCriteria;
		$menuType = MenuType::model()->findAll($criteria);
		
		$title = 'Menu';
		$pageid = 'Menu';
		
		$vars = array(
			'title' => $title,
			'pageid' => $pageid,
			'menuType' => $menuType,
		);
		
		$this->render('menu', $vars);
	}
	
	public function actionMenucustomize($slug)
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug = :slug';
		$criteria->params = array(':slug' => $slug);
		$menutype = MenuType::model()->find($criteria);
		
		$title = $menutype->name;
		$typeMenu = $menutype->id;
		
		$criteria2 = new CDbCriteria;
		$criteria2->condition = 'menu_type_id ='.$typeMenu;
		$menu = Menu::model()->findAll($criteria2);
		
		$pageid = 'MenuCustomize';
		
		$vars = array(
			'title' => $title,
			'pageid' => $pageid,
			'menu' => $menu,
			'menutype' => $menutype,
		);
		
		$this->render('menucustomize', $vars);
	}
	
	public function actionEditmenucustomize($slug)
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'id = :slug';
		$criteria->params = array(':slug' => $slug);
		$menu = Menu::model()->find($criteria);
		
		
		$criteria2 = new CDbCriteria;
		$criteria2->condition = 'id = :id';
		$criteria2->params = array(':id' => $menu->menu_type_id);
		$TypeMenu = MenuType::model()->find($criteria2);
		
		
		if(isset($_POST['Menu']))
		{
			$menu->attributes=$_POST['Menu'];
			
			$slug = Yii::app()->util->slugify($_POST['Menu']['title']);
			$menu->title= $slug;
			$menu->slug= $slug;
			
			// validate user input and redirect to the previous page if valid
			if($menu->validate())
				if ($menu->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Menu ".$TypeMenu->slug." has been updated.");
				$this->redirect(Yii::app()->request->baseUrl.'/admin/menu-customize/'.$TypeMenu->slug);
			} else {
				Yii::app()->user->setFlash('error radius', "Menu ".$TypeMenu->slug." could not be updated.");
			}
		}
		
		
		$pageid = 'EditMenuCustomize';
		
		$vars = array(
			'pageid' => $pageid,
			'menu' => $menu,
			'TypeMenu' => $TypeMenu,
		);
		
		$this->render('editmenucustomize', $vars);
	}
	
	public function actionMenucustomizeadd()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$type = $_GET['type'];
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'id ='.$type;
		$menutype = MenuType::model()->find($criteria);
		
		$typeMenu = $menutype->slug;
		
		$title = 'Add Menu';
		$pageid = 'AddMenuCustomize';
		
		$model = new Menu;
		
		if(isset($_POST['Menu'])){
			$model->attributes=$_POST['Menu'];
			
			$slug = Yii::app()->util->slugify($_POST['Menu']['title']);
			
			$model->slug= $slug;
			
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				if ($model->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Menu ".$typeMenu." has been created.");
				$this->redirect(Yii::app()->request->baseUrl.'/admin/menu-customize/'.$typeMenu);
			} else {
				Yii::app()->user->setFlash('error radius', "Menu ".$typeMenu." could not be created.");
			}
		}
		
		$vars = array(
			'title' => $title,
			'pageid' => $pageid,
			'menutype' => $menutype,
			'model' => $model,
		);
		$this->render('menucustomizeadd', $vars);
	}
	
	public function actionMenucustomizedelete()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$idMenu = $_GET['id'];
		$Menu=Menu::model()->findByPk($idMenu); // assuming there is a post whose ID is 10
		$Menu->delete(); // delete the row from the database table
		Yii::app()->user->setFlash('sucsess radius', "Menu has been deleted.");
		$this->redirect($_SERVER['HTTP_REFERER']);
		$this->render('menucustomizedelete');
	}
	
	public function actionMenucreate()
	{
		
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
	
		$criteria = new CDbCriteria;
		$menuType = MenuType::model()->findAll($criteria);
		
		$title = 'Menu Add';
		$pageid = 'MenuAdd';
		
		$vars = array(
			'title' => $title,
			'pageid' => $pageid,
			'menuType' => $menuType,
		);
		
		$this->render('menucreate', $vars);
	}
	
	public function actionUpdatecomment($id, $publish)
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$title = 'Update Comment';
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'id = :id';
		$criteria->params = array(':id' => $id);
		$model = Comment::model()->find($criteria);
		
		if(isset($id))
		{
			$model->attributes='Comment';
			
			$publish = $publish;
			$model->publish = $publish;
			
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				if ($model->save()) {
				$this->redirect($_SERVER['HTTP_REFERER']);
			}
		}
		
		$vars = array(
			'title' => $title,
		);
		
		$this->render('updatecomment', $vars);
	}
	
	public function actionRemovecomment($id)
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		}
		
		$idComment = $id;
		$comments = Comment::model()->findByPk($idComment); // assuming there is a post whose ID is 10
		$comments->delete(); // delete the row from the database table
		$this->redirect($_SERVER['HTTP_REFERER']);
		
		$this->render('removecomment');
	}
	
	public function actionReportcontenthits()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$title = '';
		$pageid = 'ReportHitsContent';
		
		$criteria = new CDbCriteria;
		$criteria->condition = '';
		$criteria->order = 'hits DESC';
		$criteria->limit = '30' ;
		$allcontent = Content::model()->findAll($criteria);
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'content_type_id = 3';
		$criteria->order = 'hits DESC';
		$criteria->limit = '30' ;
		$news = Content::model()->findAll($criteria);
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'content_type_id = 6';
		$criteria->order = 'hits DESC';
		$criteria->limit = '30' ;
		$article = Content::model()->findAll($criteria);
		
		$vars = array(
			'title' => $title,
			'pageid' => $pageid,
			'allcontent' => $allcontent,
			'news' => $news,
			'article' => $article,
		);
		
		$this->render('reportcontenthits', $vars);
	}
	
	
	public function actionSharetoemail($id)
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$this->layout=false;
		
		$title = 'Share to Email';
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'id ='.$id;
		$content = Content::model()->find($criteria);
		
		$member = Member::model()->findAll();
		
		$vars = array(
			'title' => $title,
			'content' => $content,
			'member' => $member,
		);
		
		$this->render('sharetoemail', $vars);
	}
	
	
	public function actionSendarticletoemail()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$this->layout=false;
		
		if(isset($_POST['Share'])){
			
			$email = $_POST['Share']['to'];
			
			$exp = explode(",", $email);
			
			foreach($exp as $b){
				//echo 'send to '.$b.'<br/>';
				$title = $_POST['Share']['subject'];
				$body = $_POST['Share']['body'];
				
				Yii::app()->admin_mailer->AddAddress($b);
				Yii::app()->admin_mailer->Subject = $title;
				Yii::app()->admin_mailer->MsgHTML($body);
				Yii::app()->admin_mailer->Send();
			}
			
			
			
			
			Yii::app()->user->setFlash('sucsess radius', "Content has been share via email to ".$email."");
			
		}
		
		$this->render('sendarticletoemail');
	}
	
	
	public function actionMember()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$title = '';
		$pageid = 'AdminMember';
		
		$criteria = new CDbCriteria;
		//$criteria->condition = '' ;
		//$criteria->order = 'update_time DESC';
		$result = Member::model()->findAll($criteria);
		
		/*
		$criteria = new CDbCriteria;
		$member = Member::model()->findAll();
		*/
		
		$item_count = Member::model()->count($criteria);

		$pages = new CPagination($item_count);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);  // the trick is here!
		
		$vars = array(
			'title' => $title,
			//'member' => $member,
			'pageid' => $pageid,
			'model'=> Member::model()->findAll($criteria), // must be the same as $item_count
			'item_count'=>$item_count,
			'page_size'=>Yii::app()->params['listPerPage'],
			'items_count'=>$item_count,
			'pages'=>$pages,
		);
		$this->render('member', $vars);
	}
	
	public function actionTheme()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$title = 'Theme';
		$pageid = 'AdminTheme';
		
		
		$criteria = new CDbCriteria;
		$activeTheme = Sites::model()->find($criteria);
		
		$criteria = new CDbCriteria;
		$theme = Themes::model()->findAll($criteria);
		
		
		if(isset($_POST['Sites'])){
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'id = 1';
			$model = Sites::model()->find($criteria);
			
			$model->attributes=$_POST['Sites'];
			
			//var_dump($_POST['Sites']['themes_id']);
			
			
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				if ($model->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Theme has been changed.");
				$this->redirect($_SERVER['HTTP_REFERER']);
			} else {
				Yii::app()->user->setFlash('error radius', "Theme could not be changed.");
			}
			
		}
		
		
		$vars = array(
			'title' => $title,
			'pageid' => $pageid,
			'activeTheme' => $activeTheme,
			'theme' => $theme,
		);
		$this->render('theme', $vars);
	}
	
	public function actionThemeconfig($slug)
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		}
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug = :slug';
		$criteria->params = array(':slug' => $slug);
		$theme = Themes::model()->find($criteria);
		
		$title = 'Config Theme';
		$pageid = 'ConfigTheme';
		
		$vars = array(
			'title' => $title,
			'pageid' => $pageid,
			'theme' => $theme,
		);
		$this->render('themeconfig', $vars);
	}
	
	public function actionUpdatethemeimg()
	{
		// scheck user login
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		//check privilage
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		}

		$allowext = array('jpg','png','jpeg','gif');
		
		if(isset($_POST)){
			$criteria = new CDbCriteria;
			$criteria->condition = 'id ='.$_POST['Themes']['id'];
			$model = Themes::model()->find($criteria);
			
			if(!empty($_FILES['Themes']['name']['logo'])){
				//get ext files
				$ext = strtolower(Yii::app()->util->getext($_FILES['Themes']['name']['logo']));
				//check ext file
				if(in_array($ext, $allowext)){
				
					//save logo
					$model->logo = $_FILES['Themes']['name']['logo'];
					$model->save();
					
					//save file
					move_uploaded_file($_FILES['Themes']['tmp_name']['logo'],
					Yii::app()->basePath .'/../themes/v1/img/'. $_FILES['Themes']['name']['logo']);
					Yii::app()->user->setFlash('sucsess', $_FILES['Themes']['name']['logo']." Logo has been successfully uploaded.");
					$this->redirect($_SERVER['HTTP_REFERER']);
				
				} else{
					Yii::app()->user->setFlash('error alert alert-block alert-error fade in', "Allowed extensions: jpg,jpeg,png,gif.");
					$this->redirect($_SERVER['HTTP_REFERER']);
				}
			}
			
			if(!empty($_FILES['Themes']['name']['icon'])){
				//get ext files
				$ext = strtolower(Yii::app()->util->getext($_FILES['Themes']['name']['icon']));
				//check ext file
				if(in_array($ext, $allowext)){
				
					//save icon
					$model->icon = $_FILES['Themes']['name']['icon'];
					$model->save();
					
					//save file
					move_uploaded_file($_FILES['Themes']['tmp_name']['icon'],
					Yii::app()->basePath .'/../themes/v1/img/'. $_FILES['Themes']['name']['icon']);
					Yii::app()->user->setFlash('sucsess', $_FILES['Themes']['name']['icon']." Icon has been successfully uploaded.");
					$this->redirect($_SERVER['HTTP_REFERER']);
				
				} else{
					Yii::app()->user->setFlash('error alert alert-block alert-error fade in', "Allowed extensions: jpg,jpeg,png,gif.");
					$this->redirect($_SERVER['HTTP_REFERER']);
				}
			}
			
			if(!empty($_FILES['Themes']['name']['bannertop'])){
				//get ext files
				$ext = strtolower(Yii::app()->util->getext($_FILES['Themes']['name']['bannertop']));
				//check ext file
				if(in_array($ext, $allowext)){
				
					//save icon
					$model->bannertop = $_FILES['Themes']['name']['bannertop'];
					$model->save();
					
					//save file
					move_uploaded_file($_FILES['Themes']['tmp_name']['bannertop'],
					Yii::app()->basePath .'/../assets/img/'. $_FILES['Themes']['name']['bannertop']);
					Yii::app()->user->setFlash('sucsess', $_FILES['Themes']['name']['bannertop']." Banner Top has been successfully uploaded.");
					$this->redirect($_SERVER['HTTP_REFERER']);
				
				} else{
					Yii::app()->user->setFlash('error alert alert-block alert-error fade in', "Allowed extensions: jpg,jpeg,png,gif.");
					$this->redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}
	}
	
	public function actionDocumentsettings()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		}
		
		$title = 'Document Browse Settings';
		$pageid = 'DocumentBrowseSettings';
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'nik NOT LIKE "%x%" AND nik NOT LIKE "%dep%" AND name NOT LIKE "%NONAME%"';
		$member = Member::model()->findAll($criteria);
		
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'upload_document = 1';
		$member_upload = Member::model()->findAll($criteria);
		
		
		
		if(isset($_POST['Member'])){
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'id ='.$_POST['Member']['id'];
			$model = Member::model()->find($criteria);
			
			$model->attributes=$_POST['Member'];
			
			$model->upload_document = '1';
			
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				if ($model->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Succeeded in adding users");
				$this->redirect($_SERVER['HTTP_REFERER']);
			} else {
				Yii::app()->user->setFlash('error radius', "Failed in adding users");
			}
		}
		
		$vars = array(
			'title' => $title,
			'pageid' => $pageid,
			'member' => $member,
			'member_upload' => $member_upload,
		);
		
		$this->render('documentsettings', $vars);
	}
	
	public function actionRemoveuserdocument($id)
	{
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'id ='.$id;
		$model = Member::model()->find($criteria);
		
		
		//$model->attributes=$_POST['Member'];
		
		$model->upload_document = '0';
		
		// validate user input and redirect to the previous page if valid
		if($model->validate())
			if ($model->save()) {
			Yii::app()->user->setFlash('sucsess radius', "Succeeded in removing users");
			$this->redirect($_SERVER['HTTP_REFERER']);
		} else {
			Yii::app()->user->setFlash('error radius', "Failed in adding users");
		}
			
		$vars = array(
		);
		
		$this->render('removeuserdocument', $vars);
	}
	
	public function actionPolling()
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		
		$title = 'Polling';
		$pageid = 'PollingSettings';
		
		$criteria = new CDbCriteria;
		$criteria->condition = '';
		$polling = Polling::model()->findAll($criteria);
		
		$model = new Polling;
		
		if(isset($_POST['Polling'])){
			$model->attributes=$_POST['Polling'];
			
			//$slug = Yii::app()->util->slugify($_POST['Content']['title']);
			
			//$model->slug= $slug;
			
			// validate user input and redirect to the previous page if valid
			
			if($model->validate())
				if ($model->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Polling has been created.");
				//$this->redirect(Yii::app()->request->baseUrl.'/admin/content/'.$slug);
				$this->redirect($_SERVER['HTTP_REFERER']);
			} else {
				Yii::app()->user->setFlash('error radius', "Polling could not be created.");
			}
		}
		
		//find polling active
		$criteria = new CDbCriteria;
		$criteria->condition = 'active = 1';
		$pollingActive = Polling::model()->find($criteria);
		
		// find total vote
		$criteria = new CDbCriteria;
		$criteria->condition = 'polling_id ='.$pollingActive->id;
		$TotalVote = MemberVote::model()->findAll($criteria);
		
		//count total vote
		$ResultVote = count($TotalVote);
		
		
		$vars = array(
			'title'=>$title,
			'pageid'=>$pageid,
			'polling'=>$polling,
			'model'=>$model,
			'ResultVote'=>$ResultVote,
		);
		$this->render('polling', $vars);
	}
	
	public function actionDeletepolling($id)
	{
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$pollingItem=Polling::model()->findByPk($id); // assuming there is a post whose ID is 10
		$pollingItem->delete(); // delete the row from the database table
		Yii::app()->user->setFlash('sucsess radius', "Succeeded in removing polling");
		$this->redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function actionPollingactive($id, $slug)
	{
		//echo $slug; die;
		
		if($slug == 'true'){
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'active = 1';
			$modelCheck = Polling::model()->find($criteria);
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'id = :id';
			$criteria->params = array(':id' => $id);
			$model = Polling::model()->find($criteria);
			
			if(isset($id))
			{
				
				$model->attributes='Polling';
				
				$active = 0;
				$modelCheck->active = $active;
				
				// validate user input and redirect to the previous page if valid
				if($modelCheck->validate())
					if ($modelCheck->save()) {
						//$this->redirect($_SERVER['HTTP_REFERER']);
					}
				
				$model->attributes='Polling';
				
				$active = 1;
				$model->active = $active;
				
				// validate user input and redirect to the previous page if valid
				if($model->validate())
					if ($model->save()) {
						//$this->redirect($_SERVER['HTTP_REFERER']);
					}
			}
			
		} else {
			
		}
		
		$this->redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function actionAddchoice($pollId)
	{
		
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'id ='.$pollId;
		$poll = Polling::model()->find($criteria);
		
		$poll_id = $poll->id;
		
		$title = 'Add Polling Choice';
		$pageid = 'AddPollingChoice';
		
		$model = new PollingChoice;
		
		
		if(isset($_POST['PollingChoice'])){
			$model->attributes=$_POST['PollingChoice'];
			
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				if ($model->save()) {
				Yii::app()->user->setFlash('sucsess radius', "Polling has been created.");
			} else {
				Yii::app()->user->setFlash('error radius', "Polling could not be created.");
			}
		}
		
		
		$vars = array(
			'title'=>$title,
			'pageid'=>$pageid,
			'model'=>$model,
			'poll_id'=>$poll_id,
		);
		
		$this->render('addchoice', $vars);
	}
	
	public function actionDeletechoice($id)
	{
		//check user login
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		if (!Yii::app()->user->isAdmin){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$pollingChoiceItem=PollingChoice::model()->findByPk($id); // assuming there is a post whose ID is 10
		
		//echo $id; die;
		
		$pollingChoiceItem->delete(); // delete the row from the database table
		Yii::app()->user->setFlash('sucsess radius', "Succeeded in removing choice polling");
		$this->redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function actionPollingchoice()
	{
		//check user login
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'id ='.$_POST['id'];
		$model = PollingChoice::model()->find($criteria);
		
		//var_dump($model); die;
		
		$model->choice = $_POST['value'];
		$model->save();
		
		echo $model['choice'];
		
		
	}
	
	public function actionSiteconfigure()
	{
		//check user login
		if (Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->request->baseUrl.'/admin');
		} 
		
		$criteria = new CDbCriteria;
		$criteria->condition = '';
		$sites = Sites::model()->find($criteria);
		
		$pageid = 'SiteConfigure';
		
		if(isset($_POST['Sites'])){
		
			$sites->attributes=$_POST['Sites'];
			if($sites->save()){
				Yii::app()->user->setFlash('sucsess radius', "Content has been updated.");
			}
		}
		
		$vars = array(
			'sites'=>$sites,
			'pageid'=>$pageid,
		);
		
		$this->render('siteconfigure', $vars);
	}
	
	
	public function actionContentvideo($slug)
	{
		$pageid = 'SiteConfigure';
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug = :slug';
		$criteria->params = array(':slug' => $slug);
		$content = Content::model()->find($criteria);
		
		if(isset($_POST['Video'])){
			var_dump($_FILES);
		}
		
		$vars = array(
			'pageid' => $pageid,
			'content' => $content,
		);
		
		$this->render('contentvideo', $vars);
	}
	
}

?>