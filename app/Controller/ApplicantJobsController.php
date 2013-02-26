<?php
require_once 'ApplicantEventListener.php'; //这个是专门监听和响应和applicant有关操作的消息的
class ApplicantJobsController extends AppController{
	public $uses = array('Applicant','ApplicantJob','ApplicantFile','DownloadFile');
	public $name = 'ApplicantJobs';
	public $components = array('FileUploader');
	
	public function beforeFilter(){
		parent::beforeFilter();
		if (in_array($this->action, array('upload_job_offer'))) {
			$listener = new ApplicantEventListener();
			$this->ApplicantFile->getEventManager()->attach($listener);
		}
	}
	
//运营部修改报名客户的合同和申请费信息的ajax方法
	public function ajax_save_app_job(){
		if ($this->request->is('ajax')) {
			$bean = $this->ApplicantJob->find('first',array('conditions'=>array(
				'ApplicantJob.applicant_id' => $this->request->data['applicant_id']
			)));
			$this->ApplicantJob->id = $bean['ApplicantJob']['id'];
			$bean=array('ApplicantJob'=>array());
			foreach ($this->request->data as $key=>$value) {
				$bean['ApplicantJob'][$key]=$value;
			}
			if ($this->ApplicantJob->save($bean)) {
				$this->set('data',1);
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_save_app_job','ajax');
		}
		return;
	}
	
	public function upload_job_offer(){
		if (!empty($this->request->data)) {
			//pr($this->request->data);
			//Check if the record has existed
			$result = $this->FileUploader->save($this->request->data);
			if ( $result === SUCCESS ) {
				//保存成功;接下来写到数据库中
				$temp = $this->ApplicantFile->find(
						'first',array('conditions'=>array(
								'AND'=>array(
									'ApplicantFile.applicant_id'=>$this->request->data['ApplicationFile']['applicant_id'],
									'ApplicantFile.download_file_id'=>$this->request->data['ApplicationFile']['download_file_id']
						))));
				//检查是否已经有记录存在
				if ($temp) {
					//已经有记录了，先是更新操作;
					$this->ApplicantFile->id = $temp['ApplicantFile']['id'];
					$bean = array('ApplicantFile'=>array(
							'file_name' => trim($this->request->data['Applicant']['application_form']['name']),
							'is_updated' => 1
					));
				}else{
					//没有，表示要插入一新的记录
					$this->DownloadFile->id = $this->request->data['ApplicationFile']['download_file_id'];
					$bean = array('ApplicantFile'=>array(
							'applicant_id' => $this->request->data['ApplicationFile']['applicant_id'],
							'file_name' => trim($this->request->data['Applicant']['application_form']['name']),
							'download_file_id' => $this->request->data['ApplicationFile']['download_file_id'],
							'phase_id' => $this->DownloadFile->field('phase_id')  //把这个文件属于哪个阶段也保存起来
							));
				}
				
				if ($this->ApplicantFile->save($bean)) {
					$this->Session->setFlash('文件已经成功保存！');
					$msg_type = 'success';
				}else{
					$this->Session->setFlash('数据库故障，无法保存您上传的文件，请稍候再试或联系优势的老师！');
					$msg_type = 'error';
				}
			}else{
				switch ($result) {
					case WRONG_FILE_TYPE:
						$this->Session->setFlash('您上传的文件格式不对，请使用Word文件或者PDF文件，或联系优势的老师！');
						$msg_type = 'error';
					break;
					
					case SAVE_UPLOAD_FILE_FAILED:
						$this->Session->setFlash('系统繁忙，无法保存您上传的文件，请稍候再试或联系优势的老师！！');
						$msg_type = 'error';
						break;
					
					default:
						$this->Session->setFlash('系统故障，无法保存您上传的文件，请稍候再试或联系优势的老师！！');
						$msg_type = 'error';
					break;
				}
			};
			$this->redirect(array(
						'controller'=>'Applicants',
						'action'=>'modify',
						$this->request->data['ApplicationFile']['applicant_id'],
						$this->request->data['ApplicationFile']['phase_id'],
						$msg_type
					)
			);
		}
		return ;
	}
}