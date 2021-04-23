<div id="GalleryVideo">    
    <div id="GalleryVideoContent">
        <div class="inner">
                
		   <?php foreach($videos as $b): ?>
           
           <div class="row">
                <div class="img-row"><a href="<?php echo Yii::app()->request->baseUrl; ?>/video/<?php echo $b->slug; ?>/watch"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/video/thumb-widget/<?php echo $b->ImgCover; ?>" alt="<?php echo $b->ImgCover; ?>" /></a></div>
                <div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl;?>/video/<?php echo $b->slug; ?>/watch"><?php echo $b->title; ?></a></div>
                <div class="fivestar-row">fivestar</div>
                <div class="clear"></div>
           </div>
           
		   <?php endforeach; ?>
                
        <div class="clear"></div>  
        </div>
        
        <div class="more radius">
            <div class="inner">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/video"><span>Lihat Semua Video &raquo;</span></a>
            </div>
        </div>
    </div>
</div>