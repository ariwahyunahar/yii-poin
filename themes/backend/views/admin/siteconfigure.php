<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Site Building &raquo; Sites Configure
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> Sites Configure</h3>
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <?php 
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'user-form',
				'enableAjaxValidation'=>false,
			)); 
			?>
			<div id="content-view-detail" class="grid_11">
				<div class="inner">
				
					<div class="row">
						<?php echo $form->labelEx($sites,'site_name'); ?>
						<?php echo $form->textField($sites,'site_name',array('rows'=>8, 'class'=>'span5')); ?>
						<?php echo $form->error($sites,'site_name'); ?>
					</div>
				
				
				
					<div class="row">
						<?php echo $form->labelEx($sites,'slogan'); ?>
						<?php echo $form->textField($sites,'slogan',array('rows'=>8, 'class'=>'span5')); ?>
						<?php echo $form->error($sites,'slogan'); ?>
					</div>
				
					<!--
					<div class="controls">
						<?php //echo $form->labelEx($sites,'themes_id'); ?>
						<?php //echo $form->textField($sites,'themes_id',array('rows'=>8, 'class'=>'span5')); ?>
						<?php //echo $form->error($sites,'themes_id'); ?>
					</div>
					-->
				
					<div class="row">
						<?php echo $form->labelEx($sites,'bannertop'); ?>
						<?php echo $form->checkBox($sites,'bannertop',array('rows'=>8, 'class'=>'checkBox')); ?>
						<?php echo $form->error($sites,'bannertop'); ?>
					</div>
					
					<div class="row buttons">
						<input id="SaveButton" class="form-submit" type="submit" value="Save" name="yt0">
					</div>
					
					
					<?php $this->endWidget(); ?>
					
					
					<p>&nbsp;</p>
				</div>
			</div>
            
      </div>
    </div>
</div>
<div class="clear"></div>