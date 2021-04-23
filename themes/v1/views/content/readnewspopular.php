<div id="perface-top-wrapper" class="perface-top-wrapper">
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-left" class="block grid_5">
			<div class="inner">
				<?php 
				$this->beginWidget('BannerWidget', array(
					'title'=>'Banner Side',
				));  $this->endWidget(); 
				?>
			</div>
		</div>
		
		<div id="postscript-middle" class="grid_11">
			<div class="inner">
				
				<div id="content-detail-newspopular" class="page content-detail" >
					
					<h2 class="title"><?php echo $news->title; ?></h2>
					
					<div class="inner">
					
						<?php if(empty($news->contentImages)): ?>
						
							<div class="img-content-detail">
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/default-img.jpg" alt="default-img" />
							</div>
						
						<?php else: ?>
							<?php foreach($news->contentImages as $i): ?>
							
								<div class="img-content-detail">
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/<?php echo $i->filename; ?>" alt="<?php echo $i->title; ?>" />
								</div>
							
							<?php endforeach; ?>
						<?php endif; ?>
						
							
						
						
						<?php echo $news->body; ?>
						
					</div>
                                        
                                        <div class="print-row">
						<div class="inner">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/print/<?php echo $news->slug; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/09-email-print-pdf-icon.png" alt="09-email-print-pdf-icon" /></a>
						</div>
					</div>
					
				</div>
				<div class="clear"></div>
				
				<div id="form-comment" class="comment">
					<div class="inner">
						
						<form id="comment-form" action="<?php echo Yii::app()->request->baseUrl; ?>/comment/create" method="post">
						
							<div class="title">Berikan komentar</div>
							
							<ul id="like-article">
								<li>
									<a id="" class="auto-gravity" alt="0" title="0" href="#" >
										<div class="like-icon">.</div>
										<div class="like">Like</div>
									</a>
								</li>
								<li>
									<a id="" class="auto-gravity" alt="0" title="0" href="#" >
										<div class="dislike-icon">.</div>
										<div class="dislike"></div>
									</a>
								</li>
							</ul>
							
							
							<div class="clear"></div>
							<div class="form-comment">
								<div class="form-row">
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_id" name="Comment[id]" value="">		
									</div>
									
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_create_time" name="Comment[create_time]" value="<?php echo date('Y').'-'.date('m').'-'.date('d').'&nbsp;'.date('H:i:s'); ?>">		
									</div>
									
									
									<div class="row comment-row">
										<label><span class="required"></span></label>		
										<textarea id="ComentForm_body" name="Comment[body]" cols="73" rows="6" >isi komentar...</textarea>	
									</div>
									
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_content_id" name="Comment[content_id]" value="<?php echo $news->id; ?>">		
									</div>
									
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_slug" name="slug" value="<?php echo $news->slug; ?>">		
									</div>
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_contenType" name="contenType" value="<?php echo $news->contentType->name; ?>">		
									</div>
									
									
									<div class="row submit-row">
										<input type="submit" value="Posting" name="yt0" id="post-comment" class="post-comment radius">
									</div>
								</div>
							</div>
						</form>
							
					</div>
				</div>
				
				<div class="clear"></div>
				
				<div id="post-comment" class="post-comment">
					<div class="title">
						<div class="inner">
							<div style="float: left;">Komentar</div>
							<div style="float: right; color:#cc0000; font-size:0.8em;">
								<?php
									$i=0;
									foreach($news->comments as $c):
									if ($i++) {
									}
									//var_dump($i); 
									//$result = count($i);
								?>
									
								<?php endforeach; ?>
								<?php  
									//echo $result;
								?>
								<span></span>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					
						
					<?php 
						$i = 0;
						foreach($news->comments as $c): 
						$class = null;
						if ($i++ % 2 == 0) {
						$class = 'altrow';
						}
					?>
						
						<div class="content-row <?php echo $class; ?>">
							<div class="inner">
								<div class="row">
									<div class="profile-picture">
										<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/default_profile_l.png" alt="default_profile_l" width="47" height="47" />
									</div>
									<div class="profile-user">
										<span><?php echo $c->user; ?></span>
									</div>
									<div class="comment">
										<?php echo stripslashes($c->body); ?>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
						
						
					<?php endforeach; ?>
					
						
					
					
						
						
				</div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
				
			<?php $this->beginWidget('PopularWidget', array(
				'title'=>'Popular News',
			)); ?>
			<?php $this->endWidget(); ?>
			
			<?php $this->beginWidget('NewsWidget', array(
				'title'=>'News',
			)); ?>
			<?php $this->endWidget(); ?>
					
					
			
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>