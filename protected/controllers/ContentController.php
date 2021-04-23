<?php
require_once ("SqlServer/SqlServerAdapter.php");
require_once('ariwa/myTcpdf2.php');
require_once('ariwa/data/User.php');	
require_once('ariwa/fpdi/FPDI_Protection.php');


class ContentController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	private $pt = "PT. Metra Digital Media";

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
		$this->render('index');
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
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionReadnews($slug)
	{
		$news = Content::model()->findBySlug($slug);
		if ($news) {
			if (isset(Yii::app()->session['contentHits'])) {
				$dataHits = unserialize(Yii::app()->session['contentHits']);
				if (is_array($dataHits)) {
					if (!in_array($news->id, $dataHits)) {
						Content::model()->addHit($news->id);
						$dataHits[] = $news->id;
						Yii::app()->session['contentHits'] = serialize($dataHits);
					}
				} else {
					Content::model()->addHit($news->id);
					$dataHits = array();
					$dataHits[] = $news->id;
					Yii::app()->session['contentHits'] = serialize($dataHits);
				}
			} else {
				Content::model()->addHit($news->id);
				$dataHits = array();
				$dataHits[] = $news->id;
				Yii::app()->session['contentHits'] = serialize($dataHits);
			}
			
		}
		
		
        $idpage = 'readnews';
		
		$vars = array(
			'news' => $news,
			'idpage' => $idpage,
		);		
		$this->render('readnews', $vars);
	}
	
	public function actionReadnewspopular($slug)
	{
		$news = Content::model()->findBySlug($slug);
		if ($news) {
			if (isset(Yii::app()->session['contentHits'])) {
				$dataHits = unserialize(Yii::app()->session['contentHits']);
				if (is_array($dataHits)) {
					if (!in_array($news->id, $dataHits)) {
						Content::model()->addHit($news->id);
						$dataHits[] = $news->id;
						Yii::app()->session['contentHits'] = serialize($dataHits);
					}
				} else {
					Content::model()->addHit($news->id);
					$dataHits = array();
					$dataHits[] = $news->id;
					Yii::app()->session['contentHits'] = serialize($dataHits);
				}
			} else {
				Content::model()->addHit($news->id);
				$dataHits = array();
				$dataHits[] = $news->id;
				Yii::app()->session['contentHits'] = serialize($dataHits);
			}
			
		}
		
		$vars = array('news' => $news);		
		$this->render('readnewspopular', $vars);
	}
	
	public function actionNewspopular()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'content_type_id = 3 AND is_popular = 1';
		$criteria->order = 'update_time DESC';
		$allnews = Content::model()->findAll($criteria);
		
		$titlepage = 'Berita Populer';
		
		$item_count = Content::model()->count($criteria);
		
		$pages = new CPagination($item_count);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);  // the trick is here!
		
		/*
		$vars= array(
			'allnews' => $allnews,
			'titlepage' => $titlepage
		);
		*/
		
		$vars= array(
			'allnews'=> $allnews,
			'model'=> Content::model()->findAll($criteria), // must be the same as $item_count
			'item_count'=>$item_count,
			'page_size'=>Yii::app()->params['listPerPage'],
			'items_count'=>$item_count,
			'pages'=>$pages,
			'titlepage' => $titlepage
		);
		
		$this->render('newspopular', $vars);
	}
	
	
	public function actionNews()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'content_type_id = 3 AND publish = 1';
		$criteria->order = 'update_time DESC';
		$allnews = Content::model()->findAll($criteria);
		
		$item_count = Content::model()->count($criteria);
		
		$pages = new CPagination($item_count);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);  // the trick is here!
		
		
		$vars= array(
			'allnews'=> $allnews,
			'model'=> Content::model()->findAll($criteria), // must be the same as $item_count
			'item_count'=>$item_count,
			'page_size'=>Yii::app()->params['listPerPage'],
			'items_count'=>$item_count,
			'pages'=>$pages
		);
		
		$this->render('news', $vars);
	}
	
	public function actionReadarticle($slug)
	{
		$article = Content::model()->findBySlug($slug);
		if ($article) {
			if (isset(Yii::app()->session['contentHits'])) {
				$dataHits = unserialize(Yii::app()->session['contentHits']);
				if (is_array($dataHits)) {
					if (!in_array($article->id, $dataHits)) {
						Content::model()->addHit($article->id);
						$dataHits[] = $article->id;
						Yii::app()->session['contentHits'] = serialize($dataHits);
					}
				} else {
					Content::model()->addHit($article->id);
					$dataHits = array();
					$dataHits[] = $article->id;
					Yii::app()->session['contentHits'] = serialize($dataHits);
				}
			} else {
				Content::model()->addHit($article->id);
				$dataHits = array();
				$dataHits[] = $article->id;
				Yii::app()->session['contentHits'] = serialize($dataHits);
			}
			
		}
		
		
		$vars = array(
			'article' => $article
		);
		
		/*
		$html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('readarticle', $vars, true));
        $html2pdf->Output();
		*/
				
		$this->render('readarticle', $vars);
	}
	
	public function actionArticle()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'content_type_id = 6';
		$criteria->order = 'update_time DESC';
		$article = Content::model()->findAll($criteria);
		
		
		$item_count = Content::model()->count($criteria);
		
		$pages = new CPagination($item_count);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);  // the trick is here!
		
		
		$vars= array(
			'allarticle'=> $article,
			'model'=> Content::model()->findAll($criteria), // must be the same as $item_count
			'item_count'=>$item_count,
			'page_size'=>Yii::app()->params['listPerPage'],
			'items_count'=>$item_count,
			'pages'=>$pages
		);
		
		
		
		//$vars= array('article' => $article);
		
		$this->render('article', $vars);
	}
	
	public function actionMediarelease()
	{
		//Yii::app()->media->getcontent();
		
		Yii::import('application.vendors.*');
		require_once 'magpierss/rss_fetch.inc';
		
		$url = "http://rss.detik.com";
		$rss = fetch_rss( $url );
		
		$title = 'Media Release';
		
		//var_dump($rss);
		
		$vars= array(
			'title'=> $title,
			'rss' => $rss
			
		);
		
		$this->render('mediarelease', $vars);
	}
	
	public function actionSearch()
	{
		$keyword = $_GET['search-keyword'];
		
		$title = 'Pencarian';
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'title LIKE "%'.$keyword.'%" or body LIKE "%'.$keyword.'%"' ;
		$result = Content::model()->findAll($criteria);
		
		$item_count = Content::model()->count($criteria);
		
		$pages = new CPagination($item_count);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);  // the trick is here!
		
		$vars= array(
			'keyword'=> $keyword,
			'result'=> $result,
			'model'=> Content::model()->findAll($criteria), // must be the same as $item_count
			'item_count'=>$item_count,
			'page_size'=>Yii::app()->params['listPerPage'],
			'items_count'=>$item_count,
			'pages'=>$pages,
			'title' => $title
		);

		
		$this->render('search', $vars);
	}
	
	
	public function actionGallery()
	{
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'splash = 1' ;
		$criteria->order = 'update_time DESC';
		//$criteria->limit = '6' ;
		$ImageGallery = Content::model()->findAll($criteria);
		
		$title = 'Gallery Foto';
        $idpage = 'gallery';
		
		$criteria2 = new CDbCriteria;
		$criteria2->condition = 'is_popular = 1' ;
		$criteria2->order = 'update_time DESC';
		//$criteria->limit = '6' ;
		$ImgPopular = Content::model()->findAll($criteria);
		
		
		$vars= array(
			'title' => $title,
			'idpage' => $idpage,
			'ImageGallery' => $ImageGallery,
			'ImgPopular' => $ImgPopular
		);
		
		
		
		$this->render('gallery', $vars);
	}
	
	public function actionGallerydetail($slug)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug ="'.$slug.'"' ;
		$ImgGallery = Content::model()->find($criteria);
		
		$title = 'Gallery Foto';
		$idpage = 'gallerydetail';
	
		$vars= array(
			'slug'=> $slug,
			'title'=> $title,
			'idpage'=> $idpage,
			'ImgGallery'=> $ImgGallery,
		);
		$this->render('gallerydetail', $vars);
	}
	
	public function actionDocument()
	{
		$title ='Dokumen';
		
		$vars= array(
			'title' => $title
		);
		$this->render('document', $vars);
	}
	
	public function actionApppersonil()
	{
		
		$title = 'Aplikasi Personil';
        $idpage = 'AplikasiPersonil';
		
		$vars= array(
			'title' => $title,
			'idpage' => $idpage,
		);
		$this->render('apppersonil', $vars);
	}
	
	public function actionAppservice()
	{
		
		$title = 'Aplikasi Kedinasan';
        $idpage = 'AplikasiKedinasan';
	
		$vars= array(
			'title' => $title,
			'idpage' => $idpage,
		);
		$this->render('appservice', $vars);
	}
	
	public function actionBod()
	{
		$title = 'BOD';
        	$idpage = 'bod';
		
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'content_type_id =:contentTypeId AND publish =:Publish';
		$criteria->params = array(':contentTypeId' => 7, ':Publish' => 1);
		$result = Content::model()->findAll($criteria);
		
		$vars= array(
			'title' => $title,
			'result' => $result,
			'idpage' => $idpage,
		);
		$this->render('bod', $vars);
		
	}
	
	public function actionPrint($slug)
	{
		
		$content = Content::model()->findBySlug($slug);
		
		
		
		$vars = array(
			'content' => $content
		);
		
		$this->layout = 'mainpdf';
		
		
		
		$html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('print', $vars, true));
		
		//header('Content-Disposition: attachment; filename=fname.pdf');
		//header("Content-type:application/pdf");
		
        $html2pdf->Output();
		
				
		$this->render('print', $vars);
	}
	
	public function actionPassword()
	{
		$title = 'Ubah Password';
        $idpage = 'EditPwd';
		
		$vars = array(
			'title' => $title,
			'idpage' => $idpage,
		);
		
		$this->render('password', $vars);
	}
	
	public function actionEbook()
	{
		$titlepage = 'EBook';
		$idpage = 'ebook';
		$title = 'EBook';
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'content_type_id = 8 AND publish = 1' ;
		$result = Content::model()->findAll($criteria);
		
		$item_count = Content::model()->count($criteria);
		
		$pages = new CPagination($item_count);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);  // the trick is here!
		
		$vars = array(
			'titlepage'=>$titlepage,
			'model'=> Content::model()->findAll($criteria), // must be the same as $item_count
			'idpage'=>$idpage,
			'title'=>$title,
			'result'=>$result,
			'item_count'=>$item_count,
			'pages'=>$pages,
		);
		$this->render('ebook', $vars);
	}
	
	
	public function actionReadcorporate($slug)
	{
	
		$titlePage = 'ReadCorporate';
		$idpage = 'readcorporate';
		$title = 'Read Corporate';
		
		/*
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug ='.$slug ;
		$result = Content::model()->findAll($criteria);
		*/
		
		$corporate = Content::model()->findBySlug($slug);
		
		
		$vars = array(
			'titlePage' => $titlePage,
			'idpage' => $idpage,
			'title' => $title,
			'corporate' => $corporate,
		);
		$this->render('readcorporate', $vars);
	}
	
	public function actionBirthday()
	{
		
		$query = 'SELECT name, nik, CONCAT_WS("-", MONTH(born_date) , DAY(born_date)) AS born_date, DATEDIFF( CONCAT_WS( "-", YEAR( CURDATE( ) ) , MONTH( born_date ) , DAY( born_date ) ) , curdate( ) ) AS DiffDate
FROM member
WHERE month( born_date ) <>0
AND day( born_date ) <>0
AND DATEDIFF( CONCAT_WS( "-", YEAR( CURDATE( ) ) , MONTH( born_date ) , DAY( born_date ) ) , curdate( ) ) < 7
AND DATEDIFF( CONCAT_WS( "-", YEAR( CURDATE( ) ) , MONTH( born_date ) , DAY( born_date ) ) , curdate( ) ) >= 0
AND nik <> "101344" and nik <> "15D007" and nik <> "030710" and nik <> "030710" and nik <> "960354" and nik <> "900167" and nik <> "010510" and nik <> "900167"
ORDER BY DiffDate ASC
LIMIT 100';
			$command = Yii::app()->db->createCommand($query);
			$birthday = $command->queryAll();
			
			$title = 'Yang Berulang Tahun';
			$idpage = 'Birthday';
		
		$vars = array(
			'title' => $title,
			'birthday' => $birthday,
			'idpage' => $idpage,
		);
		$this->render('birthday', $vars);
	}
	
	
	public function actionBirthdaydetail($nik)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'nik ="'.$nik.'"';
		$member = Member::model()->find($criteria);
		
		$query = 'SELECT name, nik, CONCAT_WS("-", MONTH(born_date) , DAY(born_date)) AS born_date, DATEDIFF( CONCAT_WS( "-", YEAR( CURDATE( ) ) , MONTH( born_date ) , DAY( born_date ) ) , curdate( ) ) AS DiffDate
