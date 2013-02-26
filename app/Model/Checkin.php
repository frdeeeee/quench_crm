<?php
	class Checkin extends AppModel{
		public $name = 'Checkin';
		public $belongsTo = array('Enquiry');
		
		/**
		 * 学生进行checkin的方法，重点是保存checkin的信息之后，更新profile里的modified字段为最新的checkin的创建时间
		 * 这样在按照checkin的状态进行搜索的时候可以比照这个字段
		 * @param array $request_data
		 */
		public function do_check_in($request_data){
			$enquiry_id = $request_data['Checkin']['enquiry_id'];
			$ds = $this->getDataSource();
			$ds->begin();
			$result = FALSE;
			if ($this->save($request_data)) {
				App::uses('Enquiry', 'Model');
				$e = new Enquiry();
				$e->id = $enquiry_id;
				if ($e->saveField('modified', $this->field('created'))) {
					$result = TRUE;
				}
			}
			
			if ($result) {
				$ds->commit();
			}else {
				$ds->rollback();
			}
			return $result;
		}
	}