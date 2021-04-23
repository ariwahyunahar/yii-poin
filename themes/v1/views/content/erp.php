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

<div class="clear"></div>

<div id="postscript-wrapper" class="postscript-wrapper">
    <div id="postscript" class="container_24">
        <div id="content-detail-all-AplikasiPersonil" class="page" >
            <h2 class="title" style="margin-top: 10px;"> ERP  </h2>
            <div id="content-detail-all-AplikasiPersonil">
                <ul>
                    <li class="break">
                        <a class="auto-gravity" target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/getsimulasipendi?type=ERP" title="Download Simulasi ERP">
                            <img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" />
                            Download Simulasi ERP
                        </a>
                        <p>Download Simulasi ERP</p>
                        <div class="clear"></div>
                    </li>

                    <li class="break">
                        <a class="auto-gravity" target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/getsimulasipendi?type=PKB" title="Download Simulasi PKB">
                            <img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" />
                            Download Simulasi PKB
                        </a>
                        <p>Download Simulasi PKB</p>
                        <div class="clear"></div>
                    </li>
                </ul>
            </div>
            
            <div id="content-detail-all-AplikasiPersonil">
                <ul>
                    <li class="break">
                        <a class="auto-gravity" target="_blank" href="/assets/doc/ERP/2020/BAST_ASET_ERP.docx">
                            <img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" />
                            Download Form BAST ASET ERP
                        </a>
                        <p>Download Form BAST ASET ERP</p>
                        <div class="clear"></div>
                    </li>
                    <li class="break">
                        <a class="auto-gravity" target="_blank" href="/assets/doc/ERP/2020/BAST_DOKUMEN_DAN_TUGAS_PEKERJAAN_ERP.docx">
                            <img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" />
                            Download Form BAST DOKUMEN DAN TUGAS PEKERJAAN_ERP
                        </a>
                        <p>Download Form BAST DOKUMEN DAN TUGAS PEKERJAAN_ERP</p>
                        <div class="clear"></div>
                    </li>
                    <li class="break">
                        <a class="auto-gravity" target="_blank" href="/assets/doc/ERP/2020/SURAT_PERMOHONAN_ERP.docx">
                            <img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" />
                            Download Form SURAT PERMOHONAN ERP
                        </a>
                        <p>Download Form SURAT PERMOHONAN ERP</p>
                        <div class="clear"></div>
                    </li>
                    <li class="break">
                        <a class="auto-gravity" target="_blank" href="/assets/doc/ERP/2020/Komponen_Nilai_Kompensasi_PKB.pdf">
                            <img alt="icon1" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/img/download.png" />
                            Download Komponen & Nilai Kompensasi PKB
                        </a>
                        <p>Download Komponen & Nilai Kompensasi PKB</p>
                        <div class="clear"></div>
                    </li>

                </ul>


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
