<div id="TabEventContent">
	<div class="inner">
		
		<div class="content-row">
		<div class="content-row-title">Upcoming Events</div>
        <?php 
			$i = 0;
			foreach($event as $a):
			$i++;
		?>
			
            <?php $date_now = date('Y').'-'.date('m').'-'.date('d').'&nbsp;'.date('h').':'.date('i').':'.date('s'); ?>
			
			<?php if(!empty($a->event_end_time)): ?>
				<?php if($date_now < $a->event_end_time): ?>
                    <?php if($i != 7): ?>
                        <div class="row">
                        <div class="title-row"><a href="#"><?php echo $a->title; ?></a></div>
                        <div class="date-row"><?php echo Yii::app()->util->dateInd($a->event_start_time); ?></div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
			
		<?php endforeach; ?>
		</div>
		
		
		
	</div>
</div>