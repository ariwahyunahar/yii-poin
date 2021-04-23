<div class="dropdown_2columns align_right"><!-- Begin right aligned container -->
            
            
	<div class="inner">
	
		<div class="title"><?php echo $title; ?></div>
		
		<div id="col_parsial">
			<ul>
				<?php foreach($corporate as $c): ?>
					<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/corporate/<?php echo $c->slug; ?>" class="auto-gravity" title="<?php echo $c->title; ?>"><?php echo $c->title; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

	</div>


</div><!-- End right aligned container -->