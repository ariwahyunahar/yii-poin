

<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; SPT browser
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-DocumentManagement">
    <div class="inner">
        <div class="main-content">
            
            
           
            <h3><span class="icon">&nbsp;</span>SPT</h3>
            
             <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            
            <div id="elfinder"></div>
				<?php
				
					$connector = 'connectormspt';
					
					$this->widget('application.extensions.elrte.elRTE', array(
					'selector'=>'elfinder',
						'connector'=>$connector,
					));
					
                ?>
            </div></div>

            
            
            
        </div>
    </div>
</div>
<div class="clear"></div>