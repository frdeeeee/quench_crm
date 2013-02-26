<?php 
	echo $this->Html->script('ajax_utils/utils_download_files',false); 
?>
<div class="flat_area grid_16">
	<h2>Shared Files</h2>
	<?php 
		if (isset($msg_type)) {
			echo $this->Msg->output( $msg_type,$this->Session->flash() );
		}
	?>
</div>
<div class="box grid_16">
		<a class="load_download_file_add_form_btn short_message_btn" href="#download_file_form" name="<?php echo $current_user['id'];?>">Upload files</a>
</div>
<div class="box grid_4">
	<h2 class="box_head grad_blue">Choose File owner</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">	
			<div class="block">
				<table class="static"> 
					<thead> 
						<tr> 
							<th>Owner</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ( $receivers as $key=>$employee) {
								echo '<tr><td>',$this->Html->link($employee,array('controller'=>'DownloadFiles','action'=>'list_all',$key)),'</td></tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
</div>

	
<div class="box grid_12">
	<h2 class="box_head grad_blue">Available Files</h2>
		<a href="#" class="grabber"></a>
		<a href="#" class="toggle"></a>
		<div class="toggle_container">					
			
			<div class="block">
				<table class="static"> 
					<thead> 
						<tr> 
							<th>Owner</th> 
							<th>File Title</th>
							<th>File Type</th> 
							<th>Created</th>  
							<th>Actions</th>
						</tr> 
					</thead> 
					<tbody>
						<?php 
							foreach ($data as $value) {
								echo '<tr><td>',$value['User']['name'],'</td>';
								echo '<td>',$value['DownloadFile']['title'],' (',$value['DownloadFile']['file_name'],')</td>';
								echo '<td>',$value['DownloadFile']['mimeType'],'</td>';
								echo '<td>',$value['DownloadFile']['created'],'</td>';
								echo '<td>',$this->Html->link('Download',
											array('controller'=>'DownloadFiles','action'=>'download',$value['DownloadFile']['id']),
											array('style'=>'color:blue;')),'&nbsp;&nbsp;';
								if ($current_user['id']==$value['DownloadFile']['user_id']) {
									echo $this->Html->link('Remove',
										array('controller'=>'DownloadFiles','action'=>'remove_phiscally',$value['DownloadFile']['id']),
										array('style'=>'color:red;'),
										'Are you sure you want to remove this file?'
									);
								}
								echo '</td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php 
					echo $this->element('pagination_bar');
				?>
			</div>
		</div>
</div>

<div style="display:none">
	<div id="download_file_form" style="width:600px;height:300px;overflow:auto;">
		<h2 style="margin-top: 10px;">
		File Upload
		</h2>
		<?php 
			echo $this->Form->create(
				NULL,
				array(
					'type'=>'file',
					'url'=>'/DownloadFiles/add',
					'onSubmit'=>'return validate_upload_file_form();'
				)
			);
			echo $this->Form->input('DownloadFile.user_id',array('type'=>'hidden','value'=>$current_user['id']));
		?>
		<fieldset class="label_side">
			<label>File Title</label>
				<div>
					<?php echo $this->Form->input('DownloadFile.title',array('label'=>'','div'=>FALSE,'type'=>'text')); ?>
				</div>
		</fieldset>
		<fieldset class="label_side">
			<label>Choose File</label>
				<div>
					<?php echo $this->Form->file('DownloadFile.application_form',array('class'=>'uniform','id'=>'fileupload','type'=>'file')); ?>
				</div>
		</fieldset>
		<input type="submit" class="short_message_btn" value="Upload" style="padding-bottom: 8px;" />
		<?php echo $this->Form->end();?>
	</div>
</div>