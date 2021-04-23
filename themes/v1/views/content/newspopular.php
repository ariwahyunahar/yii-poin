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
				
				<div id="content-detail-all-newspopular" class="page" >
					
					<h2 class="title"> Index Berita Populer </h2>
					
					<div class="inner">
						
						<?php
							$bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
							$m = array('/01/','/02/','/03/','/04/','/05/','/06/','/07/','/08/','/09/','/10/','/11/','/12/');
						?>
						
						<?php foreach($model as $b): ?>
						
							<div class="row">
                            	
                                <?php if(empty($b->contentImages)): ?>
							
								<div class="image-row">
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/img-thumb-default.png" title="default-img" alt="default-img" />
								</div>
								
							<?php else: ?>
							
								<?php
									$in = 0;
									foreach($b->contentImages as $i):
									$class = null;
									if ($in++ % 2 == 0) {
									$class = ' class="altrow"';
									}				
								?>
									
									<?php if($in == 1): ?>
										
										<div class="image-row">
											<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/thumb/<?php echo $i->filename; ?>" title="<?php echo $i->title; ?>" alt="<?php echo $i->title; ?>" />
										</div>
									
									<?php endif; ?>
								
								<?php endforeach; ?>

							
							<?php endif; ?>
                                
								<div class="title-row"><a class="auto-gravity" href="<?php echo Yii::app()->request->baseUrl; ?>/news/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a></div>
								<div class="date-row">
								<?php //echo $b->update_time; ?>
								
								<?php 
								
								$arr = explode(" ", $b->update_time);
								$date = $arr[0];

								$exp = explode("-", $date);

								echo preg_replace($m, $bulan, $exp[1]).'&nbsp;'.$exp[2].',&nbsp;'.$exp[0];

								?>
								
								</div>
								<div class="comment-row">
									<?php echo '<span>'.count($b->comments).'</span>'; ?>
								</div>
								<div class="clear"></div>
							</div>
								
						<?php endforeach; ?>
						
						<?php
								
							$this->widget('CLinkPager', array(
								'currentPage'=>$pages->getCurrentPage(),
								'itemCount'=>$item_count,
								'pageSize'=>$page_size,
								'maxButtonCount'=>7,
								'nextPageLabel'=>'Berikutnya &raquo;',
								'lastPageLabel'=>'&raquo;',
								'prevPageLabel'=>'&laquo; Sebelumnya',
								'firstPageLabel'=>'&laquo;',
								'header'=>'',
							'htmlOptions'=>array('class'=>'pages'),
							));
						
						?>
						
					</div>
					
				</div>
				<div class="clear"></div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			<?php $this->beginWidget('NewsWidget', array(
				'title'=>'News Popular',
			)); ?>
			<?php $this->endWidget(); ?>
			
			
			
			<?php $this->beginWidget('MediaWidget', array(
				'title'=>'title',
			)); ?>
			<?php $this->endWidget(); ?>
	
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>