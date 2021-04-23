<?php
require_once('tcpdf/tcpdf.php');
class myTcpdf2 extends TCPDF
{
	var $footer_text = "";
	var $footer_text2 = "";
	
	public function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $text_footer = '', $footer_2 = '') {
		$this->setFooterText($text_footer);
		$this->setFooterText2($footer_2);
		parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
	}
	
	public function Header() {
		$ormargins = $this->getOriginalMargins();
		$headerfont = $this->getHeaderFont();
		$headerdata = $this->getHeaderData();
		if (($headerdata['logo']) AND ($headerdata['logo'] != K_BLANK_IMAGE)) {
			$this->Image(K_PATH_IMAGES.$headerdata['logo'], '', '', $headerdata['logo_width']);
			$imgy = $this->getImageRBY();
		} else {
			$imgy = $this->GetY();
		}
		$cell_height = round(($this->getCellHeightRatio() * $headerfont[2]) / $this->getScaleFactor(), 2);
		// set starting margin for text data cell
		if ($this->getRTL()) {
			$header_x = $ormargins['right'] + ($headerdata['logo_width'] * 1.1);
		} else {
			$header_x = $ormargins['left'] + ($headerdata['logo_width'] * 1.1);
		}
		$this->SetY(7);
		$this->SetTextColor(0, 0, 0);
		// header title
		$this->SetFont($headerfont[0], 'B', $headerfont[2] + 1);
		$this->SetX(10);
		//$this->SetX($header_x - $headerdata['logo_width']+42);
		
		// ariwa
		$cell_height = $cell_height + 9;
		$this->Cell(0, $cell_height, $headerdata['title'], 0, 1, 'C', 0, '', 0);
		$cell_height = $cell_height - 9;
		// header string
		$this->SetFont($headerfont[0], $headerfont[1], 8);
		$this->SetX($header_x - $headerdata['logo_width']+42);
		$this->MultiCell(0, $cell_height, $headerdata['string'], 0, 'L', 0, 1, '', '', true, 0, false);
		// print an ending header line
		$this->SetLineStyle(array('width' => 0.85 / $this->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		$this->SetY((15 / $this->getScaleFactor()) + max($imgy, $this->GetY()));
		if ($this->getRTL()) {
			$this->SetX($ormargins['right']);
		} else {
			$this->SetX($ormargins['left']);
		}
		$this->Cell(0, 0, '', 'T', 0, 'C');
	}
	
	public function Footer()
	{
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', '', 6 );
		// Page number
		$this->Cell(0, 10, $this->getFooterText(), 0, false, 'L', 0, '', 0, false, 'T', 'M');
		$this->Cell(1, 20, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
		$this->SetY(-12);
		$this->SetFont('helvetica', '', 8 );
		$this->Cell(0, 10, $this->getFooterText2(), 0, false, 'L', 0, '', 0, false, 'T', 'M');
	}
	
	public function reFormat($format, $orientation='P'){
		parent::setPageFormat($format, $orientation);
	}
	
	public function setFooterText($t = ''){
		$this->footer_text = $t;
	}
	
	public function getFooterText(){
		return $this->footer_text;
	}
	
	public function setFooterText2($t = ''){
		$this->footer_text2 = $t;
	}
	
	public function getFooterText2(){
		return $this->footer_text2;
	}
}