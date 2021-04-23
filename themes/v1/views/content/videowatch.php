<div id="perface-top-wrapper" class="perface-top-wrapper">
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-middle" class="grid_16">
			<div class="inner">
				
				<div id="content-detail-all-<?php echo $idpage; ?>" class="page" >
				
					
					
					<h2 class="title"> <?php echo $WatchVideo->title; ?> </h2>
					
					<div class="inner">
						
						<div id="ContentDetailGallery" class="ContentGallery">
							
							
							
							<div id="WatchVideo" class="WatchVideo">
								<div class="inner">
									
                                    <!-- START OF THE PLAYER EMBEDDING TO COPY-PASTE -->
                                    <div id="container">Loading the player ...</div> 
                                    
                                    <script type="text/javascript" src="<?php echo Yii::app()->theme->getBaseUrl(); ?>/js/jwplayer.js"></script>
                                    <script type="text/javascript"> 
                                        jwplayer("container").setup({ 
                                            flashplayer: "<?php echo Yii::app()->request->baseUrl; ?>/assets/video/player.swf", 
                                            /*file: "<?php echo Yii::app()->request->baseUrl; ?>/assets/video/<?php //echo $watch->filename; ?>",*/ 
                                            /*file: "<?php echo Yii::app()->request->baseUrl; ?>/assets/video/Video-Senyumku-Rima-Melati.mp4",*/
                                            file: "<?php echo Yii::app()->request->baseUrl; ?>/assets/video/<?php echo $WatchVideo->file; ?>",
                                            height: 430, 
                                            width: 600, 
                                            skin: "<?php echo Yii::app()->request->baseUrl; ?>/assets/video/newtubedark.zip" 
                                        }); 
                                    </script> 
                                    
                                    
                                    <!-- END OF THE PLAYER EMBEDDING -->
									
								</div>
							</div>
                            
                            <div id="DesciptionVideo" class="WatchVideo">
                            	<div class="inner">
                                	<?php echo $WatchVideo->description; ?>
                                </div>
                            </div>
                            
						</div>
						
						
					</div>
					
				</div>
				<div class="clear"></div>
                
                <?php if(is_numeric(Yii::app()->user->name)): ?>
                
				<div id="form-comment" class="comment">
					<div class="inner">
						
						<form id="comment-form" action="<?php echo Yii::app()->request->baseUrl; ?>/comment/create" method="post">
						
							<div class="title">Berikan komentar</div>
							
							<div class="clear"></div>
							<div class="form-comment">
								<div class="form-row">
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_id" name="Comment[id]" />		
									</div>
									
									<div class="row comment-row">
										<label><span class="required"></span></label>		
										<textarea id="ComentForm_body" name="Comment[body]" cols="73" rows="6" >isi komentar...</textarea>	
									</div>
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_video_id" name="Comment[video_id]" value="<?php echo $WatchVideo->id; ?>" />		
									</div>
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_contenType" name="contenType" value="video" />		
									</div>
									
									
									<div class="row submit-row">
										<input type="submit" value="Posting" name="yt0" id="SubmitComment" class="radius" />
									</div>
								</div>
							</div>
						</form>
							
					</div>
				</div>
                
                <?php endif; ?>
				
				<div class="clear"></div>
				
				<div id="post-comment" class="post-comment">
					<div class="title">
						<div class="inner">
							<div style="float: left;">Komentar</div>
							<div style="float: right; color:#cc0000; font-size:0.8em;">
								<?php //echo count($WatchVideo->comments); ?>
								<span></span>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					
					<?php foreach($Comments as $cm): ?>
					<div class="content-row altrow">
						<div class="inner">
							<div class="row">
								<div class="profile-picture">
									<img width="47" height="47" alt="default_profile_l" src="/assets/img/default_profile_l.png">
								</div>
								<div class="profile-user">
									<span><?php echo $UsrComment; ?></span>
								</div>
								<div class="comment"><?php echo $cm->body; ?></div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
					
				</div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			<div id="tabs-gallery" class="block">
				<ul>
					<li><a href="#GalleryFoto"><span>Gallery Foto</span></a></li>
					<li><a href="#GalleryVideo"><span>Gallery Video</span></a></li>
				</ul>
				
					
					
					<?php $this->beginWidget('GalleryfotoWidget', array(
						'title'=>'Gallery Foto',
					)); ?>
					<?php $this->endWidget(); ?>
						
						
					
				
				
				
					
					<?php $this->beginWidget('GalleryvideoWidget', array(
						'title'=>'Gallery Video',
					)); ?>
					<?php $this->endWidget(); ?>
					
					
					
				
			</div>
			
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>