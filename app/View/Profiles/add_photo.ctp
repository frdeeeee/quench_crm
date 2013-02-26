<div class="flat_area grid_16">
	<h2>我的照片库</h2>
</div>
<?php 
	if (isset($msg_type)) {
		echo $this->Msg->output( $msg_type,$this->Session->flash() );
	}
?>

<div class="box grid_16">
	<h2 class="box_head grad_blue">上传我的照片</h2>
	<a href="#" class="grabber">&nbsp;</a> <a href="#" class="toggle">&nbsp;</a>
	<div class="toggle_container">
		<div class="block">
		<?php
		echo $this->Form->create(NULL,array('type'=>'file','url'=>'/Profiles/add_photo'));
		echo $this->Form->input('CheckinPhoto.enquiry_id',array('type'=>'hidden','value'=>$this->Session->read('enquiry_id')));
		?>
			<fieldset class="label_side">
				<label>照片标题</label>
				<div>
				<?php echo $this->Form->input('CheckinPhoto.title',array('label'=>FALSE,'div'=>FALSE)); ?>
				</div>
			</fieldset>
			<fieldset class="label_side">
				<label>选择文件</label>
				<div>
				<?php echo $this->Form->file('CheckinPhoto.application_form',array('class'=>'uniform','id'=>'fileupload','type'=>'file')); ?>
				</div>
			</fieldset>
			<fieldset class="label_side">
				<label>照片故事</label>
				<div>
				<?php echo $this->Form->input('CheckinPhoto.description',array('label'=>FALSE,'div'=>FALSE)); ?>
				</div>
			</fieldset>
			<div class="section">
				<button class="green full_width div_icon has_text">
					<div class="ui-icon ui-icon-carat-1-n"></div>
					<span>上传我的照片</span>
				</button>
			</div>
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<div class="flat_area grid_16">
	<h2>我的相册</h2>
</div>

<div class="grid_16">
	<div class="indent gallery fancybox">
		<ul class="clearfix">
			<?php 
				foreach ($data as $value) {
					?>
					<li class="blue">
						<a rel="collection" 
							href="/img/student_files/<?php echo $value['CheckinPhoto']['enquiry_id'].'/'.$value['CheckinPhoto']['file_path']; ?>"
							title="<?php echo $value['CheckinPhoto']['description'];?>"> 
							<?php 
								echo $this->Html->image(
									'student_files/'.$value['CheckinPhoto']['enquiry_id'].'/'.$value['CheckinPhoto']['file_path'],
									array('height'=>84,'width'=>150)
								);
							?>
							<span class="name"><?php echo $value['CheckinPhoto']['title'];?></span> 
							<span class="size"><?php echo round($value['CheckinPhoto']['file_size']/1000,0);?>kb</span>
						</a>
					</li>
					<?php
				}
			?>
		</ul>
		<div class="section">
			<?php echo $this->element('pagination_bar'); ?>
		</div>
	</div>
	
</div>
