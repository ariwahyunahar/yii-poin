function mainmenu(){
$(" #nav ul ").css({display: "none"}); // Opera Fix
$(" #nav li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(300);
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
		});
}

 
 
$(document).ready(function(){					
	mainmenu();
});

$(document).ready(function(){
	
	if($('#tabs').length > 0){
		$('#tabs').tabs();
	}
	
	if($('.iframe').length > 0){
		$('.iframe').colorbox({
			iframe:true, width:'50%', height:'50%', onClosed:function(){ location.reload(true) } 
			
		});
	}
	
	/*
	$('#example-1').tipsy();
    $('#auto-gravity').tipsy({gravity: $.fn.tipsy.autoNS});
    $('.auto-gravity').tipsy({gravity: $.fn.tipsy.autoNS});
    $('#example-fade').tipsy({fade: true});
    $('#example-custom-attribute').tipsy({title: 'id'});
    $('#example-callback').tipsy({title: function() { return this.getAttribute('original-title').toUpperCase(); } });
    $('#example-fallback').tipsy({fallback: "Where's my tooltip yo'?" });
    $('#example-html').tipsy({html: true });
	*/
	
	if($(':checkbox.selectall').length > 0){
		$(':checkbox.selectall').on('click', function(){
			$(':checkbox[name=' + $(this).data('checkbox-name') + ']').prop('checked', $(this).prop('checked'));

		});
	}
	
	if ($('.editable').length > 0) {
		$('.editable').each(function() {
			var classAdd = '';
			if ($(this).hasClass('numeric')) classAdd = 'numeric';
			$(this).editable(
				baseUrl+controller+'/pollingchoice',
				{
					event: 'dblclick',
					indicator: 'Saving ...',
					placeholder: '&nbsp;',
					cssclass: classAdd
				}
			);
		});
	}
	
});

$(function() {
	$( '.datepicker' ).datepicker({ dateFormat: 'yy-mm-dd' });
});