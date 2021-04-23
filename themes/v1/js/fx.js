$(document).ready(function(){
	
	if ($('#Search_keyword').length > 0) {
		$('#Search_keyword').focus(function() {
			if ($(this).val() == 'Cari konten ...') $(this).val('');
		});
		$('#Search_keyword').blur(function() {
			if ($(this).val() == '') $(this).val('Cari konten ...');
		});
	}
	
	if ($('#ComentForm_body').length > 0) {
		$('#ComentForm_body').focus(function() {
			if ($(this).val() == 'isi komentar...') $(this).val('');
		});
		$('#ComentForm_body').blur(function() {
			if ($(this).val() == '') $(this).val('isi komentar...');
		});
	}
	
	// Newsflash
	$('#content-row .inner').cycle({ 
		fx:     'turnUp', 
		speed:  'slow', 
		timeout: 5000, 
		next:   '#nextNewsFlash', 
		prev:   '#prevNewsFlash' 
	});
	
	
	// Splashed
	$('#slideshow').after('<div id="navSplash">').cycle({ 
		fx:     'fade', 
		speed:  'fast', 
		timeout: 5000, 
        next:   '#nextSplash', 
        prev:   '#prevSplash',
        pager:  '#navSplash', 
		
		// callback fn that creates a thumbnail to use as pager anchor 
        pagerAnchorBuilder: function(idx, slide) { 
			var img = jQuery(slide).find('img');
            return '<li><a href="#"><img src="' + img.attr('src') + '" width="70" height="47" /></a></li>'; 
        }
		
	});
	
	
	// Gallery
	$('#SlideGallery').after('<ul id="navSlide">').cycle({ 
		fx:     'fade', 
		speed:  'fast', 
		timeout: 5000, 
        next:   '#nextSplash', 
        prev:   '#prevSplash',
        pager:  '#navSlide', 
		
		// callback fn that creates a thumbnail to use as pager anchor 
        pagerAnchorBuilder: function(idx, slide) { 
			var img = jQuery(slide).find('img');
            return '<li><a href="#"><img src="' + img.attr('src') + '" width="130" height="93" /></a></li>'; 
        }
		
	});
	
	// Gallery Detail
	$('#SlideDetailGallery').after('<ul id="navSlideDetail">').cycle({ 
		fx:     'fade', 
		speed:  'fast', 
		timeout: 0, 
        next:   '#nextSplashSlide', 
        prev:   '#prevSplashSlide',
        pager:  '#navSlideDetail', 
		
	});
	
	
	//tab description content
	$("#tabs").tabs();
	$("#tabs-gallery").tabs();
	
	
	$('#auto-gravity').tipsy({gravity: $.fn.tipsy.autoNS});
	
    $('.auto-gravity').tipsy({gravity: $.fn.tipsy.autoNS});
    
	
	
	
	
	
	//Examples of how to assign the ColorBox event to elements
	$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	
	//Example of preserving a JavaScript event for inline calls.
	$("#click").click(function(){ 
		$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
		return false;
	});
	
	$('#navSlide').jScrollPane();
	$('.scroll').jScrollPane();
	$('#hightlights .inner').jScrollPane();
	//$('#BirthDay.BirthDay .inner').jScrollPane();
	
	
	
	
	
	
	//Examples of how to assign the ColorBox event to elements
	$(".group1").colorbox({rel:'group1'});
	$(".group2").colorbox({rel:'group2', transition:"fade"});
	$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
	$(".group4").colorbox({rel:'group4', slideshow:true});
	$(".ajax").colorbox();
	$(".youtube").colorbox({iframe:true, innerWidth:425, innerHeight:344});
	
	//$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	
	$(".iframe").colorbox({
		iframe:true, width:"70%", height:"90%", onClosed:function(){ location.reload(true) } 
		
	});
	
	$(".inline").colorbox({inline:true, width:"50%"});
	$(".callbacks").colorbox({
		onOpen:function(){ alert('onOpen: colorbox is about to open'); },
		onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
		onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
		onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
		onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
	});
	
	
	
	

});


$(document).ready(function() {
	if ($('.primary-root-has-sub').length > 0) {
		$('.primary-root-has-sub').each(function() {
			var idAttr = $(this).attr('id').split('-');
			var id = idAttr[idAttr.length-1];
			if ($('#primary-sub-'+id).length > 0) {
				$(this).parent().append($('#primary-sub-'+id));
				
				$(this).click(function() {
					//return false;
				});
				$(this).mouseover(function() {
					$('#primary-sub-'+id).show();
					$(this).addClass('primary-root-active');
				});
				$(this).parent().mouseleave(function() {
					$('#primary-sub-'+id).hide();
					$(this).find('a.primary-root-active').removeClass('primary-root-active');
				});
			}
			
			if ($('a.parent-link').length > 0) {
				$('a.parent-link').each(function() {
					var parentIdAttr = $(this).attr('id').split('-');
					var parentId = parentIdAttr[parentIdAttr.length-1];
					
					$(this).mouseover(function() {
						if ($('#children-'+parentId).length > 0) {
							$('#children-'+parentId).show();
						}
					});
						
					$(this).parent().mouseleave(function() {
						$('#children-'+parentId).hide();
					});
				});
			}
		});
	}
});

$(window).load(function() {
	$('#SlideLogOn').nivoSlider();
});