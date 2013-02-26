<?php
	/**
	 * 这个类是专门用来处理和用户有关的所有操作的。包括：
	 * 用户登录 login()
	 * 添加，修改，删除等功能
	 * 用户logout功能
	 * 这里面的所有功能都是为CKE用户准备的，与任何的前台浏览的访问这无关，他们不能使用这里面的任何一种功能，由于Auth模块的控制，这里面不能有index和view方法。用户登录成功之后，要跳转到dashboard去
	 * @author justin
	 *
	 */
	//App::uses('CakeEmail', 'Network/Email');
	class UsersController extends AppController{
		public $uses = array('User','Role','Department','Group','UserProject');
		public $name = 'Users';
		//public $components = array('Priv','Email','CkeMail','RandomString'); open
		
		public $paginate = array(
				'limit' => 20,
				'order' => array(
						'User.name'=>'ASC'
				),
				'conditions'=>array('User.role_id>1')
		);
		
		public function beforeRender(){
			$this->set('current_menu','Users');
		}
		
		public function restore($user_id = null){
			if (!is_null($user_id)) {
				$this->User->id = $user_id;
				if ($this->User->exists()) {
					if($this->User->saveField('available',1)){
						$msg_type = 'success';
						$this->Session->setFlash('Account has been restored successfully!');
					}else{
						$msg_type = 'error';
						$this->Session->setFlash('Restore account failed, please try later!');
					}
				}else{
					$msg_type = 'error';
					$this->Session->setFlash('Sorry, system error, please contact with the Administrator!');
				}
			}
			$this->redirect(array('action'=>'list_all',$msg_type));
			return ;
		}
		
		public function remove($user_id = null){
			if (!is_null($user_id)) {
				$this->User->id = $user_id;
				$user = $this->User->read();
				if ($user['User']['role_id'] != ADMIN) {
					
					if($this->User->saveField('available',0)){
						$msg_type = 'success';
						$this->Session->setFlash('Account has been cancelled successfully!');
					}else{
						$msg_type = 'error';
						$this->Session->setFlash('Cancel account failed, please try later!');
					}
				}else{
					$msg_type = 'error';
					$this->Session->setFlash('Sorry, you can not cancel this account!');
				}
			}
			$this->redirect(array('action'=>'list_all',$msg_type));
			return ;
		}
		
		public function login(){
			$this->layout = 'user_login';
			if ($this->request->is('post')) {
				if ( $this->Auth->login() && $this->Auth->user('available')==1){
					$this->redirect( $this->Auth->redirect() );
				}else{
					//这里表示用户没有登录或者Session过期了
					$this->Session->setFlash('Login failed with incorrect username/password');
				}
			}
			return;
		}
		
		public function choose_my_current_group(){
			if (!empty($this->request->data)) {
				$this->Session->write('my_group',$this->request->data['User']['current_group']);
				$this->Group->id = $this->request->data['User']['current_group'];
				$this->Session->write('my_group_name',$this->Group->field('name'));
				//根据最新的运营部需求，把当前登陆拥护操作的那个项目放到session中，用来调用不同的视图
				$this->Session->write('my_project',$this->request->data['User']['current_project']);
				$this->loadModel('Project','Model');
				$this->Project->id = $this->request->data['User']['current_project'];
				$this->Session->write('my_project_name',$this->Project->field('name'));
				//$this->Group->id = $this->request->data['User']['current_group'];data[User][current_project]
				//把我的组的领导的id页放到session中
				//$this->Session->write('my_group_leader',$this->Group->field('group_leader'));
				$this->redirect($this->Auth->redirect());
			}
			return;
		}
		
		/**
		 * 运营部的员工如果被分配了多个任务，则会选择被分配的project
		 */
		public function choose_my_current_project(){
			if (!empty($this->request->data)) {
				//根据最新的运营部需求，把当前登陆拥护操作的那个项目放到session中，用来调用不同的视图
				$this->Session->write('my_project',$this->request->data['User']['current_project']);
				$this->loadModel('Project','Model');
				$this->Project->id = $this->request->data['User']['current_project'];
				$this->Session->write('my_project_name',$this->Project->field('name'));
				$this->redirect($this->Auth->redirect());
			}
			return;
		}
		
		/**
		 * 用户登录成功之后会跳转到这里，在这里判断用户的部门和角色，从而加载不同的dashboard页面
		 */
		public function load_dashboard(){
			switch ( $this->Auth->User('role_id') ) {
				case SALES_DIRECTOR:
					$this->redirect(
						array('controller'=>'Sales', 'action'=>'load_admin')
					);
				break;
				case OPERATION_DERECTOR:
					$this->redirect(
						array('controller'=>'Sales', 'action'=>'load_admin')
					);
				break;
				case SALES:
					$this->redirect(
						array('controller'=>'Sales', 'action'=>'load')
					);
				break;
				case SALES_ASSISTANT:
					$this->redirect(
						array('controller'=>'Sales', 'action'=>'load')
					);
				break;
				case ADMIN:
					$this->redirect(
						array('controller'=>'Sales','action'=>'load_admin')
					);
					break;
				case OPERATION_ASSISTANT:
					$this->redirect(
						array('controller'=>'Applicants','action'=>'load_statistic_operator')
					);
					break;
				case OPERATION:
					$this->redirect(
						array('controller'=>'Applicants','action'=>'load_statistic_operator')
					);
					break;
				
				default:
					;
				break;
			}
			return;
		}
		
		/*
		 * Some variables used here only
		 */
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('login','forget_password','password_reset');
		}
		
		public function isAuthorized($user){
			if (in_array($this->action,array('edit','delete')) ) {
				if ($user['id'] != $this->request->params['pass'][0]) {
					//上面if中的判断语句很重要，它是cakephp2中如何去除uri中的segment的方式和方法
					//它利用重载的isAuthorized方法，其参数是当前登录的user
					//比较当前登录用户的id是否和uri中的第一个参数，是否相等，从而实现了用户不能edit和delete与自己userId不等的方法
					return false;
				};
			}
			return true;
		}
		
		public function change_password($user_id = null){
			if (empty($this->request->data)) {
				$this->User->id = $user_id;
				$this->User->unbindModel(array('hasMany'=>array('Customer')));
				$this->set('data',$this->User->read());
			}else{
				//检查输入的两个密码是否一致
				$pw = $this->request->data['User']['new_password'];
				$pwc = $this->request->data['User']['new_password_confirm'];
				if ($pw === $pwc) {
					$result = $this->User->change_password($this->request->data['User']['id'],$pw);
					if ($result) {
						$this->Session->setFlash('密码修改成功！');
						$this->redirect(array('action'=>'list_all','success'));
					}else{
						$this->Session->setFlash('密码修改失败，请稍候再试！');
					}
				}else{
					$this->Session->setFlash('您刚输入的两个密码不相同，请重新输入！');
				}
			}
			return;
		}
		
		/*
		 * 修改用户的基本信息，可是不包括密码
		*/
		public function modify( $user_id = null ){
			if (!is_null($user_id)) {
				$this->set('data',$this->User->findById($user_id) );
				$this->set('departments',$this->Department->find('list'));
				$this->set('roles',$this->Role->find('list'));
			}
			
			if ( !empty($this->request->data) ) {
				$this->User->id = $this->request->data['User']['id'];
				if( $this->User->save( $this->request->data ) ){
					$this->set('msg_type','success');
					$this->Session->setFlash('系统用户-'.$this->request->data['User']['name'].'-资料修改成功!');
					$this->redirect(array('action'=>'list_all'));
				}else{
					//添加失败
					$this->set('msg_type','error');
					$this->Session->setFlash('更新系统用户-'.$this->request->data['User']['name'].'-的资料失败， 请稍候再试!');
				}
			}
			return ;
		}
		
		/*
		 * 向系统添加一个新的用户
		 */
		public function add(){
			$this->set('departments',$this->Department->find('list'));
			$this->set('roles',$this->Role->find('list'));
			if ( !empty($this->request->data) ) {
				if( $this->User->save( $this->request->data ) ){
					$this->Session->setFlash('Account '.$this->request->data['User']['name'].' has been added successfully!');
					$this->redirect(array('action'=>'list_all','success'));
				}else{
					//添加失败
					$this->set('msg_type','error');
					$this->Session->setFlash('Can not add account for '.$this->request->data['User']['name'].', please try again.');
				}
			}
			return;
		}
		
		/**
		 * 新用户注册的方法
		 */
		public function register(){
			$this->set('departments',$this->Department->find('list'));
			$this->set('roles',$this->Role->find('list'));
			if ( !empty($this->request->data) ) {
				if( $this->User->save( $this->request->data ) ){
					//创建需要的发送配置信息
					$mail_send_options = array(
							'to' => $this->request->data['User']['email'],
							'from' => DEFAULT_ADMIN_EMAIL,
							'subject' => 'No reply: Hi '.$this->request->data['User']['name'].', your CKE account has been created.',
							'template' => 'new_user_register_confirmation',
							'smtpOptions' => null,  //表示使用CkeMail组件默认的设置
					);
					//尝试向用户发送一封电子邮件
					$this->set('data',array(
									'name'=>$this->request->data['User']['name'],
									'username'=>$this->request->data['User']['username'],
									'password'=>$this->request->data['User']['password']
								)
							);
					if ($this->CkeMail->send_mail($this->Email,$mail_send_options)) {
						//添加用户成功，向页面送成功消息，为用户发送邮件成功
						$this->Session->setFlash('A new account has been created for the user '.
												$this->request->data['User']['name'].
												' A confirmation email has been sent to '.$this->request->data['User']['email']);
						$this->redirect(array('action'=>'list_all','success'));
					}else{
						//添加用户成功，但是为用户发送邮件失败
						$this->set('msg_type','error');
						$this->Session->setFlash('A new account has been created for the user '.
												$this->request->data['User']['name'].
												', but failed to send a confirmation to '.
												$this->request->data['User']['email']);
						$this->redirect(array('action'=>'list_all','error'));
					}
				}else{
					//添加失败
					$this->set('msg_type','error');
					$this->Session->setFlash('Can not create a new account for the user '.$this->request->data['User']['name'].', please try again!');
				}
			}
			return;
		}
		
		public function logout(){
			if ($this->Session->check('role_name')) {
				$this->Session->delete('role_name');
			}
			if ($this->Session->check('my_group')) {
				$this->Session->delete('my_group');
			}
			if ($this->Session->check('my_group_leader')) {
				$this->Session->delete('my_group_leader');
			}
			$this->Session->destroy();
			$this->redirect( $this->Auth->logout() );
			return;
		}
		/**
		 * 为运营部的用户取消所分配的项目
		 */
		public function cancel_assigned_project($user_id = NULL,$project_id = NULL){
			$temp = $this->UserProject->find('first',array('conditions'=>array(
					'and'=>array(
						'UserProject.user_id'=>$user_id,
						'UserProject.project_id'=>$project_id,
					)
			)));
			if (empty($temp)) {
				$msg_type = 'error';
				$this->Session->setFlash('无法完成该操作, 请稍候再试!');	
			}else{
				if ($this->UserProject->delete($temp['UserProject']['id'])) {
						$msg_type = 'success';
						$this->Session->setFlash('项目取消分配成功!');
					}else{
						//更新失败
						$msg_type = 'error';
						$this->Session->setFlash('项目取消分配失败, 请稍候再试!');
				}
			}
			$this->redirect(array('action'=>'list_all',$msg_type));
			return;
		}
		
		/**
		 * 为运营部的用户分配所属的项目
		 */
		public function assign_project_to_user(){
			if (empty($this->request->data)) {
				//
			}else{
				$temp = $this->UserProject->find('first',array('conditions'=>array(
					'and'=>array(
						'UserProject.user_id'=>$this->request->data['UserProject']['user_id'],
						'UserProject.project_id'=>$this->request->data['UserProject']['project_id'],
					)
				)));
				
				if (empty($temp)) {
					if ($this->UserProject->save($this->request->data)) {
						$msg_type = 'success';
						$this->Session->setFlash('项目分配成功!');
					}else{
						//更新失败
						$msg_type = 'error';
						$this->Session->setFlash('项目分配失败, 请稍候再试!');
					}
				}else{
					$msg_type = 'error';
					$this->Session->setFlash('已经为该员工分配了该项目，无须再次分配!');
				}
			}
			$this->redirect(array('action'=>'list_all',$msg_type));
			return;
		}
		
		/**
		 * 该方法用来列出系统中的所有用户
		 * @param unknown_type $page_size
		 */
		public function list_all($msg_type = null){
			//create a new method in User to fetch the group name
			$this->User->unbindModel(array('hasMany'=>array( 'Customer')));
			$this->set('data',$this->User->find('all',array('order'=>'Department.name')));
			$this->set('group_names_array',$this->Group->find('list'));
			if (!is_null($msg_type)) {
				$this->set('msg_type',$msg_type);
			}
			return;
		}
		/**
		 * 用户用来提交临时密码的函数，它将比对用户提交的临时码，如果在临时库里面有这个码子，则让用户到渲染密码reset页面
		 * 如果找不到码子，则赚到登录页面，注意还要比较时间
		 * @param String $temp_code
		
		public function password_reset($token = null){
			$this->layout = 'admin/login';
			if ( !is_null($token) ) {
				//检查token是否是合格的
				if ( strlen($token) == 32 || strlen($token)==40 ) {
					if ( empty($this->request->data) ) {
						//如果token合格，但是没有提交的表单数据，表示用户在申请修改密码的页面
						$this->loadModel('Tempuser');
						$temp_user = $this->Tempuser->find('first',array('conditions'=>array('Tempuser.ciphertext LIKE '=>$token)));
						if ( $temp_user == false ) {
							//没有找到匹配的加密钥匙;
							$this->redirect(array('controller'=>'dashboard'));
						}else{
							//找到匹配钥匙，用户可以reset密码了
							$temp_user = $this->User->find('first',array( 'conditions'=>array('User.email LIKE '=>$temp_user['Tempuser']['email'])) );
							$this->set('user_id',$temp_user['User']['id']);
						}
					}else {
						//用户提交了新的密码
						$this->User->id = $this->request->data['User']['id'];
						if ($this->User->saveField('password',$this->request->data['User']['password'])) {
							//删除原来tempuser表中的记录
							$this->loadModel('Tempuser');
							$temp_user = $this->Tempuser->find('first',array('conditions'=>array('Tempuser.ciphertext LIKE '=>$token)));
							$this->Tempuser->delete( $temp_user['Tempuser']['id'] );
							//保存成功，提示成功，2秒后跳转到登录页面
							$this->Session->setFlash('Your password has been reset successfully!');
							$this->redirect(array('controller'=>'dashboard'));
						}else{
							//保存失败
							$this->Session->setFlash('Can not reset your password, please contact the admin!');
						}
					}
					
				}else{
					//直接登录页面，因为token参数长度不对
					$this->redirect(array('controller'=>'dashboard'));
				}
			}else{
				//直接跳转到登录页面，因为必须有参数或者提交了数据，否则就是欺诈
				$this->redirect(array('controller'=>'dashboard'));
			}
			return ;
		}
		 */
		
		
		/**
		 * 用户如果忘记密码，会要求找回密码的操作，这个函数执行了该操作
		
		public function forget_password(){
			$this->layout = 'admin/login';
			if ( !empty($this->request->data) ){
				//先检查提交的电子邮件是不是注册的用户
				
				if (!$this->User->find('first',array('conditions'=>array( 'User.email LIKE '=>$this->request->data['Tempuser']['email'])))) {
					//不是注册用户;
					$this->set('content','<p>Your are not the registered user, please contact our admin.</p>');
				}else{
					//表示用户是注册用户
					//检查是否已经申请过reset密码
					//临时加载tempuser model
					$this->loadModel('Tempuser');
					if ( !$this->Tempuser->find('first',array('conditions'=>array('Tempuser.email LIKE '=>$this->request->data['Tempuser']['email']))) ) {
						//表示用户是注册用户，并且还没有申请过重设密码，那么就插入一条新数据
						$temp_pwd = $this->RandomString->getRandomString();
						$this->request->data['Tempuser']['ciphertext'] = $temp_pwd['ciphertext'];
						if ($this->Tempuser->save($this->request->data)) {
							//插入成功，发送提示邮件
							$mail_send_options = array(
									'to' => $this->request->data['Tempuser']['email'],
									'from' => DEFAULT_ADMIN_EMAIL,
									'subject' => 'No reply: Hi, your CKE account password needs to be reset.',
									'template' => 'exist_user_forget_password_confirmation',
									'smtpOptions' => null,  //表示使用CkeMail组件默认的设置
							);
							$this->set('token',$temp_pwd['ciphertext']);
							if ($this->CkeMail->send_mail($this->Email,$mail_send_options)){
								//发送邮件成功
								$this->set('content','<p>Password reset succeed. Please check your email and follow the instruction in it.</p>');
							}
						}else{
							//插入失败
							$this->set('content','<p>Password reset failed, please contact the administrator.</p>');
						}
					
					}else{
						//用户已经要求重设过密码，那么告诉用户，去收邮件，而不进行任何操作
						$this->set('content','<p>Password has been reseted, please check your email then follow the instruction.</p>');
					}
				}
			}else{
				//Go to the login page
				$this->redirect(array('controller'=>'dashboard'));
			}
			return ;
		}
		 */
		
		/*
		public function change_password( $uid = null ){
			
			if (empty($this->request->data)) {
				$this->set('data',$this->User->findById($uid));
			}else{
				$this->User->id = $this->request->data['User']['id'];
				if ($this->User->save($this->request->data)) {
					//创建需要的发送配置信息
					$mail_send_options = array(
							'to' => $this->request->data['User']['email'],
							'from' => DEFAULT_ADMIN_EMAIL,
							'subject' => 'No reply: Hi '.$this->request->data['User']['name'].', your CKE account password has been changed.',
							'template' => 'exist_user_change_password_confirmation',
							'smtpOptions' => null,  //表示使用CkeMail组件默认的设置
					);
					//尝试向用户发送一封电子邮件
					$this->set('data',array(
							'name'=>$this->request->data['User']['name'],
							'password'=>$this->request->data['User']['password']
					)
					);
					if ($this->CkeMail->send_mail($this->Email,$mail_send_options)){
						//Change password succeed
						$this->Session->setFlash('Changing password for the user '.
								$this->request->data['User']['name'].
								' succeed.  A confirmation email has been sent to '.$this->request->data['User']['email']);
						$this->redirect(array('action'=>'list_all','success'));
					}else{
						//Change password succeed, but sending email to user failed
						$this->set('msg_type','error');
						$this->Session->setFlash('Changing password for the user '.
								$this->request->data['User']['name'].
								' succeed, but failed to send a confirmation to '.
								$this->request->data['User']['email']);
						$this->redirect(array('action'=>'list_all','error'));
					}
				}else{
					//Change password failed
					$this->set('msg_type','error');
					$this->Session->setFlash('Can not change password for the user '.$this->request->data['User']['name'].', please try again!');
				}
			}
			return ;
		}
		 */
		/**
		 * $this->request->is('post');
		 * $this->request->data;
		 *
		 * throw new NotFoundException('Invalid user');
		 */
	}