<div id="perface-top-wrapper" class="perface-top-wrapper">
	<div id="perface-top" class="container_24">
		
		
		<?php $this->beginWidget('InfoWidget', array(
			'title'=>'Latest Info',
		)); ?>
		<?php $this->endWidget(); ?>
		
		
		
		<div class="clear"></div>
		
		
		
		
	</div>
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-left" class="block grid_5">
			<div class="inner">
				<?php $this->beginWidget('BannerWidget', array(
					'title'=>'Banner Side',
				)); ?>
				<?php $this->endWidget(); ?>
			</div>
		</div>
		
		<div id="postscript-middle" class="grid_19">
			<div class="inner">
				
				<div id="content-detail-<?php echo $idpage; ?>" class="page content-detail" >
					
					<h2 class="title"><?php echo $title; ?></h2>
					
					<div class="inner">
					
						<?php foreach($result  as $r): ?>
							
							<?php foreach($r->contentImages as $i): ?>
								<div style="float: left; margin-right: 10px;"><img src="<?php echo Yii::app()->request->baseurl; ?>/assets/content/<?php echo $i->filename; ?>" alt="<?php echo $i->title; ?>" /></div>
							<?php endforeach; ?>
							
							<?php echo $r->body; ?>
							
						<?php endforeach;?>
					
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>