<div id="NewsFlash" class="NewsFlash grid_24 radius">
	<div class="inner">
		<div id="title" class="title">
			<div class="inner">
				<span>Info Terkini :</span>
			</div>
		</div>
		<div id="content-row" class="content">
			<div class="inner">



				<?php foreach ($latestinfo as $b): ?>	

					<div class="row"> 
						<?php if(!Yii::app()->user->isGuest): ?>
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/news/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a>
						<?php else: ?>
							<?php echo $b->title; ?>
						<?php endif; ?>
					</div>
					
				<?php endforeach; ?>
				
			</div>
							
		</div>
		<div id="NewsFlashNavigation" class="NewsFlashNavigation">
			<div class="inner">
				<ul>
					<li><a id="prevNewsFlash" href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/prev.png" alt="prev" /></a></li>
					<li><a id="pauseNewsFlash" href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/pause.png" alt="pause" /></a></li>
					<li><a id="nextNewsFlash" href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/next.png" alt="next" /></a></li>
				</ul>
			</div>
		</div>
	</div>
    <div class="clear"></div>
</div>