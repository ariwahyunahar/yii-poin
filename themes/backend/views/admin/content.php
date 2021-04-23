<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; content
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> Content</h3>
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <div id="filter-content" class="admin-content radius">
                <div class="title">Show only items where</div>
                <div class="inner">
                    <form id="ContentListingForm" accept-charset="utf-8" action="<?php echo Yii::app()->request->baseUrl; ?>/admin/contentsort" method="post" name="ContentSortForm">
                    <div id="content-admin-input" class="container-inline">    
                        <label>title
                            <input type="text" id="Content_title" name="Content[title]" value="<?php echo $TitleSort; ?>">
                        </label>
                    </div>
                    
                    <div id="content-admin-input" class="container-inline">    
                        <label>type is
                            <select name="Content[type]" id="select-type">
                                <option value="1">- All -</option>
                                <?php foreach($Type as $t): ?>
                                    <option value="<?php echo $t->id; ?>"><?php echo $t->name; ?></option>
                                <?php endforeach; ?>
                                    
                            </select>
                        </label>
                    </div>
					
					<div id="content-admin-input" class="container-inline">    
                        <label>Create Time
                            <input type="text" name="Content[create_time]" class="datepicker" >
                        </label>
                    </div>
                    
                    
                     <div id="content-admin-input" class="container-inline">    
                        <label>status is
                            <select name="Content[publish]" id="select-type">
                                <option value="1">publish</option>
                                <option value="0">un publish</option>
                            </select>
                        </label>
                    </div>
                    
                    <div class="clear"></div>
                    <br/>
                    <div id="content-admin-buttons" class="container-inline">
                        <input id="edit-submit" class="form-submit" type="submit" value="Filter" name="op">
                    </div>
                    </form>
                    &nbsp;
                    <div id="content-admin-buttons" class="container-inline">
                        <input id="edit-submit" class="form-submit" type="submit" value="Filter Clear" name="clear" onclick="window.location.href='<?php echo Yii::app()->request->baseUrl; ?>/admin/clearsort'">
                    </div>
                    
                    <div class="clear"></div>
                </div>
            </div>
            <form id="ContentListingForm" accept-charset="utf-8" action="<?php echo Yii::app()->request->baseUrl; ?>/admin/contentdelete" method="post" name="ContentDeleteForm">
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
                        <input type="checkbox" class="selectall" data-checkbox-name="Content[foo]" name="sa_foo" id="sa_foo">
                        <!--<input type="checkbox" id="data_all">-->
                        
                    </th>
                    <th width="60%">Title</th>
                    <th>Type</th>
                    <th>Comment</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th width="10%" style="text-align:center;">Operations</th>
                </tr>
                
                <?php $type = array('news','article'); ?>
                
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
                        <input type="checkbox" class="checkme" data-select-all="sa_foo" value="<?php echo $a->id; ?>" name="Content[foo][]" id="foo_<?php echo $a->id; ?>">
                        </div>
                        
                    </td>
                    <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/<?php echo $a->slug; ?>"><?php echo $a->title; ?></a></td>
                    <td>
                        <?php echo $a->contentType->name; ?>
                    </td>
                    
                    <?php if(in_array($a->contentType->name, $type)): ?>
                    <td style="text-align:center;"> <?php echo '<span>'.count($a->comments).'</span>'; ?> </td>
                    <?php else: ?>
                    <td style="text-align:center;"> no comment </td>
                    <?php endif; ?>
                    
                    <td>administrator</td>
                    <td>
                        <?php
                            if($a->publish == 1):
                                echo 'published';
                            else:
                                echo 'unpublished';
                            endif;
                        ?>
                    </td>
                    <td style="text-align:center;"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/edit/<?php echo $a->slug; ?>" title="edit" class="edit">edit</a> &nbsp; <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/sharetoemail/<?php echo $a->id; ?>" title="share" class="share iframe">shar</a></td>
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