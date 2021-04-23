<?php
	if($userLogin == 'Administrator'):
		echo $userLogin;
	else:
		/*
		foreach($userLogin as $u): 
			echo '&nbsp;Selamat Datang, '.$u->name;
		endforeach;*/
		//echo $userLogin->name;
		
		if(empty($userLogin)){
			echo 'Unknown User';
		} else {
			echo $userLogin->name;
		}
		
	endif;
	
?>