<?php 
class DateWidget extends CWidget {
	public $title = array();
	public $now = array();

	protected function registerClientScript()  {
	}
	public function run() {

		$hari = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
		$dayen = array('/Monday/', '/Tuesday/', '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/');
		$bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		$monthen = array('/January/', '/February/', '/March/', '/April/', '/May/', '/June/', '/July/', '/August/', '/September/', '/October/', '/November/', '/December/');
		$day = date('l');
		$month = date('F');
		$now = preg_replace($dayen, $hari, $day).',&nbsp;'.date('j').'&nbsp;'.preg_replace($monthen, $bulan, $month).'&nbsp;'.date('Y');
		$vars= array('title'=> $this->title, 'now'=> $now ); $this->render('datewidget', $vars); 
	}
}