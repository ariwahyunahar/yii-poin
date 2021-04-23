<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; content type
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> <?php echo $titlepage; ?></h3>
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <form id="ContentListingForm" accept-charset="utf-8" action="<?php echo Yii::app()->request->baseUrl; ?>/admin/contenttypedelete" method="post" name="ContentDeleteForm">
            <div id="update-content" class="admin-content radius">
                <div class="title">Update options</div>
                <div class="inner">
                    <div id="content-admin-buttons" class="container-inline">
                        <input id="edit-submit" class="form-submit" type="submit" value="Delete" name="op" onclick="return confirm('Are you sure to delete selected this content?');">
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <table id="listing-content" class="admin-content listing radius" cellspacing="0" cellpadding="0">
                <tr class="title">
                    <th width="3%">
                        
                        <!--<input id="selectall" class="form-checkbox" type="checkbox" title="Select all rows in this table">-->
                        <input type="checkbox" class="selectall" data-checkbox-name="ContentType[foo]" name="sa_foo" id="sa_foo">
                        <!--<input type="checkbox" id="data_all">-->
                        
                    </th>
                    <th width="60%">Title</th>
                    <th>Author</th>
                    <th width="10%">Operations</th>
                </tr>
                <?php 
                    $i=0;
                    foreach($model as $a): 
                    $class = null;
                    if ($i++ % 2 == 1) {
                    $class = 'altrow';
                    }
                ?>
                <tr class="content <?php echo $class; ?>">
                    <td>
                        
                        <div id="edit-nodes-<?php echo $i; ?>-wrapper" class="form-item form-option">
                        <input type="checkbox" class="checkme" data-select-all="sa_foo" value="<?php echo $a->id; ?>" name="ContentType[foo][]" id="foo_<?php echo $a->id; ?>">
                        </div>
                        
                    </td>
                    <td><?php echo $a->name; ?></td>
                    <td>administrator</td>
                    <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/contenttype/edit/<?php echo $a->slug; ?>">edit</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
            </form>
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