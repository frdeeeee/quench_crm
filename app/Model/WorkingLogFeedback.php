<?php
	class WorkingLogFeedback extends AppModel{
		public $name = 'WorkingLogFeedback';
		public $useTable = 'workinglogs_feedbacks';
		public $belongsTo = array('User','WorkingLog');
		public $order = array('WorkingLogFeedback.id DESC');
		
		/**
		 * 保存新的批示，同时还要在WorkingLog中更新new_feedback字段
		 * @param mix $bean
		 */
		public function add_feedback($bean = NULL){
			$ds = $this->getDataSource();
			$ds->begin();
			$flag = false;
			if ($this->save($bean)) {
				App::uses('WorkingLog', 'Model');
				$wl = new WorkingLog();
				$wl->id = $bean['WorkingLogFeedback']['working_log_id'];
				if ($wl->saveField('new_feedback', 1)) {
					$flag = true;
				}
			}
			if ($flag) {
				$ds->commit();
			}else{
				$ds->rollback();
			}
			return $flag;
		}
	}