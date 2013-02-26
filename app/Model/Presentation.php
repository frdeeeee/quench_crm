<?php
class Presentation extends AppModel{
	public $name = 'Presentation';
	public $belongsTo = array('User','Group','Customer');
	public $order = array('Presentation.id DESC');
	//暂时不添加belongsTo的属性
	public $validates = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => '宣讲会必须要有一个标题!'
		)
	);
	
	public function sales_statistic($request_data=NULL,$group_id = NULL){
		return $this->find('all',
			array(
				'conditions'=>$this->prepair_conditions($request_data,$group_id),
				'fields'=>$this->prepair_fields(),
				'joins'=>$this->prepair_joins(),
				'group'=>array('Presentation.id'),
				'order'=>array('Presentation.hold_on ASC')
			)
		);
	}
	
	public function prepair_conditions($request_data = NULL,$group_id=NULL){
		$options = array();
		
		//如果指定了学校
			if (!empty($request_data['Statistic']['customer_id'])) {
				$options['and']['Presentation.customer_id']=$request_data['Statistic']['customer_id'];
			}
			//如果指定了统计的开始时间;
			if (!empty($request_data['Statistic']['from_date'])) {
				$options['and'][]= 'Presentation.hold_on>=\''.$request_data['Statistic']['from_date'].'\'';
			}
			//如果指定了统计的结束时间;
			if (!empty($request_data['Statistic']['to_date'])) {
				$options['and'][]= 'Presentation.hold_on<=\''.$request_data['Statistic']['to_date'].'\'';
			}
		
		if (isset($options['and'])) {
			if ($group_id && $group_id>0) {
				$options['and']['Presentation.group_id']=$group_id;
				$options['and']['Presentation.status']=1;
			}else{
				$options['and']['Presentation.status']=1;
			}
		}else{
			if ($group_id && $group_id>0) {
				$options['and']['Presentation.group_id']=$group_id;
				$options['and']['Presentation.status']=1;
			}else{
				$options['Presentation.status']=1;
			}
		}
		return $options;
	}
	
	public function prepair_fields(){
		return $fields = array(
			'Customer.name','Customer.id',
			'Presentation.hold_on','Presentation.name','Presentation.regist_number','Presentation.id',
			'DATE_FORMAT(Presentation.hold_on,\'%m\') as month',
			'Presentation.arrived_number',//到场
			'COUNT(DISTINCT enq_1.id) as register_number',//登记
			'COUNT(DISTINCT enq_2.id) as slep_number',//slep不为0,表示参加了考试
			'COUNT(DISTINCT enq_3.id) as feedback_number',//回访的数量
			'COUNT(DISTINCT enq_4.id) as app_number',//称为有效销售的数量
			'COUNT(DISTINCT enq_5.id) as slep_pass',//称为有效销售的数量
		);
	}
	
	public function prepair_joins(){
		return $joins = array(
			array(
				'table'=>'enquiries',
				'alias'=>'enq_1',
				'type'=>'left',
				'conditions'=>array(
					'Presentation.id=enq_1.presentation_id'
				)
			),
			array(
				'table'=>'enquiries',
				'alias'=>'enq_2',
				'type'=>'left',
				'conditions'=>array(
					'and'=>array(
						'Presentation.id=enq_2.presentation_id',
						'enq_2.slep_scores>0'
					) 
				)
			),
			array(
				'table'=>'enquiries',
				'alias'=>'enq_3',
				'type'=>'left',
				'conditions'=>array(
					'and'=>array(
						'Presentation.id=enq_3.presentation_id',
						'enq_3.is_feedback=1'
					) 
				)
			),
			array(
				'table'=>'enquiries',
				'alias'=>'enq_4',
				'type'=>'left',
				'conditions'=>array(
					'and'=>array(
						'Presentation.id=enq_4.presentation_id',
						'enq_4.is_applicant=1'
					) 
				)
			),
			array(
				'table'=>'enquiries',
				'alias'=>'enq_5',
				'type'=>'left',
				'conditions'=>array(
					'and'=>array(
						'Presentation.id=enq_5.presentation_id',
						'enq_4.slep_scores>=42'
					) 
				)
			)
		);
	}
	
	public function get_total($group_id = null){
		if ($group_id) {
			return $this->find('count',array(
				'conditions'=>array(
					'AND'=>array(
						'Presentation.group_id'=>$group_id,
						'Presentation.available=1',
					)
				)
			));
		}else{
			return $this->find('count',array(
				'conditions'=>array(
					'Presentation.available=1'
				)
			));
		}
	}
}