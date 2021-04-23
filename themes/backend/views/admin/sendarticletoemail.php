<meta charset="utf-8">


	<style>
        body{
            font-family: "Trebuchet MS",Tahoma,Verdana,Arial,Helvetica,sans-serif;
            font-size: 0.8em;
        }
        
        h1.title{
            border-bottom: 1px solid #D7D7D7;
            padding: 0 0 5px 0;
            font-weight: normal;
        }
        
        h1.title span{
            color: transparent;
            padding: 0 10px;
            background:url(<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/img/6b49c8b444c8f935c373a9fa4fb242b4.png) no-repeat right;
            background-position: -60px -90px;
        }
		
		.flash-sucsess{
			background:#ECF8F4;
			padding: 5px;
			color:#668877;
			border: 2px solid #F8FFFC;
			border-radius: 4px;
		}
        
    </style>
	
	<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	



	<h1 class="title">Share to Email <span>.</span></h1>
    
     <?php
		foreach(Yii::app()->user->getFlashes() as $key => $message) {
				echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
		}
	?>
    