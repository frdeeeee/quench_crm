<?php 
	echo $this->Html->script('ajax_utils/utils_sales',false); 
?>
<div class="flat_area grid_16">
	<h2>添加每日工作记录表格</h2>
	<p><strong style="color:red">*1: 每日5：00分前提交当日工作记录;   &nbsp;&nbsp;&nbsp;&nbsp;  2: 该表提交后无法更改，请确保内容准确.</strong></p>
</div>
<div class="box grid_16">
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
	?>
	<div class="block">	
		<?php 
			echo $this->Form->create('WorkingLog');
			echo $this->Form->input('WorkingLog.group_id',array('type'=>'hidden','value'=>$this->Session->read('my_group')));
	    ?>
			<div class="columns clearfix">
				<div class="col_66">
					<div class="section">
						<?php 
							echo $this->Form->input('WorkingLog.created',array('label'=>'填表日期：','div'=>false,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y'))));
						?>
					</div>
				</div>
			</div>
			<div class="columns clearfix">
				<div class="col_25">
					<div class="section">
						<?php 
							echo $this->Html->image('ajax_refresh.gif',array('style'=>'margin-top:-15px;float:right;display:none;','id'=>'icon_ajax_refresh')); 
							echo $this->Form->input('WorkingLog.customer_id',array('options'=>$Customers,'label'=>'','style'=>'float:left','empty'=>'请选择对方单位..'));
						?>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<input type="text" id="province_id" value="省份" disabled="disabled">
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<input type="text" id="customer_type" value="类别" disabled="disabled">
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<?php 
						 echo $this->Form->input('WorkingLog.contact_id',array('options'=>array(),'label'=>'','id'=>'contact_selector','style'=>'float:left;','empty'=>'请选择联系人..','disabled'=>'disabled')); 
						 ?>
					</div>
				</div>
			</div>
			<div class="columns clearfix">
				<div class="col_25">
					<div class="section">
						<p style="float:left;line-height:35px;" id="contact_phone">联系方式</p>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<p style="float:left;line-height:35px;" id="contact_dept">部门</p>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<p style="float:left;line-height:35px;" id="contact_manager">上级领导</p>
					</div>
				</div>
				<div class="col_25">
					<div class="section">
						<p style="float:left;line-height:35px;" id="contact_email">电子邮件</p>
					</div>
				</div>
			</div>
		<fieldset class="label_side">
			<label>项目名称</label>
			<div>
			<?php 
				echo $this->Form->input('Presentation.projects', array(
								'type' => 'select',
								'multiple' => 'checkbox',
								'options' => $projects,
								'label'=>'','div'=>false,'default'=>$this->Session->read('my_project')
				));
			?>
			</div>
		</fieldset>
		
		<fieldset class="label_side">
			<label>标题</label>
			<div>
			<?php 
				echo $this->Form->input('WorkingLog.name',array('label'=>'','div'=>false,'type'=>'text'));
			?>
			<div class="required_tag tooltip hover left" title="必填项目"></div>
			</div>
		</fieldset>
		<fieldset class="label_side">
			<label>沟通内容</label>
			<div>
				<?php 
					echo $this->Form->input(
							'WorkingLog.content',
							array('label'=>'',
									'class'=>'tooltip autogrow',
									'title'=>"输入框会自动根据您的输入调整大小",
									'placeholder'=>'点击输入',
									'type'=>'textarea',
									'div'=>false));
				?>
			</div>
		</fieldset>
		<fieldset class="label_side">
			<label>沟通结果</label>
			<div>
				<?php 
					echo $this->Form->input(
							'WorkingLog.result',
							array('label'=>'',
									'class'=>'tooltip autogrow',
									'title'=>"输入框会自动根据您的输入调整大小",
									'placeholder'=>'点击输入',
									'type'=>'textarea',
									'div'=>false));
				?>
			</div>
		</fieldset>
		<fieldset class="label_side">
			<label>本人建议或问题</label>
			<div>
				<?php 
					echo $this->Form->input(
							'WorkingLog.questions',
							array('label'=>'',
									'class'=>'tooltip autogrow',
									'title'=>"输入框会自动根据您的输入调整大小",
									'placeholder'=>'点击输入',
									'type'=>'textarea',
									'div'=>false));
				?>
			</div>
		</fieldset>
		<table class="static">
			<tbody>
				<tr>
					<td>下次沟通日期</td>
					<td><?php echo $this->Form->input('WorkingLog.next_appointment',array('label'=>'','empty'=>FALSE,'maxYear'=>(date('Y')+1),'minYear'=>(date('Y')))); ?></td>
				</tr>
			</tbody>
		</table>
		<fieldset class="label_side">
			<label>下次沟通内容</label>
			<div>
			<?php 
				echo $this->Form->input('WorkingLog.next_title',array('label'=>FALSE,'div'=>FALSE,'type'=>'text'));
			?>
			<div class="required_tag tooltip hover left" title="必填项目"></div>
			</div>
		</fieldset>
		<button class="green full_width">
											<div class="ui-icon ui-icon-carat-1-n"></div>
											<span>提交</span>
										</button>
								<?php echo $this->Form->end();?>
	</div>
</div>