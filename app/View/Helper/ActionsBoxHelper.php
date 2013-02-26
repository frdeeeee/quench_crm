<?php
App::uses('AppHelper', 'View/Helper');
class ActionsBoxHelper extends AppHelper {
	public $helpers = array('Html');
	private $start_tag = '';
	private $content = '';
	private $end_tag = '</div>';
	
	public function output($id = null, $title=null,$controller_name=null,$action_name=null,$options=null){
		$this->clear();
		$this->start_tag = '<div class="actions_box" id="action_box_'.$id.'">';
		for ($i = 0; $i < count($title); $i++) {
			$this->content .= '<p>'.$this->Html->link(
				$title[$i],
				array('controller'=>$controller_name[$i],'action'=>$action_name[$i],$id),
				array('class'=>'action_btn','escape'=>false,'rel'=>'fancy_trigger_group')
			).'</p>';
		}
		
		return $this->start_tag.$this->content.$this->end_tag;
	}
	
	private function clear(){
		$this->start_tag = '';
		$this->content = '';
	}
	
	public function output_fancybox($id = null, $title=null,$rel=null,$href=null,$options=null){
		$this->clear();
		$this->start_tag = '<div class="actions_box" id="action_box_'.$id.'">';
		for ($i = 0; $i < count($title); $i++) {
			//$this->content .= '<p><a class="action_btn" rel="'.$rel[$i].'" href="'.$href[$i].'" title="'.$id.'">'.$title[$i].'</a></p>';
			$this->content .= '<p>'.$this->Html->link(
				$title[$i],
				$href[$i],
				array(
					'class'=>'action_btn','rel'=>$rel[$i],'title'=>$id
				),
				$options[$i]
			).'</p>';
		}
		
		return $this->start_tag.$this->content.$this->end_tag;
	}
	/*
	 <div class="actions_box">
	 	<div class="action_item">
	 		<a href="">Title</a>
	 	</div>
	 </div>
	 * 
	 */
}