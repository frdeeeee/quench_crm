<?php
class FileUploaderComponent extends Component{
	private $file_path = 'files/download_files/';
	
	public function save_download_file($request_data){
		$this->file_path = 'files/download_files/';
		if (!$this->_is_file_right_permitted($request_data['DownloadFile']['application_form']['type'])) {
			return WRONG_FILE_TYPE;
		}
		if (!$this->_get_folder_ready(NULL,$request_data['DownloadFile']['user_id'],NULL)) {
			//无法创建文件夹，返回失败
			return FAILED;
		}
		if ($this->_save_upload_file($request_data['DownloadFile'])) {
			return SUCCESS;
		}else{
			return SAVE_UPLOAD_FILE_FAILED;
		}
	}
	
	private function _save_upload_file($data){
		$result = FALSE;
		if ($data['application_form']) {
			$result = move_uploaded_file(
					$data['application_form']['tmp_name'],
					$this->file_path.trim($data['application_form']['name'])
			);
		}
		return $result;
	}
	
	/**
	 * 检查给定的文件扩展名是否在系统允许的范围之内
	 * @param unknown_type $file_type
	 * @return boolean
	 */
	private function _is_file_right_permitted($file_type){
		$permitted = array(
			'image/gif',
			'image/jpeg',
			'image/pjpeg',
			'image/png',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/pdf',
			'application/msword' //word97,2000版本
		);
		if (in_array($file_type,$permitted,true)) {
			return true;
		}
		return false;
	}
	/**
	 * 根据传入的参数，构建文件路径，如果路径不存在，就创建它
	 * @param String $file_path： 代表根路径，如果为NULL就是用默认的。在优势项目中，默认即可
	 * @param int $id : 申请人的applicant记录的id值
	 * @param mix $sub_folder : id目录下的子目录名，根据情况可以选择是否在id下建立子目录
	 */
	private function _get_folder_ready($file_path = null, $id = null,$sub_folder=null){
		//如果指定了路径，就是用指定的，然后再加上id
		if ($file_path) {
			$this->file_path .= $file_path;
		}
		//设置好路径
		$this->file_path = WWW_ROOT.$this->file_path;
		if ( $id ) {
			//如果用户指定了新的目录名
			$this->file_path = $this->file_path .DS .$id .DS;
		}
		//如果在id下还需要建子目录
		if ($sub_folder) {
			$this->file_path = $this->file_path .DS.$sub_folder.DS;
		}
		/*
		 * 检查申请的目录是否存在，路径为webroot/files/applicants/id/sub_folder/
		*/
		//pr($this->file_path);
		if ( !file_exists($this->file_path) ) {
			//如果目录不存在，那就把目录建起来
			App::uses('Folder', 'Utility');
			$dir = new Folder();
			try {
				$dir->create($this->file_path);//.DS.$path
			} catch (Exception $e) {
				return FALSE;
			}
		}
	
		/**
		 * 以下的这个代码是为了适应开发的windows平台而弄的，主要是为了构建图片的路径
		
		if ( !is_null($bean_name) && !is_null($id) ) {
			//如果用户指定了新的目录名
			$path = $bean_name ."/" .$id ."/";
		}
	
		if ($data['logo_file']) {
			$success = move_uploaded_file(
					$data['logo_file']['tmp_name'],
					//IMAGES.DS.'files'.DS.$path.DS.$data['logo_file']['name']
					IMAGES.DS.'files'.DS.$path.DS.$data['name'].'.jpg'
			);
			if (!$success) {
				return false;
			}
		}
		 */
		return TRUE;
	}
}