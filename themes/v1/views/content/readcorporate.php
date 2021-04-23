<div id="perface-top-wrapper" class="perface-top-wrapper">
	
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
		
		<div id="postscript-middle" class="grid_11">
			<div class="inner">
			
			<?php if(empty($corporate)): ?>
				
				<div id="content-detail-readarticle" class="page content-detail" >
					<h2 class="title">Artikel Tidak di Publish</h2>
				</div>
				
			<?php else: ?>
			
				
				<div id="content-detail-readarticle" class="page content-detail" >
				
					
					<h2 class="title"><?php echo $corporate->title; ?></h2>
					
					<div class="inner">
						
						<?php echo $corporate->body; ?>
						
					</div>
					
				</div>
			
			<?php endif; ?>
			
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
				
			<?php $this->beginWidget('ArticleWidget', array(
				'title'=>'Artikel Transformasi',
			)); ?>
			<?php $this->endWidget(); ?>
			
			<?php $this->beginWidget('NewsWidget', array(
				'title'=>'News',
			)); ?>
			<?php $this->endWidget(); ?>
					
					
			
		</div>
	
	</div>
	
	
</div>
<div class="clear"></div>