<div id="perface-top-wrapper" class="perface-top-wrapper">
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-middle" class="grid_24">
			<div class="inner">
				
				<div id="content-detail-all-DocumentBrowser" class="page" >
				
					
					
					<h2 class="title"> <?php echo $this->pageTitle; ?> </h2>
					
					<div class="inner">
						
						
						
						<p>Untuk mendownload file, klik kanan pada file dan pilih <strong><em>Get info</em></strong>. Kemudian pada kotak info baru dibuka Anda akan menemukan<br> info <strong><em>URL</em></strong>, klik kanan dan pilih Save link as...</p>
						<div id="elfinder"></div>
						<?php
						
						$nikarray = array();
						
						foreach($user as $b){
							$nikarray[]=$b->nik;
						}
						
						if(in_array(Yii::app()->user->name, $nikarray)){
							
							$connector = 'connectorm';
							
						} else {
						
							$connector = 'connector';
						
						}
						

						$this->widget('application.extensions.elrte.elRTE', array(
							'selector'=>'elfinder',
								'connector'=>$connector,
						 ));
						?>
						</div></div>
						
						
						
					</div>
					
				</div>
				<div class="clear"></div>
				
				
			</div>
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>