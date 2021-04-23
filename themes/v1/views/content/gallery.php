<div id="perface-top-wrapper" class="perface-top-wrapper">
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-middle" class="grid_16">
			<div class="inner">
				
				<div id="content-detail-all-<?php echo $idpage; ?>" class="page" >
				
					
					
					<h2 class="title"> <?php echo $title; ?> </h2>
					
					<div class="inner">
						<div id="ContentGallery" class="ContentGallery">
							<div id="SlideGallery" class="content">
							
								<?php  foreach($ImageGallery as $i):  ?>
								
									<?php 
						
										$in = 0;
										foreach($i->contentImages as $p):
										$class = null;
										if ($in++ % 2 == 0) {
										$class = ' class="altrow"';
										}	
										
									?>
										<?php if($in == 1): ?>
											<div class="views-content">
												<div class="img">
													<?php echo '<img src="'.Yii::app()->request->baseUrl.'/assets/content/gallery/'.$p->filename.'" alt="" />'; ?>
												</div>
												<div class="comment">
													<?php echo $i->update_time; ?>
												</div>
												<div class="caption">
													<div class="date">
														<?php echo $i->update_time; ?>
													</div>
													<div class="title">
														<a href="<?php echo Yii::app()->request->baseUrl; ?>/gallery/<?php echo $i->slug; ?>"><?php echo $i->title; ?></a>
													</div>
													<div class="comment">
														<?php echo 'Komentar '.count($i->comments); ?>
													</div>
													<div class="fivestar">
														<?php echo 'Five Star'; ?>
													</div>

												</div>
											</div>
										 <?php endif; ?>
									<?php endforeach; ?>
								
								<?php endforeach; ?>

							
							</div>
							
						</div>	
					</div>
					
				</div>
				<div class="clear"></div>
				
				
				<div id="hightlights" class="hightlights page">
					<h2 class="title">Foto Berita Popular</h2>
					<div class="inner">
						<?php foreach($ImgPopular as $i): ?>
							<?php foreach($i->contentImages as $b): ?>
								<div class="content-row">
									<div class="date-row"><?php echo $i->update_time.' WIB'; ?></div>
									<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl; ?>/gallery/<?php echo $i->slug; ?>"><span><?php echo $i->title; ?></span></a></div>
									<div class="fivestar-row">fivestar</div>
									<div class="img-row"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/<?php echo $b->filename; ?>" alt="<?php echo $b->title; ?>" /></div>
									<div class="comment-row"><?php echo 'komentar '.count($i->comments); ?></div>
									<div class="clear"></div>
								</div>
							<?php endforeach; ?>
						<?php endforeach; ?>
						<div class="clear"></div>
					</div>
				</div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			
			
			
			
			<div id="tabs" class="block radius shadow">
					<ul>
						<li><a href="#TabBod"><span>BOD</span></a></li>
						<li><a href="#TabEvent"><span>Event</span></a></li>
						<li><a href="#TabJadwalShalat"><span>Jadwal Shalat</span></a></li>
					</ul>
                                        
					<div id="TabBod">
						
						<?php $this->beginWidget('BodWidget', array(
								'title'=>'BOD',
						)); ?>
						<?php $this->endWidget(); ?>
								
					</div>
                    
					<div id="TabEvent">
					
						<?php $this->beginWidget('EventWidget', array(
							'title'=>'Event',
						)); ?>
						<?php $this->endWidget(); ?>
						
					</div>
                    
					<div id="TabJadwalShalat">
						
						<?php $this->beginWidget('JadwalshalatWidget', array(
							'title'=>'Jadwal Shalat',
						)); ?>
						<?php $this->endWidget(); ?>
						
					</div>
				</div>
			
			
	
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>