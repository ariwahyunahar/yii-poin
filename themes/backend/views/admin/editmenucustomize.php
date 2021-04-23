<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Site Building &raquo; Menus &raquo; <?php echo $TypeMenu->name; ?> &raquo; <?php echo $menu->name; ?>
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> <?php echo $menu->name; ?></h3>
            
            
            </div>
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            
            
            
             <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'content-form',
                'enableAjaxValidation'=>false,
            )); ?>
            <div id="content-view-detail" class="grid_16">
                <div class="inner">
                
                    <div class="row">
                        <?php echo $form->labelEx($menu,'title'); ?>
                        <?php echo $form->textField($menu,'title'); ?>
                        <?php echo $form->error($menu,'title'); ?>
                    </div>
                    
                    <div class="row">
                        <?php echo $form->labelEx($menu,'name'); ?>
                        <?php echo $form->textField($menu,'name'); ?>
                        <?php echo $form->error($menu,'name'); ?>
                    </div>
                    
                    <div class="row">
                        <?php echo $form->labelEx($menu,'description'); ?>
                        <?php echo $form->textArea($menu,'description', array('rows'=>15, 'cols'=>75)); ?>
                        <?php echo $form->error($menu,'description'); ?>
                    </div>
                    
                   	<div class="row">
                        <?php echo $form->labelEx($menu,'slug'); ?>
                        <?php echo $form->textField($menu,'slug'); ?>
                        <?php echo $form->error($menu,'slug'); ?>
                    </div>
                    
                    <div class="row">
                        <?php echo $form->labelEx($menu,'publish'); ?>
                        <?php echo $form->checkBox($menu,'publish',array('class'=>'checkbox')); ?>
                        <?php echo $form->error($menu,'publish'); ?>
                    </div>
                
                    <div class="row buttons">
                        <input id="SaveButton" class="form-submit" type="submit" value="Save" name="yt0">
                    </div>

                    
                </div>
            </div>
            <?php $this->endWidget(); ?>
             
        </div>
    </div>
</div>
<div class="clear"></div>