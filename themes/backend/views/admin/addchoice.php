<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Polling &raquo; Choice
		</div>			
	</div>
</div>

<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            
            
            <h3><span class="icon">&nbsp;</span> Add Polling Choice</h3>
            
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <div id="tab-menu" class="grid_16">
                <ul>
                    <li class="active"><a href="#">Add</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/polling">List</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <div class="clear"></div>

			<?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'content-form',
                'enableAjaxValidation'=>false,
            )); ?>
            
            <div class="row">
                <?php echo $form->labelEx($model,'choice'); ?>
                <?php echo $form->textField($model,'choice'); ?>
                <?php echo $form->error($model,'choice'); ?>
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($model,'description'); ?>
                <?php //echo $form->textArea($model,'body', array('rows'=>15, 'cols'=>75)); ?>
                <?php //echo CHtml::activeTextArea($model,'body',array('rows'=>10, 'cols'=>70)); ?>
                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                    'model'=>$model,
                    'attribute'=>'description',
                    
                    'config' => array(
                        'toolbar'=>array(
                            array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
                            array( 'Image', 'Link', 'Unlink', 'Anchor' ) ,
                            array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ),
                            array( 'Flash','Table','HorizontalRule','Smiley','SpecialChar','Iframe' ),
                        ),
                    ),
                    
                )); ?>
                <?php echo $form->error($model,'description'); ?>
            </div>
            
            <div class="row" style="display:none;">
                <label class="required" for="PollingChoice_choice">Polling Id</label>    
                <input type="hidden" maxlength="255" id="PollingChoice_choice" name="PollingChoice[polling_id]" value="<?php echo $poll_id; ?>">    
            </div>
            
            <div class="row buttons">
                <input id="SaveButton" class="form-submit" type="submit" value="Create" name="yt0">
            </div>
            
            <?php $this->endWidget(); ?>
			
        </div>
    </div>
</div>