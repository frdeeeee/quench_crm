<?php
/**
 * 这个类是代表申请人上传的文件的类。每个申请人需要上传多个文件，这里面保存了每个文件对应的申请人以及更新的时间，最后的评论或者反馈
 */
class ApplicantFile extends AppModel{
	public $name = 'ApplicantFile';
	public $belongsTo = array(
			'Applicant',
			'DownloadFile'=>array(
				'foreignKey'=>'download_file_id'
			));
	
	public function pass($af_id = NULL, $applicant_id = NULL,$phase_id = NULL){
		$ds = $this->getDataSource();
		$ds->begin();
		$this->id = $af_id;
		$result = FALSE;
		if ($this->saveField('is_passed', 1)) {
			//开始通过站内短信来发送通知消息
			$temp = $this->read();
			//取得文件的名称和收信学生的enquiry id
			$bean = array(
				'ShortMessage'=>array(
					'receiver_id'=>$temp['Applicant']['enquiry_id'],
					'content'=>'您提交的文件，"'.$temp['DownloadFile']['title'].'"已经通过老师的审批。'
				)
			);
			App::uses('ShortMessage', 'Model');
			$sm = new ShortMessage();
			if( $sm->save($bean) ){
				$result = TRUE;
				$ds->commit();
			}else{
				$ds->rollback();
			}
		}
		return $result;
	}
	
	public function reject($af_id = NULL, $applicant_id = NULL,$phase_id = NULL){
		$ds = $this->getDataSource();
		$ds->begin();
		$this->id = $af_id;
		$result = FALSE;
		if ($this->saveField('is_passed', 0)) {
			//开始通过站内短信来发送通知消息
			$temp = $this->read();
			//取得文件的名称和收信学生的enquiry id
			$bean = array(
				'ShortMessage'=>array(
					'receiver_id'=>$temp['Applicant']['enquiry_id'],
					'content'=>'您提交的文件，"'.$temp['DownloadFile']['title'].'"没有通过老师的审批，请立即查看原因。'
				)
			);
			App::uses('ShortMessage', 'Model');
			$sm = new ShortMessage();
			if( $sm->save($bean) ){
				$result = TRUE;
				$ds->commit();
			}else{
				$ds->rollback();
			}
		}
		return $result;
	}
}