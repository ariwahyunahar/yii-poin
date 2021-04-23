<div id="NewsPopular" class="block">
	<div class="title text-shadow"><div class="inner"><?php echo $title; ?></div></div>
	<div class="inner">
        
		<?php foreach ($popularnews as $b): ?>
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
						<?php if($in == 1): ?>
							<div class="image-row"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/<?php echo $i->filename; ?>" title="<?php echo $i->title; ?>" alt="<?php echo $i->title; ?>" width="87" height="64" /></div>
						<?php endif; ?>
					<?php endforeach; ?>

				
				<?php else: ?>
				
					<div class="image-row"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/img-thumb-default.png" title="img-thumb-default" alt="img-thumb-default" width="87" height="64" /></div>
				
				<?php endif; ?>
				
					<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl; ?>/news/newspopular/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a></div>
					<div class="date-row">
						<?php echo Yii::app()->util->dateInd($b->update_time); ?>
					</div>
					 <div class="comment-row">
						<?php echo '<span>'.count($b->comments).'</span>'; ?>
					</div>
					<div class="clear"></div>
				</div>
		<?php endforeach; ?>
		
		
	</div>
				
	<div class="more radius">
		<div class="inner">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/newspopular"><span>Lihat Semua Berita Populer &raquo;</span></a>
		</div>
	</div>
	
</div>