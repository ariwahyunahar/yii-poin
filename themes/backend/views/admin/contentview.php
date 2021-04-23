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
                    <li class="active"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/<?php echo $content->slug; ?>">View</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/edit/<?php echo $content->slug; ?>">Edit</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/video/<?php echo $content->slug; ?>">Video</a></li>
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
                   
					<?php if(!empty($content->contentImages)): ?>
                    <fieldset>
                        <legend>Image</legend>
                        <?php foreach($content->contentImages as $c): ?>
							<div class="img-row">
								<div class="img">
									<img src="<?php echo Yii::app()->request->baseurl; ?>/assets/content/<?php echo $c->filename; ?>" alt="<?php echo $c->title; ?>" />
								</div>
								<div class="actionImg">
									<a class="auto-gravity" title="delete" onclick="return confirm('Are you sure you wish to delete this image <?php echo $c->filename; ?> ?');" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/contentdeleteimg?id=<?php echo $c->id; ?>"><span>delete</span></a>
								</div>
								<div class="clear"></div>
							</div>
						<?php endforeach; ?>
                    </fieldset>
                    <?php endif; ?>
                    
					<?php if(!empty($content->source)): ?>
                    <fieldset>
                        <legend>Source</legend>
                        <?php echo $content->source; ?>
                    </fieldset>
                    <?php endif; ?>
                    
					
					<fieldset>
                        <legend>Intro</legend>
                        <?php echo $content->intro; ?>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Body</legend>
                        <?php echo $content->body; ?>
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
					<?php echo CHtml::form( Yii::app()->request->baseUrl.'/admin/contentupdateimg','post',array('enctype'=>'multipart/form-data')); ?>
						
						<div class="row">
                                <label>Image Thumb</label>
								<input type="file" id="ImgFile" class="input-form" name="ContentImage[filename]" />
								Maximum file size: 2 MB<br />
								Allowed extensions: png gif jpg jpeg

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