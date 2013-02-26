<?php
/**
 * 这个类是用来管理上传的申请人文件的，包括upload和download
 * @author justin
 *
 */
class ApplicantFilesController extends AppController{
	public $uses = array('Applicant','ApplicantFile');
	public $name = 'ApplicantFiles';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function download($applicant_file_id=NULL){
		if ($applicant_file_id) {
			$this->ApplicantFile->id = $applicant_file_id;
			$bean = $this->ApplicantFile->read();
			if ($bean['ApplicantFile']['id']) {
				//Means the teacher has read this file
				$this->ApplicantFile->saveField('is_readed',1);
				//Find the file;
				$path_info = pathinfo(
					WWW_ROOT.'files'.DS.
					'applicants'.DS. 
					$bean['ApplicantFile']['applicant_id'].DS.
					$bean['ApplicantFile']['download_file_id'] .DS.
					$bean['ApplicantFile']['file_name']);
				
				$this->viewClass = 'Media';
			    $params = array(
			        'id' => $bean['ApplicantFile']['file_name'],
			    	'name' => $path_info['filename'],
			    	'extension'=>$path_info['extension'],
			    	'download' => TRUE,
			        'path'      => 'files' . DS .'applicants'.DS.$bean['ApplicantFile']['applicant_id'].DS. $bean['ApplicantFile']['download_file_id'] .DS
			    );
			    $this->set($params);
			}else{
				//Means the student hasn't upload his file yet
			}
		}else{
			//Means the student hasn't upload his file yet
		}
		return;
	}
	
	/**
	 * Download a template file for the student
	 * @param Integer $id: applicant file id
	 */
	public function download_template($id){
        $this->viewClass = 'Media';
	    // Render app/webroot/files/example.docx
	    $path_info = pathinfo(WWW_ROOT.'files'.DS.'example_files'.DS.$id);
	    
	    $params = array(
	        'id'        => 'example.docx',
	        'name'      => 'example',
	        'extension' => 'docx',
	        'mimeType'  => array(
	            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
	        ),
	        'path'      => 'files' . DS .'example_files'.DS
	    );
	    $this->set($params);
	}
	
	public function pass($id = NULL,$applicant_id = NULL,$phase_id=NULL){
		$msg_type = 'error';
		if ($id) {
			if($this->ApplicantFile->pass($id)){
				$this->Session->setFlash('操作成功！');
				$msg_type = 'success';
			}else{
				$this->Session->setFlash('操作失败，请稍后再试或联系管理员！');
			}
		}else{
			$this->Session->setFlash('操作失败，请稍后再试或联系管理员！');
		}
		$this->redirect(array('controller'=>'Applicants','action'=>'modify',$applicant_id,$phase_id,$msg_type));
		return;
	}
	
	public function unpass($id = NULL,$applicant_id = NULL,$phase_id=NULL){
		$msg_type = 'error';
		if ($id) {
			if($this->ApplicantFile->reject($id)){
				$this->Session->setFlash('操作成功！');
				$msg_type = 'success';
			}else{
				$this->Session->setFlash('操作失败，请稍后再试或联系管理员！');
			}
		}else{
			$this->Session->setFlash('操作失败，请稍后再试或联系管理员！');
		}
		$this->redirect(array('controller'=>'Applicants','action'=>'modify',$applicant_id,$phase_id));
		return;
	}
	
	public function leave_comments(){
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$this->ApplicantFile->id = $this->request->data['applicant_file_id'];
			if ($this->ApplicantFile->exists()) {
				$bean = array('ApplicantFile'=>array(
					'latest_comments'=>$this->request->data['Applicant_file_comments'],
					'is_readed'=>1
				));
				if($this->ApplicantFile->save($bean)){
					$this->set('data',1);
				}else{
					$this->set('data',0);
				}
			}else{
				$this->set('data',1);
			}
		}
		return;
	}
}