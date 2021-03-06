<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'POIN',
	'theme'=>'v1',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//Polling
		'application.modules.poll.models.*',
		'application.modules.poll.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'password',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
		//Polling
		
		'modules' => array(
			'poll' => array(
				// Force users to vote before seeing results
				'forceVote' => TRUE,
				// Restrict anonymous votes by IP address,
				// otherwise it's tied only to user_id 
				'ipRestrict' => TRUE,
				// Allow guests to cancel their votes
				// if ipRestrict is enabled
				'allowGuestCancel' => FALSE,
			),
		),
		
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'CHttpCookie'=>array(
			'domain'=>'.mdmedia.co.id',
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive'=>false,   
			'rules'=>array(
			
				'article/<slug:[a-zA-Z0-9_\-]+>'=>'content/readarticle',
				'article/'=>'content/article',
				//'news/<slug:[a-zA-Z0-9_\-]+>'=>'content/readnews',
				'news/<slug:[a-zA-Z0-9_\-]+>'=>'content/readarticle',
				//'news/newspopular/<slug:[a-zA-Z0-9_\-]+>'=>'content/readnewspopular',
				'news/newspopular/<slug:[a-zA-Z0-9_\-]+>'=>'content/readarticle',
				'newspopular/'=>'content/newspopular',
				'news/'=>'content/news',
				'ebook/'=>'content/ebook',
				'search/'=>'content/search',
				'mediarelease/'=>'content/mediarelease',
				'gallery/'=>'content/gallery',
				'gallery/<slug:[a-zA-Z0-9_\-]+>'=>'content/gallerydetail',
				'video/'=>'content/video',
				'video/<slug:[a-zA-Z0-9_\-]+>/watch'=>'content/videowatch',
				'event/'=>'content/event',
				'event/<slug:[a-zA-Z0-9_\-]+>'=>'content/eventdetail',
				'corporate/<slug:[a-zA-Z0-9_\-]+>'=>'content/readcorporate',
				'bod'=>'content/bod',
				'bod/<slug:[a-zA-Z0-9_\-]+>'=>'content/readarticle',
				'appservice/'=>'content/appservice',
				'apppersonil/'=>'content/apppersonil',
				'birthday/'=>'content/birthday',
				'newemploye/'=>'content/newemploye',
				'gaji/'=>'content/gaji',
				'gajihr/'=>'content/gajihr',
				
                'gajiget/'=>'content/gajiget',
                'gajigetmain/'=>'content/gajigetmain',
				
				'gajihr/getuser'=>'content/gajihrgetusers',
				
				'pcinventory/'=>'content/pcinventory',
				'gajipdf/'=>'content/gajipdf',
				'gajipdfnew/'=>'content/gajipdfnew',
				'getsimulasipendi/'=>'content/getsimulasipendi',
                'menuerp/'=>'content/menuerp',
				
				'bonuspdf/'=>'content/bonuspdf',
				'downloadfile/'=>'content/downloadfile',
				'downloadfilespt/'=>'content/downloadfilespt',
				'downloadfileeid/'=>'content/downloadfileeid',
				'downloadfilesk2020/'=>'content/downloadfilesk2020',
				'sksk/'=>'content/sksk',
				'sksk/download'=>'content/skskdownload',
				
				
				// 201908
				'spt/'=>'content/spt',
				'downloadfilesptpertahun/'=>'content/downloadfilesptpertahun',
				
				'suaraanda/'=>'content/suaraanda',
				
				
				'birthday/detail/<nik:[a-zA-Z0-9_\-]+>'=>'content/birthdaydetail',
				'password/'=>'content/password',
				'print/<slug:[a-zA-Z0-9_\-]+>'=>'content/print',
				'emailto/<nik:[a-zA-Z0-9_\-]+>'=>'content/emailto',
				//'polling/vote'=>'polling/vote',
				'document/'=>'doc/index',
				'document/<slug:[a-zA-Z0-9_\-]+>'=>'doc/<slug>',
				'documentgm/'=>'docgm/index',
				'documentgm/<slug:[a-zA-Z0-9_\-]+>'=>'docgm/<slug>',
				'survey/'=>'content/survey',
				
				'admin/content/create'=>'admin/contentcreate',
				'admin/content/<slug:[a-zA-Z0-9_\-]+>'=>'admin/contentview',
				'admin/content/edit/<slug:[a-zA-Z0-9_\-]+>'=>'admin/contentupdate',
				'admin/content/video/<slug:[a-zA-Z0-9_\-]+>'=>'admin/contentvideo',
				
				'admin/contenttype/create'=>'admin/contenttypecreate',
				'admin/contenttype/edit/<slug:[a-zA-Z0-9_\-]+>'=>'admin/contenttypeupdate',
				
				'admin/report/content'=>'admin/reportcontenthits',
				
				'admin/polling'=>'admin/polling',
				'admin/polling/choice/<id:[a-zA-Z0-9_\-]+>'=>'admin/pollingchoice',
				'admin/delete/polling/<id:[a-zA-Z0-9_\-]+>'=>'admin/deletepolling/<id:[a-zA-Z0-9_\-]+>',
				'admin/polling/activate/<id:[a-zA-Z0-9_\-]+>/<slug:[a-zA-Z0-9_\-]+>'=>'admin/pollingactive',
				
				'admin/polling/choice/add/<pollId:[a-zA-Z0-9_\-]+>'=>'admin/addchoice',
				
				'admin/sharetoemail/<id:[a-zA-Z0-9_\-]+>'=>'admin/sharetoemail',
				
				'admin/menu-customize/<slug:[a-zA-Z0-9_\-]+>'=>'admin/menucustomize',
				'admin/edit-menu-customize/<slug:[a-zA-Z0-9_\-]+>'=>'admin/editmenucustomize',
				'admin/menu/add'=>'admin/menucreate',
				
				'admin/updatecomment/<id:[a-zA-Z0-9_\-]+>/<publish:[a-zA-Z0-9_\-]+>'=>'admin/updatecomment',
				'admin/removecomment/<id:[a-zA-Z0-9_\-]+>'=>'admin/removecomment',
				
				'admin/document/'=>'doc/indexadmin',
				'admin/document/settings'=>'admin/documentsettings',
				'admin/document/settings/removeuser/<id:[a-zA-Z0-9_\-]+>'=>'admin/removeuserdocument',
				
				'admin/contenttype/create'=>'admin/contenttypecreate',
				
				'admin/theme/settings/<slug:[a-zA-Z0-9_\-]+>'=>'admin/themeconfig',
				
				'admin/siteconfigure'=>'admin/siteconfigure',
				
				'admin/documenttisna/'=>'doctisna/indexadmin',
				'admin/docspt/'=>'doctisna/indexspt',
				
				//'document/'=>'doc/index',
				//'document/connector'=>'doc/connector',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				
				'documenthr/'=>'dochr/index',
			),
		),
		
		'session' => array(
			'class' => 'system.web.CHttpSession',
			'sessionName' => 'poin',
			'cookieMode' => 'allow',
			'timeout' => 1800,
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=poin',
			'emulatePrepare' => true,
			'username' => 'xxxx',
			'password' => 'xxxx',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'ldap'=>array(
			'class'=>'LdapComponent',
		),
		'media'=>array(
			'class'=>'MediaWidget',
		),
		'util'=>array(
			'class'=>'UtilComponent',
		),
		
		'ePdf' => array(
			'class'        => 'ext.yii-pdf.EYiiPdf',
			'params'       => array(
				'mpdf'     => array(
					'librarySourcePath' => 'application.vendors.mpdf.*',
					'constants'         => array(
						'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
					),
					'class'=>'mpdf',
				),
				'HTML2PDF' => array(
					'librarySourcePath' => 'application.vendors.html2pdf.*',
					'classFile'         => 'html2pdf.class.php',
					'orientation' => 'P', // landscape or portrait orientation
                    'format'      => 'A4', // format A4, A5, ...
                    'language'    => 'en', // language: fr, en, it ...
                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
				),
			),
		),
		
		'admin_mailer'=>array(
			'class'=>'ext.swiftMailer.SwiftMailer',
			//for SMTP
			'mailer'=>'smtp',
			'host'=>'smtp.gmail.com',
			'port'=> '465',
			'encryption'=>'ssl',
			'From'=>'lumy.nugraha@infomedia.web.id',
			'username'=>'Xxx',
			'password'=>'xxx',
			//'email'=>'mpah_mpeh@yahoo.com',
			// For sendmail:
		),
		
		'imageapi'=>array(
			'class'=>'ext.imageapi.CImage',
			'presets'=>array(
				'content_gallery'=>array(
					'cacheIn'=>'webroot.assets.content.gallery',
					'actions'=>array(
						'scaleAndCrop'=>array('width'=>445,    
											  'height'=>319),
					),
				),
				'content_thumb'=>array(
					'cacheIn'=>'webroot.assets.content.thumb',
					'actions'=>array(
						'scale'=>array('width'=>87,    
										'height'=>'100%'),
					),
				),
				'content_thumbFront'=>array(
					'cacheIn'=>'webroot.assets.content.thumbfront',
					'actions'=>array(
						'scale'=>array('width'=>195,    
										'height'=>144),
					),
				),
				'content_splash'=>array(
					'cacheIn'=>'webroot.assets.content.splash',
					'actions'=>array(
						'scaleAndCrop'=>array('width'=>445,    
											  'height'=>319),
					),
				),
				'content_splash_login'=>array(
					'cacheIn'=>'webroot.assets.content.SlideLogin',
					'actions'=>array(
						'scaleAndCrop'=>array('width'=>620,    
											  'height'=>392),
					),
				),
				'banner_top'=>array(
					'cacheIn'=>'webroot.assets.img',
					'actions'=>array(
						'scaleAndCrop'=>array('width'=>960,    
											  'height'=>150),
					),
				),
			),
			
		),

		'browser' => array(
		    'class' => 'ext.browser.CBrowserComponent',
		),
		
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	/*
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'praswardana@gmail.com',
	),
	*/
	'params' => include (dirname(__FILE__).'/params.php'),
);
