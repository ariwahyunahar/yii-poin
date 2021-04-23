<div id="perface-top-wrapper" class="perface-top-wrapper">
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-middle" class="grid_16">
			<div class="inner">
				
				<div id="content-detail-all-<?php echo $idpage; ?>" class="page" >
				
					
					
					<h2 class="title"> <?php echo $title; ?> </h2>
					
					<div class="inner">
						
						
						<div class="content-row">
<ul>
<li>Dokumen Sosialisasi E-BOOK Produk-produk Printed PT. Metra Digital Media dapat diunduh <a href="http://poin.mdmedia.co.id/assets/doc/POIN/Sosialisasi%20eBook%20Produk-Produk%20Printed%20PT%20Metra%20Digital%20Media.pptx" target="_new">disini</a>.
</ul>
<ul>
<li>Dokumen E-BOOK Yellow Pages - Batam Edisi 2015 PT. Metra Digital Media dapat diunduh <a href="http://poin.mdmedia.co.id/assets/doc/lain-lain/yp/Yellow%20Pages%20-%20Batam%20Edisi%202015.pdf" target="_new">disini</a>.
</ul>
<ul>
<li>Dokumen E-BOOK Yellow Pages - Batam Edisi 2015 PT. Metra Digital Media dapat diunduh <a href="http://poin.mdmedia.co.id/assets/doc/lain-lain/yp/Yellow%20Pages%20-%20Info%20Wisata%20Medan%20Edisi%202015.pdf" target="_new">disini</a>.
</ul>
<ul>
<li>Dokumen E-BOOK Yellow Pages - Medan Edisi 2015 PT. Metra Digital Media dapat diunduh <a href="http://poin.mdmedia.co.id/assets/doc/lain-lain/yp/Yellow%20Pages%20-%20Medan%20Edisi%202015.pdf" target="_new">disini</a>.
</ul>
						<?php foreach($model as $b): ?>
							<div class="row">
							
								<?php if(!empty($b->contentImages)): ?>
									
									<?php
										$in = 0;
										foreach($b->contentImages as $i):
										$class = null;
										if ($in++ % 2 == 0) {
										$class = ' class="altrow"';
										}				
									?>
									
										<div class="img-row">
											<a href="<?php echo Yii::app()->request->baseUrl; ?>/assets/EBook/<?php echo $b->ebook; ?>" class="iframe">
												<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/content/<?php echo $i->filename; ?>" alt="<?php echo $b->title; ?>" />
											</a>
										</div>
									
									<?php endforeach; ?>
								
								<?php endif; ?>
								
								<div class="title-row">
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/assets/EBook/<?php echo $b->ebook; ?>" class="iframe">
										<?php echo $b->title; ?>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
						
					</div>
					
				</div>
				<div class="clear"></div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			
			<?php $this->beginWidget('PopularWidget', array(
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
