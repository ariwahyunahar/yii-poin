<div class="ariwa_berita">
	<div class="ariwa_inner_judul">Berita Terkini</div>
	<div class="ariwa_berita_isi">
		<ul>
		
		<?php foreach ($latestnews as $b): ?>
			<li>
				<span style="font-size: 10px;color: red;"><?php echo Yii::app()->util->dateInd($b->update_time); ?></span><br />
				<a href="<?php echo Yii::app()->request->baseUrl; ?>/news/<?php echo $b->slug; ?>"><?php echo $b->title; ?></a>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div class="ariwa_inner_footer">
		<div class="ariwa_inner_footer_a1"><a href="<?php echo Yii::app()->request->baseUrl; ?>/news" class="ariwa_next">Lihat Semua Berita</a></div>
	</div>
</div>