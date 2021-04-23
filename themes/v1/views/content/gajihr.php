<style type="text/css">
	#paym table td {
		font: normal 12px tahoma, verdana, helvetica;
	}
	
	#paym {
		width: 980px;
	}
	
	#paym_bulan {
	}
	
	#bns_bulan {
		width: 400px;
	}
	
	a.paym_pdf {
		background: #fff url(/pdf.png) top left no-repeat; 
		background-size:20px 20px;
		text-align: center;
		padding: 5px;
		padding-left: 25px;
		padding-bottom: 25px;
    }
</style>

<?php

function descPeriod($period){
	$bln = substr($period, 4, 2);
	$th = substr($period, 0, 4);
	switch ($bln){
		case '01':
			return "Januari ".$th;
			break;
		case '02':
			return "Februari ".$th;
			break;
		case '03':
			return "Maret ".$th;
			break;
		case '04':
			return "April ".$th;
			break;
		case '05':
			return "Mei ".$th;
			break;
		case '06':
			return "Juni ".$th;
			break;
		case '07':
			return "Juli ".$th;
			break;
		case '08':
			return "Agustus ".$th;
			break;
		case '09':
			return "September ".$th;
			break;
		case '10':
			return "Oktober ".$th;
			break;
		case '11':
			return "Nopember ".$th;
			break;
		case '12':
			return "Desember ".$th;
			break;
		default:
			return "Salah ".$th;
			break;
	}
}

?>

<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
	<div id="postscript" class="container_24">

<div id="content-detail-all-<?php echo $idpage ?>" class="page" >
					
					<h2 class="title"> E-Slip [ HR ] </h2> <small><i>Halaman khusus HR</i></small>
					<div style="float: left;position: relative;width: 100%">
<div style="text-align: center;padding: 20px;">

<table>
<tr>
<td width="150px">Periode Gaji</td>
<td width="10px">:</td>
<td>
	<select name="mydropdown" id="paym_bulan">
		<?php foreach($periods as $hsl){ ?>
			<option value="<?php echo $hsl; ?>" <?php if($period == $hsl){ echo 'selected="selected"'; } ?> ><?php echo descPeriod($hsl); ?></option>
		<?php } ?>
	</select>
	
		<select name="user_id" id="user_id">
			<option value="">-- Pilih User --</option>
		</select>
	    <!-- <input type="submit" value="Tampilkan" name="period" id="frm1_submit" />  -->
	    <input type="submit" value="Export PDF" name="period" onclick="exportPDF()" id="frm1_submit" />
</td>
</tr>
<!--
<tr>
<td>Lainya</td>
<td>:</td>
<td>

	<select name="mydropdown2" id="bns_bulan">
		<?php if(!$periodsbonus){ ?>
			<option value="" >------</option>
		<?php }else{ ?>
			<?php foreach($periodsbonus as $hsl){ ?>
				<option value="<?php echo $hsl->BNS_PERIOD; ?>" <?php if($period == $hsl->BNS_PERIOD){ echo 'selected="selected"'; } ?> ><?php echo $hsl->BNS_PERIOD.' - '.$hsl->DESCRIPTION; ?></option>
			<?php } ?>
		<?php } ?>	</select>
		
	    <input type="submit" value="Export PDF" name="period" onclick="exportPDFGaji()" id="frm2_submit" />
</td>
</tr>
-->

<!--
<tr>
<td>Simulasi VSP</td>
<td>:</td>
<td>
	    <input type="submit" value="Download Simulasi VSP" name="simulasi" onclick="simulasi()" id="frm3_submit" />
</td>
</tr>
-->
</table>
	
</div>




						
					</div>
					
				</div>
		<div id="postscript-right" class="grid_8">
		</div>
	</div>
</div>
<div class="clear"></div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#paym_bulan").change(function() {
			getuserlistbypreiod(this.value);
		});
		
		getuserlistbypreiod('<?php echo date('Ym') ?>');
	});
	
	function getuserlistbypreiod(period = ''){
        $('#user_id').html('');
		$.ajax({
			url:'/gajihr/getuser',
			data:{ period: period },
			type:'POST',
			dataType:"html",
			success:function(response){
				$('#user_id').html(response);
			},
			error:function(data){

			}
		});
	}

	function exportPDF()
    {
    	var xx = document.getElementById('paym_bulan').value;
    	var period = xx;
    	window.open('/gajipdf?period='+period);
    }
    
    function exportPDFGaji()
    {
    	var bns_bulan = document.getElementById('bns_bulan').value;
    	window.open('/bonuspdf?period='+bns_bulan);
    }
    function simulasi()
    {
    	window.open('/getsimulasipendi');
    }
</script>