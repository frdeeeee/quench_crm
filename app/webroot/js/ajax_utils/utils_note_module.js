$(document).ready(function(){
	if($(".view_note_content_triger").length>0){
		bind_fancybox();
	}
	//删除note
	if($("#note_remove_btn").length>0){
		$("#note_remove_btn").click(function(){
			var url = get_root() + "Notes/remove";
			var json_data = {
					note_id:$("#NoteDeleteId").val()
				};
			$.post(
					url,
					json_data,
					function(data){
						if(data!=0){
							remove_from_notes_list(data);//服务器回传回被删除的id的值
							$.fancybox.close();
						}else{
							alert('便条删除失败，请稍候再试或者联系管理员！');
						}
					},
					'json'
			);
		});
	}
	//
	if($("#note_add_trigger").length > 0){
		$("#note_add_trigger").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//检查现在由几个标签项,如果为0,那么通过ajax加载
						if($("#NoteTagId option").length==0){
							var url = get_root() + "Notes/load_all_tags";
							$.post(
									url,
									{},
									function(data){
										var tags_selector = $("#NoteTagId");
										for(var key in data){
											var opt = '<option value="'+key+'">'+data[key]+'</option>';
											tags_selector.append(opt);
										}
									},
									'json'
							);
							$("#NoteTagId").attr('disabled',null);
							$("#NoteIsCool").attr('disabled',null);
							$("#NoteOnDesktop").attr('disabled',null);
							$("#NoteName").attr('disabled',null);
							$("#NoteContent").attr('disabled',null);
						}
					}
				}
		);
	}
	//提交note表单
	if($("#note_add_btn").length>0){
		$("#note_add_btn").click(function(){
			var url = get_root() + "Notes/add";
			var json_data = {
					tag_id:$("#NoteTagId").val(),
					is_cool:$("#NoteIsCool").val(),
					user_id:$("#NoteUserId").val(),
					on_desktop:$("#NoteOnDesktop").val(),
					name:$("#NoteName").val(),
					content:$("#NoteContent").val()
				};
			$("#icon_note_adding_refresh").show();
			$.post(
					url,
					json_data,
					function(data){
						if(data!=0){
							//alert('便条添加成功！');
							unshift(data, json_data);
							$.fancybox.close();
							bind_fancybox();//这里一定要从新绑定所有查看note内容的事件
						}else{
							alert('便条添加失败，请稍候再试或者联系管理员！');
						}
						$("#icon_note_adding_refresh").hide();
					},
					'json'
			);
		});
	}
});
/*将刚刚成功添加的便条放到队列的头部*/
function unshift(new_note_id, data_in_json){
	var containner = $('#note_items_containner');//一个ul元素
	/**
	 * <li class="cool"><a
					href="styles/theme/switcher2.php?style=switcher.css"
					class="features"> <img src="images/icons/large/grey/frames.png"> <span
						class="name">Side Nav</span> <span class="update">0</span>
						<div class="starred"></div> </a></li>
	 */
	//先检查是不是重要的note，如果不是就加上新的标签，是就加上cool标签
	var note_item = '<li class="'+
		((data_in_json.is_cool==0)?'new':'cool')+
		'"><a class="view_note_content_triger features" title="'+data_in_json.content+
		'" href="#note_content_viewer_wrapper" name="' + new_note_id + 
		'"><img src="/img/icons/small/grey/frames.png">'+
		'<span class="name">'+data_in_json.name+'</span><div class="starred"></div></a></li>';
	
	containner.prepend($(note_item)).isotope('reloadItems').isotope({sortBy:'original-order'});
	//每增加一个，就取消查看note内容的绑定，并再fancybox关闭之后再从新绑定，这样就可以让新note也响应查看内容的click事件了
	$(".view_note_content_triger").each(function(){
		$(this).unbind('click');
	});
}
//从列表中删除指定的note
function remove_from_notes_list(note_id){
	$("#note_id_"+note_id).remove();
	$('#note_items_containner').isotope('reloadItems').isotope({sortBy:'original-order'});
}
function bind_fancybox(){
	$(".view_note_content_triger").fancybox(
			{
				'showNavArrows':false,
				'titleShow':false,
				'onStart':function(itemArray, selectedIndex, selectedOpts){
					//填充便条的真实内容
					$("#current_note_content").text( itemArray[selectedIndex].title );//取得note内容
					$("#NoteDeleteId").val( itemArray[selectedIndex].name );//取得note id
				}
			}
		);
}