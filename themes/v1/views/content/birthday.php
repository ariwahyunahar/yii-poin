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
						
						<table id="<?php echo $idpage; ?>" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="title">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            
                            <?php foreach($birthday as $b): ?>
                            
								<?php 
									if($b['born_date'] == date('n').'-'.date('j')): 
									$event = 'now';
								?>
                                    
                                    <tr class="body">
                                        <td><img src="<?php echo Yii::app()->theme->getBaseUrl(); ?>/img/icon_hut.png" alt="icon_hut"  /></td>
                                        <td><?php echo $b['name'].'&nbsp;:&nbsp;<span>'.Yii::app()->util->getBirthday($b['born_date']).'</span>'; ?></td>
                                        <td style="text-align:right;"><a href="<?php echo Yii::app()->request->baseUrl; ?>/birthday/detail/<?php echo $b['nik']; ?>">Profil lengkap</a></td>
                                    </tr>
                                
                                <?php else: ?>
                                    
                                    <tr class="body">
                                        <td>&nbsp;</td>
                                        <td><?php echo $b['name'].'&nbsp;:&nbsp;<span>'.Yii::app()->util->getBirthday($b['born_date']).'</span>'; ?></td>
                                        <td style="text-align:right;"></td>
                                    </tr>
    
                                <?php endif; ?>
                                
                            <?php endforeach; ?>
                            
                        </table>
						
						
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