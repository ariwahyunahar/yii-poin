<?php
class Model_Help_Printr
{
	public static function printr($array = array()){
		echo '<pre>';print_r($array);die();
	}
}