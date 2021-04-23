<style type="text/css">
	#paym table td {
		font: normal 12px tahoma, verdana, helvetica;
	}
	
	#paym {
		width: 980px;
	}
	
	#paym_bulan {
		padding: 0px;
	}
	
	#bns_bulan {
		padding: 0px;
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
	.table td {
		vertical-align: middle !important;
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

<div class="page" >
					
					<h2 class="title">Download SK Pekerja</h2>
					<div style="float: left;position: relative;width: 100%">
<div style="text-align: center;padding: 20px;" class="table">

<table width="100%">
<tr>
<td width="150px">List SK</td>
<td width="10px">:</td>
<td>
	<select name="period" id="period" style="width: 40%;">
	<?php if($getsk){ ?>
		<?php foreach($getsk as $hsl){ ?>
			<option value="<?php echo $hsl['period']; ?>"><?php echo $hsl['name']; ?></option>
		<?php } ?>
	<?php } ?>
	</select>
	    <!-- <input type="submit" value="Tampilkan" name="period" id="frm1_submit" />  -->
	    <input type="submit" value="Export PDF" name="period" onclick="exportPDF()" id="frm1_submit" />
</td>
</tr>

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
	function exportPDF()
    {
    	var xx = document.getElementById('period').value;
    	var period = xx;
    	window.open('/sksk/download?period='+period);
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