<!-- <script src="ariwa/polling/hover_zoom_extended.min.js"></script> -->
<div id="Polling" class="block" style="background-color: #fff;">
	<div class="title text-shadow">
    	<div class="ariwa_inner_judul">
        	Hasil Polling
        </div>
    </div>
	
<?php if($hsl_polling_norg_count){ ?>
	<div style="float: right;padding: 10px;width: 450px;">
	<div style="padding: 5px 5px 5px 5px ;border-bottom: 1px #aaa solid;font-weight: bold;">THE BEST EMPLOYEE NON ORGANIC MDMEDIA AWARD 2016</div>
		<div class="inner">
	    
	    	<?php foreach($hsl_polling_norg as $b): ?>
	        <div class="portlet-title"><?php echo $b->title; ?></div>
	                <div class="poll-results">
	            	<?php 
						//foreach($b->pollingChoices as $p): 
						
	            		$PollChoice= Yii::app()->db->createCommand('select x.* from polling_choice x where x.polling_id=8 order by (select count(*) from member_vote where x.polling_id = polling_id and polling_choice_id=x.id) desc')->queryAll();
	            		foreach($PollChoice as $p): 	
					
						$criteria = new CDbCriteria;
						$criteria->condition = 'polling_choice_id ='.$p['id'];
						$PollChoice = MemberVote::model()->findAll($criteria);
						
						//count poll choice
						$PollChoice = count($PollChoice);
						
						$average1 = $PollChoice / $hsl_polling_norg_count;
						$average =  $average1 * '100';
						$average = explode('.',$average);
						$average = $average[0];
					?>
	                	
	                    <div class="result">
	                        <div class="label">
	                        <table border="0"><tr><td><img id="gb_<?php echo $p['choice']; ?>"  width="60px" src="ariwa/polling/2017/<?php echo $p['choice']; ?>.jpg" style="border-radius:5px;border: 1px solid #fff;"></td><td style="padding-left: 5px;"><?php echo $p['description'] ?></td></tr></table>
	                        </div>
	                        <div class="bar">
	                            <div style="width: <?php echo $average; ?>%;" class="fill"></div>
	                        </div>
	                        <div class="totals">
	                        
	                        	<span class="percent"><?php echo $average; ?>% </span>
	                            <span class="votes"> (<?php echo $PollChoice; ?> Votes) </span>
	                        </div>
	                    </div>
	                
	                <?php endforeach; ?>
	                </div>
	            
	        <?php endforeach; ?>
	    
	    </div>
	    
	    <div class="more radius">
			<div class="inner">
				<a href="#"><span><strong>Total <?php echo $hsl_polling_norg_count; ?> Votes</strong></span></a>
			</div>
		</div>
	</div>
<?php } ?>

<?php if($hsl_polling_org_count){ ?>
	<div style="padding: 10px;width: 450px;">
	<div style="padding: 5px 5px 5px 5px ;border-bottom: 1px #aaa solid;font-weight: bold;">THE BEST EMPLOYEE ORGANIC MDMEDIA AWARD 2016</div>
		<div class="inner">
	    	
	    	<?php foreach($hsl_polling_org as $b): ?>
	        <div class="portlet-title"><?php echo $b->title; ?></div>
	                <div class="poll-results">
	            	<?php 
	            	
	            		$PollChoice= Yii::app()->db->createCommand('select x.* from polling_choice x where x.polling_id=6 order by (select count(*) from member_vote where x.polling_id = polling_id and polling_choice_id=x.id) desc')->queryAll();
	            		foreach($PollChoice as $p): 	
						// foreach($b->pollingChoices as $p): 
						
						$criteria = new CDbCriteria;
						$criteria->condition = 'polling_choice_id ='.$p['id'];
						$PollChoice = MemberVote::model()->findAll($criteria);
						
						//count poll choice
						$PollChoice = count($PollChoice);
						
						$average1 = $PollChoice / $hsl_polling_org_count;
						$average =  $average1 * '100';
						$average = explode('.',$average);
						$average = $average[0];
					
					?>
	                
	                    <div class="result">
	                        <div class="label">
	                        <table border="0"><tr><td><img id="gb_<?php echo $p['choice']; ?>"  width="60px" src="ariwa/polling/2017/<?php echo $p['choice']; ?>.jpg" style="border-radius:5px;border: 1px solid #fff;"></td><td style="padding-left: 5px;"><?php echo $p['description'] ?></td></tr></table>
	                        </div>
	                        <div class="bar">
	                            <div style="width: <?php echo $average; ?>%;" class="fill"></div>
	                        </div>
	                        <div class="totals">
	                        
	                        	<span class="percent"><?php echo $average; ?>% </span>
	                            <span class="votes"> (<?php echo $PollChoice; ?> Votes) </span>
	                            
	                        </div>
	                    </div>
	                
	                <?php endforeach; ?>
	                </div>
	        
	        <?php endforeach; ?>
	    
	    </div>
	    
	    <div class="more radius">
			<div class="inner">
				<a href="#"><span><strong>Total <?php echo $hsl_polling_org_count; ?> Votes</strong></span></a>
			</div>
		</div>
	</div>
<?php } ?>

	
	<!-- <div  style="background-color: #fff;margin: 0;padding: 12px;">
		<b>*) Terdapat pengabaian data hasil pooling terkait pemilih/karyawan yang sudah resign.</b>
	</div>
	 -->
</div>

