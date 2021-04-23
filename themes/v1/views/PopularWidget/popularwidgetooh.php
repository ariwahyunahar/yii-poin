<div class="ariwa_berita1">
	<div class="ariwa_inner_judul"><?php echo $title; ?></div>
	<div class="ariwa_berita_isi">
		<ul>
		
		<?php foreach ($popularnews as $b): ?>
			<li>
				<span style="font-size: 10px;color: red;"><?php echo Yii::app()->util->dateInd($b->update_time); ?></span><br />
				<a href="<?php echo Yii::app()->request->baseUrl; ?>/news/newspopular/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div class="ariwa_inner_footer">
		<div class="ariwa_inner_footer_a1"><a href="<?php echo Yii::app()->request->baseUrl; ?>/newspopular" class="ariwa_next">Lihat Semua Berita Populer</a></div>
	</div>
</div>