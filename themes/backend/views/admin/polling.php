<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Polling
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            
            <h3><span class="icon">&nbsp;</span> Polling</h3>
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <div id="tabs">
                <ul>
                    <li><a href="#fragment-1"><span>Polling</span></a></li>
                    <li><a href="#fragment-2"><span>Detail Polling</span></a></li>
                    <li><a href="#fragment-3"><span>Add Polling</span></a></li>
                </ul>
                <div id="fragment-1">
                <table id="listing-content" class="admin-content listing radius" cellspacing="0" cellpadding="0">
                    <tr class="title">
                        <th>No.</th>
                        <th>subject</th>
                        <th>Description</th>
                        <th>Active</th>
                        <th>Operation</th>
                    </tr>
                    
                    <?php
                        $i = 0; 
                        foreach($polling as $b):
                        $class = null;
                        if ($i++ % 2 == 1) {
                        $class = 'altrow';
                        } 
                    ?>
                    <tr class="content <?php echo $class; ?>">
                        <td><?php echo $i; ?>.</td>
                        <td><a href="#"><?php echo $b->title; ?></a></td>
                        <td>&nbsp;</td>
                        <td>
							<?php 
								if($b->active  == 1): 
									echo 'activate'; 
								else: 
									echo '<a title="change to active" href="'.Yii::app()->request->baseUrl.'/admin/polling/activate/'.$b->id.'/true">deactivate</a>'; 
								endif; 
							?>
                        </td>
                        <td>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/polling/edit/<?php echo $b->id; ?>">Edit</a> 
                            &nbsp; 
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/delete/polling/<?php echo $b->id; ?>" onclick="return confirm('Are you sure you wish to delete this subject polling ?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                </table>

                </div>
                
                <div id="fragment-2">
                	<?php 
						foreach($polling as $b):
							if($b->active == 1): 
					?>
                    	<h5><?php echo $b->title; ?></h5>
                        
                        
                        <div class="grid_16" id="tab-menu">
                            <ul>
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/polling/choice/add/<?php echo $b->id; ?>">Add</a></li>
                                <li class="active"><a href="#">List</a></li>
                            </ul>
                            <div class="clear"></div>
                        </div>
                        
                        <script type="text/javascript">var baseUrl = "http://poin.infomedia.co.id/";var controller = "admin";</script>
                    	<table id="listing-content" class="admin-content listing radius" cellspacing="0" cellpadding="0">
                            <tr class="title">
                                <th>No.</th>
                                <th>Choice Questions</th>
                                <th style="text-align:center;">Result Vote</th>
                                <th style="text-align:center;">Operation</th>
                            </tr>
                        
                        <?php 
							$i = 0;
							foreach($b->pollingChoices as $p): 
							$i++;
							
							$criteria = new CDbCriteria;
							$criteria->condition = 'polling_choice_id ='.$p->id;
							$ResultChoice = MemberVote::model()->findAll($criteria);
							$ResultChoice = count($ResultChoice);
							
							$average1 = $ResultChoice / $ResultVote;
							$average =  $average1 * '100';
						?> 
                        
                        	<tr>
                            	<td><?php echo $i; ?></td>
                                <td><div id="<?php echo $p->id; ?>" class="editable" title="Double-click to edit."><?php echo $p->choice; ?></div></td>
                                <td style="text-align:center;"><?php echo $average.'% ('. $ResultChoice; ?> votes)</td>
                                <td style="text-align:center;">
                                <a title="delete" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/deletechoice/<?php echo $p->id; ?>" onclick="return confirm('Are you sure delete this choice ?')"><i class="icon-remove"></i></a>                                
                                </td>
                            </tr>
                        
                        <?php endforeach; ?>   
                        
                        	<tr bgcolor="#D3DEEA" style="color:#FFFFFF;">
                            	<td colspan="2"><strong>Total Vote</strong></td>
                                <td style="text-align:center;"><strong>100% (<?php echo $ResultVote; ?> votes)</strong></td>
                                <td>&nbsp;</td>
                            </tr>
                            
                         </table>
                    
                  <?php 
							endif;
						endforeach; 
					?>
                    
                </div>
                
                <div id="fragment-3">
                
					<?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'content-form',
                        'enableAjaxValidation'=>false,
                    )); ?>
                    
                    <div class="row">
						<?php echo $form->labelEx($model,'Subject'); ?>
                        <?php echo $form->textField($model,'title'); ?>
                        <?php echo $form->error($model,'title'); ?>
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
                    
                    <div class="row buttons">
                        <input id="SaveButton" class="form-submit" type="submit" value="Create" name="yt0">
                    </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
               
            </div>
            
            
        </div>
    </div>
</div>
<div class="clear"></div>