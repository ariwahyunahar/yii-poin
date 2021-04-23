<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-site-verification" content="XAOQqQpPLk35NDh8KYSYlVK-JnlgijSpTRuTw1xuIp0" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<link rel="shortcut icon" href="http://localhost/<?php echo Yii::app()->theme->getBaseUrl(); ?>/img/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="http://localhost/<?php echo Yii::app()->theme->getBaseUrl(); ?>/css/style-pdf.css" />

</head>

<body>
	
	<div id="main" class="container_24" >
	
		<?php echo $content; ?>
		
	</div>

	
</body>
</html>