FROM member
WHERE month( born_date ) <>0
AND day( born_date ) <>0
AND DATEDIFF( CONCAT_WS( "-", YEAR( CURDATE( ) ) , MONTH( born_date ) , DAY( born_date ) ) , curdate( ) ) < 7
AND DATEDIFF( CONCAT_WS( "-", YEAR( CURDATE( ) ) , MONTH( born_date ) , DAY( born_date ) ) , curdate( ) ) >= 0
AND nik <> "101344" and nik <> "15D007" and nik <> "030710" and nik <> "030710" and nik <> "960354" and nik <> "900167" and nik <> "010510" and nik <> "900167"
ORDER BY DiffDate ASC
LIMIT 100';
			$command = Yii::app()->db->createCommand($query);
			$birthday = $command->queryAll();	
		
		$title = 'Birtday Detail';
		$idpage = 'BirthdayDetail';
		
		$vars = array(
			'title' => $title,
			'idpage' => $idpage,
			'member' => $member,
			'birthday' => $birthday,
		);
		
		$this->render('birthdaydetail', $vars);
	}
	
	public function actionEmailto($nik)
	{
		$this->layout=false;
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'nik ="'.$nik.'"';
		$member = Member::model()->find($criteria);
		
		$title = 'Send Email';
		
		$vars = array(
			'title' => $title,
			'member' => $member,
		);
		$this->render('emailto', $vars);
	}
	
	public function actionSendemail()
	{
		$this->layout=false;
		
		$title = 'Send Email';
		
		if(isset($_POST['Email'])){
			
			$email = $_POST['Email']['sendto'];
			
			$title = $_POST['Email']['subject'];
			$body = $_POST['Email']['body'];
			
			Yii::app()->admin_mailer->AddAddress($email);
			Yii::app()->admin_mailer->Subject = $title;
			Yii::app()->admin_mailer->MsgHTML($body);
			Yii::app()->admin_mailer->Send();
			
			
			Yii::app()->user->setFlash('sucsess radius', "Pesan Anda Telah Terkirim Kepada ".$email."");
		}
		
		$vars = array(
			'title' => $title,
		);
		
		$this->render('sendemail', $vars);
	}
	
	public function actionVideowatch($slug)
	{
		$title = 'Video Watch';
		$idpage = 'VideoWatch';
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug ="'.$slug.'"';
		$WatchVideo = ContentVideo::model()->find($criteria);
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'video_id ='.$WatchVideo->id;
		$Comments = Comment::model()->findAll($criteria);
		
		
		if(!empty($Comments)){
			foreach($Comments as $b){
				$criteria = new CDbCriteria;
				$criteria->condition = 'nik ="'.$b->user.'"';
				$usr = Member::model()->find($criteria);
				$UsrComment = $usr->name;
			}
		} else {
			$UsrComment = '';
		}
		
		
		$vars = array(
			'title' => $title,
			'idpage' => $idpage,
			'WatchVideo' => $WatchVideo,
			'Comments' => $Comments,
			'UsrComment' => $UsrComment,
		);
		
		$this->render('videowatch', $vars);
	}
	
	public function actionVideo()
	{
		$title = 'Gallery Video';
		$idpage = 'Video';

		$criteria = new CDbCriteria;
		$criteria->condition = '';
			$criteria->order = 'upload_time DESC';
		$Video = ContentVideo::model()->findAll($criteria);

		$vars = array(
			'title' => $title,
			'idpage' => $idpage,
			'Video' => $Video,
		);

		$this->render('video', $vars);
	}
	
	
	// ariwa
	public function actionNewemploye()
	{
		if( substr(Yii::app()->session['usr_id'], 0,1) == 'x'){
			$this->redirect(Yii::app()->request->baseUrl . '/site/index');
		}
		
//		$q = "select emp_id, emp_name, CONVERT(VARCHAR(11), hire_date, 106) AS hire_date_out from employee where RIGHT(CONVERT(VARCHAR(10), hire_date, 105), 7) = RIGHT(CONVERT(VARCHAR(10), GETDATE(), 105), 7) order by hire_date desc";
		$q = "
			select x.emp_id, x.emp_name, CONVERT(VARCHAR(11)
			, x.hire_date, 106) AS hire_date_out 
			, RIGHT(CONVERT(VARCHAR(10), x.hire_date, 105), 7) as xx
			, y.dept_name
			, z.position_desc
			from employee x
			left join dept y on x.dept_id = y.dept_id and y.version_id = 'MD2014'
			left join dept_position z on x.position_latest_id = z.position_id and z.version_id = 'MD2014'
			where 
			(
			RIGHT(CONVERT(VARCHAR(10), x.hire_date, 105), 7) = RIGHT(CONVERT(VARCHAR(10), GETDATE(), 105), 7) 
			
			or RIGHT(CONVERT(VARCHAR(10), x.hire_date, 105), 7)
			= ( convert(varchar(2), (convert(integer,CONVERT(varchar(2), GETDATE(), 101))-1))  +'-'+CONVERT(varchar(4), GETDATE(), 102) )
			
			or RIGHT(CONVERT(VARCHAR(10), x.hire_date, 105), 7)
			= ( convert(varchar(2), (convert(integer,CONVERT(varchar(2), GETDATE(), 101))-2))  +'-'+CONVERT(varchar(4), GETDATE(), 102) )
			)
			and x.termination_status = 1
			order by x.hire_date desc
		";
		$con = new Model_SqlServer_SqlServerAdapter();
		$results = $con->fetchAll($q);
	
		$title = 'Karyawan Baru';
		$idpage = 'Newemploye';
		
		$vars = array(
			'title' => $title,
			'results' => $results,
			'idpage' => $idpage,
		);
	
		$this->render('newemploye', $vars);
	}
	
	// ariwa
	public function actionGaji()
	{
		// echo '<div style="font-size: 30px;">Server E-Slip sedang ada <i>Maintenance</i>.<br>
		// Silahkan coba beberapa saat lagi.<br>
		// <a href="/">Kembali Ke POIN</a>
		// <br><br>Salam,<br>Admin</div>';
		// die();
		// print_r('Menunggu e-slip apps ready');
		// exit();

		if(isset($_POST['mydropdown'])){
			$PRD = $_POST['mydropdown'];
		}else{
			$PRD = date('Ym');
		}

		if( substr(Yii::app()->session['usr_id'], 0,1) == 'x'){
			$this->redirect(Yii::app()->request->baseUrl . '/site/index');
		}
		
		$title = 'Slip Gaji';
		$idpage = 'Gaji';

		// $con = new ariwa_data_User();
		// $hsl = $con->ijinGaji(Yii::app()->session['usr_id'], Yii::app()->session['psw']);
		
		// if(!$hsl['rslt']){
		if(false){
			$vars = array(
					'title' => $title,
					'idpage' => $idpage,
				);
			$this->render('gajibelum', $vars);
		}else{

			$url=PAYMS_SERVER_ENCR.Yii::app()->session['usr_id'];
			// die($url);
		    $n = @file_get_contents($url);


		    $url=PAYMS_SERVER_ENCR.session_id();
		    $s = @file_get_contents($url);
		    
			$url=PAYMS_SERVER_GET. $n."___".$s."___".$PRD."___".Yii::app()->session['psw'] ; 
			// die($url);

			$i = @file_get_contents($url);

		    $hsl = json_decode($i);
			
			
// print_r("Maintenance.");die();
// print_r($url);die();
		    if(!$hsl){
				$hsl->is = 'not_ok';
			}
		    $title = 'Slip Gaji';
			$idpage = 'Gaji';
		    if($hsl->is != 'ok'){
			
		    	$vars = array(
					'title' => $title,
					'results' => array(),
					'idpage' => $idpage,
					'period' => $PRD
				);
				
				
		    }else{
		    	$vars = array(
					'title' => $title,
					'results' => $hsl->rslt,
					'idpage' => $idpage,
					'period' => $PRD
				);
		    }
		    /* 
		    $month = date('m');
		    $th = date('Y');
		    $periode_to_view = array();
		    
		    for($a = 0;$a<3;$a++){
		    	$mnt = $month-$a;
		    	if($mnt<=0){
		    		$mnt = 12-$mnt;
		    		$th = $th-1;
		    	}
		    	if(strlen($mnt)<2){
		    		$mnt = "0".$mnt;
		    	}
		    	$periode_to_view[] = $th.$mnt;
		    }
			 */
			
			$periode_to_view = array();
			$periode_to_view[] = date("Ym",strtotime("now"));
			// print_r($periode_to_view);die();
			for($a = 1;$a<4;$a++){
				$periode_to_view[] = date("Ym",strtotime("-$a month"));
			}
			
			// die("".date('Ym').' - '.date('Ym', strtotime("- 1 month")).' - '.date('Ym', strtotime("-2 month")));
			// print_r($periode_to_view);die();
			/// bonus periode ////
			$url_bns=PAYMS_SERVER_BON_PERIOD. date('Y').'__'.Yii::app()->session['usr_id'] ;
			$i_bns = @file_get_contents($url_bns);
			// print_r($url_bns);die();
			$hsl_bns = json_decode($i_bns);
			
		    // print_r($periode_to_view);die();
		    $vars['periods'] = $periode_to_view;
			$vars['periodsbonus'] = $hsl_bns->rslt;
			$this->render('gaji', $vars);
		}
	}
	// ariwa
	public function actionGajipdf()
	{
		// $url = 'http://payment.mdmedia.co.id/paym/pay?p=690160___2ffe85urast4rl8rinjn1n0d1r___201607___indonesia';
		
		// $i = @file_get_contents($url);
		// die($i);
		
		if( substr(Yii::app()->session['usr_id'], 0,1) == 'x'){
			$this->redirect(Yii::app()->request->baseUrl . '/site/index');
		}
		
		if(!isset($_GET['period'])){
			die("Data tidak ditemukan");
		}
		$PRD=$_GET['period'];
		// die($PRD);
		$title = 'Slip Gaji';
		$idpage = 'Gaji';
		
		if(false){
			$vars = array(
					'title' => $title,
					'idpage' => $idpage,
				);
			$this->render('gajibelum', $vars);
		}else{
			
			$url=PAYMS_SERVER_ENCR.Yii::app()->session['usr_id'];
		    $n = @file_get_contents($url);
			
		    $url=PAYMS_SERVER_ENCR.session_id();
		    $s = @file_get_contents($url);
		    
			$url=PAYMS_SERVER_GET. $n."___".$s."___".$PRD."___".Yii::app()->session['psw'] ;
// die($url);
		    $i = @file_get_contents($url);
			// echo '<pre>';print_r($i);die();
		    // die($url);
		    $hsl = json_decode($i);
		    
		    if($hsl->is != 'ok'){
		    	echo 'Data tidak ditemukan';
		    	exit();
		    }
			
			// ====================
			
			$hsl = $hsl->rslt;
			
			// echo '<pre>';print_r($hsl);die();
			
			// ---------------------===================== =---------------
		    $footer = 'Document ini diproses secara elektronis dan tidak memerlukan tanda tangan. - ';
			$footer2 = 'LOGT.03.01 Rev.00';
			$pdf = new myTcpdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, $footer, $footer2);
			
			//$pdf->SetProtection($permissions=array('copy'), $user_pass=Yii::app()->session['psw'], $user_pass=Yii::app()->session['psw'], $mode=0, $pubkeys=null);
			$Q = "select addp from useraddp where nik = '".Yii::app()->session['usr_id']."'";
			$command = Yii::app()->db->createCommand($Q);
			$isaddp = $command->queryAll();
			if($isaddp){
				$user_pass=Yii::app()->session['psw'].$isaddp[0]['addp'];
			}else{
				$user_pass=Yii::app()->session['psw'];
			}
			// die($user_pass);
			$pdf->SetProtection($permissions=array('copy', 'print'), $user_pass, $user_pass);
			
			
			// remove default header/footer
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			//set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			
			//set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			
			// set font
			$pdf->SetFont('times', 'BI', 20);
			// add a page
			$pdf->AddPage();
			
			// set some text to print
			
			$html1 = '
				<table cellpadding="2" cellspacing="0">
				 	<tr>
				  	<td width="280px">
						<div style="border: 1px solid #000;">
						<br>
							<table cellpadding="0" cellspacing="0">
							 	<tr>
							  	<td width="80px">NAMA KARYAWAN</td>
								<td width="5px">:</td>
								<td width="195px">'.$hsl->NAMA_KARYAWAN.'</td>
								</tr>
								<tr>
							  	<td>NO KARYAWAN</td>
								<td>:</td>
								<td>'.$hsl->NIK.'</td>
								</tr>
								<tr>
							  	<td>DEPARTEMEN</td>
								<td>:</td>
								<td>'.$hsl->DEPARTEMEN.'</td>
								</tr>
							</table>
						</div>
					</td>
					<td width="90px">
						<img src="http://'.$_SERVER["HTTP_HOST"].'/logo.png">
					</td>
					<td width="160px" style="font-size: 20px;">
						<br>
						Wisma Aldiron Dirgantara,<br>
						Lantai 2 Suite 202-209 dan 231-237,<br>
						Jl. Jend Gatot Subroto Kav 72, Pancoran 12780
					</td>
					</tr>
				</table>
			';
			// die($html1);
			$pdf->SetFont('dejavusans', '', 8);
			$pdf->writeHTML($html1, true, false, true, false, '');
			
			
			$html = '
			<div style="padding: 2px;width: 1010px;">
				
				<div style="padding: 5px;">
					<div style="text-align: center;">
						<b>PERINCIAN PENDAPATAN</b><br>
						BULAN: '.$hsl->BULAN.'
					</div>
					<br>
					<br>
					<table cellpadding="0" cellspacing="0">
					 <tr>
					  	<td width="240px" style="vertical-align: top;">
				  		[I] PENDAPATAN
				  		<br>
				  		<br>
						<table cellpadding="0" cellspacing="0" width="230px">
							<tr>
							  	<td width="10px">A)</td>
								<td colspan="2" width="110px">Gaji Pokok</td>
								<td width="70px" align="right">'.$hsl->GAJI_POKOK.'</td>
							</tr>
							<tr>
							  	<td>&nbsp;</td>
								<td colspan="2">&nbsp;</td>
								<td align="right">&nbsp;</td>
							</tr>
							<tr>
							  	<td>&nbsp;</td>
								<td colspan="2">&nbsp;</td>
								<td align="right">&nbsp;</td>
							</tr>
							<tr>
							  	<td>B)</td>
								<td colspan="2">Tunjangan</td>
								<td align="right">&nbsp;</td>
							</tr>
								
								';
								if($hsl->TUNJ_TIDAK_TETAP){
								$html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Operasional</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TIDAK_TETAP.'</td>
								</tr>';
								}
								if($hsl->TUNJ_JABATAN){
								$html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Jabatan</td>
									<td align="right" width="70px">'.(($hsl->NIK=='111377') ? self::adding($hsl->TUNJ_JABATAN) : $hsl->TUNJ_JABATAN ).'</td>
								</tr>';
								}
								if($hsl->TUNJ_TRANSISI_ORPROM){
								$html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Transisi (Orprom)</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TRANSISI_ORPROM.'</td>
								</tr>';
								}
								if($hsl->TUNJ_TRANSISI_LAINYA){
								$html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Transisi (Lainya)</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TRANSISI_LAINYA.'</td>
								</tr>';
								}
								if($hsl->TUNJ_TRANSISI_PGS){
								$html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Transisi PGS</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TRANSISI_PGS.'</td>
								</tr>';
								}
								if($hsl->TUNJ_TRANSISI_HP){
								$html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Transisi HP</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TRANSISI_HP.'</td>
								</tr>';
								}
								if($hsl->TUNJ_ASKEDIR){
								$html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Tunj ASKEDIR TELKOM</td>
									<td align="right" width="70px">'.$hsl->TUNJ_ASKEDIR.'</td>
								</tr>';
								}
								if($hsl->TUNJ_PREMIAJB){
								$html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Tunj AJB TELKOM</td>
									<td align="right" width="70px">'.$hsl->TUNJ_PREMIAJB.'</td>
								</tr>';
								}
								// 2020-10-22
                                if($hsl->TUNJ_TRANSPORT){
                                    $html .= '
                                    <tr>
                                        <td width="10px">&nbsp;</td>
                                        <td width="10px">&nbsp;</td>
                                        <td width="100px">Transport</td>
                                        <td align="right" width="70px">'.$hsl->TUNJ_TRANSPORT.'</td>
                                    </tr>';
                                }
								
							$html .= '<tr>
							  	<td>&nbsp;</td>
								<td colspan="2">&nbsp;</td>
								<td align="right">&nbsp;</td>
							</tr>';
							
							if($hsl->RAPEL){
							$html .= '
							<tr>
							  	<td>*)</td>
								<td colspan="2">Rapel Gaji</td>
								<td align="right">'.$hsl->RAPEL.'</td>
							</tr>';
							}
							if($hsl->UPAH_LEMBUR){
							$html .= '
							<tr>
							  	<td>*)</td>
								<td colspan="2">Upah Lembur</td>
								<td align="right">'.$hsl->UPAH_LEMBUR.'</td>
							</tr>';
							}
						$html .= '</table>
					</td>
					<td width="240px" style="vertical-align: top;">
						[II] POTONGAN2
						<br>
				  		<br>
						<table cellpadding="0" cellspacing="0" width="230px">
							';
							
							if($hsl->POT_DAPIN){
							$html .= '
							<tr>
							  	<td width="150px">Pot. DAPIN</td>
								<td width="70px;" align="right">'.$hsl->POT_DAPIN.'</td>
							</tr>';
							}
							if($hsl->POT_DPLK){
							$html .= '
							<tr>
							  	<td width="150px">Pot. DPLK</td>
								<td width="70px;" align="right">'.$hsl->POT_DPLK.'</td>
							</tr>';
							}
							
							if($hsl->POT_JAMSOSTEK){
							$html .= '
							<tr>
							  	<td>Pot. BPJS Ketanagakerjaan</td>
								<td align="right">'.$hsl->POT_JAMSOSTEK.'</td>
							</tr>';
							}
							
							if($hsl->POT_JAMSOSTEK2){
							$html .= '
							<tr>
							  	<td>Pot. BPJS Kesehatan</td>
								<td align="right">'.$hsl->POT_JAMSOSTEK2.'</td>
							</tr>';
							}
							
							if($hsl->POT_TAQUR){
							$html .= '
							<tr>
							  	<td>Pot. TAQUR</td>
								<td align="right">'.$hsl->POT_TAQUR.'</td>
							</tr>';
							}
							
							
							if($hsl->POT_DAPENTEL){
							$html .= '
							<tr>
							  	<td>Pot. DAPENTEL</td>
								<td align="right">'.$hsl->POT_DAPENTEL.'</td>
							</tr>';
							}
							
							if($hsl->POT_PINJAMAN_OR_EXCESS){
							$html .= '
							<tr>
							  	<td>Pot. Pinjaman / Excess</td>
								<td align="right">'.$hsl->POT_PINJAMAN_OR_EXCESS.'</td>
							</tr>';
							}
							
							if($hsl->POT_LAIN_LAIN){
							$html .= '
							<tr>
							  	<td>Pot. Lain lain</td>
								<td align="right">'.$hsl->POT_LAIN_LAIN.'</td>
							</tr>';
							}
							
							if($hsl->POT_SPIN){
							$html .= '
							<tr>
							  	<td>Pot. SPMD</td>
								<td align="right">'.$hsl->POT_SPIN.'</td>
							</tr>';
							}
							
							if($hsl->POT_ZIS_OR_BDI){
							$html .= '
							<tr>
							  	<td>Pot. ZIS (BDI)</td>
								<td align="right">'.$hsl->POT_ZIS_OR_BDI.'</td>
							</tr>';
							}
							
							if($hsl->TAB_POKOK){
							$html .= '
							<tr>
							  	<td>Tab. Pokok</td>
								<td align="right">'.$hsl->TAB_POKOK.'</td>
							</tr>';
							}
							
							if($hsl->TAB_WAJIB){
							$html .= '
							<tr>
							  	<td>Tab. Wajib</td>
								<td align="right">'.$hsl->TAB_WAJIB.'</td>
							</tr>';
							}
							
							if($hsl->TAB_SUKARELA){
							$html .= '
							<tr>
							  	<td>Tab. Sukarela</td>
								<td align="right">'.$hsl->TAB_SUKARELA.'</td>
							</tr>';
							}
							
							if($hsl->POT_BELANJA_OR_PINJAMAN){
							$html .= '
							<tr>
							  	<td>Pot. Belanja / Pinjaman</td>
								<td align="right">'.$hsl->POT_BELANJA_OR_PINJAMAN.'</td>
							</tr>';
							}
							
							if($hsl->POT_IMC_FLEXI){
							$html .= '
							<tr>
							  	<td>Pot. IMC / Flexi</td>
								<td align="right">'.$hsl->POT_IMC_FLEXI.'</td>
							</tr>';
							}
							
							if($hsl->TELKOM_IURAN_TASPEN){
							$html .= '
							<tr>
							  	<td>Iuran Taspen (Telkom)</td>
								<td align="right">'.$hsl->TELKOM_IURAN_TASPEN.'</td>
							</tr>';
							}
							if($hsl->TELKOM_TAB_WJB_PERUMAHAN){
							$html .= '
							<tr>
							  	<td>Tab Wjb Perumahan (Telkom)</td>
								<td align="right">'.$hsl->TELKOM_TAB_WJB_PERUMAHAN.'</td>
							</tr>';
							}
							if($hsl->TELKOM_SUMB_DANA_KEMATIAN){
							$html .= '
							<tr>
							  	<td>Sumb Dana Kematian (Telkom)</td>
								<td align="right">'.$hsl->TELKOM_SUMB_DANA_KEMATIAN.'</td>
							</tr>';
							}
							
							if($hsl->POT_IBO){
							$html .= '
							<tr>
							  	<td>Pot. IBO</td>
								<td align="right">'.$hsl->POT_IBO.'</td>
							</tr>';
							}
							if($hsl->POT_TELKOM_ASKEDIR){
							$html .= '
							<tr>
							  	<td>Pot. ASKEDIR TELKOM</td>
								<td align="right">'.$hsl->POT_TELKOM_ASKEDIR.'</td>
							</tr>';
							}
							if($hsl->POT_TELKOM_AJB_PREMIUM){
							$html .= '
							<tr>
							  	<td>Pot. AJB TELKOM</td>
								<td align="right">'.$hsl->POT_TELKOM_AJB_PREMIUM.'</td>
							</tr>';
							}
							if($hsl->POT_MDMAX){
							$html .= '
							<tr>
							  	<td>Pot. MDMAX</td>
								<td align="right">'.$hsl->POT_MDMAX.'</td>
							</tr>';
							}
							// 2020-10-22
                            if($hsl->POT_GAJI){
                                $html .= '
                                <tr>
                                    <td>Pot. Lain</td>
                                    <td align="right">'.$hsl->POT_GAJI.'</td>
                                </tr>';
                            }
							$html .= '<tr>
							  	<td>&nbsp;</td>
								<td align="right">&nbsp;</td>
							</tr>
						</table>
					</td>
					</tr>
					
					<tr>
					<td>
						<table width="240px">
							<tr>
								<td width="120px">T o t a l</td>
								<td width="70px;" align="right">
								<div style="border-top: 0px solid #000;">'.(($hsl->NIK=='111377') ? self::adding($hsl->JML_PENDAPATAN) : $hsl->JML_PENDAPATAN ).'</div>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table width="240px">
							<tr>
							  	<td width="150px">T o t a l</td>
								<td width="70px;" align="right">
								<div style="border-top: 0px solid #000;">'.$hsl->JML_POTONGAN.'</div>
								</td>
							</tr>
						</table>
					</td>
					</tr>
					
					</table>
				<br>
				Pendapatan Dibayarkan : <b>Rp. '.(($hsl->NIK=='111377') ? self::adding($hsl->JML_ALL) : $hsl->JML_ALL ).'</b><br>
				Terbilang: <b>'.(($hsl->NIK=='111377') ? self::adding_terbilang($hsl->JML_ALL) : $hsl->TERBILANG ).'</b> 
				<br>
				<br>
				- Gaji Pokok Pensiun (GPP) : '.$hsl->GPP.'<br>
				- Hari Lembur Biasa/Libur : '.$hsl->LEMBUR_HARI_BIASA.' / '.$hsl->LEMBUR_HARI_LIBUR.' Hari <br>
				- Hari Kerja : 22 Hari
				
				</div>
			
			</div>
			';
			
