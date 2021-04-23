
<div id="TabBodContent">
	<div class="inner">
		
		<?php foreach($bod as $b): ?>
		<div class="row">
			
			<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl; ?>/bod"><span><?php echo $b->title; ?></span></a></div>
			
			<?php foreach($b->contentImages as $i): ?>
				<div class="img-row"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/<?php echo $i->filename; ?>" alt="<?php echo $i->title; ?>" /></div>
			<?php endforeach; ?>
			
			
			<div class="intro-row"><?php echo $b->intro; ?></div>
		</div>	
		<?php endforeach; ?>
		
		<div class="more">
			<div class="inner">
				<a href="<?php echo Yii::app()->request->baseUrl; ?>/bod"><span>Selengkapnya &raquo;</span></a>
			</div>
		</div>

		
	</div>
</div>