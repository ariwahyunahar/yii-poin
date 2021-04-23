<?php

class SurveyController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->controller_name = 'survey';
	}

	public function indexAction()
	{
		$session = Model_AuthAdapter::getAllSession();
		$con3 = new Model_Survey_PollStepUser();
		$con4 = new Model_Survey_PollStep();
		$step = $con3->getForCek(array('poll_id'=>$session['POLL_ID'], 'user_id'=>$session['USER_ID']));
		
		if($step){
			$nextstep = $con4->getStepNext($session['POLL_ID'], $step['squen']);
			switch($nextstep['step_id']){
				case 'B':
					$con = new Model_Survey_PollQuetion();
					$con2 = new Model_Survey_Poll();
					$results = $con->getAllData($session['POLL_ID']);
					$this->view->results = $results;
					$this->view->poll = $con2->getEdit(array('poll_id'=>$session['POLL_ID']));
					break;
				case 'C':
					$con5 = new Model_hris_employee();
					$users = $con5->getEmployeeByNIK($session['USER_ID']);
					$this->view->users = $users;
					$this->renderScript('survey/persetujuan.phtml');
					break;
				case 'D':
					$this->renderScript('survey/finish.phtml');
					break;
			}
		}else{
			$this->renderScript('survey/sambutan.phtml');
		}
	}

	public function saveAction()
	{
		$session = Model_AuthAdapter::getAllSession();
		unset($_POST['ACTION'], $_POST['ID']);
		if($_POST){
			$con = new Model_Survey_PollUserAnswer();
			$x = array();
			foreach($_POST as $isi){
				$expl = explode("__", $isi);
				$q_id = $expl[0];
				$answers = $expl[1];
				$data = array(
					"poll_id" => $session['POLL_ID']
					,"q_id" => $q_id
					,"answers" => $answers
					,"user_id"=> $session['USER_ID']
				);
				$x[] = $data;
				$insert = $con->insert_record($data);
			}
			// update status
			$data2 = array(
				"poll_id" => $session['POLL_ID']
				,"step_id" => 'B'
				,"squen" => 2
				,"user_id"=> $session['USER_ID']
			);
			
			$con2 = new Model_Survey_PollStepUser();
			$con2->insert_record($data2);
			
			echo json_encode(array('success'=>true, 'msg' => 'Terimakasih atas partisipasi anda.'));exit();
			break;
		}

		die('Ada kesalahan system. Kode 0');
	}
	
	public function updatestatusAction()
	{
		$session = Model_AuthAdapter::getAllSession();
		if($_POST){
			$con = new Model_Survey_PollStep();
			$getpstep = $con->getEdit(array(
				"poll_id" => $session['POLL_ID']
				,"step_id" => $_POST["step_id"]
			));
			$ket = ($_POST['ket1'] ? ($_POST['ket1'].",".$_POST['ket2'].",".$_POST['ket3']) : '-');
			if($getpstep){
				$data = array(
					"poll_id" => $session['POLL_ID']
					,"step_id" => $_POST["step_id"]
					,"squen" => $getpstep['squen']
					,"user_id"=> $session['USER_ID']
					,"ket"=> $ket
				);
			}
			
			$con2 = new Model_Survey_PollStepUser();
			$con2->insert_record($data);
			echo json_encode(array('success'=>true, 'msg' => 'Terimakasih atas partisipasi anda.'));exit();
			break;
		}

		die('Ada kesalahan system. Kode 0');
	}

}

