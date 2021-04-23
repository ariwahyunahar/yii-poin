<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-site-verification" content="XAOQqQpPLk35NDh8KYSYlVK-JnlgijSpTRuTw1xuIp0" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<link rel="shortcut icon" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>img/favicon.png" type="image/x-icon" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/text.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/960_24_col.css" />
	
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Comfortaa" />
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/jquery-ui.css" />
	
	
	<?php if(!Yii::app()->user->isGuest): ?>
	
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/tipsy.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/colorbox.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/jquery.jscrollpane.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/megamenu.css" />
	
	
	<?php else: ?>
	
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/style-login.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/tipsy-login.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>css/colorbox.css" />
        
        <?php $this->beginWidget('ThemeactiveWidget', array(
			'title'=>'Theme Active',
		)); ?>
		<?php $this->endWidget(); ?>
	
	<?php endif; ?>
	
	
	
</head>
<body>
	 
    <?php //var_dump($activeTheme); ?>
    <?php if(!Yii::app()->user->isGuest): ?>
	
	  
		<div id="top-header-wrapper" class="top-header-wrapper">
			<div id="top-header" class="container_24">
            
				<div id="account" class="grid_14">
					<div class="inner">
					
						<ul class="menu">
                            <li class="leaf">
                            
                            <?php $this->beginWidget('DateWidget', array(
                                'title'=>'date',
                            )); ?>
                            <?php $this->endWidget(); ?>
                            
                            <?php $this->beginWidget('LoginasWidget', array(
                                'title'=>'login as',
                            )); ?>
                            <?php $this->endWidget(); ?>
                            
                            </li>
                            
                            <li class="last">
                            
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/logout" title="logout" id="logout">Keluar</a>
                            
                            </li>
                        </ul>
					
					</div>
				</div>
				
               <?php $this->beginWidget('SearchcontentWidget', array(
					'title'=>'Search Content',
				)); ?>
				<?php $this->endWidget(); ?>
                
			</div>
		</div>
		<div class="clear"></div>
		

		<div id="header-wrapper" class="header-wrapper">
			<div id="header" class="container_24">
            
            
				<div id="logo" class="logo grid_6">
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/" title="logo">
                    	<img src="<?php echo Yii::app()->theme->getBaseUrl(); ?>/img/logo-poin.png" alt="logo" width="207" height="63" />
                    </a>
				</div>
                
                <?php $this->beginWidget('ToplinksWidget', array(
					'title'=>'Toplinks',
				)); ?>
				<?php $this->endWidget(); ?>
                
				
                <div class="clear"></div>
                
                
                <?php $this->beginWidget('PrimarymenuWidget', array(
					'title'=>'Primarymenu',
				)); ?>
				<?php $this->endWidget(); ?>
                
				<div class="clear"></div>
				
				
				
			</div>
		</div>
		<div class="clear"></div>

		
		
		
		<?php echo $content; ?>
		
		

		<div id="footer-wrapper" class="footer-wrapper">
			<div id="footer" class="container_24">
				<div id="copyright" class="copyright">
					Copyright &copy; 2005-<?php echo date('Y'); ?> PT Infomedia Nusantara. All rights reserved.<br/>
					POIN powered by Infomedia IT Division.
				</div>
			</div>
		</div>
		<div class="clear"></div>
	  
	<?php else: ?>
	
		
		<div id="header-wrapper" class="header-wrapper shadow">
			<div id="header" class="container_24">
			
				
				<?php $this->beginWidget('InfoWidget', array(
					'title'=>'Latest Info',
				)); ?>
				<?php $this->endWidget(); ?>
				
				
			</div>
			<div class="clear"></div>
		</div>
        
        <div id="giude" class="guide">
        	<div class="inner">
            	<a class="group1" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/POIN2012_whatsnew/POIN2012_whatsnew_1.jpg" title="POIN2012 whats new.">
  	              <span>.</span>
                </a>
            </div>
        </div>

		<div id="torso" class="torso">
			<div id="content" class="container_24">
				<div id="main" class="grid_16 radius shadow">
					<div class="inner">
						<div id="SlideLogOn" class="SlideLogOn" style="color: #fff; font-weight: bold;"><span>Infomedia Nusantara</span></div>
					</div>
				</div>
				<div id="sidebar" class="grid_8">
					
					
				
					<div id="login-area" class="login-area radius shadow">
						
						<div class="inner">
							<form id="login-form" action="<?php echo Yii::app()->request->baseUrl; ?>/site/login" method="post">
							<!--<form id="login-form" action="" method="post">-->
							
								<div class="row">
									<label for="LoginForm_username" class="required">N I K <span class="required">*</span></label>					
									<input name="LoginForm[username]" id="LoginForm_username" class="LoginInput" type="text" />					
									<div class="errorMessage" id="LoginForm_username_em_" style="display: none;"></div>				
								</div>
								
								<div class="row">
									<label for="LoginForm_password" class="required">Kata Sandi <span class="required">*</span></label>					
									<input name="LoginForm[password]" id="LoginForm_password" class="LoginInput" type="password" />					
									<div class="errorMessage" id="LoginForm_password_em_" style="display: none;"></div>					
									
                                                                        <?php
										foreach(Yii::app()->user->getFlashes() as $key => $message) {
											echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
										}
									?>
                                                                        
                                                                        <p class="hint">
										<!--Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.-->
									</p>
                                                                        
								</div>

								<div class="row rememberMe">
									<input id="ytLoginForm_rememberMe" value="0" name="LoginForm[rememberMe]" type="hidden" />
									<input name="LoginForm[rememberMe]" id="LoginForm_rememberMe" value="1" type="checkbox" />					
									<label for="LoginForm_rememberMe">Ingat saya</label>					
									<div class="errorMessage" id="LoginForm_rememberMe_em_" style="display: none;"></div>				
								</div>
								
								<div class="clear"></div>

								<div class="row buttons">
									<input id="LoginButton" class="LoginButton radius" name="yt0" value="Masuk" type="submit" />				
								</div>
							
							</form>
						</div>
						
					</div>
					
					<div id="logo" class="logo">
						<div class="inner">
							&nbsp;
						</div>
					</div>
					
					
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div id="footer-wrapper" class="footer-wrapper">
            <div id="footer" class="container_24">
                <div id="menu-bottom" class="menu-bottom">
                    <ul class="menu">
                        <li><a class="auto-gravity" href="http://new.yellowpages.co.id" title="Yellow Pages" target="_blank">Yellow Pages</a></li>
                        <li><a class="auto-gravity" href="http://infojajan.com" title="Infojajan" target="_blank">Culinary</a></li>
                        <li><a class="auto-gravity" href="http://yptravel.com" title="YP Travel" target="_blank">Travelling</a></li>
                        <li><a class="auto-gravity" href="http://yellowpages.co.id/cityguide" title="City Guide" target="_blank">City Guide</a></li>
                        <li><a class="auto-gravity" href="http://yptrading.co.id" title="YP Trading" target="_blank">Market Place</a></li>
                        <li><a class="auto-gravity" href="http://goodizz.com" title="Goodizz" target="_blank">Special Deals</a></li>
                        <li><a class="auto-gravity" href="http://digitalkreatif.com" title="Digital Kreatif" target="_blank">Techno</a></li>
                        <li><a class="auto-gravity" href="http://tabloidyellowpages.com" title="Tabloid YP" target="_blank">Tabloid</a></li>
                        <li id="copyright">Infomedia Nusantara &copy; 2005-<?php echo date('Y'); ?>.</li>
                    </ul>
                </div>
            </div>
        </div>
				
	
	<?php endif; ?>
	 
	<!--
	<script type="text/javascript" src="http://en.yellowpages.co.id/assets/widget/search.js"></script>
	-->
    
    
    
    <?php if($this->pageTitle == 'Document Browser'):?>
	<?php else: ?>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery-ui.min.js"></script>
	<?php endif; ?>
		
		
		<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery.jscrollpane.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery.colorbox.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery.tipsy.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jquery.cycle.all.latest.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/fx.js"></script>
	
	<script type="text/javascript">
	//<![CDATA[
	var baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>';
	var themeUrl = '<?php echo Yii::app()->theme->baseUrl; ?>';
	//]]>
	</script>
    
    

</body>
</html>
<!--
Execution time: <?php //echo round(CLogger::getExecutionTime(), 3); ?> sec
Memory usage: <?php //echo round(CLogger::getMemoryUsage()/1000000, 3); ?> mb
-->