<div id="perface-top-wrapper" class="perface-top-wrapper">
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-middle" class="grid_24">
			<div class="inner">
				
				<div id="content-detail-all-DocumentBrowser" class="page" >
				
					
					
					<h2 class="title"> Dokumen Khusus </h2>
					
					<div class="inner">
						
						<?php 
						if($peserta_doc_khss){ 
							$prnt = '<div>User yang Terdaftar: </div><div style="width: 400px;height: 80px;">';
							foreach($peserta_doc_khss as $peserta){
								$prnt .= '<div style="padding: 3px;border: 1px #ccc solid;float: left;margin-right: 2px;">'.$peserta['name'].' ('.$peserta['nik'].')</div>';
							}
							echo $prnt."</div>";
						}
						?>

						
						<p>Untuk mendownload file, klik kanan pada file dan pilih <strong><em>Get info</em></strong>. Kemudian pada kotak info baru dibuka Anda akan menemukan<br> info <strong><em>URL</em></strong>, klik kanan dan pilih Save link as...</p>
						<div id="elfinder"></div>
						<?php 
						$nikarray = array();
						if($peserta_doc_khssA){ 
							foreach($peserta_doc_khssA as $peserta){
								$nikarray[]=$peserta['nik'];
							}
						}
						?>
						
						<?php
						
						if(in_array(Yii::app()->user->name, $nikarray)){
							
							$connector = 'connectorm';
							
						} else {
						
							$connector = 'connector';
						
						}
						$connector = 'connectorm';

						$this->widget('application.extensions.elrtegm.elRTE', array(
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