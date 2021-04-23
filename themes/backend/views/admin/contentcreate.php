<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; content create
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            
            
           
            <h3><span class="icon">&nbsp;</span>Create Content</h3>
            
             <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'content-form',
                'enableAjaxValidation'=>false,
            )); ?>
            <div id="content-view-detail" class="grid_11">
                <div class="inner">
                   
						
						<div class="row">
							<?php echo $form->labelEx($model,'title'); ?>
							<?php echo $form->textField($model,'title'); ?>
							<?php echo $form->error($model,'title'); ?>
                        </div>
						
						
						<div class="row">
							<?php echo $form->labelEx($model,'source'); ?>
							<?php echo $form->textField($model,'source'); ?>
							<?php echo $form->error($model,'source'); ?>
                        </div>
						
						<div class="row">
                                <?php echo $form->labelEx($model,'intro'); ?>
                                <?php //echo $form->textArea($model,'intro', array('rows'=>15, 'cols'=>75)); ?>
                                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                                    'model'=>$model,
                                    'attribute'=>'intro',
                                    
                                    'config' => array(
                                        'toolbar'=>array(
                                            array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
											array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ),
                                        ),
                                    ),
                                    
                                )); ?>
                                <?php echo $form->error($model,'intro'); ?>
                        </div>
						
						<div class="row">
                                <?php echo $form->labelEx($model,'body'); ?>
                                <?php //echo $form->textArea($model,'body', array('rows'=>15, 'cols'=>75)); ?>
                                <?php //echo CHtml::activeTextArea($model,'body',array('rows'=>10, 'cols'=>70)); ?>
                                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                                    'model'=>$model,
                                    'attribute'=>'body',
                                    
                                    'config' => array(
                                        'toolbar'=>array(
                                            array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
                                            array( 'Image', 'Link', 'Unlink', 'Anchor' ) ,
											array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ),
											array( 'Flash','Table','HorizontalRule','Smiley','SpecialChar','Iframe' ),
                                        ),
                                    ),
                                    
                                )); ?>
                                <?php echo $form->error($model,'body'); ?>
                        </div>
                       
						<div class="row">
							<?php echo $form->labelEx($model,'create_time'); ?>
							<?php echo $form->textField($model,'create_time',array('size'=>60,'maxlength'=>255, 'class'=>'datepicker', 'readonly'=>'readonly', 'value'=> $datenow)); ?>
							<?php echo $form->error($model,'create_time'); ?>
                        </div>
						
						<div class="row">
							<?php echo $form->labelEx($model,'update_time'); ?>
							<?php echo $form->textField($model,'update_time',array('size'=>60,'maxlength'=>255, 'class'=>'datepicker', 'readonly'=>'readonly', 'value'=> $datenow)); ?>
							<?php echo $form->error($model,'update_time'); ?>
                        </div>
						
						<div class="row">
							<?php echo $form->labelEx($model,'publish'); ?>
							<?php echo $form->checkBox($model,'publish',array('class'=>'checkbox')); ?>
							<?php echo $form->error($model,'publish'); ?>
                        </div>
						
                        <div class="row">
                            <?php echo $form->labelEx($model,'is_popular'); ?>
                            <?php echo $form->checkBox($model,'is_popular',array('class'=>'checkbox')); ?>
                            <?php echo $form->error($model,'is_popular'); ?>
                        </div>
                        
                        <div class="row">
                                <?php echo $form->labelEx($model,'splash'); ?>
                                <?php echo $form->checkBox($model,'splash',array('class'=>'checkbox')); ?>
                                <?php echo $form->error($model,'splash'); ?>
                        </div>
                        
                        <div class="row">
                            <?php echo $form->labelEx($model,'ebook'); ?>
                            <?php echo $form->textField($model,'ebook',array('size'=>60,'maxlength'=>255, 'value'=> '')); ?>
                            <?php echo $form->error($model,'ebook'); ?>
                        </div>
                        
                        <div class="row">
                            <?php echo $form->labelEx($model,'event_start_time'); ?>
                            <?php echo $form->textField($model,'event_start_time',array('size'=>60,'maxlength'=>255, 'class'=>'datepicker', 'value'=> '')); ?>
                            <?php echo $form->error($model,'event_start_time'); ?>
                        </div>
                        
                         <div class="row">
                            <?php echo $form->labelEx($model,'event_end_time'); ?>
                            <?php echo $form->textField($model,'event_end_time',array('size'=>60,'maxlength'=>255, 'class'=>'datepicker', 'value'=> '')); ?>
                            <?php echo $form->error($model,'event_end_time'); ?>
                        </div>
                        
                        <div class="row" style="display:none;">
                            <?php echo $form->labelEx($model,'Hits'); ?>
                            <?php echo $form->textField($model,'hits',array('size'=>60,'maxlength'=>255, 'readonly'=>'readonly', 'value'=> '0', 'hidden'=>'hidden')); ?>
                            <?php echo $form->error($model,'hits'); ?>
                        </div>
                        
						
						
						<div class="row buttons">
                            <input id="SaveButton" class="form-submit" type="submit" value="Save" name="yt0">
                        </div>

                        
                    
                    
                    
                </div>
            </div>
            
            <div id="content-updatetime-detail" class="radius grid_5">
                <div class="inner">
                    <label> Content Type <span>*</span>
                        <select name="Content[content_type_id]" id="Content_content_type_id">
                            <option value="NULL"> - select - </option>
                            <?php foreach( $contentType as $c): ?>
                                <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
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