<?php
	/**
	 * 这个类是专门为Youth开发的发送邮件的组件，配置根据CakeMail的要求，配置文件在config/email.php
	 */
	App::uses('CakeEmail', 'Network/Email');
	
	class YouthEmailComponent extends Component{
		
		private $sender = null;
		public $components = array('Auth','Session');
		
		public function __construct(){
			$this->sender = new CakeEmail('smtp');
		}
		
		public function send_mail( $template='welcome', $layout='default', $options = null, $data = null ){
			//template will be in app/View/Emails/html/welcome.ctp
			//layout will be in app/View/Layouts/Emails/html/fancy.ctp
			if (!is_null($this->sender)) {
				$this->sender->template($template,$layout);
				$this->sender->viewVars(array('data'=>$data));
				$this->sender->emailFormat('html');
				$this->sender->to($options['to'])->
							   subject($options['subject'])->
							   from(array($data['User']['username']=>$data['User']['name']));
				return $this->sender->send();
			}else{
				return false;
			}
		}
		
		/**
		 * 
		 * 用来发送邮件的快捷方式，把用户的输出不加变化的写道邮件中，页面ajax方法发送邮件是调用
		 * @param unknown_type $template
		 * @param unknown_type $layout
		 * @param unknown_type $options
		 * @param unknown_type $data
		 */
		public function send_simple_mail($template='welcome', $layout='fancy', $options = null, $data = null){
			if (!is_null($this->sender)) {
				$this->sender->template($template,$layout);
				$this->sender->viewVars(array('data'=>$data));
				$this->sender->emailFormat('html');
				$this->sender->to($options['to'])->
							   subject($options['subject']);
				if ($this->sender->send()) {
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}
?>