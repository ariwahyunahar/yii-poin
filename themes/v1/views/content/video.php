<div id="perface-top-wrapper" class="perface-top-wrapper">
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-middle" class="grid_16">
			<div class="inner">
				
				<div id="content-detail-all-<?php echo $idpage; ?>" class="page" >
				
					
					
				<h2 class="title"> <?php echo $title; ?> </h2>
					
				<?php foreach($Video as $v): ?>
				
				<div class="content-row">
					<div class="img-row">
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/video/<?php echo $v->slug; ?>/watch">
						<div class="play"></div>
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/video/<?php echo $v->ImgCover; ?>" alt="<?php echo $v->ImgCover; ?>" />
						</a>
					</div>
					<div class="date-row"><?php echo $v->upload_time.' WIB'; ?></div>
					<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl; ?>/video/<?php echo $v->slug; ?>/watch"><span><?php echo $v->title; ?></span></a></div>
					<div class="fivestar-row">fivestar</div>
					<div class="clear"></div>
				</div>

				<?php endforeach; ?>
				
				</div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			
			
			
			<div id="tabs-gallery" class="block">
				<ul>
					<li><a href="#GalleryFoto"><span>Gallery Foto</span></a></li>
					<li><a href="#GalleryVideo"><span>Gallery Video</span></a></li>
				</ul>
				
					
					
					<?php $this->beginWidget('GalleryfotoWidget', array(
						'title'=>'Gallery Foto',
					)); ?>
					<?php $this->endWidget(); ?>
						
						
					
				
				
				
					
					<?php $this->beginWidget('GalleryvideoWidget', array(
						'title'=>'Gallery Video',
					)); ?>
					<?php $this->endWidget(); ?>
					
					
					
				
			</div>
			
	
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>