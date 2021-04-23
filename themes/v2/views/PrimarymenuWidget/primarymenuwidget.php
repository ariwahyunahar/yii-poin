<div id="primarymenu" class="primarymenu">
    <div class="inner">
    
        <ul class="menu">
            
            <?php foreach($primarymenu as $b): ?>
            
            	<li class="leaf"><a class="auto-gravity" href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $b->slug; ?>" title="<?php echo $b->name; ?>" alt="<?php echo $b->name; ?>" id="<?php echo $b->title; ?>"><?php echo $b->name; ?></a></li>
            
			<?php endforeach; ?>
            
            <li class="leaf infomedia">
                <a class="auto-gravity drop" href="#" title="Infomedia Nusantara" alt="Infomedia Nusantara" id="infomedia">infomedia</a>
                
                
                <?php $this->beginWidget('CorporateWidget', array(
                    'title'=>'Perusahaan',
                )); ?>
                <?php $this->endWidget(); ?>
                                
            </li>
            
        </ul>
    <div class="clear"></div>
    </div>
</div>