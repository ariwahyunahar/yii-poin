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
		<div id="postscript-middle" class="grid_16">
			<div class="inner">
				
				<div id="content-detail-all-search" class="page" >
				
					
					
					<h2 class="title"> Hasil Pencarian </h2>
					
					<div class="inner">
						
						<?php if(!empty($model)): ?>
						
								<?php foreach($model as $m): ?>
							
							
								<?php
								
								//$arr = explode(" ", $keyword);
								
								$patterns = '/'.$keyword.'/';
								$replacements = '<span>'.$keyword.'</span>';
								
								
								$titleReplace = preg_replace($patterns, $replacements, $m->slug);
								
								//echo $titleReplace.'<br>';
								
								
								$paterns2 = '/-/';
								$replacements2 = '&nbsp;';
								$titleResult = preg_replace($paterns2, $replacements2, $titleReplace);
								
								?>
								
									
								<div class="row">
									<div class="title-row"><a href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $m->contentType->name; ?>/<?php echo $m->slug; ?>"><?php echo $titleResult; ?></a></div>
									<div class="clear"></div>
								</div>
									
								
							<?php endforeach; ?>
							
							<?php
							
								$data = array();
								foreach($model as $m){  // loop to get the data (this is different from the complex way)
								$data[] = $m->attributes;
								}
							
							?>
							
							<?php
								
								$this->widget('CLinkPager', array(
									'currentPage'=>$pages->getCurrentPage(),
									'itemCount'=>$item_count,
									'pageSize'=>$page_size,
									'maxButtonCount'=>10,
									'nextPageLabel'=>'Berikutnya &raquo;',
									'lastPageLabel'=>'Terakhir &raquo;',
									'prevPageLabel'=>'&laquo; Sebelumnya',
									'firstPageLabel'=>'&laquo; Pertama',
									'header'=>'',
								'htmlOptions'=>array('class'=>'pages'),
								));
							
							?>


						
						<?php elseif($keyword == 'Cari konten ...'): ?>
						
							<div class="row">
								<div class="title-row"> <span>Tidak ada katakunci yang dicari.</span> </div>
								<div class="clear"></div>
							</div>
						
						<?php else: ?>
						
							<div class="row">
								<div class="title-row"> <span>Konten tidak ditemukan.</span> </div>
								<div class="clear"></div>
							</div>
						
						<?php endif;?>
						
						
						
						
					</div>
					
				</div>
				<div class="clear"></div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			<div id="Summary" class="Summary">
				<h2 class="title"> Ringkasan Pencarian </h2>
				<div class="inner">
					<div id="keyword">Anda sedang mencari 
					
					<?php if($keyword == 'Cari konten ...'): ?>
						<span>&nbsp;</span> 
					<?php else: ?>
						<a href="#"><span><?php echo $keyword; ?></span></a> 
					<?php endif; ?>
					
					
					
					.</div>
					<div id="result">Ada <span><?php echo $item_count; ?></span> data dalam database.</div>
				</div>
	
			</div>
			
			
			
			<?php $this->beginWidget('NewsWidget', array(
				'title'=>'News',
			)); ?>
			<?php $this->endWidget(); ?>
			
			
			
			
	
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>