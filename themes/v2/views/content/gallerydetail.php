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
		<div id="postscript-middle" class="grid_16">
			<div class="inner">
				
				<div id="content-detail-all-<?php echo $idpage; ?>" class="page" >
				
					
					
					<h2 class="title"> <?php echo $title; ?> </h2>
					
					<div class="inner">
						
						<div id="ContentDetailGallery" class="ContentGallery">
							
							<div id="Navigation" class="Navigation">
								<div class="inner">
									<div class="next"><a href="#" id="nextSplashSlide"><span>Next</span></a></div>
									<div class="prev"><a href="#" id="prevSplashSlide"><span>Prev</span></a></div>
									<div class="clear"></div>
								</div>
							</div>
							
							<div id="SlideDetailGallery" class="content">
							
							
							<?php foreach($ImgGallery->contentImages as $i): ?>
								<div class="views-content">
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/<?php echo $i->filename; ?>" alt="<?php echo $i->title; ?>" />
								</div>
								
								
								
							<?php endforeach; ?>

							
							</div>
							<div id="SlideCaption" class="SlideCaption">
								<div class="inner">
									<div class="content-row">
										<div class="title-row">
											<?php echo $ImgGallery->title; ?>
										</div>
										<div class="fivestar-row">
											fivestar
										</div>
										<div class="date-row">
											<?php echo $ImgGallery->update_time.' WIB'; ?>
										</div>
										<div class="comment-row">
											<?php echo 'komentar '.count($ImgGallery->comments); ?>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div>
						
						
					</div>
					
				</div>
				<div class="clear"></div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			
			
			
			
			<div id="tabs" class="block radius shadow">
					<ul>
						<li><a href="#TabBod"><span>BOD</span></a></li>
						<li><a href="#TabKurs"><span>Kurs</span></a></li>
						<li><a href="#TabEvent"><span>Event</span></a></li>
						<li><a href="#TabJadwalShalat"><span>Jadwal Shalat</span></a></li>
					</ul>
                                        
					<div id="TabBod">
						
						<?php $this->beginWidget('BodWidget', array(
								'title'=>'BOD',
						)); ?>
						<?php $this->endWidget(); ?>
								
					</div>
					<div id="TabKurs">
						
						<?php $this->beginWidget('KursWidget', array(
								'title'=>'Kurs',
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