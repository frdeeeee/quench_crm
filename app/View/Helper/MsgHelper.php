<?php
/**
 * 专门用来配合显示系统消息的帮助类
 */
App::uses('AppHelper', 'View/Helper');

/*
 * <div id="alerts_anchor" class="box grid_8">
						<div class="toggle_container">
							<div class="block">
								<div class="section" style="padding-bottom:5px;">
									<div class="alert dismissible alert_black">
										<img height="24" width="24" src="images/icons/small/white/locked_2.png">
									This is a <strong>black</strong> Alert!
									</div>
									<div class="alert dismissible alert_navy">
									<img height="24" width="24" src="images/icons/small/white/cog_3.png">
									This is a <strong>navy</strong> Alert!
									</div>
									<div class="alert dismissible alert_grey">
									<img height="24" width="24" src="images/icons/small/grey/speech_bubble_2.png">
									This is a <strong>grey</strong> Alert!
									</div>
									<div class="alert alert_grey">
									<img height="24" width="24" src="images/icons/small/grey/speech_bubble_2.png">
										This alert cannot be dismissed.
									</div>
								</div>
							</div>
						</div>
					</div>
 * 
 */
class MsgHelper extends AppHelper {
	public $helpers = array('Html');
	public function output($type = null,$text = null){
		$message = '<div class="toggle_container">
							<div class="block">
								<div class="section" style="padding-bottom:5px;">';
		switch ($type) {
			case 'success':
				$message .= '<div class="alert dismissible alert_green">'.$this->Html->image('icons/small/white/alert.png',array('width'=>24,'height'=>24)).'<strong>'.$text.'</strong>';
			break;
			
			case 'error':
				$message .= '<div class="alert dismissible alert_red">'.$this->Html->image('icons/small/white/alarm_bell.png',array('width'=>24,'height'=>24)).'<strong>'.$text.'</strong>';
			break;
			
			case 'alert':
				$message .= '<div class="alert dismissible alert_blue">'.$this->Html->image('icons/small/white/alarm_clock.png',array('width'=>24,'height'=>24)).'<strong>'.$text.'</strong>';
				break;
			
			default:
				;
			break;
		}
		return $message.'</div></div></div></div>';
	}
}