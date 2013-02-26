var slider_not_run = true;
var index_of_last_clicked_contact_item = 0;
$(document).ready(function(){
	/*Start slider nav*/
	if(slider_not_run){
		$('#slider_list').sliderNav({height:'600',arrows:true});
		$(".slide-down").eq(0).show();
		$(".slide-up").eq(0).show();
		
		slider_not_run = false;
		//响应在用户列表中的用户条目的鼠标点击事件
		//$(".contact_item").each(function(){
			$(".contact_item").live('click',function(){
				//改变被点击条目的颜色
				if(index_of_last_clicked_contact_item==0){
					index_of_last_clicked_contact_item = $(this).attr('title');
				}else{
					$("#contact_item_"+index_of_last_clicked_contact_item).removeClass('clicked_contact_item');
					index_of_last_clicked_contact_item = $(this).attr('title');
				}
				$("#contact_item_"+index_of_last_clicked_contact_item).addClass('clicked_contact_item');
				//
				//先检查当前的条目是否被更新了
				if($("#is_form_updated").text()=="1"){
					//Get contact data from DB
					var id = $(this).attr("title");
					var url = get_root() + 'Contacts/ajax_get_contact';
					$.post(
						url,
						{contact_id:id},
						function(data){
							parse_json_contact(data);
						},
						'json'
					);
				}else{
					//当前条目被更新了,提示用户是否更新，还是忽略
					$( "#contact_confirm_change_or_ignore" ).dialog({
				        resizable: false,
				        height:140,
				        modal: true,
				        buttons: {
				            "Save": function() {
				                $( this ).dialog( "close" );
				            },
				            "Ignore": function() {
				                $( this ).dialog( "close" );
				            }
				        }
				    });
				}
			});
		//});
		
		//清空当前的contact表单
		$("#clear_contact_form").click(function(){
			var all_inputs = $("input","#ContactListAllForm");
			all_inputs.each(function(){
				if($(this).attr('name')!='data[Contact][created_by]'){
					$(this).val('');
				}
			});
			return false;
		});
		//专为正式客户
		$("#save_as_client_ajax").click(function(){
			$("#contact_became_client_confirm").dialog({
			 	resizable: false,
		        height:140,
		        modal: true,
		        buttons: {
		            "Confirm": function() {
		                $( this ).dialog( "close" );
		                //开始真正的保存操作
		                $.post(
								get_root() + 'Clients/ajax_add_new',
								{contact_id:$("#ContactId").val()},
								function(data){
									if(data.result==0){
										//保存失败
										alert('Can not find the contact info.');
									}else if(data.result==-1){
										alert('This contact has been a client.');
									}else if(data.result==-2){
										alert('Can not add this client, please try later.');
									}else{
										alert('This contact has been saved as a new client.');
										//从左侧的列表中删除contact项
										var li_item_id = "#contact_item_"+$("#ContactId").val();
										$(li_item_id).remove();
										//清空表单
										$("#clear_contact_form").trigger('click');
									}
								},
								'json'
						);
		            },
		            "Cancel": function() {
		                $( this ).dialog( "close" );
		            }
		        }
		});
		return false;
		});
		//删除当前的contact
		$("#remove_contact_ajax").click(function(){
			$("#contact_confirm_delete").dialog({
				 	resizable: false,
			        height:140,
			        modal: true,
			        buttons: {
			            "Delete": function() {
			                $( this ).dialog( "close" );
			                //开始真正的删除操作
			                $.post(
									get_root() + 'Contacts/ajax_remove',
									{id:$("#ContactId").val()},
									function(data){
										if(data.result==1){
											alert('Contact info has been deleted successfully!');
											//从左侧的列表中删除contact项
											var li_item_id = "#contact_item_"+$("#ContactId").val();
											$(li_item_id).remove();
											//清空表单
											$("#clear_contact_form").trigger('click');
										}else{
											alert('Can not delete the contact, please try later.');
										}
									},
									'json'
							);
			            },
			            "Cancel": function() {
			                $( this ).dialog( "close" );
			            }
			        }
			});
			return false;
		});
		//加入校验规则
		$("#ContactListAllForm").validate({
			rules:{
				'data[Contact][first_name]': "required",
				'data[Contact][email]': {
				    required: true,
				    email: true
				},
				'data[Contact][phone]': {
				    required: true,
				    digits: true
				}
			},
			submitHandler: function(form) {
				//验证成功，保存提交的数据
				$.post(
						get_root() + 'Contacts/ajax_add_new',
						$("#ContactListAllForm").serialize(),
						function(data){
							if(data.result==0){
								//保存失败
								alert('Can not save the contact, please try later.');
							}else{
								if(data.is_update=0){
									//保存成功，返回的是最新的contact id值，需要把它付给contactId字段
									$("#ContactId").val(data.result);
									//把新的contact插入到左侧的列表中
									var _first_upper_letter = $("#ContactFirstName").val().substring(1,0).toUpperCase();//取首字母并转为大写
									//构造一个新的contact项
									var new_li_element = '<li id="contact_item_'+
												data.result+
												'"><a class="contact_item" title="'+
												data.result+
												'" href="#">'+$("#ContactFirstName").val()+' '+
												$("#ContactMiddleName").val()+' '+
												$("#ContactLastName").val()+' '+
												$("#ContactCompany").val()+'</a></li>';
									$("#contacts_list_holder_"+_first_upper_letter).append($(new_li_element));
									alert('Contact info has been saved successfully!');
								}else{
									//只有更新才检查是否customer type有变化
									if(data.customer_type != 0){
										var type_str = '(<b>Others</b>)';
										switch (data.customer_type) {
										case "1":
											type_str = '(<b style="color:blue">Cold Lead</b>)';
											break;
										case "2":
											type_str = '(<b style="color:red">Hot Lead</b>)';
											break;
										case "3":
											type_str = '(<b style="color:green">Referral</b>)';
											break;
										default:
											break;
										}
										$("#customer_type_"+data.result).html(type_str);
									}
									alert('Contact info has been updated!');
								}
								$("#contact_modified_text").text(data.created + ' / ' + data.modified);
							}
						},
						'json'
				);
				return false;
			}
		});
		
		//增加新的workinglog纪录的按钮
		$("#add_new_task_log_btn").fancybox({
			'onStart':function(itemArray, selectedIndex, selectedOpts){
				//检查是否选择了contact，如果没有选择，那么提示用户
				if($("#ContactId").val()==''){
					//用户没有选择contact
					$("#working_log_current_contact_info").text("Please choose a contact first!");
					$("#save_working_log_ajax").attr('disabled',"true");
				}else{
					//选择了contact，把其信息写进去
					$("#WorkingLogContactId").val($("#ContactId").val());
					var text = $("#ContactFirstName").val() + ' ' + $("#ContactLastName").val() + '; ' + $("#ContactCompany").val();
					$("#working_log_current_contact_info").text(text);
					$("#save_working_log_ajax").removeAttr("disabled");;
				}
			},
			'autoScale':true
		});
		//增加task时候的校验规则和提交处理
		$("#WorkingLogListAllForm").validate({
			rules:{
				'data[WorkingLog][name]':"required"
			},
			submitHandler: function(form) {
				//验证成功，保存提交的数据
				$.post(
						get_root() + 'WorkingLogs/ajax_add_new',
						$("#WorkingLogListAllForm").serialize(),
						function(data){
							if(data.result==0){
								//保存失败
								alert('Can not save the contact, please try later.');
							}else{
								//打开我的工作纪录表格
								alert('A new task has been saved successfully.');
								$.fancybox.close();
								refresh_task_list(data);
							}
						},
						'json'
				);
				return false;
			}
		});
		
		//响应查看所有tasks的按钮点击事件的方法
		$("#view_all_task_logs_btn").fancybox({
			'onStart':function(itemArray, selectedIndex, selectedOpts){
				//检查是否选择了contact，如果没有选择，那么提示用户
				$.post(
						get_root() + 'WorkingLogs/ajax_list_all',
						{},
						function(data){
							refresh_task_list(data);
						},
						'json'
				);
			},
			'autoScale':true
		});
		
		//响应查看当前客户的task logs的按钮点击事件的方法
		$("#view_current_contact_task_logs_btn").fancybox({
			'onStart':function(itemArray, selectedIndex, selectedOpts){
				//检查是否选择了contact，如果没有选择，那么提示用户
				$.post(
						get_root() + 'WorkingLogs/ajax_list_current_contact_task_logs',
						{current_contact_id:$("#ContactId").val()},
						function(data){
							refresh_task_list(data);
						},
						'json'
				);
			},
			'autoScale':true
		});
	}
});

