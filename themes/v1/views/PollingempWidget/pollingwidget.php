<div style="z-index: 1000;position: absolute;right: 0px;margin-top: 0px;">
		<div id="sidebar" style="z-index: 1000;position: absolute;right: 10px;">
			<div style="background-color: red;padding: 10px;color: #fff;border:2px solid;border-radius:10px;box-shadow: 5px 5px 5px #666;">
				
				
				
				
<table>
<tr>
<td>
<?php if(!$usr_vote_employee_or){ ?>
	<div id="Polling" class="block" style="width: 500px;">
    	<?php foreach($polling_org as $b): ?>
    	<div style="padding: 5px 0 5px 0 ;border-bottom: 1px #fff solid;margin-left: 5px;">THE BEST EMPLOYEE MDMEDIA AWARD 2017</div>
        <div class="portlet-title"><?php echo $b->title; ?></div>
                <div class="form"" style="">
                    <form id="formemployeeor" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/polling/vote" >
                        <div>
                            <span id="PortletPollVote_choice_id">
                            <?php
                                $i = -1;
                                $PollChoice= Yii::app()->db->createCommand('select x.* from polling_choice x where x.polling_id='.$b->id.' order by x.id asc')->queryAll();
                                foreach($PollChoice as $p):
                                $i++; 
                            ?>
                            
                                <div class="row-choice clearfix" style="float: left;">
                                    <div class="form-radio">
                                        <input type="checkbox" name="PortletPollVote_choice_id[]" value="<?php echo $p['id']; ?>" id="PortletPollVote_choice_id_<?php echo $p['id']; ?>">
                                    </div>
                                    <div class="form-label">
                                    	<label for="PortletPollVote_choice_id_<?php echo $p['id']; ?>">
                                    	<table border="0"><tr><td>
                                    	
                                    	<img class="hover-zoom-element" id="gb_<?php echo $i; ?>" width="60px" src="ariwa/polling/2017/<?php echo $p['choice']; ?>.jpg" style="border-radius:5px;border: 1px solid #fff;">
                                    	
                                    	</td><td style="padding-left: 5px;"><?php echo $p['description']; ?></td></tr></table>
                                    	</label>
                                    </div>
                                </div>
                                
                            <?php endforeach; ?>
                            </span>
                            
                        </div>
                        <input type="hidden" name="polling_id" value="<?php echo $b->id ?>">
                        
                        <div class="row buttons" style="bottom: 0;position: absolute;">
                        		<div style="padding: 3px;"><i><b>*) Anda harus menentukan 2 pilihan untuk karyawan organik</b></i></div>
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
	<div id="Polling" class="block" style="width: 450px;">
    	<?php foreach($polling_norg as $b): ?>
    	<div style="padding: 5px 0 5px 0 ;border-bottom: 1px #fff solid;margin-left: 5px;">THE BEST EMPLOYEE MDMEDIA AWARD 2017</div>
        <div class="portlet-title"><?php echo $b->title; ?></div>
                <div class="form"">
                    <form id="formemployeeos" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/polling/vote" >
                        <div>
                            <span id="PortletPollVote_choice_id">
                            <?php
                                $i = -1;
                                $PollChoice= Yii::app()->db->createCommand('select x.* from polling_choice x where x.polling_id='.$b->id.' order by x.id asc')->queryAll();
                                foreach($PollChoice as $p):
                                $i++; 
                            ?>
                            
                                <div class="row-choice clearfix" style="float: left;">
                                    <div class="form-radio">
                                        <input type="checkbox" name="PortletPollVote_choice_id[]" value="<?php echo $p['id']; ?>" id="PortletPollVote_choice_id_<?php echo $p['id']; ?>">
                                    </div>
                                    <div class="form-label">
                                    	<label for="PortletPollVote_choice_id_<?php echo $p['id']; ?>">
                                    	<table border="0"><tr><td>
                                    	
                                    	<img class="hover-zoom-element" id="gb_<?php echo $i; ?>" width="60px" src="ariwa/polling/2017/<?php echo $p['choice']; ?>.jpg" style="border-radius:5px;border: 1px solid #fff;">
                                    	
                                    	</td><td style="padding-left: 5px;"><?php echo $p['description']; ?></td></tr></table>
                                    	</label>
                                    </div>
                                </div>
                                
                            <?php endforeach; ?>
                            </span>
                            
                        </div>
                        <input type="hidden" name="polling_id" value="<?php echo $b->id ?>">
                        
                        <div class="row buttons" style="bottom: 0;position: absolute;">
                        		<div style="padding: 3px;"><i><b>*) Anda harus menentukan 2 pilihan untuk karyawan non organik</b></i></div>
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
	
	

<script type="text/javascript">
$('#formemployeeor').submit(function(){
	var xx = $("input[name='PortletPollVote_choice_id[]']:checked").length;
	if(!xx){
		alert('Harus menentukan 2 pilihan.');
       	return false;
	}
    if (xx!=2){
       alert('Harus menentukan 2 pilihan.');
       return false;
    }
	
    if (!confirm('Anda Yakin ?' )) { 
		return false; 
	} 
}); 
$('#formemployeeos').submit(function(){
	var xx = $("input[name='PortletPollVote_choice_id[]']:checked").length;
	if(!xx){
		alert('Harus menentukan 2 pilihan.');
       	return false;
	}
    if (xx!=2){
       alert('Harus menentukan 2 pilihan.');
       return false;
    }
	
    if (!confirm('Anda Yakin ?' )) {
		return false; 
	} 
}); 
</script>
