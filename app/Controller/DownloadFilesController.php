<?php
class DownloadFilesController extends AppController{
	public $uses = array('DownloadFile');
	public $name = 'DownloadFiles';
	public $components = array('FileUploader');
	
	public $paginate = array(
			'limit' => 20,
			'order' => array(
				'DownloadFile.title'=>'ASC'
			),
			'recursive' => 1
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('current_menu','filemanagers');
	}
	
	public function publish($id=NULL){
		$this->DownloadFile->id = $id;
		if ($this->DownloadFile->exists()) {
			if ($this->DownloadFile->field('available')==1) {
				$this->DownloadFile->saveField('available',0);
			}else{
				$this->DownloadFile->saveField('available',1);
			}
		}
		$this->redirect('list_all');
		return;
	}
	
	public function modify(){
		if ($this->request->is('ajax')) {
			$this->DownloadFile->id = $this->request->data['id'];
			if ($this->DownloadFile->exists()) {
				$result = $this->DownloadFile->save(
					array('DownloadFile'=>array(
						'title'=>$this->request->data['title'],
						'notes'=>$this->request->data['notes']
					))
				);
				if($result){
					$this->set('data',$this->request->data['id']);
				}else{
					$this->set('data',0);
				}
			}else{
				$this->set('data',0);
			}
			$this->render('ajax_result','ajax');
		}
	}
	
	public function remove_phiscally($id = NULL,$deleted_status=0){
		if ($id) {
			$this->DownloadFile->id = $id;
			if ( $this->DownloadFile->exists() ) {
				if($this->DownloadFile->delete()){
					$this->Session->setFlash('Your file has been removed successfully. ');
					$this->redirect(array('action'=>'list_all',0,'success'));
				}else{
					$this->Session->setFlash('Can not remove your file, please try later. ');
					$this->redirect(array('action'=>'list_all',0,'error'));
				}
			}
		}
		return;
	}
	
	public function list_all($user_id = NULL,$msg_type = NULL){
		if ($user_id) {
			$this->paginate['conditions'] = array(
				'DownloadFile.user_id'=>$user_id,
			);
		}
		$this->set('data',$this->paginate('DownloadFile'));
		if ($msg_type) {
			$this->set('msg_type',$msg_type);
		}
		return;
	}
	
	public function add(){
		if (!empty($this->request->data)) {
			if (
				strlen($this->request->data['DownloadFile']['application_form']['name'])==0 ||
				$this->request->data['DownloadFile']['application_form']['size']==0
			){
				//something wrong with the uploaded file
				$result = FAILED;
			}else{
				$result = $this->FileUploader->save_download_file($this->request->data);
			}
			
			if ($result===SUCCESS) {
				$temp = array();
				if(strlen($this->request->data['DownloadFile']['title'])==0){
						//如果没有输入模版的title，就把文件名给它，作为默认的title
						$temp['DownloadFile']['title'] = $this->request->data['DownloadFile']['application_form']['name'];
				}else{
						$temp['DownloadFile']['title'] = $this->request->data['DownloadFile']['title'];
				}
				$temp['DownloadFile']['user_id'] = $this->request->data['DownloadFile']['user_id'];
				$temp['DownloadFile']['file_name']=$this->request->data['DownloadFile']['application_form']['name'];
				$temp['DownloadFile']['mimeType']=$this->request->data['DownloadFile']['application_form']['type'];
				if($this->DownloadFile->save($temp)){
					$this->Session->setFlash('Your file has been uploaded successfully!');
					$this->redirect(array('action'=>'list_all',0,'success'));
				}else{
					$this->Session->setFlash('Can not uploade your file, please try later!');
					$this->redirect(array('action'=>'list_all',0,'error'));
				}
			}else{
				switch ($result) {
					case WRONG_FILE_TYPE:
						$this->Session->setFlash('The file\'s type is not supported. Please contact your admin.');
						$this->redirect(array('action'=>'list_all',0,'error'));
					break;
					
					case SAVE_UPLOAD_FILE_FAILED:
						$this->Session->setFlash('System busy, can not handle your request.');
						$this->redirect(array('action'=>'list_all',0,'error'));
						break;
					
					default:
						$this->Session->setFlash('System fault, can not handle your request. Please contact your admin.');
						$this->redirect(array('action'=>'list_all',0,'error'));
					break;
				}
			}
		}
		return;
	}
	
	public function download($id = NULL){
		if ($id) {
			$this->DownloadFile->id = $id;
			$bean = $this->DownloadFile->read();
			$path_info = pathinfo(WWW_ROOT.'files'.DS.'download_files'.DS.$bean['DownloadFile']['user_id'].DS.$bean['DownloadFile']['file_name']);
			
			$this->viewClass = 'Media';
		    $params = array(
		        'id' => $bean['DownloadFile']['file_name'],
		    	'name' => $path_info['filename'],
		    	'extension'=>$path_info['extension'],
		    	'download' => TRUE,
		        'path'      => 'files' . DS .'download_files'.DS.$bean['DownloadFile']['user_id'].DS
		    );
		    $this->set($params);
		}
		return;
	}
}