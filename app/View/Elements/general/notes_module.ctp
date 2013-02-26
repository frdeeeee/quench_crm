<div class="main_container container_16 clearfix">
	<div class="box grid_8">
		<div class="block">
			<fieldset class="label_side label_small">
				<label>Stickies Filter</label>
				<div>
					<div class="jqui_radios">
						<input type="radio" name="filter" class="isotope_filter"
							id="filter_all" checked="checked" /><label for="filter_all">All</label>
						<input type="radio" name="filter" class="isotope_filter"
							id="filter_new" /><label for="filter_new">Past 2 weeks</label> <input
							type="radio" name="filter" class="isotope_filter"
							id="filter_cool" /><label for="filter_cool">Important</label>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="box grid_8">
		<div class="block">
			<fieldset class="label_side label_small">
				<label>Sort</label>
				<div>
					<div class="jqui_radios">
						<input type="radio" name="sort" class="isotope_sort"
							id="sort_name" checked="checked" /><label for="sort_name">Title</label>
						<input type="radio" name="sort" class="isotope_sort"
							id="sort_update" /><label for="sort_update">Date</label> 
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="grid_16">
		<div class="indent gallery">
			<ul class="clearfix feature_tiles" id="note_items_containner">
				<?php 
					if (count($my_notes)==0) {
						echo '';
					}else{
						$two_weeks_ago = mktime(0, 0, 0, date("m")  , date("d")-14, date("Y")); 
						$class_type = 'all';
						
						foreach ($my_notes as $note_item) {
							$update = strtotime( $note_item['Note']['modified']); //把更新时间找出来，用于下面的过滤和排序
							?>
							<?php 
								if ($update> $two_weeks_ago) {
									$class_type = 'new';
								}
								if ($note_item['Note']['is_cool']==1) {
									$class_type = 'cool';
								}
							?>
							<li class="<?php echo $class_type?>" id="note_id_<?php echo $note_item['Note']['id'];?>">
									<a class="view_note_content_triger" name="<?php echo $note_item['Note']['id'];?>" href="#note_content_viewer_wrapper" title="<?php echo $note_item['Note']['content'];?>">
										<?php echo $this->Html->image('icons/small/grey/'.$note_item['Tag']['icon']); ?>
										<span class="name"><?php echo $note_item['Note']['name']?></span>
										<span class="update"><?php echo $update; ?></span>
										<span class="<?php echo ($note_item['Note']['on_desktop']==1)?'starred green':'' ;?>"></span>
									</a>
							</li>
							<?php
						}
					}
				?>

			</ul>
		</div>
	</div>
</div>