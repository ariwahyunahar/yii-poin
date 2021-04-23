<div class="ariwa_new_emp">
	<div class="ariwa_inner_judul">Karyawan Baru Bulan Ini</div>
	<div class="ariwa_berita_isi">
	
	<?php if($all){ ?>
		<ul>
		<?php foreach($all as $b) { ?>
				<li>
					<b><?php echo ucwords(strtolower($b['emp_name'])) ?></b> : <span style="color: red;"><?php echo $b['hire_date_out'] ?></span>
					<ul style="padding-left: 3px;margin-bottom: 5px;font-size: 10px;">
						<li style="margin-bottom: 0px;list-style-image: none;list-style-type: none;"><?php echo $b['position_desc'] ?></li>
						<li style="margin-bottom: 0px;list-style-image: none;list-style-type: none;"><?php echo $b['dept_name'] ?></li>
					</ul>
				</li>
		<?php } ?>
		</ul>
	<?php }else{ ?>
		Tidak ada karyawan baru
	<?php } ?>
	</div>
	<div class="ariwa_inner_footer">
		<div class="ariwa_inner_footer_a1"><a href="<?php echo Yii::app()->request->baseUrl; ?>/newemploye" class="ariwa_next">Lihat Semua Karyawan Baru</a></div>
	</div>
</div>