<div id="NewsPopular" class="block">
	<div class="title text-shadow"><div class="inner">Berita Terkini</div></div>
	<div class="inner">

		<?php foreach ($latestnews as $b): ?>
		
			<div class="row">
				<div class="title-row">
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/news/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a>
				</div>
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
				
	<div class="more">
		<div class="inner">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/news"><span>Lihat Semua Berita &raquo;</span></a>
		</div>
	</div>
	
</div>