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
						
						
						<div class="content-row">
						<?php foreach($model as $b): ?>
							<div class="row">
							
								<?php if(!empty($b->contentImages)): ?>
									
									<?php
										$in = 0;
										foreach($b->contentImages as $i):
										$class = null;
										if ($in++ % 2 == 0) {
										$class = ' class="altrow"';
										}				
									?>
									
										<div class="img-row">
											<a href="<?php echo Yii::app()->request->baseUrl; ?>/assets/EBook/<?php echo $b->ebook; ?>" class="iframe">
												<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/<?php echo $i->filename; ?>" alt="<?php echo $b->title; ?>" />
											</a>
										</div>
									
									<?php endforeach; ?>
								
								<?php endif; ?>
								
								<div class="title-row">
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/assets/EBook/<?php echo $b->ebook; ?>" class="iframe">
										<?php echo $b->title; ?>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
						
					</div>
					
				</div>
				<div class="clear"></div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			
			<?php $this->beginWidget('PopularWidget', array(
				'title'=>'News Popular',
			)); ?>
			<?php $this->endWidget(); ?>
			
			
			
			<?php $this->beginWidget('MediaWidget', array(
				'title'=>'title',
			)); ?>
			<?php $this->endWidget(); ?>
			
			
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>
