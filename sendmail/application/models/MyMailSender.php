<?php
class Model_MyMailSender{
	var $thissession = null;
	var $transport;

	public function __construct()
	{
		$config = array('auth' => 'login',
            'username' => 'ari.wahyu@mdmedia.co.id',
            'password' => 'ariwahyunahar1',
			'ssl' => 'tls',
			'port' => 25
		);
		
		$this->transport = new Zend_Mail_Transport_Smtp('mail.mdmedia.co.id', $config);
	}
	
	public function sendMail($pars = array("subject"=>"x", "isi_html"=>"x", "send_to"=>array("ari.wahyu@mdmedia.co.id"), "send_from"=>"ari.wahyu@mdmedia.co.id", "addcc" => array(), "replay_to"=>"ari.wahyu@mdmedia.co.id"))
	{
		try{
			Zend_Mail::setDefaultFrom($pars['send_from']);
			// Zend_Mail::setDefaultReplyTo($pars['send_from']);
			
			$mail = new Zend_Mail();
			$mail->addHeader("X-Priority", "1");
			
			if($pars['send_to']){
				foreach($pars['send_to'] as $rslt){
					$mail->addTo(trim($rslt));
				}
				if(isset($pars['addcc'])){
					$mail->addCc($pars['addcc']);
				}
				$mail->setSubject($pars['subject']);
				$mail->setBodyHtml($pars['isi_html']);
				$mail->setReplyTo(isset($pars['replay_to']));
				$issend = $mail->send($this->transport);
				
				return $issend;
			}
		}catch (Zend_Mail_Transport_Exception $ex) {
			die($ex->__toString());
			// Model_hris_AttendanceLog::s_insert_log($ex->__toString(), json_encode($pars['send_to']).json_encode($pars['addcc']));
		}catch (Exception $ex) {
			die($ex->__toString());
			// Model_hris_AttendanceLog::s_insert_log($ex->__toString(), json_encode($pars['send_to']).json_encode($pars['addcc']));
		} 
		
		return true;
		
		
	}
}