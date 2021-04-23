<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; content type edit
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            
            
           
            <h3><?php echo $model->name; ?></h3>
            
            <div id="tab-menu" class="grid_16">
                <ul>
                    <li class="active"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/edit/<?php echo $model->slug; ?>">Edit</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'content-form',
                'enableAjaxValidation'=>false,
            )); ?>
            
            <div id="content-view-detail" class="grid_16">
                <div class="inner">
                   
                    
						 <div class="row">
							<?php echo $form->labelEx($model,'name'); ?>
							<?php echo $form->textField($model,'name'); ?>
							<?php echo $form->error($model,'name'); ?>
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