<div id="header" class="header">
	<?php echo $content->title; ?>
</div>

<div id="torso" class="main">
	<div class="inner">
		
		<?php foreach($content->contentImages as $i): ?>
							
			<!--<div class="img-content-detail"><img src="http://poin.infomedia.co.id<?php //echo Yii::app()->request->baseUrl; ?>/assets/content/<?php //echo $i->filename; ?>" alt="<?php //echo $i->title; ?>" /></div>-->

		<?php endforeach; ?>
		<?php echo $content->body; ?>
		<p>&nbsp;</p>
	</div>
</div>

<div id="footer" class="foot">
	<div style="float:left;">PT Infomedia Nusantara</div>
	<div style="float:right;"><?php echo date('l, d-m-Y'); ?></div>
</div>