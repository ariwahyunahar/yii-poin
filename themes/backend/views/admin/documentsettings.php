<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Document Browse &raquo; Settings
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> Document Browse Settings</h3>
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <fieldset>
            	<legend>Add User to Upload Doument Browser</legend>
                <?php echo CHtml::form( Yii::app()->request->baseUrl.'/admin/document/settings','post',array('')); ?>
                <div class="grid_8">
                    <label>Listing Member
                        <select name="Member[id]" id="Member">
                            <option value="-">-</option>
                            <?php foreach($member as $b): ?>
                            <option value="<?php echo $b->id; ?>"><?php echo $b->name; ?> ( <span><?php echo $b->nik; ?></span> )</option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                <div class="grid_8">
                	<div class="row buttons">
                            <input id="SaveButton" class="form-submit" type="submit" value="Add User" name="yt0" />
                    </div>
                </div>
                <?php echo CHtml::endForm(); ?>
            </fieldset>
            
            <fieldset>
            	<legend>Users Allow Upload Document Browser</legend>
                <table id="listing-content" class="admin-content listing radius" cellspacing="0" cellpadding="0">
                    <tr class="title">
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Operation</th>
                    </tr>
                    
                    <?php
                        $i = 0; 
                        foreach($member_upload as $b):
                        $class = null;
                        if ($i++ % 2 == 1) {
                        $class = 'altrow';
                        } 
                    ?>
                    
                    <tr class="content <?php echo $class; ?>">
                        <td><?php echo $b->nik; ?></td>
                        <td><?php echo $b->name; ?></td>
                        <td><?php echo $b->email; ?></td>
                        <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/document/settings/removeuser/<?php echo $b->id; ?>" onclick="return confirm('Are you sure you wish to delete this user <?php echo $b->name; ?> ?');">Delete</a></td>
                    </tr>
                    
                    <?php endforeach; ?>
                    
                </table>
			</fieldset>
            
            
            
        </div>
    </div>
</div>
<div class="clear"></div>