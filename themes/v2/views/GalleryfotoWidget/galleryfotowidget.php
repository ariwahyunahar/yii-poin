<div id="GalleryFoto">   
    <div id="GalleryFotoContent">
        <div class="inner">
		
			<?php foreach($ImgPopular as $i): ?>
				<div class="row">
					<?php 
						$c = 0;
						foreach($i->contentImages as $im): 
						$c++;
					?>
						
						<?php if($c == 1): ?>
							<div class="img-row">
								<a class="group1" href="<?php echo Yii::app()->request->baseUrl;?>/gallery/<?php echo $i->slug; ?>">
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/<?php echo $im->filename; ?>" alt="<?php echo $i->title; ?>" />
								</a>
							</div>
						<?php endif; ?>
						
					<?php endforeach; ?>
					<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl;?>/gallery/<?php echo $i->slug; ?>"><?php echo $i->title; ?></a></div>
					<div class="fivestar-row">fivestar</div>
					<div class="clear"></div>
				</div>
			<?php endforeach; ?>
            
            <div class="clear"></div>
            
            
        </div>
    
    
        <div class="more radius">
            <div class="inner">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/gallery"><span>Lihat Semua Gallery Foto &raquo;</span></a>
            </div>
        </div>
    </div>
</div>