<div id="GalleryFoto">   
    <div id="GalleryFotoContent">
        <div class="inner">

        <?php foreach($ImgPopular as $i): ?>
        
        	<div class="row">

				<div class="img-row">
					<a class="group1" href="<?php echo Yii::app()->request->baseUrl;?>/gallery/<?php echo $i->contentId1->slug; ?>">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/<?php echo $i->filename; ?>" alt="<?php echo $i->contentId1->title; ?>" />
					</a>
				</div>
        		<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl;?>/gallery/<?php echo $i->contentId1->slug; ?>"><?php echo $i->contentId1->title; ?></a></div>
				<div class="fivestar-row">fivestar</div>
				<div class="clear"></div>

        	</div>

        <?php endforeach; ?>

       	</div>


       	<div class="more radius">
            <div class="inner">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/gallery"><span>Lihat Semua Gallery Foto &raquo;</span></a>
            </div>
        </div>

    </div>
</div>