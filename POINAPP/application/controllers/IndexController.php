<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		$user_id = $_GET['user_id'];
		$poll_id = 1;
		if(!$user_id){
			$this->_redirect("/halaman");
		}
		
		$con = new Model_AuthAdapter();
		$con->authenticate($user_id, $poll_id);
	}

	public function survey1Action()
	{
		$session = Model_AuthAdapter::getAllSession();
		 
		$con = new Model_Survey_PollQuetion();
		$results = $con->getAllData($session['POLL_ID']);
		$this->view->results = $results;
	}
}

