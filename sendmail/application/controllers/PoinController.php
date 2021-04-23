<?php

class PoinController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$html = '';
        $x = new Model_poin_member();
        $getdata = $x->getData1WeekBeforeBirthDay();
        if($getdata){
        	$hit = 0;
        	
        	$html .= 'Berikut adalah data karyawan yang akan berulang tahun, mulai <b>besok</b> sampai <b>1 minggu</b> kedepan :<br><br>';
        	$html .= '<table  cellpadding="5" cellspacing="0" border="0">
				<tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>BornDate</th>
				<th>Email</th>
				</tr>';
        	foreach($getdata as $data){
        		$html .= '
				<tr>
				<td>'.($hit+=1).'</td>
				<td>'.$data['nik'].'</td>
				<td>'.$data['name'].'</td>
				<td>'.$data['born_date'].'</td>
				<td>'.$data['email'].'</td>
				</tr>
				';
        	}
        	$html .= '</table>';
        	$html .= '<br><br>';
        	$html .= 'Regards,<br>';
        	$html .= 'Admin';
        }
        
        $pars = array(
			"subject"=>"Remainder Ulang Tahun sampai 1 minggu kedepan"
			, "isi_html"=>$html
			, "send_to"=>array('mely.primayanti@mdmedia.co.id', 'ari.wahyu@mdmedia.co.id')
			// , "send_to"=>array('ari.wahyu@mdmedia.co.id')
			, "send_from"=>"ari.wahyu@mdmedia.co.id"
		);
		
		$con_mail = new Model_MyMailSender();
		$con_mail->sendMail($pars);
		
        die('1');
    }
    
}

