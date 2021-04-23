<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Member List
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> Member List</h3>
            
            
            
            <table id="listing-content" class="admin-content listing radius" cellspacing="0" cellpadding="0">
                <tr class="title">
                    <th>Id.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>NIK</th>
                    <th>Born Date</th>
                </tr>
                
                <?php
                    $i = 0; 
                    foreach($model as $b):
                    $class = null;
                    if ($i++ % 2 == 1) {
                    $class = 'altrow';
                    } 
                ?>
                <tr class="content <?php echo $class; ?>">
                    <td><?php echo $b->id; ?>.</td>
                    <td><a href="mailto:<?php echo $b->email; ?>;"><?php echo $b->name; ?></a></td>
                    <td><a href="mailto:<?php echo $b->email; ?>;"><?php echo $b->email; ?></a></td>
                    <td><?php echo $b->nik; ?></td>
                    <td><?php echo $b->born_date; ?></td>
                </tr>
                <?php endforeach; ?>
                
            </table>

            <div id="pagging-<?php echo $pageid; ?>" class="pagging">
                <?php

                    $this->widget('CLinkPager', array(
                    'currentPage'=>$pages->getCurrentPage(),
                    'itemCount'=>$item_count,
                    'pageSize'=>$page_size,
                    'maxButtonCount'=>10,
                    'nextPageLabel'=>'Next &raquo;',
                    'lastPageLabel'=>'',
                    'prevPageLabel'=>'&laquo; Previous',
                    'firstPageLabel'=>'',
                    'header'=>'',
                    'htmlOptions'=>array('class'=>'admin-listing'),
                    ));

                ?>
            </div>
            
            
        </div>
    </div>
</div>
<div class="clear"></div>