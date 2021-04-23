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
					
					<p><span>Dalam mengakses aplikasi kedinasan kami merekomendasikan untuk menggunakan Browser Mozila Firefox, dan khusus untuk Aplikasi IBS, Cashflow dan Portal gunakan Browser Internet Explorer.</span></p>
					
					<ul>
					
						<li class="break">
							<a href="http://jkta01.mdmedia.co.id" target="_blank"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/icon1.png" /></a>
							<a class="auto-gravity" target="_blank" href="https://notadinas.mdmedia.co.id/" title="Nota Dinas">Nota Dinas</a>
							<p>Nota Dinas</p>
							<div class="clear"></div>
						</li>
						
						<li class="break">
							<a href="http://fast.mdmedia.co.id" target="_blank"><img alt="icon4" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/icon4.png" /></a>
							<a class="auto-gravity" target="_blank" href="http://fast.mdmedia.co.id" title="FAST">FAST</a>
							<p>FAST</p>
							<div class="clear"></div>
						</li>
										
						<li class="break">
							<a href="http://sima.mdmedia.co.id" target="_blank"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/icon1.png" /></a>
							<a class="auto-gravity" target="_blank" href="http://sima.mdmedia.co.id" title="SIMA">SIMA</a>
							<p>Sistem Informasi Manajemen Aset</p>
							<div class="clear"></div>
						</li>
						
						<li class="break">
							<a href="http://gadis.mdmedia.co.id/login" target="_blank"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/icon1.png" /></a>
							<a class="auto-gravity" target="_blank" href="http://gadis.mdmedia.co.id/login" title="GADIS">GADIS</a>
							<p>General Affair Digital Information System </p>
							<div class="clear"></div>
						</li>
						
						<li class="break">
							<a href="http://gadis.mdmedia.co.id/login" target="_blank"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/icon1.png" /></a>
							<a class="auto-gravity" target="_blank" href="http://gadis.mdmedia.co.id/login" title="GADIS">GADIS</a>
							<p>General Affair Digital Information System </p>
							<div class="clear"></div>
						</li>
					</ul>
                        
					</div>
					
				</div>
				<div class="clear"></div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			
			
			
			<div id="tabs" class="block radius shadow">
					<ul>
						<li><a href="#TabBod"><span>BOD</span></a></li>
						<li><a href="#TabEvent"><span>Event</span></a></li>
						<li><a href="#TabJadwalShalat"><span>Jadwal Shalat</span></a></li>
					</ul>
                                        
					<div id="TabBod">
						
						<?php $this->beginWidget('BodWidget', array(
								'title'=>'BOD',
						)); ?>
						<?php $this->endWidget(); ?>
								
					</div>
                    
					<div id="TabEvent">
					
						<?php $this->beginWidget('EventWidget', array(
							'title'=>'Event',
						)); ?>
						<?php $this->endWidget(); ?>
						
					</div>
                    
					<div id="TabJadwalShalat">
						
						<?php $this->beginWidget('JadwalshalatWidget', array(
							'title'=>'Jadwal Shalat',
						)); ?>
						<?php $this->endWidget(); ?>
						
					</div>
				</div>
			
			
			
			
	
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>
