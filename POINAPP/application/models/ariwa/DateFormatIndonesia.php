<?php
class Model_ariwa_DateFormatIndonesia
{
	public static function getDayByNumOfDay($num = null){
		if(!$num){
			return '';
		}
		$num = (int)$num;
		$con = new Model_ariwa_DateFormatIndonesia();
		$return = $con->getDay($num);
		
		return $return;
	}
	
	public static function getLengkapDayByDate($date = 'yyyy-mm-dd'){
		if($date=='yyyy-mm-dd'){
			return '';
		}
		$return = '';
		
		$time = strtotime($date);
		$hari = date('d',$time);
		$bulan = date('m',$time);
		$tahun = date('Y',$time);
		
		$day = date( "w", $time);
		
		$con = new Model_ariwa_DateFormatIndonesia();
		$return = $con->getDay($day);
		$bln = $con->getMonth($bulan);
		
		return $return.", ".$hari." ".$bln." ".$tahun;
	}
	
	public static function getLengkapDayByDateTime($date = 'yyyy-mm-dd H:i:s'){
		if($date=='yyyy-mm-dd'){
			return '';
		}
		$return = '';
		
		$time = strtotime($date);
		$hari = date('d',$time);
		$bulan = date('m',$time);
		$tahun = date('Y',$time);
		
		$jam = date('H:i',$time);
		$day = date( "w", $time);
		
		$con = new Model_ariwa_DateFormatIndonesia();
		$return = $con->getDay($day);
		$bln = $con->getMonth($bulan);
		
		return $return.", ".$hari." ".$bln." ".$tahun." ".$jam;
	}
	
	public function getDay($numday){
		
		$return = '';
		switch ($numday){
			case 0:
				$return = 'Minggu';
				break;
			case 1:
				$return = 'Senin';
				break;
			case 2:
				$return = 'Selasa';
				break;
			case 3:
				$return = 'Rabu';
				break;
			case 4:
				$return = 'Kamis';
				break;
			case 5:
				$return = 'Jumat';
				break;
			case 6:
				$return = 'Sabtu';
				break;
		}
		return $return;
	}
	
	public function getMonth($numday){
		
		$return = '';
		switch ($numday){
			case 1:
				$return = 'Januari';
				break;
			case 2:
				$return = 'Februari';
				break;
			case 3:
				$return = 'Maret';
				break;
			case 4:
				$return = 'April';
				break;
			case 5:
				$return = 'Mei';
				break;
			case 6:
				$return = 'Juni';
				break;
			case 7:
				$return = 'Juli';
				break;
			case 8:
				$return = 'Agustus';
				break;
			case 9:
				$return = 'September';
				break;
			case 10:
				$return = 'Oktober';
				break;
			case 11:
				$return = 'Nopember';
				break;
			case 12:
				$return = 'Desember';
				break;
		}
		return $return;
	}
}