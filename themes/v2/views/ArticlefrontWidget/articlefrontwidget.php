<div id="Article" class="block" >
	
	<div class="title text-shadow">
	
		<div class="inner">
			
			
			<div style="float: left;">
				<?php echo $title; ?>
			</div>
			
			
			<div style="float: right;">
				<a href="<?php echo Yii::app()->request->baseurl; ?>/article">Lihat Semua Artikel &raquo;</a>
			</div>
			
			<div class="clear"></div>
			
		</div>
	
	</div>
	
	<div class="inner">
						
						
		<?php 
			$n = 0;
			foreach($article as $b): 
			$class = null;
			if ($n++ % 2 == 0) {
			$class = ' class="altrow"';
			}
		?>
			
			
			
			
			
			<?php if($n == 1): ?>
			
				<div class="first-row">
					
					
					<?php
						$in = 0;
						foreach($b->contentImages as $i):
						$class = null;
						if ($in++ % 2 == 0) {
						$class = ' class="altrow"';
						}				
					?>
						
						<?php if($in == 1): ?>
							
							<div class="image-row">
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumbfront/<?php echo $i->filename; ?>" alt="colaboration" />
							</div>
							
						<?php endif; ?>
						
					<?php endforeach; ?>
					
					<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl; ?>/article/<?php echo $b->slug; ?>"><span><?php echo $b->title; ?></span></a></div>
					<div class="date-row">
						
						<?php echo Yii::app()->util->dateInd($b->update_time); ?>
						
					</div>
					<div class="comment-row">
						<?php echo '<span>'.count($b->comments).'</span>'; ?>
					</div>
					<div class="clear"></div>
					<div class="intro-row"><?php echo $b->intro; ?></div>
				
				</div>
			
			<?php else: ?>
				
				
				
				<div class="row">
					<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl; ?>/article/<?php echo $b->slug; ?>"><span><?php echo $b->title; ?></span></a></div>
					<div class="date-row">
                        
                        <?php echo Yii::app()->util->dateInd($b->update_time); ?>
						
					</div>
					<div class="comment-row">
						<?php echo '<span>'.count($b->comments).'</span>'; ?>
					</div>
					<div class="clear"></div>
					<div class="intro-row"><?php echo $b->intro; ?></div>
				</div>
				
			
			<?php endif; ?>

		<?php endforeach; ?>
		
		<div class="clear"></div>
		
	</div>
	<div class="clear"></div>
</div>