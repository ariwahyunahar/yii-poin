<div id="SplashWidget" class="block splash">
	<div class="inner">

		<div id="slideshow" class="content">
			
			<?php foreach ($imagesplash as $b): ?>
				<?php 
					
					$in = 0;
					foreach($b->contentImages as $i):
					$class = null;
					if ($in++ % 2 == 0) {
					$class = ' class="altrow"';
					}	
					
				?>
					<?php if($in == 1): ?>
						<div class="views-content">
							<div class="img">
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/splash/<?php echo $i->filename; ?>" alt="<?php echo $i->title; ?>" />
							</div>
							<div class="caption">
								<a href="<?php echo Yii::app()->request->baseUrl; ?>/news/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a>
							</div>
						 </div>
					 <?php endif; ?>
				<?php endforeach; ?>
            <?php endforeach; ?>
			
		</div>
	
	</div>
</div>