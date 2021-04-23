<?php //print_r($birthday);die();
//echo date('n').'-'.date('j');
//die();
 ?>
<div class="ariwa_ulang_tahun">
	<div class="ariwa_inner_judul">Yang Berulang Tahun Hari Ini</div>
	<div class="ariwa_ulang_tahun_isi">
	<?php if($birthday){ ?>
		<ul>
			<?php foreach($birthday as $b) { ?>
				<?php if($b['born_date'] == date('n').'-'.date('j')){ ?>
				<li>
					<a href="<?php echo Yii::app()->request->baseUrl.'/birthday/detail/'.$b['nik'] ?>"><?php echo $b['name'] ?></a>
				</li>
				<?php } ?>
			<?php } ?>
		</ul>
	<?php }else{ ?>
		Tidak ada yang berulang tahun hari ini.
	<?php } ?>
	</div>
	<div class="ariwa_inner_footer">
		<div class="ariwa_inner_footer_a1"><a href="<?php echo Yii::app()->request->baseUrl; ?>/birthday" class="ariwa_next">Lihat Semua Yang Berulang Tahun</a></div>
	</div>
</div>