function parse_json_contact(data){
	/*給input项目附值*/
	var all_inputs = $("input","#ContactListAllForm");
	var len = all_inputs.length;
	for ( var int = 0; int < len; int++) {
		//利用input的name属性来进行附值
		var name = all_inputs.eq(int).attr("name");
		if( name){
			//data[Contact][type_id],下面的语句会截取出type_id
			var name_len = all_inputs.eq(int).attr("name").length;
			var field_name = all_inputs.eq(int).attr("name").substring(14,name_len-1);
			//检查一下，因为不会有字段长度为1的情况，避免一些可能的错误
			if(field_name.length>1){
				//給input进行附值
				all_inputs.eq(int).val(data.Contact[field_name]);
			}
		}
	}
	/*給select项目附值*/
	var all_selects = $("select","#ContactListAllForm");
	var len_select = all_selects.length;
	for ( var int = 0; int < len_select; int++) {
		//利用input的name属性来进行附值
		var name = all_selects.eq(int).attr("name");
		if( name){
			//data[Contact][type_id],下面的语句会截取出type_id
			var name_len = all_selects.eq(int).attr("name").length;
			var field_name = all_selects.eq(int).attr("name").substring(14,name_len-1);
			//检查一下，因为不会有字段长度为1的情况，避免一些可能的错误
			if(field_name.length>1){
				//給input进行附值
				all_selects.eq(int).get(0).value = data.Contact[field_name];
			}
		}
	}
	/*給textarea*/
	var all_textarea = $("textarea","#ContactListAllForm");
	var len_textarea = all_textarea.length;
	for ( var int = 0; int < len_textarea; int++) {
		//利用input的name属性来进行附值
		var name = all_textarea.eq(int).attr("name");
		if( name){
			//data[Contact][type_id],下面的语句会截取出type_id
			var name_len = all_textarea.eq(int).attr("name").length;
			var field_name = all_textarea.eq(int).attr("name").substring(14,name_len-1);
			//检查一下，因为不会有字段长度为1的情况，避免一些可能的错误
			if(field_name.length>1){
				//給input进行附值
				all_textarea.eq(int).val(data.Contact[field_name]);
			}
		}
	}
	/*Set created datetime value*/
	$("#contact_modified_text").text(data.Contact['created']+' / '+data.Contact['modified']);
}
//专门为了刷新task列表的方法
function refresh_task_list(data){
	$("#ajax_task_list tbody").html('');
	var len = data.tasks.length;
	for ( var int = 0; int < len; int++) {
		var tr_str = '<tr>';
		tr_str += '<td><a href="/WorkingLogs/list_all_by_contact/'+data.tasks[int].Contact.id+'">'+data.tasks[int].Contact.first_name+' '+data.tasks[int].Contact.last_name+', '+data.tasks[int].Contact.company+'</a></td>';
		tr_str += '<td>'+data.tasks[int].WorkingLog.name+'</td>';
		tr_str += '<td>'+data.tasks[int].WorkingLog.created+'</td>';
		tr_str += '<td>'+data.tasks[int].WorkingLog.next_appointment_date+'</td>';
		tr_str += '<td><a href="/WorkingLogs/view_detail/'+data.tasks[int].WorkingLog.id
				  +'">View details</a> - <a href="/WorkingLogs/remove/'+data.tasks[int].WorkingLog.id
				  +'">Delete</a> - <a href="/WorkingLogs/modify/'+data.tasks[int].WorkingLog.id
				  +'">Modify</a></td></tr>';
		$("#ajax_task_list tbody").append($(tr_str));
	}
	return;
}