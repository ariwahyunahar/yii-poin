<div id="perface-top-wrapper" class="perface-top-wrapper">
	<div id="perface-top" class="container_24">
		
		<?php $this->beginWidget('InfoWidget', array(
			'title'=>'Latest Info',
		)); ?>
		<?php $this->endWidget(); ?>
		<div class="clear"></div>
		
		<div id="breadcrumb" class="breadcrumb grid_24">
			<div class="inner">
				<ul class="menu">
					<li class="activePage"><a href="<?php echo Yii::app()->request->baseUrl; ?>">Halaman Utama</a></li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
		
		<div class="clear"></div>
		
		<!--
		<div id="BannerSeason" class="BannerSeason grid_24">
			<div class="inner">
				<img src="<?php //echo Yii::app()->request->baseUrl; ?>/assets/img/hut28-infomedia.jpg" alt="hut28-infomedia" />
			</div>
		</div>
		-->
		
		
	</div>
	
</div>
<div class="clear"></div>

<div id="main-wrapper" class="main-wrapper">

	<div id="main" class="container_24">

		<!--
		<div id="sidebar-first" class="grid_5">
			<div class="inner">
			&nbsp;
			</div>
		</div>
		-->
		
		<div id="MainContent" class="grid_16">
			<div class="inner"> 
			<?php if(!Yii::app()->user->isGuest): ?>
			
				<?php $this->pageTitle=Yii::app()->name; ?>

				<!--<h1>Welcome to <i><?php //echo CHtml::encode(Yii::app()->name); ?></i></h1>-->
				<!-- <p><?php //echo __FILE__; ?></p> -->
				<!-- <p><?php //echo $this->getLayoutFile('main'); ?></p> -->

				
				<?php $this->beginWidget('SplashWidget', array(
					'title'=>'SplasImage',
				)); ?>
				<?php $this->endWidget(); ?>
				
				
				<?php $this->beginWidget('NewsfrontWidget', array(
					'title'=>'Latest News',
				)); ?>
				<?php $this->endWidget(); ?>

			
			<?php endif; ?>
			</div>
		</div>
		
		<div id="sidebar-last" class="grid_8">
			
						
				<div id="tabs" class="block radius shadow">
					<ul>
						<li><a href="#TabBod"><span>BOD</span></a></li>
						<li><a href="#TabKurs"><span>Kurs</span></a></li>
						<li><a href="#TabEvent"><span>Event</span></a></li>
						<li><a href="#TabJadwalShalat"><span>Jadwal Shalat</span></a></li>
					</ul>
                                        
					<div id="TabBod">
						
						<?php $this->beginWidget('BodWidget', array(
								'title'=>'BOD',
						)); ?>
						<?php $this->endWidget(); ?>
								
					</div>
					<div id="TabKurs">
						
						<?php $this->beginWidget('KursWidget', array(
								'title'=>'Kurs',
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

		<div class="clear"></div>
		
	</div>
	
	
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
                
                <?php $this->beginWidget('SpinWidget', array(
					'title'=>'Spin',
				)); ?>
				<?php $this->endWidget(); ?>
				
				<?php $this->beginWidget('DmsWidget', array(
					'title'=>'DMS',
				)); ?>
				<?php $this->endWidget(); ?>
				
				<?php $this->beginWidget('SmartWidget', array(
					'title'=>'Smart',
				)); ?>
				<?php $this->endWidget(); ?>
				
				<?php 
					/*
					$this->widget('EPoll');
					$this->endWidget();
					*/
				?>
				
				<div class="clear"></div>
				
			</div>
		</div>
		
		<div id="postscript-middle" class="grid_11">
			<div class="inner">
				
				
				<?php $this->beginWidget('ArticlefrontWidget', array(
					'title'=>'',
				)); ?>
				<?php $this->endWidget(); ?>
				
				
				<?php $this->beginWidget('MediaWidget', array(
					'title'=>'Media Release',
				)); ?>
				<?php $this->endWidget(); ?>

				
				<?php $this->beginWidget('FacebookWidget', array(
					'title'=>'Facebook',
				)); ?>
				<?php $this->endWidget(); ?>
				
				
				<?php $this->beginWidget('TwitterWidget', array(
					'title'=>'Twitter',
				)); ?>
				<?php $this->endWidget(); ?>
				
				<div class="clear"></div>
				
				
			</div>
		</div>
		
		<div id="postscript-right" class="grid_8">
			
			
			
			<div id="tabs-gallery" class="block">
				<ul>
					<li><a href="#GalleryFoto"><span>Gallery Foto</span></a></li>
					<li><a href="#GalleryVideo"><span>Gallery Video</span></a></li>
				</ul>
				
					
					
					<?php $this->beginWidget('GalleryfotoWidget', array(
						'title'=>'Gallery Foto',
					)); ?>
					<?php $this->endWidget(); ?>
						
						
					
				
				
				
					
					<?php $this->beginWidget('GalleryvideoWidget', array(
						'title'=>'Gallery Video',
					)); ?>
					<?php $this->endWidget(); ?>
					
					
					
				
			</div>
			
			
			
				
				
			<?php $this->beginWidget('PopularWidget', array(
				'title'=>'Popular News',
			)); ?>
			<?php $this->endWidget(); ?>
            
			<?php $this->beginWidget('BirthdayWidget', array(
				'title'=>'Birthday',
			)); ?>
			<?php $this->endWidget(); ?>
					
					
			<div id="ypcoid-search" class="ypcoid-widget"></div>
			
			
			
			
		</div>
		
	</div>
	
	
</div>
<div class="clear"></div>


<?php if (!Yii::app()->user->isGuest && isset($_GET['ssoLogin'])): ?>
	
	<form name="domLoginForm" action="<?php echo Yii::app()->params['ldap']['dominoUrl']; ?>" method="post">
		<input type="hidden" name="username" value="<?php echo Yii::app()->user->username; ?>" /><br>
		<input type="hidden" name="password" value="<?php echo Yii::app()->user->password; ?>" /><br>
		<input type="hidden" name="redirectto" value="<?php echo 'http://poin.infomedia.co.id/' . Yii::app()->request->baseUrl; ?>" /><br>
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
		};
	
	</script>
	

<?php endif; ?>

