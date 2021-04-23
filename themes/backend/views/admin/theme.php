<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Themes
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> Themes</h3>
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <form id="ThemeListingForm" accept-charset="utf-8" action="<?php echo Yii::app()->request->baseUrl; ?>/admin/theme" method="post" name="ConfigTheme">
            
            <table id="listing-content" class="admin-content listing radius" cellspacing="0" cellpadding="0">
              <tr class="title">
                <th>Screen Shoot</th>
                <th>Name</th>
                <th>Version</th>
                <th>Active</th>
                <th>Operation</th>
              </tr>
              
              <?php foreach($theme as $b): ?>
              <tr>
                <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/theme/<?php echo $b->screenshoot; ?>" alt=""  /></td>
                <td style="vertical-align:middle;"><?php echo $b->name; ?><br/><?php echo $b->description; ?></td>
                <td style="vertical-align:middle;"><?php echo 'Version 1'; ?></td>
                
                <td style="vertical-align:middle;">
                
                	<?php if($b->id == $activeTheme->themes_id): ?>
                        <label>
                            <input name="Sites[themes_id]" type="radio" id="Sites_Themes_id" value="<?php echo $b->id; ?>" checked="checked">
                        </label>
                    <?php else: ?>
                        <label>
                            <input name="Sites[themes_id]" type="radio" id="Sites_Themes_id" value="<?php echo $b->id; ?>">
                        </label>
                    <?php endif; ?>
                
                </td>
                
                <td style="vertical-align:middle;"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/theme/settings/<?php echo $b->slug; ?>">Configure</a></td>
              
              </tr>
              <?php endforeach; ?>
            </table>
            
            <div id="content-admin-buttons" class="container-inline">
                <input id="edit-submit" class="form-submit" type="submit" value="Save" name="op">
            </div>
            </form>
            
            
            <p>&nbsp;</p>
            
      </div>
    </div>
</div>
<div class="clear"></div>