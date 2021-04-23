<?php if($sites->bannertop == 1): ?>

<div id="BannerSeason" class="BannerSeason grid_24">
	<div class="inner">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/<?php echo $themes->bannertop; ?>" alt="<?php echo $themes->bannertop; ?>" />
	</div>
</div>

<?php endif; ?>