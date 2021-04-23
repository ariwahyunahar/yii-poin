<div class="ariwa_berita">
	<div class="ariwa_inner_judul">Artikel Transformasi</div>
	<div class="ariwa_berita_isi_img">
	<table width="100%">
		<?php foreach ($article as $b): ?>
			
			
			<tr><td>
				<?php if(!empty($b->contentImages)): ?>
                    
                    	<?php 
                            
                            $in = 0;
                            foreach($b->contentImages as $i):
                            $class = null;
                            if ($in++ % 2 == 0) {
                            $class = ' class="altrow"';
                            }
                            
                        ?>
                            <?php if($in == 1): ?>
                                <div class="image-row"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/<?php echo $i->filename; ?>" title="<?php echo $i->title; ?>" alt="<?php echo $i->title; ?>" /></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
						
                    	<div class="image-row"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/img-thumb-default.png" title="img-thumb-default" alt="img-thumb-default" /></div>
                    
                    <?php endif; ?>
			</td><td>
				<span style="font-size: 10px;color: red;"><?php echo Yii::app()->util->dateInd($b->update_time); ?> | <?php echo count($b->comments).'</span>'; ?><br />
				<a href="<?php echo Yii::app()->request->baseUrl; ?>/news/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a>
			</td></tr>
			
                    
		<?php endforeach; ?>
		</table>
	</div>
	<div class="ariwa_inner_footer">
		<div class="ariwa_inner_footer_a1"><a href="<?php echo Yii::app()->request->baseUrl; ?>/article" class="ariwa_next">Lihat Semua Artikel Transformasi</a></div>
	</div>
</div>