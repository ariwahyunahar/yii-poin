<div id="perface-top-wrapper" class="perface-top-wrapper">
	
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">
		<div id="postscript-middle" class="grid_16">
			<div class="inner">
				
				<div id="content-detail-all-<?php echo $idpage ?>" class="page" >
				
					
					
					<h2 class="title"> <?php echo $title ?> </h2>
					
					<div class="inner">
						
						
						<p><span>Ubahlah Password anda minimal setiap 3 bulan sekali, gunakan kombinasi karakter huruf besar, kecil, karakter khusus dan angka. Jangan sekali-kali memberitahukan password anda ke orang lain. Setiap adanya penyalahgunaan password, akan merugikan anda sendiri.</span></p>
						
						<ul>			<!--				
							<li class="break">
								<a href="#"><img alt="icon3" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/icon3.png" /></a>
								<a class="auto-gravity" href="<?php echo Yii::app()->request->baseUrl; ?>/password" title="Ubah Password">Ubah Password</a>
								<p>Ubah Password</p>
								<div class="clear"></div>
							</li>-->
							
							<!--
							<li class="break">
								<a href="http://jkta03.infomedia.web.id/cuti/esscuti.nsf" target="_blank"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/icon1.png" /></a>
								<a class="auto-gravity" target="_blank" href="http://jkta03.infomedia.web.id/cuti/esscuti.nsf" title="Cuti Online">Cuti Online</a>
								<p>Cuti Online</p>
								<div class="clear"></div>
							</li>
							-->

							<li class="break">
								<a href="http://172.9.1.78/hris/default.asp" target="_blank"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/icon1.png" /></a>
								<a class="auto-gravity" target="_blank" href="http://hris.mdmedia.co.id" title="HRIS On Web">HRIS On Web</a>
								<p>HRIS On Web</p>
								<div class="clear"></div>
							</li>
						
							<li class="break">
								<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/gaji"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/ariwa/gaji.png" /></a>
								<a class="auto-gravity" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/gaji" title="Slip Gaji">Slip Gaji</a>
								<p>Slip Gaji</p>
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
