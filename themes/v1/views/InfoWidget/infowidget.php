<div id="NewsFlash" class="NewsFlash grid_24 radius">
	<div class="inner">
		<div id="title" class="title">
			<div class="inner">
				<span><?php echo getDay(date('N')).", ".date('d M Y') ?></span>
			</div>
		</div>
		<div id="bgimg"><img src="/images/berita_icon.png"></div>
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
			</div>
		</div>
	</div>
    <div class="clear"></div>
</div>

<?php
function getDay($day_num = 0){
	switch ($day_num) {
		case 1:
			return "Senin";
			break;
		case 2:
			return "Selasa";
			break;
		case 3:
			return "Rabu";
			break;
		case 4:
			return "Kamis";
			break;
		case 5:
			return "Jumat";
			break;
		case 6:
			return "Sabtu";
			break;
		case 7:
			return "Minggu";
			break;
		
		default:
			return "Libur";
			break;
	}
}
?>