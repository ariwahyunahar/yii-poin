<?php

class PollingController extends Controller
{

	public function actionVote()
	{
//		echo '<pre>';print_r($_POST);die();
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'active = 1';
		$polling = Polling::model()->find($criteria);
		
		if(isset($_POST)){
			if(!empty($_POST['PortletPollVote_choice_id'])){
				
				$model = new MemberVote;
				$model->create_time = date('Y-m-d h:i:s');
				$model->member_id = Yii::app()->session['usr_id'];
				$model->polling_id = $_POST['polling_id'];
				$model->polling_choice_id = $_POST['PortletPollVote_choice_id'][0];
				if($model->validate()) $model->save();
				
				$model2 = new MemberVote;
				$model2->create_time = date('Y-m-d h:i:s');
				$model2->member_id = Yii::app()->session['usr_id'];
				$model2->polling_id = $_POST['polling_id'];
				$model2->polling_choice_id = $_POST['PortletPollVote_choice_id'][1];
				if($model2->validate()) $model2->save();
				
				echo '<script>alert("Terima kasih atas partisipasi anda.");window.location = "http://'.$_SERVER['SERVER_NAME'].'";</script>';
				
			} else {
				$this->redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
	}

}

?>