var modify_page_locked = false;
var app_id = 0;
var enquiry_id = 0;
var applicant_file_id = 0;

$(document).ready(function(){
	//搜索学生的姓名用
	if($("#find_by_name_input_trigger").length>0){
		$("#find_by_name_input_trigger").focusin(function(){
			if($(this).val()=="输入学生姓名开始搜索..."){
				$(this).val("");
			}
		});
		$("#find_by_name_input_trigger").focusout(function(){
			if($(this).val()==""){
				$(this).val("输入学生姓名开始搜索...");
			}
		});
		//autocomplete functions
		var availableNames = [];
		$(".enq_name","#availble_enquiry_names").each(function(index){
			availableNames[index] = {value:$(this).text(),label:$(this).text(),enq_id:$(this).attr('title')};
		});
		$("#find_by_name_input_trigger").autocomplete({
		    source: availableNames,
		    select: function(event, ui){
		    	$("#target_app_id").val(ui.item.enq_id);
		    }
		});
		//
		$("#switch_to_this_btn").click(function(){
			if($("#target_app_id").val()==""){
				alert("没有选定要跳转的学生的姓名");
			}else{
				window.location.href = get_root() + "Applicants/modify_by_enquiry_id/" + $("#target_app_id").val();
			}
		});
	}
		
	
	//学生上传的照片，老师浏览时使用相册
	if($("a[rel=collection]").length>0){
		$("a[rel=collection]").fancybox({
			'transitionIn' : 'none',
			'transitionOut' : 'none',
			'titlePosition' : 'over'
		});
	}
	
	//关于checkin的留言
	if($(".leave_checkin_teacher_notes_btn").length>0){
		$(".leave_checkin_teacher_notes_btn").fancybox(
				{
					'showNavArrows':false,
					'titleShow':true,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						$("#CheckinId").val( itemArray[selectedIndex].name );
					}
				}		
		);
		$("#leave_checkin_teacher_note_submit").click(function(){
			var url = get_root() + "Checkins/leave_teacher_note";
			var id = $("#CheckinId").val();
			var json_data = {id:id,teacher_notes:$("#CheckinTeacherNotes").val()};
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，留言失败，请稍候再试！');
						}else if(data==1){
							alert('给申请人留言成功！');
							parent.$.fancybox.close();
							$("#checkin_teacher_notes_"+id).text($("#CheckinTeacherNotes").val());
							$("#checkin_is_updated_<?php"+id).html('无更新');
						}
					},
					'json'
			);
		});
	}
	
	if($("#leave_teacher_notes_btn").length>0){
		$("#leave_teacher_notes_btn").fancybox();
		$("#leave_teacher_note_submit").click(function(){
			var url = get_root() + "Profiles/leave_teacher_note";
			var profile_id = $("#leave_teacher_notes_btn").attr('name');
			var json_data = {profile_id:profile_id,teacher_notes:$("#ProfileTeacherNotes").val()};
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，留言失败，请稍候再试！');
						}else if(data==1){
							//alert('给申请人留言成功！');
							parent.$.fancybox.close();
							$("#profile_is_updated_"+profile_id).html('无更新');
						}
					},
					'json'
			);
		});
	}
	
	//通过申请人的某个checkin
	if($(".checkin_pass_btn").length>0){
		$(".checkin_pass_btn").click(function(){
			var url = get_root() + "Checkins/update_status";
			var id = $(this).attr('name');
			var json_data = {id:id};
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，申请人Checkin的通过操作失败，请稍候再试！');
						}else if(data==1){
							alert('申请人的Checkin通过成功！');
							$("#checkin_actions_"+id).text('申请人Checkin已通过');
						}
					},
					'json'
			);
		});
	}
	
	if($("#profile_activate_btn").length>0){
		$("#profile_activate_btn").click(function(){
			var url = get_root() + "Profiles/update_status";
			var json_data = {profile_id:$(this).attr('name')};
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，申请人激活失败，请稍候再试！');
						}else if(data==1){
							alert('申请人激活成功！');
							$("#profile_activate_btn").unbind('click');
							$("#profile_activate_btn").remove();
						}
					},
					'json'
			);
		});
	}
	
	if($(".teacher_upload_app_job_offer_btn").length>0){
		$(".teacher_upload_app_job_offer_btn").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//根据appid初始化表格，取得点击的a连接的id的值，代表了文件的类型
						$("#ApplicationFileDownloadFileId").val( $(itemArray[selectedIndex]).attr('title') );
						$("#ApplicationFilePhaseId").val( $(itemArray[selectedIndex]).attr('name') );
						$("input","#applicant_submit_file_form").each(function(){
							$(this).attr("disabled",null);
						});
					}
				}		
		);
	}
	$("#upload_app_job_offer").fancybox();
	//老师留言给申请人的ajax表单
	if($(".applicant_leave_comments_btn").length >0){
		$(".applicant_leave_comments_btn").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//根据appid初始化表格，取得点击的a连接的id的值，代表了文件的类型
						$("#ApplicationFileId").val( $(itemArray[selectedIndex]).attr('id') );
					}
				}
		);
	}
	if($("#applicant_leave_comment_send_btn").length > 0){
		$("#applicant_leave_comment_send_btn").click(function(){
			var url = get_root() + "ApplicantFiles/leave_comments";
			var Applicant_file_comments = $("#ApplicantFileLatestComments").val();
			applicant_file_id = $("#ApplicationFileId").val();
			var json_data = {
					applicant_file_id:applicant_file_id,
					Applicant_file_comments:Applicant_file_comments
			};
			$.post(
					url,
					json_data,
					function(data){
						if(data==1){
							alert('留言发布成功！');
							$("#is_readed_"+applicant_file_id).html('<b style="color:green">老师已阅</b>');
							$("#latest_comment_"+applicant_file_id).text(Applicant_file_comments);
						}else{
							alert('对不起，留言保存失败，请稍候再试！');
						}
						$.fancybox.close();
					},
					'json'
			);
		});
	}
	
	if(!modify_page_locked){
		toggle_app_form_input('disabled');
		modify_page_locked =true;
	}
	app_id = $("#ApplicantId").val();
	enquiry_id = $("#EnquiryId").val();
	
	//老师修改申请人的归国信息按钮响应
	$("#modify_app_return_btn").click(function(){
		if(modify_page_locked){
			toggle_app_form_input(null,"#app_return_form");
			$(this).text('锁定归国状态');
		}else{
			toggle_app_form_input('disabled',"#app_return_form");
			$(this).text('修改归国状态');
		}	
	});
	
	//老师修改申请人的行程单按钮响应
	$("#modify_app_itinerary_btn").click(function(){
		if(modify_page_locked){
			toggle_app_form_input(null,"#app_itineray_form");
			$(this).text('锁定行程单信息');
		}else{
			toggle_app_form_input('disabled',"#app_itineray_form");
			$(this).text('修改行程单信息');
		}	
	});
	
	//老师修改申请人的签证资料和进度的按钮响应
	$("#modify_app_visa_btn").click(function(){
		if(modify_page_locked){
			toggle_app_form_input(null,"#app_visa_form");
			$(this).text('锁定签证进度信息');
		}else{
			toggle_app_form_input('disabled',"#app_visa_form");
			$(this).text('修改签证进度信息');
		}	
	});
	//如果选择了其他的领馆
	if($("#embassy_id").length>0){
		$("#embassy_id").change(function(){
			if($(this).val()==3){
				$("#embassy_address").show();
				$("#embassy_address").val('请输入哪个领馆或地址');
			}else{
				$("#embassy_address").val('');
				$("#embassy_address").hide();
			}
		});
	}
	
	//老师修改申请人的jf工作信息的按钮响应
	$("#modify_app_job_btn").click(function(){
		if(modify_page_locked){
			toggle_app_form_input(null,'#app_job_form');
			$(this).text('锁定岗位信息');
		}else{
			toggle_app_form_input('disabled','#app_job_form');
			$(this).text('修改岗位信息');
		}	
	});
	//申请人费用于协议信息的处理
	$("#modify_progress_app_btn").click(function(){
		if(modify_page_locked){
			toggle_app_form_input(null,"#app_progress_form");
			$(this).text('锁定状态信息');
		}else{
			toggle_app_form_input('disabled',"#app_progress_form");
			$(this).text('修改状态信息');
		}
	});
	//申请人家庭信息的处理
	$("#modify_family_app_btn").click(function(){
		if(modify_page_locked){
			toggle_app_form_input(null,"#app_family_form");
			$(this).text('锁定家庭信息');
		}else{
			toggle_app_form_input('disabled',"#app_family_form");
			$(this).text('修改家庭信息');
		}
	});
	//申请人基础信息的处理
	$("#modify_basic_app_btn").click(function(){
		if(modify_page_locked){
			toggle_app_form_input(null,"#app_basic_form");
			$(this).text('锁定基础信息');
		}else{
			toggle_app_form_input('disabled',"#app_basic_form");
			$(this).text('修改基础信息');
		}
	});
	//报名费与项目费还有合同信息更新
	$("#modify_contract_app_btn").click(function(){
		if(modify_page_locked){
			toggle_app_form_input(null,"#app_contract_form");
			$(this).text('锁定合同信息');
		}else{
			toggle_app_form_input('disabled',"#app_contract_form");
			$(this).text('修改合同信息');
		}
	});
	
	//老师ajax方式提交修改归国状态信息的按钮
	$("#save_app_return_btn").click(function(){
		if(modify_page_locked){
			alert('申请人归国状态信息被锁定，不能保存。请先解除锁定！');
		}else{
			$(this).text('通讯中，请稍候..');
			var url = get_root() + "Applicants/ajax_save_app_return";
			var json_data = build_app_data_in_json("#app_return_form");
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，申请人归国状态信息保存失败，请稍候再试！');
						}else if(data==1){
							alert('申请人归国状态信息保存成功！');
							$("#save_app_return_btn").text('保存归国状态');
						}
					},
					'json'
			);
		}
	});
	
	//老师ajax方式提交修改郭的签证信息的按钮
	$("#save_app_visa_btn").click(function(){
		if(modify_page_locked){
			alert('申请人签证进度信息被锁定，不能保存。请先解除锁定！');
		}else{
			$(this).text('通讯中，请稍候..');
			var url = get_root() + "ApplicantVisas/ajax_save_app_visa";
			var json_data = build_app_data_in_json("#app_visa_form");
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，申请人签证进度信息保存失败，请稍候再试！');
						}else if(data==1){
							alert('申请人签证进度信息保存成功！');
							$("#save_app_visa_btn").text('保存修改');
						}
					},
					'json'
			);
		}
	});
	//保存行程单按钮的响应
	if($("#save_app_itinerary_btn").length>0){
		$("#save_app_itinerary_btn").click(function(){
			if(modify_page_locked){
				alert('申请人行程单信息被锁定，不能保存。请先解除锁定！');
			}else{
				$(this).text('通讯中，请稍候..');
				var url = get_root() + "ApplicantItineraries/ajax_save_app_itinerary";
				var json_data = build_app_data_in_json("#app_itineray_form");
				$.post(
						url,
						json_data,
						function(data){
							//返回的是属于该组的customer列表, id:customer_name
							if(data==0){
								alert('对不起，申请人行程单信息保存失败，请稍候再试！');
							}else if(data==1){
								alert('申请人行程单信息保存成功！');
								$("#save_app_itinerary_btn").text('保存修改');
							}
						},
						'json'
				);
			}
		});
	}
	
	//老师ajax方式提交修改郭的岗位信息的按钮
	$("#save_app_job_btn").click(function(){
		if(modify_page_locked){
			alert('申请人JF工作信息被锁定，不能保存。请先解除锁定！');
		}else{
			$(this).text('通讯中，请稍候..');
			var url = get_root() + "ApplicantJobs/ajax_save_app_job";
			var json_data = build_app_data_in_json("#app_job_form");
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，申请人JF工作信息保存失败，请稍候再试！');
						}else if(data==1){
							alert('申请人JF工作信息保存成功！');
							$("#save_app_job_btn").text('保存修改');
						}
					},
					'json'
			);
		}
	});
	
	$("#save_progress_app_btn").click(function(){
		if(modify_page_locked){
			alert('申请人申请资料和工作岗位状态信息被锁定，不能保存。请先解除锁定！');
		}else{
			$(this).text('通讯中，请稍候..');
			var url = get_root() + "Applicants/ajax_save_progress";
			var json_data = build_app_data_in_json("#app_progress_form");
			$.post(
					url,
					json_data,
					function(data){
						if(data==0){
							alert('对不起，申请人申请资料和工作岗位状态信息保存失败，请稍候再试！');
						}else if(data==1){
							alert('申请人申请资料和工作岗位状态信息保存成功！');
							$("#save_progress_app_btn").text('保存修改');
						}
					},
					'json'
			);
		}
	});
	
	$("#save_family_app_btn").click(function(){
		if(modify_page_locked){
			alert('申请人家庭信息被锁定，不能保存。请先解除锁定！');
		}else{
			$(this).text('通讯中，请稍候..');
			var url = get_root() + "Applicants/ajax_save_family";
			var json_data = build_app_data_in_json("#app_family_form");
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，申请人家庭信息保存失败，请稍候再试！');
						}else if(data==1){
							alert('申请人家庭信息保存成功！');
							$("#save_family_app_btn").text('保存修改');
						}
					},
					'json'
			);
		}
	});
	
	$("#save_basic_app_btn").click(function(){
		if(modify_page_locked){
			alert('申请人基础信息被锁定，不能保存。请先解除锁定！');
		}else{
			$(this).text('通讯中，请稍候..');
			var url = get_root() + "Enquiries/ajax_save_basic";
			var json_data = build_app_data_in_json("#app_basic_form");
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，申请人基础信息保存失败，请稍候再试！');
						}else if(data==1){
							alert('申请人基础信息保存成功！');
							$("#save_basic_app_btn").text('保存修改');
						}
					},
					'json'
			);
		}
	});
	
	$("#save_contract_app_btn").click(function(){
		if(modify_page_locked){
			alert('申请人基础信息被锁定，不能保存。请先解除锁定！');
		}else{
			$(this).text('通讯中，请稍候..');
			var url = get_root() + "Enquiries/ajax_save_contract";
			var json_data = build_app_data_in_json("#app_contract_form");
			$.post(
					url,
					json_data,
					function(data){
						//返回的是属于该组的customer列表, id:customer_name
						if(data==0){
							alert('对不起，申请人费用与合同信息更新失败，请稍候再试！');
						}else if(data==1){
							alert('申请人基础信息保存成功！');
							$("#save_contract_app_btn").text('保存修改');
						}
					},
					'json'
			);
		}
	});
});
//申请人各种表单的解锁与加锁
function toggle_app_form_input(value,form_name){
	$("input",form_name).each(function(){
		$(this).attr('disabled',value);
	});
	$("select",form_name).each(function(){
		$(this).attr('disabled',value);
	});
	modify_page_locked = !modify_page_locked;
	//搜索学生人名的输入框需要一直有效
	$("#find_by_name_input_trigger").attr('disabled',null);
}
function build_app_data_in_json(context){
	var json_data = {applicant_id:app_id,enquiry_id:enquiry_id};
	//先找input text
	$("input",context).each(function(){
		json_data[$(this).attr('id')]=$(this).val();
	});
	//找select text
	$("select",context).each(function(){
		json_data[$(this).attr('id')]=$(this).val();
	});
	//找textarea
	$("textarea",context).each(function(){
		json_data[$(this).attr('id')]=$(this).val();
	});
	//如果由日期和时间的
	if($(".cake_input_datetime",context).length>0){
		$(".cake_input_datetime",context).each(function(){
			//循环找出其中的select
			var key = $(this).attr('name');
			var year = '';
			var month = '';
			var day = '';
			var hour = '';
			var minute = '';
			var meridian = '';
			var all_selects = $('select',this);
			month=all_selects.eq(0).val();
			day=all_selects.eq(1).val();
			year=all_selects.eq(2).val();
			hour=all_selects.eq(3).val();				
			minute=all_selects.eq(4).val();
			meridian=all_selects.eq(5).val();
			if(meridian=='pm'){
				hour = parseInt(hour);
				hour +=12;
				hour = hour+'';
			}
			json_data[key]=year+'-'+month+'-'+day+' '+hour+':'+minute+':00';
			//date("F j, Y, g:i a")
		});
	}
	if($(".cake_input_date",context).length>0){
		$(".cake_input_date",context).each(function(){
			//循环找出其中的select
			var key = $(this).attr('name');
			var year = '';
			var month = '';
			var day = '';
			var all_selects = $('select',this);
			month=all_selects.eq(0).val();
			day=all_selects.eq(1).val();
			year=all_selects.eq(2).val();
			json_data[key]=year+'-'+month+'-'+day;
			//date("F j, Y, g:i a")
		});
	}
	return json_data;
}