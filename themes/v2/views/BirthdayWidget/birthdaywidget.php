<!--
<div id="BirthDay" class="BirthDay">
	<div class="inner">
	<div class="title">Yang Berulang Tahun</div>
		<?php 
			/*
			echo '<ul>';
			foreach($birthday as $b) {
				
				
				if($b['born_date'] == date('n').'-'.date('d')){
					$event = 'now';
					echo  '<li class="'.$event.'"><strong><em>'.$b['name'] . ' : <span>' . Yii::app()->util->getBirthday($b['born_date']) . '</span></em></strong></li>';
				} else {
					$event = '';
					echo '<li class="'.$event.'">'.$b['name'] . ' : <span>'. Yii::app()->util->getBirthday($b['born_date']) .'</span></li>';
				}
				
				
			}
			echo '</ul>';*/
		?>
	</div>
</div>
-->


<div id="BirthDay" class="BirthDay block">
	<div class="title text-shadow">
    	<div class="inner">Yang Berulang Tahun</div>
    </div>
	<div class="body inner scroll">
    
    	<?php 
			
			echo '<ul>';
			foreach($birthday as $b) {
				
				
				if($b['born_date'] == date('n').'-'.date('d')){
					$event = 'now';
					echo  '<li class="'.$event.'"><a href="'.Yii::app()->request->baseUrl.'/birthday/detail/'.$b['nik'].'">'.$b['name'] . '</a> : <span>' . Yii::app()->util->getBirthday($b['born_date']) . '</span></li>';
				} else {
					$event = '';
					echo '<li class="'.$event.'">'.$b['name'] . ' : <span>'. Yii::app()->util->getBirthday($b['born_date']) .'</span></li>';
				}
				
				
			}
			echo '</ul>';
		?>
    
    </div>
    
    <div class="more radius">
		<div class="inner">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/birthday"><span>Lihat Semua yang Berulang Tahun &raquo;</span></a>
		</div>
	</div>
    
</div>