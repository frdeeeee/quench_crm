<?php 
		echo '<div class="pagination_wrapper"><div class="pagination_btns_wrapper">';	
		//$this->Paginator->options = array('url'=>"/$controller_name/$action_name");
		if (isset($controller_name) && isset($query_id)) {
			$this->Paginator->options = array('url'=>array('controller'=>$controller_name,'action'=>'search',$query_id));
		}
		
		echo $this->Paginator->first(
				'First',
				array('class' => 'pg_btn_first')
		);
							echo $this->Paginator->prev(
									'Prev',
									array('class' => 'pg_btn_prev')
							);
							
							//echo '<div id="pagination_bar">';
							$temp_params = $this->Paginator->params();
							//debug($temp_params);
							for ($i = 1; $i < $temp_params['pageCount']+1; $i++) {
								if ($i==$temp_params['page']) {
									echo $this->Paginator->link(
										$i
										,array(
												'sort' => 'name', 
												'page' => $i, 
												'direction' => 'DESC'
											),
										array('escape'=>false,'class'=>'pg_btn_current'));
								}else{
									echo $this->Paginator->link(
											$i
											,array(
													'sort' => 'name', 
													'page' => $i, 
													'direction' => 'DESC',
												),
											array('escape'=>false,'class'=>'pg_btn'));
								}
								
							}
							//echo '</div>';
							echo $this->Paginator->next(
									'Next', 
									array('class' => 'pg_btn_next')
									);
	echo $this->Paginator->last(
			'Last', 
			array('class' => 'pg_btn_last')
	);
	echo '</div></div>';
	/**
	 * <div class="pagination_wrapper">
					<div class="pagination_btns_wrapper">
						<span class="pg_btn_first">首页</span>
						<span class="pg_btn_prev">前一页</span>
						<span class="pg_btn_current">1</span>
						<span class="pg_btn">2</span>
						<span class="pg_btn">3</span>
						<span class="pg_btn">4</span>
						<span class="pg_btn">5</span>
						<span class="pg_btn_next">后一页</span>
						<span class="pg_btn_last">末页</span>
					</div>
				</div>
			</div>
	 */
?>
