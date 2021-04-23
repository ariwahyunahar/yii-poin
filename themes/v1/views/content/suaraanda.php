<style type="text/css">
p{
	font-size: 1.3em;
	margin-bottom: 15px;
}

#page-wrap {
	width: 660px;
	background: white;
	padding: 20px 50px 20px 50px;
	margin: 20px auto;
	min-height: 500px;
	height: auto !important;
	height: 500px;
}

#contact-area {
	width: 600px;
	margin-top: 25px;
}

#contact-area input, #contact-area textarea {
	padding: 5px;
	width: 471px;
	font-family: Helvetica, sans-serif;
	font-size: 1.4em;
	margin: 0px 0px 10px 0px;
	border: 2px solid #ccc;
}

#contact-area textarea {
	height: 90px;
}

#contact-area textarea:focus, #contact-area input:focus {
	border: 2px solid #900;
}

#contact-area input.submit-button {
	width: 100px;
	float: right;
}

label {
	float: left;
	text-align: right;
	margin-right: 15px;
	width: 100px;
	padding-top: 5px;
	font-size: 1.4em;
}
</style>

<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
<div id="postscript" class="container_24">

<div class="page" id="content-detail-all-AplikasiPersonil">
<h2 class="title"><?php echo $title ?></h2>
<div>
</div>
<div style="float: left; position: relative; width: 100%">
<div style="text-align: center; ">

	
		<?php if($flash){ ?>
			<?php echo $flash; ?>
		<?php } ?>
				
		<div id="contact-area">		
			<form action="/suaraanda" method="post">
				<label for="name">Tanggal:</label>
				<input type="text" value="<?php echo date('Y-m-d') ?>" id="tanggal" disabled="" name="tanggal">				
				<label for="title">Bidang:</label>
				<select id="title" name="title" style="width: 485px;">
					<option value="" selected="true" style="display:none;">Pilih Bidang...</option>
				  	<option value="HCM" <?php if($post['title']=='HCM') echo 'selected="selected"'; ?>>HCM</option>
				  	<option value="IT" <?php if($post['title']=='IT') echo 'selected="selected"'; ?>>IT</option>
				  	<option value="Fasilitas - Peralatan Kerja" <?php if($post['title']=='Fasilitas - Peralatan Kerja') echo 'selected="selected"'; ?>>Fasilitas - Peralatan Kerja</option>
				</select> 
				<label for="suara">Suara Anda:</label>
				<textarea placeholder="Silahkan tuliskan suara anda disini..." id="suara" cols="40" rows="40" style="height:155px" name="suara"></textarea>
				<label for="">&nbsp;</label>
				<input type="submit" style="width:155px" name="submit" value="Submit">
				<input type="hidden" name="nik" value="101344">
			</form>			
			<div style="clear: both;"></div>		
		</div>	
	
	

</div>




</div>

</div>
<div id="postscript-right" class="grid_8"></div>
</div>
</div>
<div class="clear"></div>
