<?php if(Yii::app()->user->isGuest): ?>
	
	<div class="grid_16">
		<div class="inner">
		
			<div id="login-front" class="login-front" >
			
				<div id="logo" class="logo">
						<img src="<?php echo Yii::app()->theme->getBaseUrl(); ?>/img/logo-poin.png" title="logo" alt="logo"/>
				</div>
				
				<div class="clear"></div>
				<div class="login-area shadow" id="login-area">
					<div class="inner">
					
						<div class="form">
							<form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/admin/login" id="login-form">
								<div class="title">
									<div class="inner">
										Login to your account
									</div>
								</div>
								<div class="row">
									<label class="required" for="LoginForm_username">Username <span class="required">*</span></label>								
									<input type="text" id="LoginForm_username" name="LoginForm[username]" />								
									<div style="display:none" id="LoginForm_username_em_" class="errorMessage"></div>
								</div>

								<div class="row">
									<label class="required" for="LoginForm_password">Password <span class="required">*</span></label>								
									<input type="password" id="LoginForm_password" name="LoginForm[password]" />								
									<div style="display:none" id="LoginForm_password_em_" class="errorMessage"></div>
									<?php
										foreach(Yii::app()->user->getFlashes() as $key => $message) {
											echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
										}
									?>
								</div>

								<div class="row buttons">
									<input id="login-submit" class="login-submit radius" type="submit" value="Login" name="yt0" />							
								</div>

							</form>						
						</div>
					
					</div>
				</div>
				
				<div id="copyright-login" class="copyright-login">
					<div class="inner">
						Copyright &copy; <?php echo date('Y'); ?> <b>PT. Infomedia Nusantara</b>. Allright Reserved.
					</div>
				</div>
				
				
			
			</div>

		
		</div>
	</div>

	
<?php else: ?>

    <?php if(Yii::app()->user->isAdmin): ?>
		
		<div id="perface-top" class="grid_16">
			<div id="breadcurmb" class="breadcurmb">
				<div class="inner">
				Dashboard &raquo;
				</div>			
			</div>
		</div>
		
		<div id="main" class="grid_16 radius">
		
			
			<div class="main-content">
				<div class="inner">
				<?php echo Yii::app()->user->name; ?>
				</div>
			</div>
			
		</div>
		<div class="clear"></div>

    <?php else: ?>
		
		<div class="grid_16">
			<div class="inner">
			
				<div id="login-front" class="login-front" >
				
					<div id="logo" class="logo">
							<img src="<?php echo Yii::app()->theme->getBaseUrl(); ?>/img/logo-poin.png" title="logo" align="left" />
					</div>
					<div id="logo" class="logo">
							<img src="<?php echo Yii::app()->theme->getBaseUrl(); ?>/img/login-area.png" title="infomedia" align="right" />
					</div>
					
					<div class="clear"></div>
					<div class="login-area shadow" id="login-area">
						<div class="inner">
						
							<div class="form">
								<form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/admin/login" id="login-form">
									<div class="title">
										<div class="inner">
											Login to your account
										</div>
									</div>
									<div class="row">
										<label class="required" for="LoginForm_username">Username <span class="required">*</span></label>								
										<input type="text" id="LoginForm_username" name="LoginForm[username]">								
										<div style="display:none" id="LoginForm_username_em_" class="errorMessage"></div>

										<?php
											foreach(Yii::app()->user->getFlashes() as $key => $message) {
												echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
											}
										?>
										
									</div>

									<div class="row">
										<label class="required" for="LoginForm_password">Password <span class="required">*</span></label>								
										<input type="password" id="LoginForm_password" name="LoginForm[password]">								
										<div style="display:none" id="LoginForm_password_em_" class="errorMessage"></div>							
									</div>

									<div class="row buttons">
										<input id="login-submit" class="login-submit radius" type="submit" value="Login" name="yt0">							
									</div>

								</form>						
							</div>
						
						</div>
					</div>
					
					<div id="copyright-login" class="copyright-login">
						<div class="inner">
							Copyright &copy; <?php echo date('Y'); ?> <b>PT. Infomedia Nusantara</b>. Allright Reserved.
						</div>
					</div>
					
					
				
				</div>

			
			</div>
		</div>
		
    <?php endif; ?>

<?php endif; ?>