<?php if(Yii::app()->user->isGuest){ 
	header("Location: /site/login");
	die();
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-site-verification" content="XAOQqQpPLk35NDh8KYSYlVK-JnlgijSpTRuTw1xuIp0" />
	<meta name="author" content="Created By ARIWA"/>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	
	<link rel="shortcut icon" href="/ariwa/np_images/icon/icon.png" type="image/x-icon" />
	
	<link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/text.css" />
	<link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/960_24_col.css" />
	
	<link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/jquery-ui.css" />
	
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/tipsy.css" />
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/colorbox.css" />
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/jquery.jscrollpane.css" />
    <link rel="stylesheet" type="text/css" href="/ariwa/np_css/css/megamenu.css" />
	
	<link rel="stylesheet" type="text/css" href="/ariwa/np_css/ariwa_main.css" />
	
	<?php if($this->pageTitle == 'Document Browser'):?>
	<?php else: ?>
		<script type="text/javascript" src="/ariwa/np_js/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/ariwa/np_js/js/jquery-ui.min.js"></script>
	<?php endif; ?>
		<script type="text/javascript" src="/ariwa/np_js/js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="/ariwa/np_js/js/jquery.jscrollpane.js"></script>
		<script type="text/javascript" src="/ariwa/np_js/js/jquery.colorbox.js"></script>
		<script type="text/javascript" src="/ariwa/np_js/js/jquery.tipsy.js"></script>
		<script type="text/javascript" src="/ariwa/np_js/js/jquery.cycle.all.latest.js"></script>
		<script type="text/javascript" src="/ariwa/np_js/js/jquery.nivo.slider.pack.js"></script>
		<script type="text/javascript" src="/ariwa/np_js/js/fx.js"></script>
	<script type="text/javascript">
	//<![CDATA[
	var baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>';
	var themeUrl = '<?php echo Yii::app()->theme->baseUrl; ?>';
	//]]>
	
	$(document).ready( function(){
	    $('#ariwa_trigger').click( function(event){
	        event.stopPropagation();
	        $('#ariwa_drop').toggle();
	    });
	    $(document).click( function(){
	        $('#ariwa_drop').hide();
	    });
	});
	</script>
</head>

<body>
		<div class="ariwa_header_info_top">
			<div class="ariwa_header_info">
				<div style="float: left;margin-left: 10px;">
					<a class="fb-sld social-slide" href="https://www.facebook.com/pages/MDMedia/370534649723981" target="_blank">&nbsp;</a>
					<a class="twiter-sld social-slide" href="https://twitter.com/mdmediaofficial" target="_blank">&nbsp;</a>
					<a class="ig-sld social-slide" href="https://www.instagram.com/mdmediaofficial/" target="_blank">&nbsp;</a>
					<a class="yt-sld social-slide" href="https://www.youtube.com/channel/UCvhVUbxrEXaPK-5jjCRuj_A" target="_blank">&nbsp;</a>
					
					
                </div>
				
				
				<div class="ariwa_header_info_tgl">
					<?php $this->beginWidget('DateWidget', array(
                                'title'=>'date',
                            )); ?><?php $this->endWidget(); ?></div>
                            
				<div class="ariwa_header_info_kotak">
				    <a href="#" id="ariwa_trigger">&nbsp;</a>
				</div>
				<div class="ariwa_header_info_kotak_2">
			    <div class="ariwa_container">
				    <div id="ariwa_drop">
				        <div class="alogout"><a href="/site/logout">Log Out</a></div>
				        <?php if(count(UssDocKhusus::anggotaDOkKhusus(Yii::app()->user->username))>0){ ?>
				        	<div class="doc_khss"><a href="/documentgm">Dokumen Khusus</a></div>
				        <?php } ?>
						
				        <?php if(count(UssDocHr::anggotaDOkHr(Yii::app()->user->username))>0){ ?>
				        	<div class="doc_khss"><a href="/documenthr">Dokumen HR</a></div>
				        <?php } ?>
                        <?php if(UssDocKhusus::anggotaMenuKhusus()){ ?>
                            <div class="doc_khss"><a href="/gajigetmain">All E-Slip</a></div>
                        <?php } ?>
				    </div>
				</div>
				</div>
				
				
				<div class="ariwa_header_info_selamat_datang"><span style="font-weight: normal;">Selamat datang, </span> 
				<?php $this->beginWidget('LoginasWidget', array(
                                'title'=>'login as',
                            )); ?>
                            <?php $this->endWidget(); ?></div>
			</div>
		</div>
		<div class="ariwa_header_main">
			<div style="float: left;margin-top: 15px;"><a href="/"><img src="/ariwa/np_images/logomdm_intern.png" width="150px" /></a>  </div>
			<!-- <div style="float: left;margin-top: 15px;"><a href="/"><img src="/ariwa/np_images/logo_2018.jpeg" width="150px" /></a>  </div> -->
			<div id="ariwa_top-links">
				<ul class="ariwa_menu">
					<li><a target="_balnk" id="ariwa_menu_md" href="https://notadinas.mdmedia.co.id/">Nota Dinas</a></li>
					<li><a id="ariwa_menu_email" href="https://outlook.office.com/mail/inbox" target="_balnk" >Email</a></li>
					<!-- <li><a target="_balnk" id="ariwa_menu_hd" href="http://helpdesk.mdmedia.co.id">IT Helpdesk</a></li> -->
					<li><a target="_balnk" id="ariwa_menu_hris" href="http://hris.mdmedia.co.id/">HRIS</a></li>
					<li><a target="_balnk" id="ariwa_menu_cuti" href="http://cuti.mdmedia.co.id">Cuti & Izin</a></li>
					<!-- <li><a target="_balnk" id="ariwa_menu_scm" href="http://scm.mdmedia.co.id/">SCM</a></li> -->
					<!-- <li><a target="_balnk" id="ariwa_menu_suaraanda" href="http://ticket.mdmedia.co.id/">Ticket Support</a></li> -->
					<li><a target="_balnk" id="ariwa_menu_k360" href="https://cbhrm.telkom.co.id/index.php?r=site/login">K360</a></li>				
				</ul>
			</div>
		</div>
		
		<div>
			<div class="ariwa_menu_kedua">
				<div class="ariwa_menu_kedua_masuk">
					<div class="ariwa_menu_home"><a href="/">&nbsp;</a></div>
					<div style="float: right;margin-left: 10px;">
						<div id="w2b-searchbox">
						<form id="w2b-searchform" action="/search" method="get">
						    <input type="text" id="s" name="search-keyword" value="Search..." onfocus='if (this.value == "Search...") {this.value = ""}' onblur='if (this.value == "") {this.value = "Search...";}'/>
						</form>
						</div>
					</div>
					<ul class="arrowunderline">
					<li><a href="/appservice">Aplikasi Kedinasan</a></li>
					<li><a href="/apppersonil">Aplikasi Personil</a></li>
					<li><a href="/news">Berita dan Informasi</a></li>
					<li><a href="/article">Artikel</a></li>
					<li><a href="/document">Dokumen</a></li>	
					<li><a href="/gallery">Galeri</a></li>
					<li><a href="/ebook">E-Book</a></li>
					</ul>
					
				</div>
			</div>
		</div>
		
		<?php echo $content; ?>
		
		<div class="ariwa_footer">
			
		</div>
		
</body>

</html>

