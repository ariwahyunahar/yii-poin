<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Site Building &raquo; Menus
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> Menu</h3>
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <div class="clear"></div>
            
            <div id="tab-menu" class="grid_16">
                <ul>
                    <li class="active">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menu">
                            list items
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menu/add">
                            add items
                        </a>
                    </li>
                </ul>
            <div class="clear"></div>
            </div>
            
            <div id="MenuSiteManager" class=listing-menu"">
            	<div class="inner">
                	<?php foreach($menuType as $m): ?>
                    	<div class="menu-items">
                        	<div class="bullets"></div>
                        	<div class="title"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menu-customize/<?php echo $m->slug; ?>"><?php echo $m->name; ?></a></div>
                        	<div class="description"><?php echo $m->description; ?></div>
                            <div class="clear"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="clear"></div>