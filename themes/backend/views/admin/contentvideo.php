<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; content
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            
            
           
            <h3><?php echo $content->title; ?></h3>
            
            <div id="tab-menu" class="grid_16">
                <ul>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/<?php echo $content->slug; ?>">View</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/edit/<?php echo $content->slug; ?>">Edit</a></li>
                    <li class="active"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/video/<?php echo $content->slug; ?>">Video</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <div id="content-view-detail" class="grid_11">
                <div class="inner">
                    
                    <?php
                        foreach(Yii::app()->user->getFlashes() as $key => $message) {
                                echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
                        }
                    ?>
                   
					
                    <fieldset>
                        <legend>Video</legend>
						<?php $i=0; foreach($content->contentVideos as $v): $i++; ?>
							<h3><?php echo $v->title; ?></h3>
							<!-- START OF THE PLAYER EMBEDDING TO COPY-PASTE -->
							<div id="container-<?php echo $i; ?>">Loading the player ...</div> 
							
							<script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>js/jwplayer.js"></script>
							<script type="text/javascript"> 
								jwplayer("container-<?php echo $i; ?>").setup({ 
									flashplayer: "<?php echo Yii::app()->request->baseUrl; ?>/assets/video/player.swf", 
									file: "<?php echo Yii::app()->request->baseUrl; ?>/assets/video/<?php echo $v->file; ?>",
									height: 430, 
									width: 600, 
									skin: "<?php echo Yii::app()->request->baseUrl; ?>/assets/video/newtubedark.zip" 
								}); 
							</script> 
							<!-- END OF THE PLAYER EMBEDDING -->
							<br/>
						<?php endforeach; ?>
                    </fieldset>
                </div>
            </div>
            
            <div id="content-updatetime-detail" class="radius grid_5">
                <div class="inner">    
                    
                    <p>Posted by <a href="#">Admin</a><br />
                    <?php echo $content->update_time; ?></p>
                   
                </div>
            </div>
			
			<div id="content-update-img" class="radius grid_5">
				<div class="inner">
					<?php echo CHtml::form( Yii::app()->request->baseUrl.'/admin/contentvideo','post',array('enctype'=>'multipart/form-data')); ?>
						
						<div class="row">
                                <label>Upload Video</label>
								<input type="file" id="ImgFile" class="input-form" name="ContentImage[filename]" /><br />
								Maximum file size: 15 MB<br />
								Allowed extensions: flv mp4

                        </div>
						
						<div class="row">
                                <input type="hidden" id="ContentId" class="input-form" name="ContentImage[content_id1]" value="<?php echo $content->id; ?>" />
                        </div>
						
						<div class="row buttons">
                                <input id="SaveButton" class="form-submit" type="submit" value="Upload" name="yt0" />
                        </div>
						
					<?php echo CHtml::endForm(); ?>
				</div>
			</div>
            
            
        </div>
    </div>
</div>
<div class="clear"></div>