<div style="z-index: 1000;position: absolute;right: 0px;margin-top: 0px;">
		<div id="sidebar" style="z-index: 1000;position: absolute;right: 10px;">
			<div style="background-color: red;padding: 10px;color: #fff;border:2px solid;border-radius:10px;box-shadow: 5px 5px 5px #666;">
				
				
				
				
<table width="80%">
<tr>
<td>
<?php if(!$usr_vote_dept){ ?>
    <div id="Polling" class="block" style="width: 300px;">
	<?php
	$usr_login = Yii::app()->user->name;
	$start_user_string = substr($usr_login, 1, 1);
	if(is_numeric($start_user_string))
	{
		$polling = $polling_org;
	}else{
		$polling = $polling_norg;
	}
	?>
    	<?php foreach($polling_dept as $b): ?>
    	<div style="padding: 5px 0 5px 0 ;border-bottom: 1px #fff solid;margin-left: 5px;">THE BEST DEPARTMENT 2015</div>
        <div class="portlet-title" style="margin-right: 5px;"><?php echo $b->title; ?></div>
                <div class="form">
                    <form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/polling/vote" >
                    
                        <div class="row">
                            <label class="required" for="PollVote_choice_id">Pilihan <span class="required">*</span></label>
                            
                            <span id="PortletPollVote_choice_id">
                            
                            <?php
                                $i = -1;
                                foreach($b->pollingChoices as $p):
                                $i++; 
                            ?>
                            
                                <div class="row-choice clearfix">
                                    <div class="form-radio">
                                        <input type="radio" name="PortletPollVote_choice_id" value="<?php echo $p->id; ?>" id="dept_choice_id_<?php echo $i; ?>">
                                    </div>
                                    <div class="form-label">
                                    	<label for="dept_choice_id_<?php echo $i; ?>">
                                    	<table border="0"><tr><td></td><td style="padding-left: 5px;"><?php echo $p->description; ?></td></tr></table>
                                    	</label>
                                    </div>
                                </div>
                                
                            <?php endforeach; ?>
                            
                            </span>
                            
                        </div>
                        <input type="hidden" name="polling_id" value="<?php echo $b->id ?>">
                        
                        <div class="row buttons">
                            <input type="submit" value="Pilih Departemen" name="yt0">  
                        </div>
                    </form>
                </div>
        <?php endforeach; ?>
	</div>
<?php } ?>
</td>
<td>
<?php if(!$usr_vote_employee_or){ ?>
	<div id="Polling" class="block" style="width: 300px;">
    	<?php foreach($polling_org as $b): ?>
    	<div style="padding: 5px 0 5px 0 ;border-bottom: 1px #fff solid;margin-left: 5px;">THE BEST EMPLOYEE MDMEDIA AWARD 2015</div>
        <div class="portlet-title"><?php echo $b->title; ?></div>
                <div class="form"">
                    <form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/polling/vote" >
                        <ul>
                            <?php
                                $i = -1;
                                $PollChoice= Yii::app()->db->createCommand('select x.* from polling_choice x where x.polling_id='.$b->id.' order by x.id asc')->queryAll();
                                foreach($PollChoice as $p):
                                $i++; 
                            ?>
                            
                                <li style="display: inline;">
                                    <div class="form-radio">
                                        <input type="radio" name="PortletPollVote_choice_id" value="<?php echo $p['id']; ?>" id="PortletPollVote_choice_id_<?php echo $p['id']; ?>">
                                    </div>
                                    <div class="form-label">
                                    	<label for="PortletPollVote_choice_id_<?php echo $p['id']; ?>">
                                    	<table border="0"><tr><td>
                                    	
                                    	<img class="hover-zoom-element" id="gb_<?php echo $i; ?>" width="60px" src="ariwa/polling/2016/<?php echo $p['choice']; ?>.jpg" style="border-radius:5px;border: 1px solid #fff;">
                                    	
                                    	</td><td style="padding-left: 5px;"><?php echo $p['description']; ?></td></tr></table>
                                    	</label>
                                    </div>
                                </li>
                                
                            <?php endforeach; ?>
                            
                        </ul>
                        <input type="hidden" name="polling_id" value="<?php echo $b->id ?>">
                        
                        <div class="row buttons">
                            <input type="submit" value="Pilih Karyawan">  
                        </div>
                    </form>
                </div>
        <?php endforeach; ?>
	</div>
<?php } ?>
</td>


<td>
<?php if(!$usr_vote_employee_os){ ?>
	<div id="Polling" class="block" style="width: 300px;">
    	<?php foreach($polling_norg as $b): ?>
    	<div style="padding: 5px 0 5px 0 ;border-bottom: 1px #fff solid;margin-left: 5px;">THE BEST EMPLOYEE MDMEDIA AWARD 2015</div>
        <div class="portlet-title"><?php echo $b->title; ?></div>
                <div class="form"">
                    <form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/polling/vote" >
                        <div>
                            <span id="PortletPollVote_choice_id">
                            <?php
                                $i = -1;
                                $PollChoice= Yii::app()->db->createCommand('select x.* from polling_choice x where x.polling_id='.$b->id.' order by x.id asc')->queryAll();
                                foreach($PollChoice as $p):
                                $i++; 
                            ?>
                            
                                <div class="row-choice clearfix">
                                    <div class="form-radio">
                                        <input type="radio" name="PortletPollVote_choice_id" value="<?php echo $p['id']; ?>" id="PortletPollVote_choice_id_<?php echo $p['id']; ?>">
                                    </div>
                                    <div class="form-label">
                                    	<label for="PortletPollVote_choice_id_<?php echo $p['id']; ?>">
                                    	<table border="0"><tr><td>
                                    	
                                    	<img class="hover-zoom-element" id="gb_<?php echo $i; ?>" width="60px" src="ariwa/polling/2016/<?php echo $p['choice']; ?>.jpg" style="border-radius:5px;border: 1px solid #fff;">
                                    	
                                    	</td><td style="padding-left: 5px;"><?php echo $p['description']; ?></td></tr></table>
                                    	</label>
                                    </div>
                                </div>
                                
                            <?php endforeach; ?>
                            </span>
                            
                        </div>
                        <input type="hidden" name="polling_id" value="<?php echo $b->id ?>">
                        
                        <div class="row buttons">
                            <input type="submit" value="Pilih Karyawan">  
                        </div>
                    </form>
                </div>
        <?php endforeach; ?>
	</div>
<?php } ?>
</td>
</tr>
</table>
				
				
				
				
				
			</div>
		</div>
	</div>