<div id="NewsUpdateFront" class="block ">
		<div class="inner">

		<div class="title">Berita Terkini</div>
		<div id="NewsUpdateFrontContent">
        
                    
			
			<?php foreach ($latestnews as $b): ?>
					<div class="row">
						<div class="date-row">
                        	<?php echo Yii::app()->util->dateInd($b->update_time); ?>
                                                    
                                                    
                        </div>
                        <div class="comment-row">
                            <?php echo '<span>'.count($b->comments).'</span>'; ?>
                        </div>
                        <div class="clear"></div>
						<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl; ?>/news/<?php echo $b->slug; ?>"><span><?php echo $b->title; ?></span></a></div>
					</div>
			<?php endforeach; ?>
			
		</div>
		<div class="more radius">
			<div class="inner">
				<a href="<?php echo Yii::app()->request->baseUrl; ?>/news"><span>Lihat Semua Berita &raquo;</span></a>
			</div>
		</div>
		
	</div>
</div>