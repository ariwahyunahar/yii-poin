<div id="perface-top-wrapper" class="perface-top-wrapper">
	<div id="perface-top" class="container_24">
		
		
		<?php $this->beginWidget('InfoWidget', array(
			'title'=>'Latest Info',
		)); ?>
		<?php $this->endWidget(); ?>
		
		
		
		<div class="clear"></div>
		
		
		
		
	</div>
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-left" class="block grid_5">
			<div class="inner">
				
                <?php $this->beginWidget('BannerWidget', array(
					'title'=>'Banner Side',
				)); ?>
				<?php $this->endWidget(); ?>
                
                <?php $this->beginWidget('SpinWidget', array(
					'title'=>'Spin',
				)); ?>
				<?php $this->endWidget(); ?>
				
				<?php $this->beginWidget('DmsWidget', array(
					'title'=>'DMS',
				)); ?>
				<?php $this->endWidget(); ?>
				
				<?php $this->beginWidget('SmartWidget', array(
					'title'=>'Smart',
				)); ?>
				<?php $this->endWidget(); ?>
                
			</div>
		</div>
		
		<div id="postscript-middle" class="grid_11">
			<div class="inner">
			
			<?php if(empty($article)): ?>
				
				<div id="content-detail-readarticle" class="page content-detail" >
					<h2 class="title">Artikel Tidak di Publish</h2>
				</div>
				
			<?php else: ?>
			
				
				<div id="content-detail-readarticle" class="page content-detail" >
				
					
					<h2 class="title"><?php echo $article->title; ?></h2>
					
					<div class="inner">
						
						<?php 
							
							$in = 0;
							foreach($article->contentImages as $i):
							$class = null;
							if ($in++ % 2 == 0) {
							$class = ' class="altrow"';
							}	
							
						?>
							<?php if($in == 1): ?>
							<div class="img-content-detail"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/<?php echo $i->filename; ?>" alt="<?php echo $i->title; ?>" width="400" /></div>
							<?php endif; ?>
						<?php endforeach; ?>
						
						
						<?php echo $article->body; ?>
						
					</div>
					
					<div class="print-row">
						<div class="inner">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/print/<?php echo $article->slug; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/09-email-print-pdf-icon.png" alt="09-email-print-pdf-icon" /></a>
						</div>
					</div>
					
					<!--
					<div class="gallery">
						<div class="inner">
							<div class="content-row">
								<div class="img-row">
								<?php //foreach($article->contentImages as $i): ?>
									
									<a href="<?php //echo Yii::app()->request->baseurl; ?>/gallery/<?php //echo $article->slug;?>">
										<img src="<?php //echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/<?php //echo $i->filename; ?>" alt="<?php //echo $article->title; ?>" />
									</a>
									
								<?php //endforeach; ?>
								</div>
								
								<div class="title">
									Gallery Terkait
								</div>
								
							</div>
						</div>
					</div>
					-->
					
					
				</div>
				<div class="clear"></div>
				
                <?php if(is_numeric(Yii::app()->user->name)): ?>
                
				<div id="form-comment" class="comment">
					<div class="inner">
						
						<form id="comment-form" action="<?php echo Yii::app()->request->baseUrl; ?>/comment/create" method="post">
						
							<div class="title">Berikan komentar</div>
							
                            <!--
							<ul id="like-article">
								<li>
									<a class="auto-gravity" alt="0" title="0" href="#" >
										<div class="like-icon">.</div>
										<div class="like">Like</div>
									</a>
								</li>
								<li>
									<a class="auto-gravity" alt="0" title="0" href="#" >
										<div class="dislike-icon">.</div>
										<div class="dislike"></div>
									</a>
								</li>
							</ul>
							-->
							
							<div class="clear"></div>
							<div class="form-comment">
								<div class="form-row">
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_id" name="Comment[id]" />		
									</div>
									
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_create_time" name="Comment[create_time]" value="<?php echo date('Y').'-'.date('m').'-'.date('d').'&nbsp;'.date('H:i:s'); ?>" />		
									</div>
									
									
									<div class="row comment-row">
										<label><span class="required"></span></label>		
										<textarea id="ComentForm_body" name="Comment[body]" cols="73" rows="6" >isi komentar...</textarea>	
									</div>
									
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_content_id" name="Comment[content_id]" value="<?php echo $article->id; ?>" />		
									</div>
									
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_slug" name="slug" value="<?php echo $article->slug; ?>" />		
									</div>
									
									<div class="row">
										<label></label>		
										<input type="hidden" id="ComentForm_contenType" name="contenType" value="<?php echo $article->contentType->name; ?>" />		
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
								<?php echo count($article->comments); ?>
								<span></span>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					
						
					<?php 
						$i = 0;
						foreach($article->comments as $c): 
						$class = null;
						if ($i++ % 2 == 0) {
						$class = 'altrow';
						}
					?>
                    <?php if($c->publish == 1): ?>
                    	
						
						<div class="content-row <?php echo $class; ?>">
							<div class="inner">
								<div class="row">
									<div class="profile-picture">
										<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/default_profile_l.png" alt="default_profile_l" width="47" height="47" />
									</div>
									<div class="profile-user">
										<span>
                                        
                                        	<?php 
												$criteria = new CDbCriteria;
												$criteria->condition = 'nik ="'.$c->user.'"';
												$UserName = Member::model()->findAll($criteria);
												
												if(!empty($UserName)){
													foreach($UserName as $u):
														echo $u->name;
													endforeach;
												} else {
													echo $c->user ;
												}
											?>
                                            
                                        </span>
									</div>
									<div class="comment">
										<?php echo stripslashes($c->body); ?>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
						
						
					<?php endif; ?>
                    <?php endforeach; ?>
					
				</div>
			
			<?php endif; ?>
			
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
				
			<?php $this->beginWidget('ArticleWidget', array(
				'title'=>'Artikel Transformasi',
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