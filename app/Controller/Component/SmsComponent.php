<?php 
//App::uses('View', 'View');  //先导入View的类文档，因为要模仿email类来加载模版和设置变量
class SmsComponent extends Component{
	private $login_name = array( 'name'=> 'regnum=','value'=> 'zjcm-0078');
	private $login_pwd = array( 'name'=>'&pwd=' ,'value'=> '131416');
	private $content = array(
			'name'=>'&content=',
			'value' => '王越在测试优势的短信功能！打扰了。'
	);
	private $template = array(
		'check_in_activated'=>',您好！您的Checkin系统已经激活成功。优势办。',
	);
	private $phone = array( 'name'=> '&phone=','value'=>'');
	private $sending_time = array( 'name' => '&time=', 'value'=>'');
	private $sms_gateway_url = 'http://sdk.send1.net/Service.asmx/SendSMS';
	
	//private $_View = NULL;
	
	public function __construct(){
		//$this->_View = new View();
	}
	
    public function send($receiver = null,$content= null){
    	if (!is_null($content)) {
    		$this->content['value'] = $content;
    	}
    	return $this->build_get_option($receiver);
    }
    
	public function send_template($receiver = null,$content_key = null){
    	if (!is_null($content_key)) {
    		$this->content['value'] = $receiver['name'].$this->template[$content_key];
    	}
    	return $this->build_get_option($receiver);
    }
    
    /**
     * 
     * Enter description here ...
     * @param array $receiver : {'name'=>'justin','mobile'=>'12345678','email'=>'justin@test.com'}
     * @param string $template
     * @param string $layout
     * @param array $data  : used in the template
     
    public function send_pending($receiver,$template=NULL, $layout='default_sms',$data=NULL ){
    	if (is_null($this->_View)) {
    		return FALSE;
    	}else{
    		//$this->_View->_viewVars = ($data) ? array('data'=>$data) : array('data'=>$receiver);
    		//$this->_set_template($template, $layout);
    		$this->content['value']=$this->_View->output;
    		$to = array('mobile_number'=>$receiver['mobile']);
    		return $this->build_get_option($to);
    	}
    }
    
    //设定要render的template然后渲染
    private function _set_template($template,$layout){
    	//$this->_View->set('content', $content);
		$this->_View->hasRendered = false;
		$this->_View->viewPath = 'Sms' . DS . 'text';
		$this->_View->render($template, $layout);
    }
    */
    
    private function build_get_option( $receiver, $options = array()){
    	$url = $this->login_name['name'].urlencode($this->login_name['value']);
    	$url .= $this->login_pwd['name'].urlencode($this->login_pwd['value']);
    	$url .= $this->content['name'].urlencode($this->content['value']);
    	$url .= $this->phone['name'].urlencode($receiver['mobile_number']);
    	$url .= $this->sending_time['name'];
    	
    	$handle = curl_init();
    	curl_setopt_array(
    			$handle,
    			array(
    					CURLOPT_URL =>$this->sms_gateway_url,
    					CURLOPT_POST => true,
    					CURLOPT_POSTFIELDS => $url,
    					CURLOPT_RETURNTRANSFER => true
    					)
    			);
    	$result = curl_exec($handle);
    	curl_close($handle);
    	$xml = Xml::toArray(Xml::build($result));
    	return $xml;
    }
}
?>