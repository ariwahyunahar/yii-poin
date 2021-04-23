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

							
							<?php if(!Yii::app()->user->isGuest){ ?>
							<li class="break">
								<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/downloadfile" target="_blank"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" /></a>
								<a class="auto-gravity" target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/downloadfile" title="Download e-ID BPJS Kesehatan">Download e-ID BPJS Kesehatan</a>
								<p>Download e-ID BPJS Kesehatan</p>
								<div class="clear"></div>
							</li>
							<?php } ?>
							
							<?php if(!Yii::app()->user->isGuest){ ?>
							<li class="break">
								<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/spt"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" /></a>
								<a class="auto-gravity" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/spt" title="SPT Tahunan">SPT Tahunan</a>
								<p>SPT Tahunan</p>
								<div class="clear"></div>
							</li>
							<?php } ?>
							
							
							<?php if(!Yii::app()->user->isGuest){ ?>
							<li class="break">
								<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/downloadfileeid" target="_blank"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" /></a>
								<a class="auto-gravity" target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/downloadfileeid" title="e-ID BPJS Ketenagakerjaan">Download e-ID BPJS Ketenagakerjaan</a>
								<p>Download e-ID BPJS Ketenagakerjaan</p>
								<div class="clear"></div>
							</li>
							<?php } ?>
							
							
							
							<?php
							$dir_path = Yii::getPathOfAlias('webroot') . "/assets/sk/".Yii::app()->user->username.".pdf";
							if( true ){ ?>
							<!-- <li class="break">
								<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/content/downloadfilesk"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" /></a>
								<a class="auto-gravity" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/content/downloadfilesk" title="SK MDMedia Okt 2019">SK MDMedia</a>
								<p>SK MDMedia Okt 2019</p>
								<div class="clear"></div>
							</li>
							-->
							<?php } ?>
							
							<li class="break">
								<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/sksk"><img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/decree.png" style="width: 40px;"/></a>
								<a class="auto-gravity" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/sksk" title="Download SK Pekerja">Download SK Pekerja</a>
								<p>Download SK Pekerja</p>
								<div class="clear"></div>
							</li>
							
							
                            <li class="break">
                                <a class="auto-gravity" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/menuerp" title="ERP">
                                    <img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/decree.png" style="width: 40px;"/>
                                    ERP
                                </a>
                                <p>ERP</p>
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
