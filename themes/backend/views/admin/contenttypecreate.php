<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; content type create
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            
            
           
            <h3><span class="icon">&nbsp;</span>Create Content Type</h3>
            
            
            
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'content-form',
                'enableAjaxValidation'=>true,
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