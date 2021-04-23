<div id="perface-top" class="grid_16">
	<div id="breadcurmb" class="breadcurmb">
		<div class="inner">
		Dashboard &raquo; Themes &raquo; Themes Configuration
		</div>			
	</div>
</div>
<div id="main" class="grid_16 radius main main-<?php echo $pageid; ?>">
    <div class="inner">
        <div class="main-content">
            <h3><span class="icon">&nbsp;</span> Themes Configuration</h3>
            
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
						echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
			?>
            
            <?php echo CHtml::form( Yii::app()->request->baseUrl.'/admin/updatethemeimg','post',array('enctype'=>'multipart/form-data')); ?>
            
             <div id="content-view-detail" class="grid_11">
                <div class="inner">
            		
                    <h2><?php echo $theme->name; ?></h2>
					
					<fieldset style="display:none;"> 
                    	<div class="row" style="display:none;">
                            <input type="hidden" id="idTheme" class="input-form" name="Themes[id]" value="<?php echo $theme->id; ?>" />
                        </div>
                    </fieldset>
                    
                    <fieldset> 
                    	<legend>Logo</legend>
                        <div class="row">
                                <label>Image Logo</label>
                                <input type="file" id="LogoFile" class="input-form" name="Themes[logo]" />
                                Maximum file size: 2 MB<br />
                                Allowed extensions: png gif jpg jpeg<br/>
    							<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo $theme->slug; ?>/img/<?php echo $theme->logo; ?>" alt="logo-poin" />
                        </div>
                    </fieldset>
                    
                    <fieldset> 
                    	<legend>Icon</legend>
                        <div class="row">
                                <label>Icon</label>
                                <input type="file" id="IconFile" class="input-form" name="Themes[icon]" />
                                Maximum file size: 2 MB<br />
                                Allowed extensions: ico png gif jpg jpeg<br/>
    							<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo $theme->slug; ?>/img/<?php echo $theme->icon; ?>" alt="favicon" />
                        </div>
                    </fieldset>
					
					<fieldset> 
                    	<legend>Banner Top</legend>
                        <div class="row">
                                <label>Banner Top</label>
                                <input type="file" id="BannerFile" class="input-form" name="Themes[bannertop]" />
                                Maximum file size: 2 MB<br />
                                Allowed extensions: png gif jpg jpeg<br/>
    							<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/<?php echo $theme->bannertop; ?>" alt="banner-top" />
                        </div>
                    </fieldset>
                    
                </div>
            </div>
            
            <div id="content-updatetime-detail" class="radius grid_5">
                <div class="inner">
                	
                    <fieldset style="display:none;"> 
                    	<legend>Theme id</legend>
                        <div class="row">
                                <label>Theme id</label>
                                <input type="hidden" id="ImgFile" class="input-form" name="Themes[id]" value="<?php echo $theme->id; ?>" />
                        </div>
                    </fieldset>
                    
                     <fieldset> 
                    	<legend>Save This Configuration</legend>
                        <div id="content-admin-buttons" class="container-inline">
                            <input id="edit-submit" class="form-submit" type="submit" value="Save Configuration" name="op">
                        </div>
                     </fieldset>
                	
                    <div class="clear"></div>
                    
                </div>
            </div>
            
            <?php echo CHtml::endForm(); ?>
            
            
            <p>&nbsp;</p>
            
      </div>
    </div>
</div>
<div class="clear"></div>