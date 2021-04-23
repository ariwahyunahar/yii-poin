
<div id="TabBodContent">
	<div class="inner">
		<?php if($bod){ ?>
		
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

		<?php }else{ ?>
		<div class="row" style="width: 285px;">
			<!-- <img src="/ariwa/np_images/new/poin_say_BOD.jpg"> -->
			<img src="/ariwa/np_images/logomdm_intern.png" width="100%">
			<div style="margin-top: 20px;font-size: 14px;line-height: 20px;">
			<!-- <b><i>"The achievement depends on many things, but mostly on you. Failure is not fatal, success is not final."</i></b> -->
			</div>
		</div>	
		<?php } ?>
	</div>
</div>