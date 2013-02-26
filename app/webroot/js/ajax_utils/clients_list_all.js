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
		$(".contact_item").each(function(){
			$(this).click(function(){
				//改变被点击条目的颜色
				if(index_of_last_clicked_contact_item==0){
					index_of_last_clicked_contact_item = $(this).attr('title');
				}else{
					$("#contact_item_"+index_of_last_clicked_contact_item).removeClass('clicked_contact_item');
					index_of_last_clicked_contact_item = $(this).attr('title');
				}
				$("#contact_item_"+index_of_last_clicked_contact_item).addClass('clicked_contact_item');
				//先检查当前的条目是否被更新了
				if($("#is_form_updated").text()=="1"){
					//取得client的信息，根据contact id
					var id = $(this).attr("title");
					var url = get_root() + 'Clients/ajax_get_client';
					$.post(
						url,
						{contact_id:id},
						function(data){
							parse_json_bean(data,"#ContactListAllForm","data[Contact]");
							parse_json_bean(data,"#ClientWebhostingListAllForm","data[ClientWebhosting]");
							parse_json_bean(data,"#ClientSocialListAllForm","data[ClientSocial]");
							parse_json_bean(data,"#ClientSEOListAllForm","data[ClientSEO]");
							parse_json_bean(data,"#ClientSEMListAllForm","data[ClientSEM]");
							parse_json_bean(data,"#ClientOtherListAllForm","data[ClientOther]");
							parse_json_bean(data,"#ClientAccountingListAllForm","data[ClientAccounting]");
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
				};
				
			});
		});
		//查找所有id以data结尾的input，并绑定datepicker
		$("input[id$='Date']").each(function(){
			$(this).datepicker();
		});
		
		
		//保存client的Accounting数据
		$("#save_accounting_ajax").click(function(){
			$.post(
					get_root() + 'Clients/ajax_save_accounting',
					$("#ClientAccountingListAllForm").serialize(),
					function(data){
						if(data.result==0){
							//保存失败
							alert('Can not save the client info, please try later.');
						}else{
							alert('Client info has been saved successfully!');
						}
					},
					'json'
			);
			return false;
		});
		
		//保存client的other数据
		$("#save_other_ajax").click(function(){
			$.post(
					get_root() + 'Clients/ajax_save_other',
					$("#ClientOtherListAllForm").serialize(),
					function(data){
						if(data.result==0){
							//保存失败
							alert('Can not save the client info, please try later.');
						}else{
							alert('Client info has been saved successfully!');
						}
					},
					'json'
			);
			return false;
		});
		//保存client的sem数据
		$("#save_sem_ajax").click(function(){
			$.post(
					get_root() + 'Clients/ajax_save_sem',
					$("#ClientSEMListAllForm").serialize(),
					function(data){
						if(data.result==0){
							//保存失败
							alert('Can not save the client info, please try later.');
						}else{
							alert('Client info has been saved successfully!');
						}
					},
					'json'
			);
			return false;
		});
		//保存client的seo数据
		$("#save_seo_ajax").click(function(){
			$.post(
					get_root() + 'Clients/ajax_save_seo',
					$("#ClientSEOListAllForm").serialize(),
					function(data){
						if(data.result==0){
							//保存失败
							alert('Can not save the client info, please try later.');
						}else{
							alert('Client info has been saved successfully!');
						}
					},
					'json'
			);
			return false;
		});
		//保存client的social数据
		$("#save_social_ajax").click(function(){
			$.post(
					get_root() + 'Clients/ajax_save_social',
					$("#ClientSocialListAllForm").serialize(),
					function(data){
						if(data.result==0){
							//保存失败
							alert('Can not save the client info, please try later.');
						}else{
							alert('Client info has been saved successfully!');
						}
					},
					'json'
			);
			return false;
		});
		//保存client的hosting数据
		$("#save_web_hosting_ajax").click(function(){
			$.post(
					get_root() + 'Clients/ajax_save_web_hosting',
					$("#ClientWebhostingListAllForm").serialize(),
					function(data){
						if(data.result==0){
							//保存失败
							alert('Can not save the client info, please try later.');
						}else{
							//保存成功，返回的是最新的contact id值，需要把它付给contactId字段
							alert('Client info has been saved successfully!');
						}
					},
					'json'
			);
			return false;
		});
		//保存client的hosting数据
		$("#save_web_hosting_ajax").click(function(){
			$.post(
					get_root() + 'Clients/ajax_save_accounting',
					$("#ClientAccountingListAllForm").serialize(),
					function(data){
						if(data.result==0){
							//保存失败
							alert('Can not save the client info, please try later.');
						}else{
							//保存成功，返回的是最新的contact id值，需要把它付给contactId字段
							alert('Client info has been saved successfully!');
						}
					},
					'json'
			);
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
								//保存成功，返回的是最新的contact id值，需要把它付给contactId字段
								$("#ContactId").val(data.result);
								alert('Contact info has been saved successfully!');
							}
						},
						'json'
				);
				return false;
			}
		});
	}
});

