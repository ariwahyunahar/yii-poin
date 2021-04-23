<?php
	$getPlatform =  Yii::app()->browser->getPlatform();
	$getBrowser =  Yii::app()->browser->getBrowser();
?>

<?php if($getPlatform == 'Linux'): ?>

	<div id="torso">
	 <div class="row-fluid">
	    <div class="span7">
	       <div id="splash">
	          <div class="img"><img class="span12" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/Security.jpg"></div>
	          <div class="caption"><h2>Your account, our priority</h2> <br/> Adding security information helps protect your account</div>
	       </div>
	    </div>
	    <div class="span1">&nbsp;</div>
	    <div class="span4">
	       <div id="login-box">
	          
	          <!--
	          <form class="">
	             <fieldset>
	               <legend>Masuk Akun Anda</legend>
	               <input type="text" placeholder="NIK…" class="span12">
	               <input type="text" placeholder="Kata Sandi…" class="span12">
	               <label class="checkbox">&nbsp;</label>
	               <button class="btn btn-info" type="submit">Masuk</button>
	             </fieldset>
	           </form>
	       		-->

				<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableClientValidation'=>true,
				'clientOptions'=>array(
				'validateOnSubmit'=>true,
				),
				)); ?>

				<legend>Masuk Akun Anda</legend>

				<div class="control-group">
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username'); ?>
				<?php echo $form->error($model,'username'); ?>
				</div>

				<div class="control-group">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password'); ?>
				<?php echo $form->error($model,'password'); ?>
				</div>

				<div class="control-group buttons">
				<?php echo CHtml::submitButton('Login'); ?>
				</div>

				<?php $this->endWidget(); ?>

	       </div>

			<div>
				<div class="bs-docs-example">
					<ul class="nav nav-pills nav-stacked">
						<li>Macintosh Version</li>
					</ul>
				</div>
			</div>

	    </div>
	 </div>
	</div>

<?php else:?>

	<h1>Login</h1>
	
	<p>Please fill out the following form with your login credentials:</p>
	
	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	
		<p class="note">Fields with <span class="required">*</span> are required.</p>
		
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
			<p class="hint">
				Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
			</p>
		</div>

		<div class="row rememberMe">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton('Login'); ?>
		</div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->

<?php endif; ?>
