<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Site Building &raquo; Menus &raquo; 
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> <?php echo $title; ?></h3>
            
            <div id="tab-menu" class="grid_16">
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menu-customize/<?php echo $menutype->slug; ?>">
                            list items
                        </a>
                    </li>
                    <li class="active">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menu-customize/add/<?php echo $menutype->slug; ?>">
                            add items
                        </a>
                    </li>
                </ul>
            <div class="clear"></div>
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
                        <?php echo $form->labelEx($model,'title'); ?>
                        <?php echo $form->textField($model,'title'); ?>
                        <?php echo $form->error($model,'title'); ?>
                    </div>
                    
                    <div class="row">
                        <?php echo $form->labelEx($model,'name'); ?>
                        <?php echo $form->textField($model,'name'); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div>
                    
                    <div class="row">
                        <?php echo $form->labelEx($model,'description'); ?>
                        <?php //echo $form->textArea($model,'description'); ?>
                        <?php echo $form->textArea($model,'description', array('rows'=>15, 'cols'=>75)); ?>
                        <?php echo $form->error($model,'description'); ?>
                    </div>
                    
                    <div class="row">
                        <?php echo $form->labelEx($model,'slug'); ?>
                        <?php echo $form->textField($model,'slug'); ?>
                        <?php echo $form->error($model,'slug'); ?>
                    </div>
                    
                    <!--
                    <div class="row">
                        <?php //echo $form->labelEx($model,'parent_id'); ?>
                        <?php //echo $form->textField($model,'parent_id'); ?>
                        <?php //echo $form->error($model,'parent_id'); ?>
                    </div>
                    -->
                    
                    <div class="row" style="display:none;">
                        <label for="Menu_parent_id">Parent</label>                        
                        <input type="text" id="Menu_parent_id" name="Menu[parent_id]" value="0">                                            
                    </div>
                    
                    <div class="row">
                        <?php echo $form->labelEx($model,'publish'); ?>
                        <?php echo $form->checkBox($model,'publish',array('class'=>'checkbox')); ?>
                        <?php echo $form->error($model,'publish'); ?>
                    </div>
                    
                    <!--
                    <div class="row">
                        <?php //echo $form->labelEx($model,'menu_type_id'); ?>
                        <?php //echo $form->textField($model,'menu_type_id'); ?>
                        <?php //echo $form->error($model,'menu_type_id'); ?>
                    </div>
                    -->
                    
                    <div class="row" style="display:none;">
                        <label for="Menu_menu_type_id">Menu Type Id</label>                        
                        <input type="text" id="Menu_menu_type_id" name="Menu[menu_type_id]" value="<?php echo $menutype->id ?>">                                            
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