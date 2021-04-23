<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-site-verification" content="XAOQqQpPLk35NDh8KYSYlVK-JnlgijSpTRuTw1xuIp0" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
    <link rel="shortcut icon" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/img/favicon.png" type="image/x-icon" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/text.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/grid.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/jquery-ui-1.8.21.custom.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/colorbox.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/css/tipsy.css" />
	
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" />
    
    <script type="text/javascript">
	//<![CDATA[
	var baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>';
	var themeUrl = '<?php echo Yii::app()->theme->baseUrl; ?>';
	//]]>
	</script>
	
</head>
<body>
	<!--<div class="container_16">-->
		<div id="header-wrapper">
			<div id="header" class="container_16">
				<?php if(Yii::app()->user->isGuest) : ?>
				<?php elseif(!Yii::app()->user->isAdmin): ?>
				<?php else: ?>
					
					<div class="clear"></div>
					
					<?php $this->beginWidget('AdminmenuWidget', array(
                    	'title'=>'admin menu',
                    )); ?>
                    <?php $this->endWidget(); ?>
					
				<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		
		
		
		<div id="content" class="container_16">
		
			
			<?php echo $content; ?>
           
			
		</div>
		
		
		<div class="clear"></div>
		
	<!--</div>-->
	<!-- end .container_16 -->
    
    <?php if($this->pageTitle == 'Document Browser'):?>
	<?php else: ?>
    
    	<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery-1.7.2.min.js"></script>
    	<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery.jeditable.mini.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery.tipsy.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery-ui-1.8.21.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery.colorbox.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/fx.js"></script>

    <?php endif; ?>
    
    
    
	</body>
</html>