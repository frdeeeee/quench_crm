var event_tool_box_wrapper_shown = false;
$(document).ready(function(){
	/**
	 * 所有页面都可能用到的一些功能
	 */
	window.document.onclick = function(){
		if($("#day_tasks_tool_box_wrapper").length > 0){
			$("#day_tasks_tool_box_wrapper").hide();
		}
		if($("#event_tool_box_wrapper").length > 0){
			$("#event_tool_box_wrapper").hide();
		}
	};
	
	//查找所有id以data结尾的input，并绑定datepicker
	$("input[id$='Date']").each(function(){
		$(this).datepicker();
	});
	
	
	if($(".show_comments").length>0){
		$(".show_comments").fancybox();
	}
	
	
	if($("a[rel=fancy_trigger_group]").length > 0){
		$("a[rel=fancy_trigger_group]").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//itemArray is the complete list of all fancybox elements within the current group (elements that you designate with a common rel=”" attribute).
						//selectedIndex is the numerical index (0 offset) of the fancybox element being currently evaluated.
						//selectedOpts are all the fancybox options that are active on the element currently being evaluated. 
						//The return value is an Object that contains fancybox options that get added (or replace) the options on the currently evaluated element
						//set the value of mobile of receiver取得手机号并设置到发信表单中
						$("#SmsReceiverId").val( $("#mobile_nb_"+itemArray[selectedIndex].title).text() );
					}
				}
		);
		
		$("#sms_send_btn").click(function(){
			var receiver_mobile = $("#SmsReceiverId").val(); //取得收信人手机号
			var message_content = $("#SmsContent").val();
			var url = get_root() + "ShortMessages/send_sms_ajax";
			$("#icon_sms_sending_refresh").show();
			$.post(
					url,
					{
						receiver_mobile:receiver_mobile,
						message_content:message_content
					},
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data.string==1){
							alert('短信发送成功！');
							$.fancybox.close();
						}else{
							alert('短信发送失败，请联系管理员！');
						}
						$("#icon_sms_sending_refresh").hide();
					},
					'json'
			);
		});
	}
	
	//当点击actionbox中的按钮时的响应
	
	
	//响应select all的功能
	if($("#select_all").length>0){
		$("#select_all").change(function(){
			var is_select_all = $(this).attr('checked');
			if(typeof is_select_all == 'undefined'){
				$(".select_itmes").each(function(){
					$(this).attr('checked',null);
				});
			}else{
				$(".select_itmes").each(function(){
					$(this).attr('checked','checked');
				});
			}
		});
	}
	
	//更多操作按钮
	if($(".action_trigger").length > 0){
		$(".action_trigger").each(function(){
			$(this).click(function(){
				if(current_shown_action==0){
					//means no action box shown
					var top = $(this).offset().top-15;
					var left = $(this).offset().left-120;
					current_shown_action = $(this).attr('name');
					$("#action_box_"+current_shown_action).show();
					//$(this).text('隐藏菜单');
					$("#action_box_"+current_shown_action).css('left',left).css('top',top);
					//response the any click then hide
					$("#action_box_"+current_shown_action).attr('tabindex',-1);//important
					$("#action_box_"+current_shown_action).focus();
					$("#action_box_"+current_shown_action).blur(function(){
						//delay is important
						setTimeout(function(){
							$("#action_box_"+current_shown_action).hide(100);
							current_shown_action = 0;
						}, 200);
					});
				}else{
					//means to hide
					$("#action_box_"+current_shown_action).hide();
					$("#action_box_"+current_shown_action).unbind('blur');
					current_shown_action = 0;
					//$(this).text('更多菜单');
				}
			});
		});
	}
	
	//
	if($("#current_group_selector").length>0){
		$("#current_group_selector").change(function(){
			var group_id = $("#current_group_selector").val(); 
			var url = get_root() + "Tasks/ajax_get_tasks_by_group";
			$("#icon_sms_sending_refresh").show();
			$.post(
					url,
					{group_id:group_id},
					function(data){
						$("#current_project_selector").html('');
						//返回的是属于该组的tasks列表, id:customer_name
						if(data.length>0){
							var opt ='<option value="">Please choose group...</option>';
							$("#current_project_selector").append(opt);
							$.each(data,function(key,value){
								opt = '<option value="'+data[key].Project.id+'">'+data[key].Task.name+'</option>';
								$("#current_project_selector").append(opt);
							});
							$("#enter_btn").attr('disabled',null);
						}else{
							$("#enter_btn").attr('disabled','disabled');
						}
						$("#icon_sms_sending_refresh").hide();
					},
					'json'
			);
		});
	}
});

function get_root(){
	return "http://"+document.location.hostname+"/";
}