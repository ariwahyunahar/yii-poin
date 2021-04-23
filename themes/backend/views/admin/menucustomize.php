<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Site Building &raquo; Menus &raquo; 
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> <?php echo $title; ?></h3>
            
             <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <div class="clear"></div>
            
            <div id="tab-menu" class="grid_16">
                <ul>
                    <li class="active">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menu-customize/<?php echo $menutype->slug; ?>">
                            list items
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menucustomizeadd/?type=<?php echo $menutype->id; ?>">
                            add items
                        </a>
                    </li>
                </ul>
            <div class="clear"></div>
            </div>
            
            
            <table id="listing-menu" class="admin-content listing radius" cellspacing="0" cellpadding="0">
                <tr class="title">
                    <th width="60%">Menu Item</th>
                    <th>Enabled</th>
                    <th>Weight</th>
                    <th>Operations</th>
                </tr>
                
                
                <?php
					$i = 0; 
					foreach($menu as $b): 
					$i++;
				?>
                <tr class="content">
                
                	<?php if($b->menu_type_id == 1 && $b->id == 1): ?>
                    <td style="display:none;"><a href="#"><?php echo $b->title; ?></a></td>
                    <td style="display:none;"><?php if($b->publish == 1): echo 'enable'; else: echo 'disable'; endif; ?></td>
                    <td style="display:none;"><?php echo $i; ?></td>
                    <td style="display:none;"><span>disable</span> &nbsp; <span>disable</span></td>
                    <?php else: ?>
                    <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/edit-menu-customize/<?php echo $b->id; ?>"><?php echo $b->title; ?></a></td>
                    <td><?php if($b->publish == 1): echo 'enable'; else: echo 'disable'; endif; ?></td>
                    <td><?php echo $i; ?></td>
                    <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/edit-menu-customize/<?php echo $b->id; ?>">Edit</a> &nbsp; <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menucustomizedelete/?id=<?php echo $b->id; ?>" onclick="return confirm('Are you sure to delete selected this menu <?php echo $b->title; ?> ?');">Delete</a></td>
                    <?php endif; ?>
                    
                </tr>
                <?php endforeach; ?>
                
                
            </table>
            
            
            
           
            
        </div>
    </div>
</div>
<div class="clear"></div>