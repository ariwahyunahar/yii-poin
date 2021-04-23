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

<div id="content-detail-all-<?php echo 'spt' ?>" class="page" >
					
					<h2 class="title">SPT Tahunan</h2>
					<div style="float: left;position: relative;width: 100%">
<div style="text-align: center;padding: 20px;">

<table>
<tr>
<td width="150px">Tahun SPT</td>
<td width="10px">:</td>
<td>
	<select name="mydropdown" id="paym_bulan">
		<?php for($th = date('Y')-1;$th > (date('Y')-5);$th--){ ?>
			<option value="<?php echo $th; ?>" ><?php echo $th; ?></option>
		<?php } ?>
	</select>
	    <!-- <input type="submit" value="Tampilkan" name="period" id="frm1_submit" />  -->
	    <input type="submit" value="Download" name="period" onclick="exportPDF()" id="frm1_submit" />
</td>
</tr>


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
    	var th = document.getElementById('paym_bulan').value;
    	window.open('/downloadfilesptpertahun?th='+th);
    }
    
</script>