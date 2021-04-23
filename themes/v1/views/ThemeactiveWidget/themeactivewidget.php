<div class="">
    <div class="slider-wrapper theme-default">
        <div id="SlideLogOn" class="nivoSlider">
			<?php foreach($splash_login->contentImages as $b): ?>
				<img height="340px;" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/SlideLogin/<?php echo $b->filename; ?>" class="radius" alt="<?php echo $b->filename; ?>"/>
			<?php endforeach; ?>	
        </div>
    </div>
</div>