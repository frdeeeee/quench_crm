<table border="1" cellpadding="1">
	<thead>
		<tr>
			<?php 
				foreach ($field_heads as $value) {
					echo '<td><b>',$value,'</b></td>';
				}
			?>
		</tr>
	</thead>
	<tbody>
		<?php  
			foreach ($data as $value) {
				echo '<tr>';
				foreach ($query_fields as $v) {
					$tf = explode('.', $v); // 0 是model的名字，1是字段的名称
					$current_model_name = $tf[0];
					$current_field_name = $tf[1];
					$current_value = $value[$current_model_name][$current_field_name];
					
					$paser_result = $this->FieldNameParser->parse( $current_field_name );
					if($paser_result){
						//是特殊字段
						if(is_array($paser_result)){
							//返回的是一个数组，里面是所有可能的值，通过$current_value取处其中的值即可
							if (is_null($current_value) || count($current_value)==0){
								echo '<td></td>';
							}else{
								if (isset($paser_result[$current_value])) {
									echo '<td>',$paser_result[$current_value],'</td>';;
								}else{
									'<td></td>';
								}
							}
						}else{
							//不是数组，那返回的是model的名字
							if(is_null($current_value) || empty($current_value)){
								echo '<td></td>';
							}else{
								if (isset($the_value[$paser_result][$current_value])) {
									//表示有对应的值
									echo '<td>',$the_value[$paser_result][$current_value],'</td>';;
								}else{
									echo '<td></td>';
								}
							}
						}
					}else{
						//不是特殊字段
						echo '<td>',$current_value,'</td>';
					}
				}
				echo '</tr>';
			}
		?>
	</tbody>
</table>