<?php
	class User extends AppModel{
		public $name = 'User';
		public $belongsTo = array('Role','Department');
		public $hasMany = array('Customer','GroupUser','UserProject');
		public $validate = array(
				'name' => array(
						'Please enter your name' => array(
							'rule' => 'notEmpty',
							'message' => 'Please enter your name!'	
							)
					),
				'username' => array(
						'Valid email' => array(
											'rule' => 'email',
											'message' => 'Please enter a valid email address.'
										),
						'Unique email' => array(
								'rule' => 'isUnique',
								'message' => 'This email address has already been take.'
								)
							),
				'password' => array(
						'Not empty' => array(
								'rule' => 'notEmpty',
								'message' => 'pleae enter the password.'
								),
						'Match passwords' => array(
								'rule' => 'matchPasswords',  //这个是自定义的规则，实现方法是自行编写这个名字为matchPasswords的函数
								'message' => 'Your passwords do not match!'
								)
						),
				'password_confirmation' => array(
						'Not empty' => array(
								'rule' => 'notEmpty',
								'message' => 'pleae confirm your password.'
						)
						)	
			);
		
		/**
		 * This method uses to fetch all info including group names
		 */
		public function find_all_user_details(){
			$this->unbindModel(array('belongsTo'=>array('Role','Department'),'hasMany'=>array('Customer','GroupUser')));
			$options['fields'] = array(
					'User.name',
					'User.username',
					'User.id',
					'Role.name',
					'Department.name',
					'Group.name'
					);
			$options['order']=array('Department.name');
			$options['joins'] = array(
					array(
							'table'=>'departments',
							'alias' => 'Department',
							'type' => 'LEFT',
							'conditions'=>array(
									'Department.id = User.department_id'
							)
						),
					array(
							'table'=>'roles',
							'alias' => 'Role',
							'type' => 'LEFT',
							'conditions'=>array(
									'Role.id = User.role_id'
							)
						),
					array(
							'table'=>'group_users',
							'alias' => 'GroupUser',
							'type' => 'RIGHT',
							'conditions'=>array(
									'GroupUser.user_id = User.id'
							)
						),
					array(
							'table'=>'groups',
							'alias' => 'Group',
							'type' => 'LEFT',
							'conditions'=>array(
									'GroupUser.group_id = Group.id'
							)
						)
					);
			return $this->find('all',$options);
		}
		
		public function change_password($user_id = NULL, $new_password = NULL){
			$result = false;
			if ($user_id){
				$this->id = $user_id;
				if ($this->exists() && strlen($new_password)>0) {
					$result = $this->saveField( 'password', $new_password );
				}
			}
			return $result;
		}
		
		public function matchPasswords( $data ){
			/**
			 * 特别需要注意的是，在这里的$data是在Model里面调用时使用的；$this->data是在model里面调用用户提交的数据用的。而在Controller中，提取用户提交的数据要用$this->request->data;
			 * 这是cakephp2.0的新特性
			 */
			if ($data['password'] == $this->data['User']['password_confirmation']) {
				return true;
			}else{
				$this->invalidate('password_confirmation','Your passwords do not match!');//这句的意思是，由于已经知道2个密码不match，所以在password_confirmation的验证也同时失败并显示错误提示消息
				return false;
			}
		}
		
		public function beforeSave(){
			if ( isset($this->data['User']['password']) ) {
				$this->data['User']['password'] = AuthComponent::password( $this->data['User']['password'] );
			}
			return true;
		}
		
		public function find_group_leaders(){
			return $this->find('list',array(
					'conditions'=>array(
							'AND'=>array(
									'User.available'=>1,
									'User.role_id ='.SALES
									)
							)
					));
		}
		
		public function get_sales_assistants($not_in = null){
			return (is_null($not_in))
					?
					$this->find('list',array(
					'conditions'=>array(
							'OR'=>array(
								'AND'=>array(
									'User.available'=>1,
									'User.role_id'=>SALES_ASSISTANT
								),
								'AND'=>array(
									'User.available'=>1,
									'User.role_id'=>OPERATION_ASSISTANT
								),
								'AND'=>array(
									'User.available'=>1,
									'User.role_id'=>SALES
								),
								'AND'=>array(
									'User.available'=>1,
									'User.role_id'=>OPERATION
								)
							)
							
					)))
					:
					$this->find('list',array(
					'conditions'=>array(
							'OR'=>array(
								array('AND'=>array(
									'User.available'=>1,
									'User.role_id'=>SALES_ASSISTANT,
									'User.id NOT IN ('.$not_in.')'
									)
								),
								array('AND'=>array(
									'User.available'=>1,
									'User.role_id'=>OPERATION_ASSISTANT,
									'User.id NOT IN ('.$not_in.')'
									)
								),
								array('AND'=>array(
									'User.available'=>1,
									'User.role_id'=>SALES,
									'User.id NOT IN ('.$not_in.')'
									)
								),
								array('AND'=>array(
									'User.available'=>1,
									'User.role_id'=>OPERATION,
									'User.id NOT IN ('.$not_in.')'
									)
								)
								)
							)
					))
			;
		}
	}
?>