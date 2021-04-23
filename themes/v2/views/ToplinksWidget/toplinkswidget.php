<div id="top-links" class="grid_18">
    <div class="inner" >
    
    <ul class="menu">
    
    	<!--
        <li class="leaf"><a class="auto-gravity" href="http://jkta01.infomedia.web.id/" target="new" id="menu-memodinas" title="Memo Dinas">Memo Dinas</a></li>
        <li class="leaf"><a class="auto-gravity" onclick="javascript: window.open('http://jktm01.infomedia.web.id/mytodo.nsf/mymail?OpenForm', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false"  href="#" id="menu-email" title="Email">Email</a></li>
        <li class="leaf"><a class="auto-gravity" href="http://helpdesk.infomedia.web.id" target="new" id="menu-ithelpdesk" title="IT Helpdesk">IT Helpdesk</a></li>
        <li class="leaf"><a class="auto-gravity" href="http://172.9.1.78/hris/default.asp" target="new" id="menu-hris" title="HRIS">HRIS</a></li>
        <li class="leaf"><a class="auto-gravity" href="http://jkta03.infomedia.web.id/cuti/esscuti.nsf" target="new" id="menu-cutiizin" title="Cuti & Izin"">Cuti & Izin</a></li>
        <li class="leaf last"><a class="auto-gravity" href="http://scm.infomedia.web.id/" target="new" id="menu-scm" title="SCM">SCM</a></li>
        -->
        
        <?php 
			$c = count($toplinks);
			$i = 0;
			foreach($toplinks as $b): 
			$i++;
		?>
        
        <?php if($b->title == 'email'): ?>
        	
            <li class="leaf"><a class="auto-gravity" onclick="javascript: window.open('<?php echo $b->slug; ?>', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false" href="#" id="menu-<?php echo $b->title; ?>" title="<?php echo $b->name; ?>"><?php echo $b->name; ?></a></li>
            
        <?php else: ?>
        
        	<li class="leaf <?php if($i == $c): echo 'last'; endif; ?> ">
           	 <a class="auto-gravity" href="<?php echo $b->slug; ?>" target="new" id="menu-<?php echo $b->title; ?>" title="<?php echo $b->name; ?>"><?php echo $b->name; ?></a>
            </li>
        
        <?php endif; ?>
        
        
        <?php endforeach; ?>
        
    </ul>
    
    </div>
</div>