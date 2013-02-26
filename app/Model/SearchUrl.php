<?php
class SearchUrl extends AppModel{
	public $name = 'SearchUrl';
	public $useTable = 'search_urls';
	
	public function save_user_view($user_id,$useful_url_bean,$fields,$name){
		$ds = $this->getDataSource();
		$ds->begin();
		$flag = FALSE;
		$bean = array(
			'SearchUrl'=>array(
				'link'=>http_build_query($fields)
			)
		);
		if ($this->save($bean)) {
			$bean=array(
				'UsefulUrl'=>array(
					'user_id'=>$user_id,
					'name'=>$name,
					'search_url_id'=>$this->getInsertID()
				)
			);
			if ($useful_url_bean->save($bean)) {
				$flag = TRUE;
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