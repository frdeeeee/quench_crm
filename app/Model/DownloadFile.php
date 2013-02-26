<?php
class DownloadFile extends AppModel{
	public $name = 'DownloadFile';
	public $useTable = 'download_files';
	public $belongsTo = array('User');
	
	/*
	public function beforeDelete(){
		App::uses('File', 'Utility');
		$this->read();
		if(strlen($this->data['DownloadFile']['file_name'])==0){
			//表示没有关联的模版文件
			return TRUE;
		}else{
			$file_path = WWW_ROOT. 'files'.DS.'download_files'.DS.$this->data['DownloadFile']['project_id'].DS.$this->data['DownloadFile']['phase_id'].DS.$this->data['DownloadFile']['file_name'];
			if (file_exists($file_path)) {
				$file = new File($file_path);
				return $file->delete();
			}else{
				//文件不存在，直接返回成功即可
				return TRUE;
			}
		}
	}
	*/
}