function parse_json_bean(data,context,bean_name_prefix){
	//刷新最后更新日期的文本
	if(bean_name_prefix=="data[Contact]"){
		$("#contact_modified_text").text(data.Contact['modified']+' / '+data.Contact['modified']);
	}
	//其他
	var all_inputs = $("input,textarea,number",context);
	var len = all_inputs.length;
	for ( var int = 0; int < len; int++) {
		//利用input的name属性来进行附值
		var name = all_inputs.eq(int).attr("name");
		if( name){
			//data[Contact][type_id],下面的语句会截取出type_id
			var name_len = all_inputs.eq(int).attr("name").length;
			var field_name = all_inputs.eq(int).attr("name").substring(bean_name_prefix.length+1,name_len-1);
			//检查一下，因为不会有字段长度为1的情况，避免一些可能的错误
			if(field_name.length>1){
				//給input进行附值
				switch (bean_name_prefix) {
				case "data[Contact]":
					all_inputs.eq(int).val(data.Contact[field_name]);
					break;
				case "data[ClientWebhosting]":
					all_inputs.eq(int).val(data.ClientWebhosting[field_name]);
					break;
				case "data[ClientSocial]":
					all_inputs.eq(int).val(data.ClientSocial[field_name]);
					break;
				case "data[ClientSEO]":
					all_inputs.eq(int).val(data.ClientSEO[field_name]);
					break;
				case "data[ClientSEM]":
					all_inputs.eq(int).val(data.ClientSEM[field_name]);
					break;
				case "data[ClientOther]":
					all_inputs.eq(int).val(data.ClientOther[field_name]);
					break;
				case "data[ClientAccounting]":
					all_inputs.eq(int).val(data.ClientAccounting[field_name]);
					break;
				default:
					break;
				}
				
			}
		}
	}
	//
	var all_selects = $("select",context);
	var len_select = all_selects.length;
	for ( var int = 0; int < len_select; int++) {
		//利用input的name属性来进行附值
		var name = all_selects.eq(int).attr("name");
		if( name){
			//data[Contact][type_id],下面的语句会截取出type_id
			var name_len = all_selects.eq(int).attr("name").length;
			var field_name = all_selects.eq(int).attr("name").substring(bean_name_prefix.length+1,name_len-1);
			//检查一下，因为不会有字段长度为1的情况，避免一些可能的错误
			if(field_name.length>1){
				//給input进行附值
				switch (bean_name_prefix) {
				case "data[Contact]":
					all_selects.eq(int).get(0).value = data.Contact[field_name];
					break;
				case "data[ClientWebhosting]":
					all_selects.eq(int).get(0).value = data.ClientWebhosting[field_name];
					break;
				case "data[ClientSocial]":
					all_selects.eq(int).get(0).value = data.ClientSocial[field_name];
					break;
				case "data[ClientSEO]":
					all_selects.eq(int).get(0).value = data.ClientSEO[field_name];
					break;
				case "data[ClientSEM]":
					all_selects.eq(int).get(0).value = data.ClientSEM[field_name];
					break;
				case "data[ClientOther]":
					all_selects.eq(int).get(0).value = data.ClientOther[field_name];
					break;
				case "data[ClientAccounting]":
					all_selects.eq(int).get(0).value = data.ClientAccounting[field_name];
					break;
				default:
					break;
				}
			}
		}
	}
	
}