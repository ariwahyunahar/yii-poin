<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Report Content Hits
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> Top Content Hits</h3>
            
            
            
            <div id="tabs">
                <ul>
                    <li><a href="#fragment-1"><span>All Content</span></a></li>
                    <li><a href="#fragment-2"><span>News</span></a></li>
                    <li><a href="#fragment-3"><span>Article</span></a></li>
                </ul>
                <div id="fragment-1">
                <table id="listing-content" class="admin-content listing radius" cellspacing="0" cellpadding="0">
                    <tr class="title">
                        <th>No.</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Create</th>
                        <th>Status</th>
                        <th>Hits</th>
                    </tr>
                    
                    <?php
                        $i = 0; 
                        foreach($allcontent as $b):
                        $class = null;
                        if ($i++ % 2 == 1) {
                        $class = 'altrow';
                        } 
                    ?>
                    <tr class="content <?php echo $class; ?>">
                        <td><?php echo $i; ?>.</td>
                        <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a></td>
                        <td><?php echo $b->contentType->name; ?></td>
                        <td><?php echo $b->create_time; ?></td>
                        <td><?php if($b->publish == 1): echo 'publish'; else: echo 'unpublish'; endif; ?></td>
                        <td><span><?php echo $b->hits; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                    
                </table>

                </div>
                <div id="fragment-2">
                   
                   
                   <table id="listing-content" class="admin-content listing radius" cellspacing="0" cellpadding="0">
                    <tr class="title">
                        <th>No.</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Create</th>
                        <th>Status</th>
                        <th>Hits</th>
                    </tr>
                    
                    <?php
                        $i = 0; 
                        foreach($news as $b):
                        $class = null;
                        if ($i++ % 2 == 1) {
                        $class = 'altrow';
                        } 
                    ?>
                    <tr class="content <?php echo $class; ?>">
                        <td><?php echo $i; ?>.</td>
                        <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a></td>
                        <td><?php echo $b->contentType->name; ?></td>
                        <td><?php echo $b->create_time; ?></td>
                        <td><?php if($b->publish == 1): echo 'publish'; else: echo 'unpublish'; endif; ?></td>
                        <td><span><?php echo $b->hits; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                    
                </table>
                   
                   
                </div>
                <div id="fragment-3">
                    
                                     <table id="listing-content" class="admin-content listing radius" cellspacing="0" cellpadding="0">
                    <tr class="title">
                        <th>No.</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Create</th>
                        <th>Status</th>
                        <th>Hits</th>
                    </tr>
                    
                    <?php
                        $i = 0; 
                        foreach($article as $b):
                        $class = null;
                        if ($i++ % 2 == 1) {
                        $class = 'altrow';
                        } 
                    ?>
                    <tr class="content <?php echo $class; ?>">
                        <td><?php echo $i; ?>.</td>
                        <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a></td>
                        <td><?php echo $b->contentType->name; ?></td>
                        <td><?php echo $b->create_time; ?></td>
                        <td><?php if($b->publish == 1): echo 'publish'; else: echo 'unpublish'; endif; ?></td>
                        <td><span><?php echo $b->hits; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                    
                </table>

                    
                </div>
            </div>
            
            
            
        </div>
    </div>
</div>
<div class="clear"></div>