//			 die($html);
			
			$pdf->SetFont('dejavusans', '', 8);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->IncludeJS("print();");
			
			$pdf->Output('slip.pdf', 'D');
			
			exit();
		}
	}


	public function actionBonuspdf()
	{
		if( substr(Yii::app()->session['usr_id'], 0,1) == 'x'){
			$this->redirect(Yii::app()->request->baseUrl . '/site/index');
		}
		
		if(!isset($_GET['period'])){
			die("Data tidak ditemukan");
		}
		
		$PRD=$_GET['period'];
		
		$title = 'Slip Bonus';
		$idpage = 'Bonus';
		
		$url=PAYMS_SERVER_ENCR.Yii::app()->session['usr_id'];
		$n = @file_get_contents($url);
		
		$url=PAYMS_SERVER_ENCR.session_id();
		$s = @file_get_contents($url);
		
		$url=PAYMS_SERVER_BON. $n."___".$s."___".$PRD."___".Yii::app()->session['psw'] ;
		// die($url);
		$i = @file_get_contents($url);
		
// die($url);
		$hsl = json_decode($i);
		
		if($hsl->is != 'ok'){
			echo 'Data tidak ditemukan';
			exit();
		}
		
		// ====================
			
		$hsl = $hsl->rslt;
//		echo '<pre>';print_r($hsl);die();
		// judul sesuai jenis bonus
//		switch ($hsl->BNS_JENIS){
//			case 'TW':
//				$twke = substr($hsl->BNS_PERIOD, -1,1);
//				$judul = 'TANDA TERIMA<br>PEMBAYARAN INSENTIF TRIWULAN '.$twke.' TAHUN '.$hsl->BNS_TAHUN;
//				$ucapan = 'Telah terima dari '.$this->pt.' pembayaran Insentif Triwulan '.$twke.' Tahun '.$hsl->BNS_TAHUN.'';
//				break;
//			case 'THR':
//				$tgl_pecah = explode("-", $hsl->BNS_TGL_HIJRIYAH);
//				$h = $tgl_pecah[0];
//				$bln = $tgl_pecah[1];
//				$th = $tgl_pecah[2];
//				
//				$th_hijriyah = $this->_hijriah_year($h, $bln, $th);
//				
//				$judul = 'TUNJANGAN HARI RAYA KEAGAMAAN TAHUN '.$hsl->BNS_TAHUN.' / '.$th_hijriyah.' H';
//				$ucapan = 'Telah terima dari '.$this->pt.' pembayaran Tunjangan Hari Raya Keagamaan Tahun '.$hsl->BNS_TAHUN.'';
//				
//				break;
//			case 'SMT':
//				$judul = 'xxx';
//				$ucapan = 'xxx';
//				
//				break;
//			case 'THN':
//				$judul = 'xxx';
//				$ucapan = 'xxx';
//				
//				break;
//			case 'CT':
//				$judul = 'TANDA TERIMA<br>PEMBAYARAN TUNJANGAN CUTI TAHUN '.$hsl->BNS_TAHUN;
//				$ucapan = 'Telah terima dari '.$this->pt.' pembayaran Tunjangan Cuti Tahun '.$hsl->BNS_TAHUN.'';
//				
//				break;
//			default:
//				$judul = '...';
//				$ucapan = '...';
//				
//				break;
//				
//		}
		
		$judul = "TANDA TERIMA<br>". strtoupper($hsl->NOTE_JUDUL_HTML);
		if($hsl->BNS_JENIS=='SPR'){
			$judul = "TANDA TERIMA<br>
					SPREADING<br>
					BULAN : ".$hsl->BLN_SPR;
		}
		$ucapan = $hsl->NOTE_DESC_HTML;
		
		//			echo '<pre>';print_r($hsl);die();
		
		// ---------------------===================== =---------------
		$footer = 'Document ini diproses secara elektronis dan tidak memerlukan tanda tangan. - ';
		$footer2 = 'LOGT.03.01 Rev.00';
		$pdf = new myTcpdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, $footer, $footer2);
			
		$pdf->SetProtection($permissions=array('copy'), $user_pass=Yii::app()->session['psw'], $user_pass=Yii::app()->session['psw'], $mode=0, $pubkeys=null);
			
		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set font
		$pdf->SetFont('times', 'BI', 20);
		// add a page
		$pdf->AddPage();
		
		// set some text to print
		
		$html1 = '
				<table cellpadding="2" cellspacing="0">
				 	<tr>
				  	<td width="280px">
						<div style="border: 1px solid #000;">
						<br>
							<table cellpadding="0" cellspacing="0">
							 	<tr>
							  	<td width="82px">&nbsp;&nbsp;NAMA KARYAWAN</td>
								<td width="5px">:</td>
								<td width="195px">'.$hsl->NAMA_KARYAWAN.'</td>
								</tr>
								<tr>
							  	<td>&nbsp;&nbsp;NO KARYAWAN</td>
								<td>:</td>
								<td>'.$hsl->NIK.'</td>
								</tr>
								<tr>
							  	<td>&nbsp;&nbsp;DEPARTEMEN</td>
								<td>:</td>
								<td>'.$hsl->DEPARTEMEN.'</td>
								</tr>
							</table>
						</div>
					</td>
					<td width="90px">
						<img src="http://'.$_SERVER["HTTP_HOST"].'/logo.png">
					</td>
					<td width="160px" style="font-size: 20px;">
						<br>
						Wisma Aldiron Dirgantara,<br>
						Lantai 2 Suite 202-209 dan 231-237,<br>
						Jl. Jend Gatot Subroto Kav 72, Pancoran 12780
					</td>
					</tr>
				</table>
			';
			
		$pdf->SetFont('dejavusans', '', 8);
		$pdf->writeHTML($html1, true, false, true, false, '');
		
		// case case khusus disini ================================
		// case case khusus disini ================================
		
		switch ($hsl->KHUSUS_OR_UMUM) {
			case 'THR2020':
                $tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $html = '
					<div style="padding: 2px;width: 1010px;">
						
						<div style="padding: 5px;">
							<div style="text-align: center;">
								<b>'.$judul.'</b><br>
							</div>
							<br>
							<br>
						
						'.$ucapan.'
						<br>
						<br>
						'.$tab.$tab.'THR '.$tab.$tab.$tab.$tab.$tab.'Rp. <b>'.$hsl->BNS_NOMINAL.'</b><br>
						'.$tab.$tab.'Potongan Donasi '.$tab.'Rp. <b>'.$hsl->LAINYA2.'</b><br>
						<br>
						Yang DIterima Rp. <b>'.($hsl->LAINYA3).'</b><br>
						
						Terbilang : <b>'. $hsl->TERBILANG_LAINYA3 .'</b>
						<br>
						<br>
						'.$hsl->NOTE_HTML.'
						<br>
						<br>
						<br>
						Jakarta, '.$hsl->BNS_TGL.'
						<br>
						<br>
						'.$this->pt.'
						
						</div>
					
					</div>
					';
                break;
			case 'K':
				$html = '
					<div style="padding: 2px;width: 1010px;">
						
						<div style="padding: 5px;">
							<div style="text-align: center;">
								<b>'.$judul.'</b><br>
							</div>
							<br>
							<br>
						
						'.$ucapan.'
						<br>
						'.$this->_getBonusKhusus($hsl, $PRD).'
						<br>
						'.$hsl->NOTE_HTML.'
						<br>
						<br>
						Jakarta, '.$hsl->BNS_TGL.'
						<br>
						<br>
						Direksi '.$this->pt.'
						
						</div>
					
					</div>
					';
				break;
			case 'K2': // ada sisa spreading @ juli 2020
				$html = '
					<div style="padding: 2px;width: 1010px;">
						
						<div style="padding: 5px;">
							<div style="text-align: center;">
								<b>'.$judul.'</b><br>
							</div>
							<br>
							<br>
						
						'.$ucapan.'
						<br>
						<br>
						Sebesar Rp. <b>'.$hsl->BNS_NOMINAL.'</b><br>
						Terbilang : <b>'.$hsl->TERBILANG.'</b>
						
						'.
						(((int)$hsl->LAINYA2_ASLI) ? '
						<br>
						<br>
						Rapel Spreading Insentif<br>
						Sebesar Rp. <b>'.$hsl->LAINYA2.'</b><br>
						Terbilang : <b>'.$hsl->TERBILANG_LAINYA2.'</b>' : '')
						
						.'
						<br>
						<br>
						'.$hsl->NOTE_HTML.'
						<br>
						<br>
						Jakarta, '.$hsl->BNS_TGL.'
						<br>
						<br>
						Direksi '.$this->pt.'
						
						</div>
					
					</div>
					';
				break;
			case 'K3': // ada sisa sesuai ket LAINYA3
				$html = '
					<div style="padding: 2px;width: 1010px;">
						
						<div style="padding: 5px;">
							<div style="text-align: center;">
								<b>'.$judul.'</b><br>
							</div>
							<br>
							<br>
						
						'.$ucapan.'
						<br>
						<br>
						Sebesar Rp. <b>'.$hsl->BNS_NOMINAL.'</b><br>
						Terbilang : <b>'.$hsl->TERBILANG.'</b>
						
						'.
						(((int)$hsl->LAINYA2_ASLI) ? '
						<br>
						<br>
						'.$hsl->KETERANGANLAINYA.'<br>
						Sebesar Rp. <b>'.$hsl->LAINYA2.'</b><br>
						Terbilang : <b>'.$hsl->TERBILANG_LAINYA2.'</b>' : '')
						
						.'
						<br>
						<br>
						'.$hsl->NOTE_HTML.'
						<br>
						<br>
						Jakarta, '.$hsl->BNS_TGL.'
						<br>
						<br>
						Direksi '.$this->pt.'
						
						</div>
					
					</div>
					';
				break;
			default:
				$html = '
					<div style="padding: 2px;width: 1010px;">
						
						<div style="padding: 5px;">
							<div style="text-align: center;">
								<b>'.$judul.'</b><br>
							</div>
							<br>
							<br>
						
						'.$ucapan.'
						<br>
						<br>
						Sebesar Rp. <b>'.$hsl->BNS_NOMINAL.'</b><br>
						Terbilang : <b>'.$hsl->TERBILANG.'</b>
						<br>
						<br>
						'.$hsl->NOTE_HTML.'
						<br>
						<br>
						Jakarta, '.$hsl->BNS_TGL.'
						<br>
						<br>
						Direksi '.$this->pt.'
						
						</div>
					
					</div>
					';
				break;
		}
		// case case khusus disini ================================
		// case case khusus disini ================================
		// if(Yii::app()->session['usr_id']=='101344'){
			// die($html);
		// }
		
		$pdf->SetFont('dejavusans', '', 8);
		$pdf->writeHTML($html, true, false, true, false, '');
		
		if($hsl->BNS_JENIS=='SPR'){
			$pdf->Output('spreading.pdf', 'D');
		}else{
			$pdf->Output('lainya.pdf', 'D');
		}
		
		
		exit();
	}
	
	public function _hijriah_year($day, $mnt, $yr){
		$theDate = getdate();
		$wday = $theDate[wday];
//		$hr = $theDate[mday];
//		$theMonth = $theDate[mon];
//		$theYear = $theDate[year];
		
		$hr = $day;
		$theMonth = $mnt;
		$theYear = $yr;
		
		if (($theYear > 1582) || (($theYear == 1582) && ($theMonth > 10)) || (($theYear == 1582) && ($theMonth == 10) && ($hr > 14))) {
			$zjd = (int)((1461 * ($theYear + 4800 + (int)(($theMonth - 14) / 12))) / 4) + (int)((367 * ($theMonth - 2 - 12 * ((int)(($theMonth - 14) / 12)))) / 12) - (int)((3 * (int)((($theYear + 4900 + (int)(($theMonth - 14) / 12)) / 100))) / 4) + $hr - 32075;
		} else {
			$zjd = 367 * $theYear - (int)((7 * ($theYear + 5001 + (int)(($theMonth - 9) / 7))) / 4) + (int)((275 * $theMonth) / 9) + $hr + 1729777;
		}

		$zl            = $zjd - 1948440 + 10632;
		$zn            = (int)(($zl-1)/10631);
		$zl            = $zl - 10631 * $zn + 354;
		$zj            = ((int)((10985 - $zl)/5316))*((int)((50 * $zl)/17719))+((int)($zl/5670))*((int)((43 * $zl)/15238));
		$zl            = $zl-((int)((30 - $zj)/15))*((int)((17719 * $zj)/50))-((int)($zj/16))*((int)((15238 * $zj)/43))+29;
		$theMonth    = (int)((24 * $zl)/709);
		$hijriDay    = $zl-(int)((709 * $theMonth)/24);
		$hijriYear    = 30 * $zn + $zj - 30;

		if ($theMonth==1){ $hijriMonthName = "Muharram";}
		if ($theMonth==2){ $hijriMonthName = "Safar";}
		if ($theMonth==3){ $hijriMonthName = "Rabiul Awal";}
		if ($theMonth==4){ $hijriMonthName = "Rabiul Akhir";}
		if ($theMonth==5){ $hijriMonthName = "Jamadil Awal";}
		if ($theMonth==6){ $hijriMonthName = "Jamadil Akhir";}
		if ($theMonth==7){ $hijriMonthName = "Rejab";}
		if ($theMonth==8){ $hijriMonthName = "Syaaban";}
		if ($theMonth==9){ $hijriMonthName = "Ramadhan";}
		if ($theMonth==10){ $hijriMonthName = "Syawal";}
		if ($theMonth==11){ $hijriMonthName = "Zulkaedah";}
		if ($theMonth==12){ $hijriMonthName = "Zulhijjah";}
		
		if ($wday==0) { $hijriDayString = "Al-Ahad"; }
		if ($wday==1) { $hijriDayString = "Al-Itsnain"; }
		if ($wday==2) { $hijriDayString = "Ats-tsulatsa'"; }
		if ($wday==3) { $hijriDayString = "Al-Arbi'aa"; }
		if ($wday==4) { $hijriDayString = "Al-Khomis"; }
		if ($wday==5) { $hijriDayString = "Al-Jumuah"; }
		if ($wday==6) { $hijriDayString = "As-Sabt"; }

//		return $hijriDayString .' ' . $hijriDay . ' ' . $hijriMonthName . ' ' . $hijriYear;
		return (string)$hijriYear;
	}
	
	private function _getBonusKhusus($data, $PRD)
	{
		switch ($PRD) {
			case '2013TW2_SMT1':
				$string = '<table border="0">
				<tr>
				<td valign="top" width="30px">&nbsp;&nbsp;&nbsp;a.</td>
				<td width="500px">Ekstra Insentif Semester I Tahun 2013, sebesar Rp. '.$data->LAINYA1.'
				<br>
				Potongan Pembiayaan ESOP (100% Ekstra Insentif Sem. I Tahun 2013), sebesar Rp. '.$data->LAINYA2.'
				</td>
				</tr>
				<tr>
				<td valign="top">&nbsp;&nbsp;&nbsp;b.</td>
				<td>Insentif Triwulan II Tahun 2013, sebesar Rp. '.$data->LAINYA3.'
				<br>
				Potongan Pembiayaan ESOP (50%  Insentif Triwulan II Tahun 2013), sebesar Rp. '.$data->LAINYA4.'
				</td>
				</tr>
				<tr>
				<td valign="top">&nbsp;&nbsp;&nbsp;c.</td>
				<td>
				Total Transfer ke pekerja sebesar Rp. <b>'.$data->LAINYA5.'</b>
				<br>
				Terbilang : <b>'.$data->TERBILANG_LAINYA5.'</b>
				</td>
				</tr>
				</table>';
				break;
			case '2013TW3':
				$string = '<table border="0">
					<tr>
						<td width="20">1.</td>
						<td width="400">Nilai Insentif TW-3 Th. 2013</td>
						<td width="100">: Rp. <b>'.$data->LAINYA1.'</b></td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Sisa kewajiban pembiayaan ESOP s/d Ekstra Insentif  SM-1 Th. 2013</td>
						<td>: Rp. <b>'.$data->LAINYA2.'</b></td>
					</tr>
					<tr>
						<td>3.</td>
						<td>Pembayaran ESOP dari Insentif TW-3 Th. 2013 (50% x Insentif TW-3 Th. 2013)</td>
						<td>: Rp. <b>'.$data->LAINYA3.'</b></td>
					</tr>
					<tr>
						<td>4.</td>
						<td>Total pembayaran Insentif TW-3 Th. 2013 yang diterima Pekerja<br>Terbilang <b>'.$data->TERBILANG_LAINYA4.'</b></td>
						<td>: Rp. <b>'.$data->LAINYA4.'</b></td>
					</tr>
					<tr>
						<td>5.</td>
						<td>Sisa kewajiban pembiayaan ESOP setelah pembayaran Insentif TW-3 Th. 2013 (poin 2-3)</td>
						<td>: Rp. <b>'.$data->LAINYA5.'</b></td>
					</tr>
				</table>
				<br>
				<br>
				';
				if($data->LAINYA6 == 1){
					$string .= '<b>Catatan :</b>
					<br>
					- Pembiayaan ESOP melalui Insentif
					<br>
					<br>
					';
				}elseif($data->LAINYA6 == 2){
					$string .= '<b>Catatan :</b>
					<br>
					- Pembiayaan ESOP melalui Kopin
					<br>
					<br>
					';
				}else{ 
					$string .= '';
				}
				break;
			default:
				$string = 'Maaf Data tidak ada';
				break;
		}
		return $string;
	}
	
	public function actionPcinventory()
	{
		$vars = array(
			'title' => "Inventarisasi Perangkat IT",
			'idpage' => "pcinventory"
			,'nik'=>Yii::app()->session['usr_id']
		);
		$this->render('pcinventory', $vars);
	}
	
	public function actionDownloadfile()
	{
		$dir_path = Yii::getPathOfAlias('webroot') . "/assets/bpjs_/".Yii::app()->user->username.".pdf";
		if( file_exists( $dir_path ) ){
			Yii::app()->getRequest()->sendFile( "bpjs.pdf" , @file_get_contents( $dir_path ) );
		}
		else{
			die("Maaf, dokumen BPJS anda tidak ditemukan. Silhkan hubungi HR.");
		} 
	}
	
	public function actionDownloadfilespt()
	{
		$dir_path = Yii::getPathOfAlias('webroot') . "/assets/spt_/".Yii::app()->user->username.".pdf";
		if( file_exists( $dir_path ) ){
			Yii::app()->getRequest()->sendFile( "spt2018.pdf" , @file_get_contents( $dir_path ) );
		}
		else{
			die("Maaf, dokumen SPT 2017 anda tidak ditemukan. Silhkan hubungi HR.");
		}
	}
	
	public function actionDownloadfilesptpertahun()
	{
		if(!isset(Yii::app()->user->username)) die('Anda telah keluar dari POIN / belum melakukan login.');
		$dir_path = Yii::getPathOfAlias('webroot') . "/assets/spt_/".$_GET['th']."/".Yii::app()->user->username.".pdf";
		if( file_exists( $dir_path ) ){
			Yii::app()->getRequest()->sendFile( "spt_".$_GET['th'].".pdf" , @file_get_contents( $dir_path ) );
		}
		else{
			die("Maaf, dokumen SPT yang anda minta tidak ditemukan. Silhkan hubungi HR.");
		}
	}
	
	public function actionDownloadfileeid()
	{
		$dir_path = Yii::getPathOfAlias('webroot') . "/assets/bpjs_card/".Yii::app()->user->username.".pdf";
		if( file_exists( $dir_path ) ){
			Yii::app()->getRequest()->sendFile( "id_card_bpjs.pdf" , @file_get_contents( $dir_path ) );
		}
		else{
			die("Maaf, dokumen BPJS anda tidak ditemukan. Silhkan hubungi HR.");
		} 
	}
	
	
	public function actionDownloadfilesk2020()
	{
		$dir_path = Yii::getPathOfAlias('webroot') . "/assets/bpjs_/".Yii::app()->user->username.".pdf";
		if( file_exists( $dir_path ) ){
			Yii::app()->getRequest()->sendFile( "sk2020.pdf" , @file_get_contents( $dir_path ) );
		}
		else{
			die("Maaf, dokumen BPJS anda tidak ditemukan. Silhkan hubungi HR.");
		}
	}
	
	public function actionDownloadfilesk()
	{
		if(!isset(Yii::app()->user->username)) die('Anda telah keluar dari POIN / belum melakukan login.');
		$dir_path = Yii::getPathOfAlias('webroot') . "/assets/sk/".Yii::app()->user->username.".pdf";
		if( file_exists( $dir_path ) ){
			Yii::app()->getRequest()->sendFile( "sk_".Yii::app()->user->username.".pdf" , @file_get_contents( $dir_path ) );
		}
		else{
			die("Maaf, dokumen SK yang anda minta tidak ditemukan. Silhkan hubungi HR.");
		}
	}
	
	
	
	public function actionGetsimulasipendi()
	{
        $type = isset($_GET['type']) ? $_GET['type'] : 'ERP'; // ERP / PKB
        if($type == 'ERP' || $type == 'PKB') ''; else die('Data tidak ditemukan.');
		
		$url=PAYMS_SERVER_ENCR.Yii::app()->session['usr_id'];
		$n = @file_get_contents($url);

		$url=PAYMS_SERVER_ENCR.session_id();
		$s = @file_get_contents($url);

		$url="http://172.19.28.108:8888/paym/pendi?p=". $n."___".$s."___202101___".Yii::app()->session['psw'] . "___".$type ;
		$i = @file_get_contents($url);
		// dd($url);

		$hsl = json_decode($i);

		if($hsl->is != 'ok'){
			echo 'Data tidak ditemukan';
			exit();
		}
			
		// ====================
			
		$hsl = $hsl->rslt;
		
		
			// ---------------------===================== =---------------
			$footer = 'Document ini diproses secara elektronis dan tidak memerlukan tanda tangan. - ';
			$footer2 = 'LOGT.03.01 Rev.00';
			$pdf = new myTcpdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, $footer, $footer2);
			
			$Q = "select addp from useraddp where nik = '".Yii::app()->session['usr_id']."'";
			$command = Yii::app()->db->createCommand($Q);
			$isaddp = $command->queryAll();
			if($isaddp){
				$user_pass=Yii::app()->session['psw'].$isaddp[0]['addp'];
			}else{
				$user_pass=Yii::app()->session['psw'];
			}
			$pdf->SetProtection($permissions=array('copy'), $user_pass, $user_pass, $mode=0, $pubkeys=null);
				
			// remove default header/footer
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
				
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				
			//set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
				
			//set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				
			// set font
			$pdf->SetFont('dejavusans', 'BI', 11);
			// add a page
			$pdf->AddPage();
				
			// set some text to print
				
			$html1 = '
				<div></div>
			';
				
			$pdf->SetFont('dejavusans', '', 11);
			$pdf->writeHTML($html1, true, false, true, false, '');
			
			
			$html = '
			<div style="font-size: 42px;text-align: center;font-weight: bold;width: 100%;border-top: 2px #ddd solid;">
			<div>SIMULASI PERHITUNGAN KOMPENSASI<br>PESERTA PROGRAM ERP 2020 - 2021</div>
			</div>
			<div>
			<table cellpadding="2" cellspacing="0" width="100%" border="0">
			
				<tr>
					<td style="font-size: 38px;background-color: #a8d08d;padding-top: 10px;" colspan="3">Data Pekerja</td>
				</tr>
				
				<tr>
					<td width="35%">NIK</td>
					<td width="2%">:</td>
					<td width="63%" align="left">'.$hsl->nik.'</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td align="left">'.strtoupper($hsl->nama).'</td>
				</tr>
				<tr>
					<td>Departemen</td>
					<td>:</td>
					<td align="left">'.$hsl->dept.'</td>
				</tr>
				<tr>
					<td>Band</td>
					<td>:</td>
					<td align="left">'.$hsl->band.'</td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td>:</td>
					<td align="left">'.date_format(date_create($hsl->tgl_lahir), 'd M Y').'</td>
				</tr>
				<tr>
					<td>Tanggal Mulai Bekerja</td>
					<td>:</td>
					<td align="left">'.date_format(date_create($hsl->tgl_mulai_kerja), 'd M Y'). '</td>
				</tr>
				<tr>
					<td>Cut Off</td>
					<td>:</td>
					<td align="left">'.date_format(date_create($hsl->cut_off), 'd M Y').'</td>
				</tr>
				<tr>
					<td>Usia</td>
					<td>:</td>
					<td align="left">'.$hsl->usia.' Tahun</td>
				</tr>
				<tr>
					<td>Masa Kerja</td>
					<td>:</td>
					<td align="left">'.$hsl->masa_kerja.' Tahun</td>
				</tr>
				<tr>
					<td>Sisa Cuti</td>
					<td>:</td>
					<td align="left">'.$hsl->sisa_cuti.'</td>
				</tr>
				
				
				
				<tr>
					<td style="font-size: 38px;background-color: #a8d08d;" colspan="3">Dasar Perhitungan ERP</td>
				</tr>
				
				<tr>
					<td>Gaji Pokok</td>
					<td>:</td>
					<td align="right">'.$this->formatmoney($hsl->gaji_pokok).'</td>
				</tr>
				<tr>
					<td>Tunjangan Operasional</td>
					<td>:</td>
					<td align="right">'.$this->formatmoney($hsl->gaji_tunj_operasional).'</td>
				</tr>
				'.
                (($type == 'ERP') ? '<tr>
					<td>Tunjangan Jabatan</td>
					<td>:</td>
					<td align="right">'.$this->formatmoney($hsl->gaji_tunj_jabatan).'</td>
				</tr>' : '')
                .'
				<tr>
					<td><b>Total</b></td>
					<td><b>:</b></td>
					<td align="right"><b>'.$this->formatmoney($hsl->gaji_total).'</b></td>
				</tr>
				
				
				<tr>
					<td style="font-size: 38px;background-color: #a8d08d;padding-top: 10px;" colspan="3">&nbsp; </td>
				</tr>
				<tr>
					<td colspan="3">
					<table cellpadding="2" cellspacing="0" width="100%" border="0">
					    <tr>
                            <td width="30%" colspan="2" style="border-bottom: 1px #ddd solid;"><b>Komponen Kompensasi</b></td>
                            <td width="37%" style="border-bottom: 1px #ddd solid;"><b>Deskripsi</b></td>
                            <td width="13%" style="border-bottom: 1px #ddd solid;" align="right"><b>Koefisien</b></td>
                            <td width="20%" style="border-bottom: 1px #ddd solid;" align="right"><b>Nilai (Rp.)</b></td>
                        </tr>
                        <tr>
                            <td width="5%">1.</td>
                            <td width="25%">Uang Pesangon</td>
                            <td width="40%">2x ketentuan Pasal 56 ayat 3b tentang Uang Pesangon</td>
                            <td width="10%" align="right">'.$this->formatmoney($hsl->p_pesangon_koef).'</td>
                            <td width="20%" align="right">'.$this->formatmoney($hsl->p_pesangon_nilai).'</td>
                        </tr>
                        <tr>
                            <td width="5%">2.</td>
                            <td width="25%">Penghargaan Masa Kerja</td>
                            <td width="40%">1x ketentuan Pasal 56 ayat 3 tentang Uang Penghargaan Masa Kerja</td>
                            <td width="10%" align="right">'.$this->formatmoney($hsl->p_masa_kerja_koef).'</td>
                            <td width="20%" align="right">'.$this->formatmoney($hsl->p_masa_kerja_nilai).'</td>
                        </tr>
                        <tr>
                            <td width="5%">3.</td>
                            <td width="25%">Uang Penggantian Hak</td>
                            <td width="40%">1. Sisa Cuti yang belum di ambil
                            </td>
                            <td width="10%" align="right">'.$hsl->p_hak_sisa_cuti.'</td>
                            <td width="20%" align="right">'.$this->formatmoney($hsl->p_hak_sisa_cuti_nilai).'</td>
                        </tr>
                        <tr>
                            <td width="5%">&nbsp; </td>
                            <td width="25%">&nbsp; </td>
                            <td width="40%">2. Uang Penggantian Perumahan dan Pengobatan (15%) dari Uang Pesangon & Uang Penghargaan
                            </td>
                            <td width="10%" align="right">'.$hsl->p_hak_perumahan_persen.'</td>
                            <td width="20%" align="right">'.$this->formatmoney($hsl->p_hak_perumahan_nilai).'</td>
                        </tr>
                        
                        <tr>
                            <td width="5%">4.</td>
                            <td width="25%">Uang Pisah</td>
                            <td width="40%">1x Ketentuan Pasal 56 ayat 3c tentang Uang Pisah</td>
                            <td width="10%" align="right">'.$this->formatmoney($hsl->p_uang_pisah_koef).'</td>
                            <td width="20%" align="right">'.$this->formatmoney($hsl->p_uang_pisah_niali).'</td>
                        </tr>
                        '.
                        (($type == 'ERP') ? '<tr>
                            <td width="5%">5.</td>
                            <td width="25%">Sweetener</td>
                            <td width="40%">2x Sweetener</td>
                            <td width="10%" align="right">'.$this->formatmoney($hsl->p_sweetener_koef).'</td>
                            <td width="20%" align="right">'.$this->formatmoney($hsl->p_sweetener_nilai).'</td>
                        </tr>' : '')
                        .'
                        
                    </table>
                    </td>
				</tr>
				<tr>
					<td colspan="3" style="border-bottom: 2px #ddd solid;"></td>
				</tr>
				<tr>
				    <td colspan="3" style="padding: 3px 0 3px 0;">
                        <table width="100%" style="margin: 0;" cellspacing="0">
                            <tr>
                                <td style="font-size: 38px;background-color: #a8d08d;padding-top: 10px;"><b>Total Kompensasi ERP '.(($type == 'ERP') ? '' : '(PKB)').':</b></td>
                                <td style="font-size: 38px;background-color: #a8d08d;text-align: right;padding-right: 5px;" ><b>'.$this->formatmoney($hsl->total_kompesnsasi).'</b></td>
                            </tr>
                        </table>
                    </td>
				</tr>
				<tr>
					<td colspan="3" style="border-top: 2px #ddd solid;"></td>
				</tr>
			</table>
			</div>
			';

//			die($html);
			
			$pdf->SetFont('dejavusans', '', 11);
			$pdf->writeHTML($html, true, false, true, false, '');
				
			$pdf->Output(($type == 'ERP') ? 'Simulasi Kompensasi ERP 2020.pdf' : 'Simulasi Kompensasi PKB 2020.pdf', 'D');
				
			exit();
	}
	
	public function formatmoney($money = 0){
		$angka = $money;
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";

		return number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	}
	
	public function actionSuaraanda()
	{
		$vars = array(
			'title' => "Suara Anda"
			,'nik'=>Yii::app()->session['usr_id']
			,'post' => array('title'=>null)
			,'flash' => null
		);
		
		if($_POST){
			$vars['post'] = $_POST;
			if(!$_POST['title']){
				$vars['flash'] = '<h2 style="color: red;">Maaf, anda belum memilih Bidang.</h2>';
				$this->render('suaraanda', $vars);
			}
			if(!$_POST['suara']){
				$vars['flash'] = '<h2 style="color: red;">Maaf, anda belum mengisikan suara anda.</h2>';
				$this->render('suaraanda', $vars);
			}
			
			if($_POST['title'] && $_POST['suara']){
				$nik = Yii::app()->session['usr_id'];
				$emp = Member::model()->findByNik($nik);
				$nama = $emp ? $emp->name : '-';
				$title = $_POST['title'];
				$suara = $_POST['suara'];
				$email = $emp->email;
				
				$query = "insert into `poin`.`suaraanda` 
					(nik, nama, title, suara, balas_email_penerima, created_at)
					values
					('$nik', '$nama', '$title', '$suara', '$email', NOW())";
				$command = Yii::app()->db->createCommand($query)->execute();
				
				$vars['post'] = null;
				$vars['flash'] = '<h2 style="color: green;">Terima kasih atas suara anda.</h2>';
			}
		}
		
		$this->render('suaraanda', $vars);
	}
	
	public function actionSurvey()
	{
		$nik = Yii::app()->session['usr_id'];
		$this->render('survey', array('nik'=>$nik));
	}
	
	private static function adding($str = ''){
		$angka = str_replace(".", "", $str);
		$new = $angka+0;
		return number_format( $new, 0 , '' , '.' );
	}
	private static function adding_terbilang ($str = '') {
		return 'ENAM BELAS JUTA DELAPAN RATUS DELAPAN PULUH TIGA RIBU TUJUH RATUS DELAPAN PULUH TIGA RUPIAH';
    }
	
	
	
	

	// ariwa
	public function actionSpt()
	{
		$usr_id = substr(Yii::app()->session['usr_id'], 0,1);
		$this->render('spt', array());
	}

	public function actionGajipdfnew(){// ---------------------===================== =---------------
		$footer = 'Document ini diproses secara elektronis dan tidak memerlukan tanda tangan. - ';
		$footer2 = 'LOGT.03.01 Rev.00';
		$pdf = new myTcpdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, $footer, $footer2);
			
		//$pdf->SetProtection($permissions=array('copy'), $user_pass=Yii::app()->session['psw'], $user_pass=Yii::app()->session['psw'], $mode=0, $pubkeys=null);
		$Q = "select addp from useraddp where nik = '".Yii::app()->session['usr_id']."'";
		$command = Yii::app()->db->createCommand($Q);
		$isaddp = $command->queryAll();
		if($isaddp){
			$user_pass=Yii::app()->session['psw'].$isaddp[0]['addp'];
		}else{
			$user_pass=Yii::app()->session['psw'];
		}
		
		// die($user_pass);
		// $pdf->SetProtection($permissions=array('copy', 'print'), $user_pass, $user_pass);
		
		
		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set font
		$pdf->SetFont('times', 'BI', 20);
		// add a page
		$pdf->AddPage();
		
		// set some text to print
		
		$html = '
		<div style="padding: 2px;width: 1010px;">
				
				<div style="padding: 5px;">
					<div style="text-align: center;">
						<b>PERINCIAN PENDAPATAN</b><br>
						BULAN: JULI 2020
					</div>
					<br>
					<br>
					
					
					
					<table style="border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0" width="100%">
    <tbody>

    <tr style="height: 12.5pt;">
        <td width="33%" style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Gaji Pokok</td>
        <td width="5%" style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td width="12%" style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;"> xxxx&nbsp;&nbsp;</td>
        <td width="33%" style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan JHT - Perusahaan</td>
        <td width="5%" style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td width="12%" style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan Operasional</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan JHT - Karyawan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan Jabatan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan JKK - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan Orprom</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  -&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan JKM - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan Lain</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan JP - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan Komunikasi</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan JP - Karyawan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;"></td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;"></td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan BPJS KS - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Lembur</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  -&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan BPJS KS - Karyawan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Rapel</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan DAPIN/ DPLK - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;"></td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;"></td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan DAPIN/ DPLK - Karyawan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan JHT - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan Ekses Klaim</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan JKK - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan SPMD</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan JKM - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan Taqur</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan JP - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan Lain-lain</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan BPJS KS - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Iuran Pokok</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: left;">&nbsp;Tunjangan DAPIN/ DPLK - Perusahaan</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Iuran Wajib</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; "></td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; "></td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; "></td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Iuran Sukarela</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;">  xxxx&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; "></td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; "></td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; "></td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Potongan Belanja/ Pinjaman</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;"> -&nbsp;&nbsp;</td>
    </tr>
    <tr style="height: 12.5pt;">
        <td style="border-top: none; border-right: none; border-bottom: none; border-left: 0.5pt solid windowtext; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; "></td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; "></td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; "></td>
        <td style="border: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; white-space: nowrap; text-align: left;">&nbsp;Iuran MD Max</td>
        <td style="padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; text-align: right;">:Rp.</td>
        <td style="border-top: none; border-right: 0.5pt solid windowtext; border-bottom: none; border-left: none; padding-top: 1px; padding-right: 5px; padding-left: 5px; color: windowtext; font-size: 10pt; font-weight: 400; font-style: normal; vertical-align: bottom; border-image: initial; white-space: nowrap; text-align: right;"> -&nbsp;&nbsp;</td>
    </tr>
    </tbody>
</table>






					
					
					
					
				<br>
				Pendapatan Dibayarkan : <b>Rp. 10.468.239</b><br>
				Terbilang: <b>SEPULUH JUTA EMPAT RATUS ENAM PULUH DELAPAN RIBU DUA RATUS TIGA PULUH SEMBILAN RUPIAH</b> 
				<br>
				<br>
				- Gaji Pokok Pensiun (GPP) : 749.525,00<br>
				- Hari Lembur Biasa/Libur : 0 / 0 Hari <br>
				- Hari Kerja : 22 Hari
				
				</div>
			
			</div>
		';
		
		// die($html);
		
		$pdf->SetFont('helvetica', '', 8);
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->IncludeJS("print();");
		
		$pdf->Output('slip.pdf', 'D');
		
		
	}
	
	// ariwa
	public function actionGajihr()
	{
		if(Yii::app()->session['usr_id']!='101344'){
			die('Anda Tidak ada hak akses.');
		}
		
		// echo '<div style="font-size: 30px;">Server E-Slip sedang ada <i>Maintenance</i>.<br>
		// Silahkan coba beberapa saat lagi.<br>
		// <a href="/">Kembali Ke POIN</a>
		// <br><br>Salam,<br>Admin</div>';
		// die();
		// print_r('Menunggu e-slip apps ready');
		// exit();

		if(isset($_POST['mydropdown'])){
			$PRD = $_POST['mydropdown'];
		}else{
			$PRD = date('Ym');
		}

		if( substr(Yii::app()->session['usr_id'], 0,1) == 'x'){
			$this->redirect(Yii::app()->request->baseUrl . '/site/index');
		}
		
		$title = 'Slip Gaji';
		$idpage = 'Gaji';

		// $con = new ariwa_data_User();
		// $hsl = $con->ijinGaji(Yii::app()->session['usr_id'], Yii::app()->session['psw']);
		
		// if(!$hsl['rslt']){
		// $users = @file_get_contents(PAYMS_SERVER.'/paym/getuserbyperiod?user_id=101344&period=202008');
		// $usersobj = json_decode($users);
		// if($usersobj->stts){
			// foreach($usersobj->data as $isi){
				// dd($isi); //$isi->NIK
			// }
		// }
		
		if(false){
			$vars = array(
					'title' => $title,
					'idpage' => $idpage,
				);
			$this->render('gajibelum', $vars);
		}else{

			$url=PAYMS_SERVER_ENCR.Yii::app()->session['usr_id'];
			// die($url);
		    $n = @file_get_contents($url);


		    $url=PAYMS_SERVER_ENCR.session_id();
		    $s = @file_get_contents($url);
		    
			$url=PAYMS_SERVER_GET. $n."___".$s."___".$PRD."___".Yii::app()->session['psw'] ; 
			// die($url);

			$i = @file_get_contents($url);

		    $hsl = json_decode($i);
			
			
// print_r("Maintenance.");die();
// print_r($url);die();
		    if(!$hsl){
				$hsl->is = 'not_ok';
			}
		    $title = 'Slip Gaji';
			$idpage = 'Gaji';
		    if($hsl->is != 'ok'){
			
		    	$vars = array(
					'title' => $title,
					'results' => array(),
					'idpage' => $idpage,
					'period' => $PRD
				);
				
				
		    }else{
		    	$vars = array(
					'title' => $title,
					'results' => $hsl->rslt,
					'idpage' => $idpage,
					'period' => $PRD
				);
		    }
		    /* 
		    $month = date('m');
		    $th = date('Y');
		    $periode_to_view = array();
		    
		    for($a = 0;$a<3;$a++){
		    	$mnt = $month-$a;
		    	if($mnt<=0){
		    		$mnt = 12-$mnt;
		    		$th = $th-1;
		    	}
		    	if(strlen($mnt)<2){
		    		$mnt = "0".$mnt;
		    	}
		    	$periode_to_view[] = $th.$mnt;
		    }
			 */
			
			$periode_to_view = array();
			$periode_to_view[] = date("Ym",strtotime("now"));
			// print_r($periode_to_view);die();
			for($a = 1;$a<24;$a++){
				$periode_to_view[] = date("Ym",strtotime("-$a month"));
			}
			
			// die("".date('Ym').' - '.date('Ym', strtotime("- 1 month")).' - '.date('Ym', strtotime("-2 month")));
			// print_r($periode_to_view);die();
			/// bonus periode ////
			$url_bns=PAYMS_SERVER_BON_PERIOD. date('Y').'__'.Yii::app()->session['usr_id'] ;
			$i_bns = @file_get_contents($url_bns);
			// print_r($url_bns);die();
			$hsl_bns = json_decode($i_bns);
			
		    // print_r($periode_to_view);die();
		    $vars['periods'] = $periode_to_view;
			$vars['periodsbonus'] = $hsl_bns->rslt;
			$this->render('gajihr', $vars);
		}
	}
	
	
	public function actionGajihrgetusers(){
		$user_id = Yii::app()->session['usr_id'];
		$period = $_POST['period'];
		$users = @file_get_contents(PAYMS_SERVER.'/paym/getuserbyperiod?user_id=101344&period=202008');
		$usersobj = json_decode($users);
		$html = '<option value="">-- Pilih Pekerja --</option>';
		if($usersobj->stts){
			foreach($usersobj->data as $isi){
				$html .= '<option value="">'.$isi->NAMA_KARYAWAN.' ('.$isi->NIK.')</option>';
			}
			// die(json_encode(array('stts'=> true, 'data' => (array) $usersobj->data)));
		}
		// die(json_encode(array('stts'=> false, 'msg' => 'Data not found')));
		die($html);
		
	}
	
	public function actionSksk()
	{
		$query = "select * from sk where nik = '".Yii::app()->session['usr_id']."'";
		$command = Yii::app()->db->createCommand($query);
		$getsk = $command->queryAll();
		
		$vars['getsk'] = $getsk;
		$this->render('sksk', $vars);
	}
	
	public function actionSkskdownload()
	{
		if(!isset($_GET['period'])){
			die("Data tidak ditemukan");
		}
		
		$query = "select * from sk where nik = '".Yii::app()->session['usr_id']."' and period='".$_GET['period']."'";
		$command = Yii::app()->db->createCommand($query);
		$getsk = $command->queryAll();
		// dd($getsk);
		if(!$getsk){
			die("Data tidak ditemukan");
		}
		
		$dir_path = Yii::getPathOfAlias('webroot') . "/assets/sk/".$getsk[0]['period']."/".$getsk[0]['file'];
		
		//password for the pdf file (I suggest using the email adress of the purchaser)
		// $password = "ariwa";

		//name of the original file (unprotected)
		// $origFile = $dir_path;

		//name of the destination file (password protected and printing rights removed)
		// $destFile = $dir_path;

		//encrypt the book and create the protected file
		// pdfEncrypt($origFile, $password, $destFile );
		
		if( file_exists( $dir_path ) ){
			Yii::app()->getRequest()->sendFile( $getsk[0]['name']."__".$getsk[0]['nik'].".pdf" , @file_get_contents( $dir_path ) );
		}
		else{
			die("Maaf, dokumen SK yang Anda pilih tidak ditemukan. Silhkan hubungi HCM / IT.");
		} 
	}
	
	function pdfEncrypt ($origFile, $password, $destFile){
		dd('ariwa');
		$pdf =& new FPDI_Protection();
		// set the format of the destinaton file, in our case 6×9 inch
		$pdf->FPDF('P', 'in', array('6','9'));

		//calculate the number of pages from the original document
		$pagecount = $pdf->setSourceFile($origFile);

		// copy all pages from the old unprotected pdf in the new one
		for ($loop = 1; $loop <= $pagecount; $loop++) {
			$tplidx = $pdf->importPage($loop);
			$pdf->addPage();
			$pdf->useTemplate($tplidx);
		}

		// protect the new pdf file, and allow no printing, copy etc and leave only reading allowed
		$pdf->SetProtection(array(),$password);
		$pdf->Output($destFile, 'F');

		return $destFile;
	}






    // ------\-===
    public function actionGajigetmain()
    {
        $q1 = "select * from usr_es where code_in='".md5(Yii::app()->session['usr_id'].'_ariwa')."'";
        $cmd1 = Yii::app()->db->createCommand($q1);
        $is_member = $cmd1->queryAll();

        if(!$is_member){
            die('Salah menu. Tks.');
        }

        $query = "select nik, name from member order by name asc";
        $command = Yii::app()->db->createCommand($query);
        $member = $command->queryAll();

        $vars = array(
            'member' => $member
        );
        $this->render('gajigetmain', $vars);
    }
    public function actionGajiget()
    {
        $q1 = "select * from usr_es where code_in='".md5(Yii::app()->session['usr_id'].'_ariwa')."'";
        $cmd1 = Yii::app()->db->createCommand($q1);
        $is_member = $cmd1->queryAll();

        if(!$is_member){
            die('Salah menu. Tks.');
        }


        /*$users = array(
            array("NIK"=>'101344', "PASSWD"=>'ariwaselalubisa')
            ,array("NIK"=>'161623', "PASSWD"=>'ariwaselalubisa')
        );*/

        $title = 'Slip Gaji';
        $idpage = 'Gaji';

        $url=PAYMS_SERVER_ENCR.session_id();
        $s = @file_get_contents($url);

        $footer = 'Document ini diproses secara elektronis dan tidak memerlukan tanda tangan. - ';
        $footer2 = 'LOGT.03.01 Rev.00';

        $url=PAYMS_SERVER_ENCR.$_GET['nik'];
        $n = @file_get_contents($url);

        $url=PAYMS_SERVER_GET. $n."___".$s."___".$_GET['period']."___ariwaselalubisa";
		// $url = "http://172.19.28.108:8888/paym/pay?p=856181___33drldiun56vk6upjsm12l73a5___201808___ariwaselalubisa";
		// dd($url);

        $i = @file_get_contents($url);

        $hsl = json_decode($i);
//        dd($hsl);

        if($hsl->is == 'ok'){
            $pdf = new myTcpdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, $footer, $footer2);
            // remove default header/footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            //set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            //set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            // set font
            $pdf->SetFont('times', 'BI', 20);
            // add a page
            $pdf->AddPage();

            $hsl = $hsl->rslt;

            $html1 = '
				<table cellpadding="2" cellspacing="0">
				 	<tr>
				  	<td width="280px">
						<div style="border: 1px solid #000;">
						<br>
							<table cellpadding="0" cellspacing="0">
							 	<tr>
							  	<td width="80px">NAMA KARYAWAN</td>
								<td width="5px">:</td>
								<td width="195px">'.$hsl->NAMA_KARYAWAN.'</td>
								</tr>
								<tr>
							  	<td>NO KARYAWAN</td>
								<td>:</td>
								<td>'.$hsl->NIK.'</td>
								</tr>
								<tr>
							  	<td>DEPARTEMEN</td>
								<td>:</td>
								<td>'.$hsl->DEPARTEMEN.'</td>
								</tr>
							</table>
						</div>
					</td>
					<td width="90px">
						<img src="http://'.$_SERVER["HTTP_HOST"].'/logo.png">
					</td>
					<td width="160px" style="font-size: 20px;">
						<br>
						Wisma Aldiron Dirgantara,<br>
						Lantai 2 Suite 202-209 dan 231-237,<br>
						Jl. Jend Gatot Subroto Kav 72, Pancoran 12780
					</td>
					</tr>
				</table>
			';
            // die($html1);
            $pdf->SetFont('dejavusans', '', 8);
            $pdf->writeHTML($html1, true, false, true, false, '');


            $html = '
			<div style="padding: 2px;width: 1010px;">
				
				<div style="padding: 5px;">
					<div style="text-align: center;">
						<b>PERINCIAN PENDAPATAN</b><br>
						BULAN: '.$hsl->BULAN.'
					</div>
					<br>
					<br>
					<table cellpadding="0" cellspacing="0">
					 <tr>
					  	<td width="240px" style="vertical-align: top;">
				  		[I] PENDAPATAN
				  		<br>
				  		<br>
						<table cellpadding="0" cellspacing="0" width="230px">
							<tr>
							  	<td width="10px">A)</td>
								<td colspan="2" width="110px">Gaji Pokok</td>
								<td width="70px" align="right">'.$hsl->GAJI_POKOK.'</td>
							</tr>
							<tr>
							  	<td>&nbsp;</td>
								<td colspan="2">&nbsp;</td>
								<td align="right">&nbsp;</td>
							</tr>
							<tr>
							  	<td>&nbsp;</td>
								<td colspan="2">&nbsp;</td>
								<td align="right">&nbsp;</td>
							</tr>
							<tr>
							  	<td>B)</td>
								<td colspan="2">Tunjangan</td>
								<td align="right">&nbsp;</td>
							</tr>
								
								';
            if($hsl->TUNJ_TIDAK_TETAP){
                $html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Operasional</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TIDAK_TETAP.'</td>
								</tr>';
            }
            if($hsl->TUNJ_JABATAN){
                $html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Jabatan</td>
									<td align="right" width="70px">'.(($hsl->NIK=='111377') ? self::adding($hsl->TUNJ_JABATAN) : $hsl->TUNJ_JABATAN ).'</td>
								</tr>';
            }
            if($hsl->TUNJ_TRANSISI_ORPROM){
                $html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Transisi (Orprom)</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TRANSISI_ORPROM.'</td>
								</tr>';
            }
            if($hsl->TUNJ_TRANSISI_LAINYA){
                $html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Transisi (Lainya)</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TRANSISI_LAINYA.'</td>
								</tr>';
            }
            if($hsl->TUNJ_TRANSISI_PGS){
                $html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Transisi PGS</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TRANSISI_PGS.'</td>
								</tr>';
            }
            if($hsl->TUNJ_TRANSISI_HP){
                $html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Transisi HP</td>
									<td align="right" width="70px">'.$hsl->TUNJ_TRANSISI_HP.'</td>
								</tr>';
            }
            if($hsl->TUNJ_ASKEDIR){
                $html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Tunj ASKEDIR TELKOM</td>
									<td align="right" width="70px">'.$hsl->TUNJ_ASKEDIR.'</td>
								</tr>';
            }
            if($hsl->TUNJ_PREMIAJB){
                $html .= '
								<tr>
								  	<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Tunj AJB TELKOM</td>
									<td align="right" width="70px">'.$hsl->TUNJ_PREMIAJB.'</td>
								</tr>';
            }
            // 2020-10-22
            if($hsl->TUNJ_TRANSPORT){
                $html .= '
                                    <tr>
                                        <td width="10px">&nbsp;</td>
                                        <td width="10px">&nbsp;</td>
                                        <td width="100px">Transport</td>
                                        <td align="right" width="70px">'.$hsl->TUNJ_TRANSPORT.'</td>
                                    </tr>';
            }

            $html .= '<tr>
							  	<td>&nbsp;</td>
								<td colspan="2">&nbsp;</td>
								<td align="right">&nbsp;</td>
							</tr>';

            if($hsl->RAPEL){
                $html .= '
							<tr>
							  	<td>*)</td>
								<td colspan="2">Rapel Gaji</td>
								<td align="right">'.$hsl->RAPEL.'</td>
							</tr>';
            }
            if($hsl->UPAH_LEMBUR){
                $html .= '
							<tr>
							  	<td>*)</td>
								<td colspan="2">Upah Lembur</td>
								<td align="right">'.$hsl->UPAH_LEMBUR.'</td>
							</tr>';
            }
            $html .= '</table>
					</td>
					<td width="240px" style="vertical-align: top;">
						[II] POTONGAN2
						<br>
				  		<br>
						<table cellpadding="0" cellspacing="0" width="230px">
							';

            if($hsl->POT_DAPIN){
                $html .= '
							<tr>
							  	<td width="150px">Pot. DAPIN</td>
								<td width="70px;" align="right">'.$hsl->POT_DAPIN.'</td>
							</tr>';
            }
            if($hsl->POT_DPLK){
                $html .= '
							<tr>
							  	<td width="150px">Pot. DPLK</td>
								<td width="70px;" align="right">'.$hsl->POT_DPLK.'</td>
							</tr>';
            }

            if($hsl->POT_JAMSOSTEK){
                $html .= '
							<tr>
							  	<td>Pot. BPJS Ketanagakerjaan</td>
								<td align="right">'.$hsl->POT_JAMSOSTEK.'</td>
							</tr>';
            }

            if($hsl->POT_JAMSOSTEK2){
                $html .= '
							<tr>
							  	<td>Pot. BPJS Kesehatan</td>
								<td align="right">'.$hsl->POT_JAMSOSTEK2.'</td>
							</tr>';
            }

            if($hsl->POT_TAQUR){
                $html .= '
							<tr>
							  	<td>Pot. TAQUR</td>
								<td align="right">'.$hsl->POT_TAQUR.'</td>
							</tr>';
            }


            if($hsl->POT_DAPENTEL){
                $html .= '
							<tr>
							  	<td>Pot. DAPENTEL</td>
								<td align="right">'.$hsl->POT_DAPENTEL.'</td>
							</tr>';
            }

            if($hsl->POT_PINJAMAN_OR_EXCESS){
                $html .= '
							<tr>
							  	<td>Pot. Pinjaman / Excess</td>
								<td align="right">'.$hsl->POT_PINJAMAN_OR_EXCESS.'</td>
							</tr>';
            }

            if($hsl->POT_LAIN_LAIN){
                $html .= '
							<tr>
							  	<td>Pot. Lain lain</td>
								<td align="right">'.$hsl->POT_LAIN_LAIN.'</td>
							</tr>';
            }

            if($hsl->POT_SPIN){
                $html .= '
							<tr>
							  	<td>Pot. SPMD</td>
								<td align="right">'.$hsl->POT_SPIN.'</td>
							</tr>';
            }

            if($hsl->POT_ZIS_OR_BDI){
                $html .= '
							<tr>
							  	<td>Pot. ZIS (BDI)</td>
								<td align="right">'.$hsl->POT_ZIS_OR_BDI.'</td>
							</tr>';
            }

            if($hsl->TAB_POKOK){
                $html .= '
							<tr>
							  	<td>Tab. Pokok</td>
								<td align="right">'.$hsl->TAB_POKOK.'</td>
							</tr>';
            }

            if($hsl->TAB_WAJIB){
                $html .= '
							<tr>
							  	<td>Tab. Wajib</td>
								<td align="right">'.$hsl->TAB_WAJIB.'</td>
							</tr>';
            }

            if($hsl->TAB_SUKARELA){
                $html .= '
							<tr>
							  	<td>Tab. Sukarela</td>
								<td align="right">'.$hsl->TAB_SUKARELA.'</td>
							</tr>';
            }

            if($hsl->POT_BELANJA_OR_PINJAMAN){
                $html .= '
							<tr>
							  	<td>Pot. Belanja / Pinjaman</td>
								<td align="right">'.$hsl->POT_BELANJA_OR_PINJAMAN.'</td>
							</tr>';
            }

            if($hsl->POT_IMC_FLEXI){
                $html .= '
							<tr>
							  	<td>Pot. IMC / Flexi</td>
								<td align="right">'.$hsl->POT_IMC_FLEXI.'</td>
							</tr>';
            }

            if($hsl->TELKOM_IURAN_TASPEN){
                $html .= '
							<tr>
							  	<td>Iuran Taspen (Telkom)</td>
								<td align="right">'.$hsl->TELKOM_IURAN_TASPEN.'</td>
							</tr>';
            }
            if($hsl->TELKOM_TAB_WJB_PERUMAHAN){
                $html .= '
							<tr>
							  	<td>Tab Wjb Perumahan (Telkom)</td>
								<td align="right">'.$hsl->TELKOM_TAB_WJB_PERUMAHAN.'</td>
							</tr>';
            }
            if($hsl->TELKOM_SUMB_DANA_KEMATIAN){
                $html .= '
							<tr>
							  	<td>Sumb Dana Kematian (Telkom)</td>
								<td align="right">'.$hsl->TELKOM_SUMB_DANA_KEMATIAN.'</td>
							</tr>';
            }

            if($hsl->POT_IBO){
                $html .= '
							<tr>
							  	<td>Pot. IBO</td>
								<td align="right">'.$hsl->POT_IBO.'</td>
							</tr>';
            }
            if($hsl->POT_TELKOM_ASKEDIR){
                $html .= '
							<tr>
							  	<td>Pot. ASKEDIR TELKOM</td>
								<td align="right">'.$hsl->POT_TELKOM_ASKEDIR.'</td>
							</tr>';
            }
            if($hsl->POT_TELKOM_AJB_PREMIUM){
                $html .= '
							<tr>
							  	<td>Pot. AJB TELKOM</td>
								<td align="right">'.$hsl->POT_TELKOM_AJB_PREMIUM.'</td>
							</tr>';
            }
            if($hsl->POT_MDMAX){
                $html .= '
							<tr>
							  	<td>Pot. MDMAX</td>
								<td align="right">'.$hsl->POT_MDMAX.'</td>
							</tr>';
            }
            // 2020-10-22
            if($hsl->POT_GAJI){
                $html .= '
                                <tr>
                                    <td>Pot. Lain</td>
                                    <td align="right">'.$hsl->POT_GAJI.'</td>
                                </tr>';
            }
            $html .= '<tr>
							  	<td>&nbsp;</td>
								<td align="right">&nbsp;</td>
							</tr>
						</table>
					</td>
					</tr>
					
					<tr>
					<td>
						<table width="240px">
							<tr>
								<td width="120px">T o t a l</td>
								<td width="70px;" align="right">
								<div style="border-top: 0px solid #000;">'.(($hsl->NIK=='111377') ? self::adding($hsl->JML_PENDAPATAN) : $hsl->JML_PENDAPATAN ).'</div>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table width="240px">
							<tr>
							  	<td width="150px">T o t a l</td>
								<td width="70px;" align="right">
								<div style="border-top: 0px solid #000;">'.$hsl->JML_POTONGAN.'</div>
								</td>
							</tr>
						</table>
					</td>
					</tr>
					
					</table>
				<br>
				Pendapatan Dibayarkan : <b>Rp. '.(($hsl->NIK=='111377') ? self::adding($hsl->JML_ALL) : $hsl->JML_ALL ).'</b><br>
				Terbilang: <b>'.(($hsl->NIK=='111377') ? self::adding_terbilang($hsl->JML_ALL) : $hsl->TERBILANG ).'</b> 
				<br>
				<br>
				- Gaji Pokok Pensiun (GPP) : '.$hsl->GPP.'<br>
				- Hari Lembur Biasa/Libur : '.$hsl->LEMBUR_HARI_BIASA.' / '.$hsl->LEMBUR_HARI_LIBUR.' Hari <br>
				- Hari Kerja : 22 Hari
				
				</div>
			
			</div>
			';

//            die($html);

            $pdf->SetFont('dejavusans', '', 8);
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->IncludeJS("print();");

            $pdf->Output('slip.pdf', 'D');
        }

        die('Tidak Ada Data');
    }
	
	
    // ariwa
    public function actionMenuerp()
    {
        // echo '<div style="font-size: 30px;">Server E-Slip sedang ada <i>Maintenance</i>.<br>
        // Silahkan coba beberapa saat lagi.<br>
        // <a href="/">Kembali Ke POIN</a>
        // <br><br>Salam,<br>Admin</div>';
        // die();
        // print_r('Menunggu e-slip apps ready');
        // exit();

        $vars['periods'] = array();
        $this->render('erp', $vars);
    }

}
