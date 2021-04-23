<?php
	$getPlatform =  Yii::app()->browser->getPlatform();
	$getBrowser =  Yii::app()->browser->getBrowser();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, nofollow">
	<meta name="description" content="POIN" />
	<meta name="keywords" content="POIN MDmedia" />
	<meta name="author" content="Design by Prass Wardana"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<link rel="shortcut icon" href="/ariwa/np_images/icon/icon.png" type="image/x-icon" />
	
	<link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/text.css" />
	<link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/960_24_col.css" />
	
	<link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/jquery-ui.css" />
	
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/style-login.css" />
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/tipsy-login.css" />
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/default.css" />
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/nivo-slider.css" />
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/colorbox.css" />

	<link rel="stylesheet" type="text/css" href="/css/login.css">
	
	
</head>
<body>


    <div id="header-wrapper" class="header-wrapper shadow">
		<div id="header" class="container_24">
		
			
			<?php $this->beginWidget('InfoWidget', array(
				'title'=>'Latest Info',
			)); ?>
			<?php $this->endWidget(); ?>
			
			
		</div>
		<div class="clear"></div>
	</div>
    <!-- 
    <div id="giude" class="guide">
    	<div class="inner">
        	<a class="group1" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/POIN2012_whatsnew/POIN2012_whatsnew_1.jpg" title="POIN2012 whats new.">
	              <span>.</span>
            </a>
        </div>
    </div>
	 -->
	 
	<div id="torso" class="torso">
		<div id="content" class="container_241">
			<div id="main" class="grid_161">
			
               <?php // $this->beginWidget('ThemeactiveWidget', array('title'=>'Theme Active',)); $this->endWidget(); ?>
               <?php // MD BUMPER no text.gif ?>
               <?php // 
				/*
				1. defaullt
				<img src="/ariwa/np_images/banner20140902.gif" height="340px" />

				2.
				<img src="/ariwa/np_images/2015/merdeka70.jpg" height="340px" />
				3.
				<img src="/ariwa/np_images/2015/poin_login_aircraft.jpg" height="305px" />
				
				4.
				<img src="/ariwa/np_images/2015/poin_login_aircraft.jpg" height="340px" />		
				
				5.
				<img src="/ariwa/np_images/2015/poin_login_aircraft.jpg" height="340px" />	
				
				6.
				<img src="/ariwa/2018/pergantianpoint/logo_utama_2018.jpg" height="340px" />	
				*/
               ?>
				
				
				
				<img src="/ariwa/2020/img/new_login_img.jpg" height="340px" />	
				
			</div>
			<div id="sidebar" class="grid_81">
			
			<form id="login-form" action="<?php echo Yii::app()->request->baseUrl; ?>/site/login" method="post">
			<!--<form id="login-form" action="" method="post">-->
				<div id="login-area">
					
					<img src="/ariwa/np_images/logo_mdmedia.png" />
					
					<div style="font-size: 26px;">Selamat Datang</div>
					<div style="font-size: 10px;">di Poin MD Media</div>
					
					<div style="margin-top: 55px;">
						<table cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 0px;">
							<tr>
							<td>
								<label class="input">
								<span>NIK*</span>
								<input tabindex="1" name="LoginForm[username]" id="LoginForm_username" class="LoginInput" type="text" />					
								</label>
								<div class="errorMessage" id="LoginForm_username_em_" style="display: none;"></div>
							</td>
							<td rowspan="2"><input tabindex="3" id="LoginButton" class="LoginButton" name="yt0" value="Masuk" type="submit" /></td>
							</tr>
							<tr>
							<td>
								<label class="input">
								<span>Password*</span>
								<input tabindex="2" name="LoginForm[password]" id="LoginForm_password" class="LoginInput" type="password" />					
								</label>
								<div class="errorMessage" id="LoginForm_password_em_" style="display: none;"></div>					
								
		                                <?php foreach(Yii::app()->user->getFlashes() as $key => $message) { echo '<div class="flash-' . $key . '">' . $message . "</div>\n"; } ?>
		                               
							
							</td>
							</tr>
						</table>
					</div>
					<div class="row rememberMe">
						<input id="ytLoginForm_rememberMe" value="0" name="LoginForm[rememberMe]" type="hidden" />
						<input tabindex="4" name="LoginForm[rememberMe]" id="LoginForm_rememberMe" value="1" type="checkbox" />					
						<label for="LoginForm_rememberMe">Ingat saya</label>					
						<div class="errorMessage" id="LoginForm_rememberMe_em_" style="display: none;"></div>				
					</div>
				</div>
			
			</form>
				
				
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<div id="footer-wrapper" class="footer-wrapper">
        <div id="footer" class="container_24">
            <div id="menu-bottom" class="menu-bottom">
               
			   <?php 
			   /*
			   <ul class="menu">
                    <li><a class="auto-gravity" href="http://new.yellowpages.co.id" title="Yellow Pages" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/IconProduct/yellowpages.png" alt="yellowpages" /></a></li>
                    <li><a class="auto-gravity" href="http://infojajan.com" title="Infojajan" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/IconProduct/infojajan.png" alt="infojajan" /></a></li>
                    <li><a class="auto-gravity" href="http://yptravel.com" title="YP Travel" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/IconProduct/travel.png" alt="travel" /></a></li>
                    <li><a class="auto-gravity" href="http://yellowpages.co.id/cityguide" title="City Guide" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/IconProduct/cityguide.png" alt="cityguide" /></a></li>
                    <li><a class="auto-gravity" href="http://yptrading.co.id" title="YP Trading" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/IconProduct/trading.png" alt="trading" /></a></li>
                    <!-- <li><a class="auto-gravity" href="http://goodizz.com" title="Goodizz" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/IconProduct/goodizz_deal.png" alt="goodizz_deal" /></a></li>  -->
                    <li><a class="auto-gravity" href="http://digitalkreatif.com" title="Digital Kreatif" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/IconProduct/techno.png" alt="techno" /></a></li>
                    <li><a class="auto-gravity" href="http://tabloidyellowpages.com" title="Tabloid YP" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/IconProduct/tabloidyp.png" alt="tabloidyp" /></a></li>
                </ul>
				*/
				?>
            </div>
        </div>
    </div>
	 
	<!--
	<script type="text/javascript" src="http://en.yellowpages.co.id/assets/widget/search.js"></script>
	-->

    
    
	<script type="text/javascript" src="/ariwa/np_js/js/jquery-1.7.2.min.js"></script>

	<script type="text/javascript" src="/ariwa/np_js/jquery.yiiactiveform.js"></script>
	
	<script type="text/javascript" src="/ariwa/np_js/js/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="/ariwa/np_js/js/jquery.jscrollpane.js"></script>
	<script type="text/javascript" src="/ariwa/np_js/js/jquery.colorbox.js"></script>
	<script type="text/javascript" src="/ariwa/np_js/js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="/ariwa/np_js/js/jquery.cycle.all.latest.js"></script>
	<script type="text/javascript" src="/ariwa/np_js/js/jquery.nivo.slider.pack.js"></script>
	<script type="text/javascript" src="/ariwa/np_js/js/fx.js"></script>

	<script type="text/javascript">
	//<![CDATA[
	var baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>';
	var themeUrl = '<?php echo Yii::app()->theme->baseUrl; ?>';
	//]]>
	</script>
    
    <script type="text/javascript" src="/ariwa/np_js/login.js"></script>
    

</body>
</html>
<!--
Execution time: <?php //echo round(CLogger::getExecutionTime(), 3); ?> sec
Memory usage: <?php //echo round(CLogger::getMemoryUsage()/1000000, 3); ?> mb
-->
