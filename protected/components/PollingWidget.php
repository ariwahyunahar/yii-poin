<?php
	class PollingWidget extends CWidget
	{
		public $title = 'Polling';
		
		protected function registerClientScript()
		{
			// ...publish CSS or JavaScript file here...
			/*$cs=Yii::app()->clientScript;
			$cs->registerCssFile($cssFile);
			$cs->registerScriptFile($jsFile);*/
		}
		
	public function run() {
		
			/* ====== DEPARTEMEN ======= */
			//choose polling active
			$criteria = new CDbCriteria;
			$criteria->condition = 'id = 1' ;
			$criteria->limit = '1' ;
			$hsl_polling_dept = Polling::model()->findAll($criteria);
			
			// find total vote
			$criteria = new CDbCriteria;
			$criteria->condition = 'polling_id = 1';
			$hsl_polling_dept_total_vote = MemberVote::model()->findAll($criteria);
			// print_r(  );die();
			// count total vote
			$hsl_polling_dept_count = count($hsl_polling_dept_total_vote);
			
			/* ====== ORGANIK ======= */
			//choose polling active
			$criteria = new CDbCriteria;
			$criteria->condition = 'id = 6' ;
			$criteria->limit = '1' ;
			$hsl_polling_org = Polling::model()->findAll($criteria);
			
			// find total vote
			$criteria = new CDbCriteria;
			$criteria->condition = 'polling_id = 6';
			$hsl_polling_org_total_vote = MemberVote::model()->findAll($criteria);
			// print_r(  );die();
			// count total vote
			$hsl_polling_org_count = count($hsl_polling_org_total_vote);
			
			/* ====== NON ORGANIK ======= */
			//choose polling active
			$criteria = new CDbCriteria;
			$criteria->condition = 'id = 8' ;
			$criteria->limit = '1' ;
			$hsl_polling_norg = Polling::model()->findAll($criteria);
			
			// find total vote
			$criteria = new CDbCriteria;
			$criteria->condition = 'polling_id = 8';
			$hsl_polling_norg_total_vote = MemberVote::model()->findAll($criteria);
			// print_r(  );die();
			// count total vote
			$hsl_polling_norg_count = count($hsl_polling_norg_total_vote);
			
//			$vars= array(
//				'title'=> $this->title,
//				'polling'=> $polling,
//				'ResultVote'=> $ResultVote,
//				'TotalVote'=> $TotalVote,
//			);
			
			//choose polling active
			$criteria = new CDbCriteria;
			$criteria->condition = 'id = 6' ;
			$criteria->limit = '1' ;
			$polling_org = Polling::model()->findAll($criteria);
			
			//choose polling active
			$criteria = new CDbCriteria;
			$criteria->condition = 'id = 8' ;
			$criteria->limit = '1' ;
			$polling_norg = Polling::model()->findAll($criteria);
			
			//choose polling active
			$criteria = new CDbCriteria;
			$criteria->condition = 'id = 1' ;
			$criteria->limit = '1' ;
			$polling_dept = Polling::model()->findAll($criteria);
			
			// sudah melakukan 2 voting ??
			$usr = Yii::app()->user->name;
			$criteria = new CDbCriteria;
			$criteria->condition = "(polling_id = 1 or polling_id = 8 or polling_id = 6) and member_id = '".$usr."'";
			$countVote = MemberVote::model()->count($criteria);
			
			// apakah sudah melakukan poling employee
			$usr = Yii::app()->user->name;
			$criteria = new CDbCriteria;
			$criteria->condition = "(polling_id = 6 or polling_id = 8) and member_id = '".$usr."'";
			$usr_vote_employee = MemberVote::model()->count($criteria);
			
			$criteria = new CDbCriteria;
			$criteria->condition = "polling_id = 1 and member_id = '".$usr."'";
			$usr_vote_dept = MemberVote::model()->count($criteria);
			
			// echo '<pre>';print_r($polling_org);die();
			$vars= array(
				'title'=> $this->title,
				'polling_org'=> $polling_org,
				'polling_norg'=> $polling_norg,
				'polling_dept'=>$polling_dept,
				
				'usr_vote_employee' => $usr_vote_employee,
				'usr_vote_dept' => $usr_vote_dept
				
				,'hsl_polling_dept'=> $hsl_polling_dept
				,'hsl_polling_dept_count'=> $hsl_polling_dept_count
				,'hsl_polling_dept_total_vote'=> $hsl_polling_dept_total_vote
				
				,'hsl_polling_org'=> $hsl_polling_org
				,'hsl_polling_org_count'=> $hsl_polling_org_count
				,'hsl_polling_org_total_vote'=> $hsl_polling_org_total_vote
				
				,'hsl_polling_norg'=> $hsl_polling_norg
				,'hsl_polling_norg_count'=> $hsl_polling_norg_count
				,'hsl_polling_norg_total_vote'=> $hsl_polling_norg_total_vote
				
				,'countVote'=>$countVote
			);
			
			$this->render('pollingwidget', $vars);
		}
		
	}
?>