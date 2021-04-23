<div class="ariwa_home_bg">
	<div class="ariwa_home_utama">
		
		<?php 
		// if(!$countVote){ 
			 // $this->beginWidget('PollingempWidget', array(
				// 'title'=>'Poling',
			// ));
			// $this->endWidget(); 
		// }
		?>
	
		<div class="ariwa_himbauan">
			<div class="ariwa_himbauan_masuk">
				<div class="ariwa_himbauan_masuk_penting">Penting :</div>
				<div id="ariwa_himbauan_masuk_penting_isi">
					<marquee width="850px;" onmouseout="start()" onmouseover="stop()" truespeed="" scrolldelay="30" scrollamount="1">
						........
						
						<?php
						/*
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<a href="http://poin.mdmedia.co.id/news/newspopular/pemberitahuan-gangguan-email-perusahaan">PEMBERITAHUAN GANGGUAN EMAIL PERUSAHAAN</a>
						<a href="http://poin.mdmedia.co.id/news/himbauan-untuk-mengubah-password">Himbauan Untuk Mengubah Password</a>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<a href="http://poin.mdmedia.co.id/news/panduan-penggunaan-aplikasi">Panduan Penggunaan Aplikasi E-SLIP</a>
						<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/pcinventory" style="color: red;font-weight: bold;">Inventarisasi Perangkat IT</a>
						*/
						?>
					</marquee>
				</div>
			</div>
		</div>
		
		<div style="padding-bottom: 70px;">
			<table cellpadding="0" cellspacing="0" style="margin: 0;">
				<tr>
					<td>
						<div class="ariwa_event">
							<div id="sidebar-last" class="grid_81">
								<div id="tabs" class="block radius shadow" style="margin: 0;">
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
						
					</td>
					
					<td colspan="2">
						<div class="ariwa_banner">
							<?php $this->beginWidget('SplashWidget', array(
								'title'=>'SplasImage',
							)); ?>
							<?php $this->endWidget(); ?>
							<div style="width: 110px;margin-left: 520px;height: 5px; position: absolute; margin-top: 320px; ">
								<div class="ariwa_inner_footer_a1"><a href="<?php echo Yii::app()->request->baseUrl; ?>/news">Lihat semua<br />berita</a></div>
							</div>
						</div>
					</td>
					
				</tr>
				
				<tr>
					<td style="border-top: #000 1px solid;	" colspan="3">
					<?php $this->beginWidget('PerformanceWidget', array(
						'title'=>'Performance',
					)); ?>
					<?php $this->endWidget(); ?>
					</td>
				</tr>
				
				<tr>
					<td style="border-top: #000 1px solid;	" colspan="3">
						<?php $this->beginWidget('BirthdayWidget', array(
							'title'=>'Birthday',
						)); ?>
						<?php $this->endWidget(); ?>
						
						<?php $this->beginWidget('PopularWidget', array(
							'title'=>'Popular News',
							'ishome'=>1
						)); ?>
						<?php $this->endWidget(); ?>
						
					</td>
				</tr>
			</table>
			
			<?php 
			
			/*
			if($countVote){ //20150417
				$this->beginWidget('PollingWidget', array(
					'title'=>'Poling',
				));
				$this->endWidget();
			} 
			*/
			?>
			
			<?php 
			/*
			$this->beginWidget('TwitterWidget', array(
					'title'=>'Tweeter',
				)); ?>
				<?php $this->endWidget(); 
				*/
				?>
			
		</div>
	</div>
</div>


<?php if (!Yii::app()->user->isGuest && isset($_GET['ssoLogin'])): ?>
	
	<form name="domLoginForm" action="<?php echo Yii::app()->params['ldap']['dominoUrl']; ?>" method="post">
		<input type="hidden" name="username" value="<?php echo Yii::app()->user->username; ?>" /><br>
		<input type="hidden" name="password" value="<?php echo Yii::app()->user->password; ?>" /><br>
		<input type="hidden" name="redirectto" value="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/' . Yii::app()->request->baseUrl; ?>" /><br>
		<input type="submit" value="" style="background-color:#FFFFFF; color:#FFFFFF ; border-style:none" />
	</form>
	
	<form name="domLoginForm2" action="http://cuti.mdmedia.co.id/index.php/index/login" method="post">
		<input type="hidden" name="username" value="<?php echo Yii::app()->user->username; ?>" /><br>
		<input type="hidden" name="password" value="<?php echo Yii::app()->user->password; ?>" /><br>
		<input type="hidden" name="redirectto" value="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/' . Yii::app()->request->baseUrl; ?>" /><br>
		<input type="submit" value="" style="background-color:#FFFFFF; color:#FFFFFF ; border-style:none" />
	</form>
	
	<script type="text/javascript">
		//this.document.domLoginForm.submit();
		setTimeout ( 'this.document.domLoginForm.submit()', 2000 );
	</script>
	
	<script type="text/javascript">
	
		window.onload = function()
		{
			document.domLoginForm.submit();
			document.domLoginForm2.submit();
		};
	
	</script>
<?php endif; ?>
	
<script src="ariwa/np_js/jquery.sticky-sidebar-scroll.min.js"></script>
<script>
	    $(document).ready(function() {
		$.stickysidebarscroll("#sidebar",{offset: {top: 40, bottom: 10}});
	    });
</script>