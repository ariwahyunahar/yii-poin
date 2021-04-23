<style type="text/css">
    
</style>

<div id="perface-top-wrapper" class="perface-top-wrapper">
</div>
<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">

<div id="content-detail-all-<?php echo $idpage ?>" class="page" >
					
					<h2 class="title"> <?php echo $title ?> </h2>
					
					<div style="float: left;position: relative;width: 100%">
						<ul style="list-style: none outside none;margin: 10px 0;padding: 0;width: 100%;">
						<?php foreach($results as $rslt){ ?>
						<?php $img = @fopen("http://hris.mdmedia.co.id/pic/".$rslt['emp_id'].".jpg", "r") ?>
							<?php if($img){ ?>
								<li style="float: left;height: 300px;width: 450px;">
									<table cellpadding="5" cellspacing="0"><tr><td><img src="http://hris.mdmedia.co.id/pic/<?php echo $rslt['emp_id'] ?>.jpg" width="150px"></td>
									<td><div style="padding: 0 5px 5px 5px;">
										<table width="260px">
										<tr><td width="25%" style="font-size: 14px;font-weight: bold;">Nama</td><td width="5%" style="font-size: 14px;font-weight: bold;">:</td><td width="70%" style="font-size: 14px;font-weight: bold;"><?php echo $rslt['emp_name'] ?></td></tr>
										<tr><td>Jabatan</td><td>:</td><td><?php echo $rslt['position_desc'] ?></td></tr>
										<tr><td>Dept/Div</td><td>:</td><td><?php echo $rslt['dept_name'] ?></td></tr>
										<tr><td>Tgl Masuk</td><td>:</td><td><?php echo $rslt['hire_date_out'] ?></td></tr>
										</table>
									</div></td>
									</tr></table>
								</li>
							<?php }else{ ?>
								<li style="float: left;height: 300px;width: 450px;">
									<table cellpadding="5" cellspacing="0"><tr><td><img src="images/blank_cow.jpg" width="150px"></td>
									<td><div style="padding: 0 5px 5px 5px;">
										<table width="260px">
										<tr><td width="25%" style="font-size: 14px;font-weight: bold;">Nama</td><td width="5%" style="font-size: 14px;font-weight: bold;">:</td><td width="70%" style="font-size: 14px;font-weight: bold;"><?php echo $rslt['emp_name'] ?></td></tr>
										<tr><td>Jabatan</td><td>:</td><td><?php echo $rslt['position_desc'] ?></td></tr>
										<tr><td>Dept/Div</td><td>:</td><td><?php echo $rslt['dept_name'] ?></td></tr>
										<tr><td>Tgl Masuk</td><td>:</td><td><?php echo $rslt['hire_date_out'] ?></td></tr>
										</table>
									</div></td>
									</tr></table>
								</li>
							<?php } ?>
						<?php } ?>
						</ul>
					</div>
					
				</div>
		<div id="postscript-right" class="grid_8">
		</div>
	</div>
</div>
<div class="clear"></div>