var basic_app_locked = true;
var family_app_locked = true;
var app_id = 0;
var enquiry_id = 0;
var applicant_file_id = 0;
var modify_page_locked = false;
$(document).ready(function(){
	if($("a[rel=collection]").length>0){
		$("a[rel=collection]").fancybox({
			'transitionIn' : 'none',
			'transitionOut' : 'none',
			'titlePosition' : 'over'
		});
	}
	//lock_the_modify_page();
	if($("#ApplicantId").length>0){
		app_id = $("#ApplicantId").val();
	}
	if($("#EnquiryId").length>0){
		enquiry_id = $("#EnquiryId").val();
	}
	
	if($(".notes").length>0){
		$(".notes").fancybox(
		{
			'showNavArrows':false,
			'titleShow':false,
			'onStart':function(itemArray, selectedIndex, selectedOpts){
				//set the value of mobile of receiver取得手机号并设置到发信表单中
				$("#notes_display_wrapper").text( itemArray[selectedIndex].title );
			}
		}		
		);
	}

	if($("#CheckinIsJobLocationChanged").length>0){
		$("#CheckinIsJobLocationChanged").change(function(){
			if($(this).val()==1){
				$("#CheckinNewJobLocation").show(400);
			}else{
				$("#CheckinNewJobLocation").hide(200);
			}
		});
	}
	
	if($("#CheckinIsAccomChanged").length>0){
		$("#CheckinIsAccomChanged").change(function(){
			if($(this).val()==1){
				$("#CheckinNewAccom").show(400);
			}else{
				$("#CheckinNewAccom").hide(200);
			}
		});
	}
	if($("#CheckinAccomCondChanged").length>0){
		$("#CheckinAccomCondChanged").change(function(){
			if($(this).val()==1){
				$("#CheckinNewAccomCond").show(400);
			}else{
				$("#CheckinNewAccomCond").hide(200);
			}
		});
	}
	//申请人ajax方式提交修改归国状态信息的按钮
	$("#save_app_return_btn").click(function(){
		if(modify_page_locked){
			alert('申请人归国状态信息被锁定，不能保存。请先解除锁定！');
		}else{
			$(this).text('通讯中，请稍候..');
			var url = get_root() + "Students/ajax_save_app_return";
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
	
	//修改申请人的行程单按钮响应
	if($("#modify_app_itinerary_btn").length>0){
		toggle_app_form_input('disabled',"#app_itineray_form");
		$("#modify_app_itinerary_btn").click(function(){
			if(modify_page_locked){
				toggle_app_form_input(null,"#app_itineray_form");
				$(this).text('锁定行程单');
			}else{
				toggle_app_form_input('disabled',"#app_itineray_form");
				$(this).text('修改行程单');
			}	
		});
	}
	//保存行程单按钮的响应
	if($("#save_app_itinerary_btn").length>0){
		$("#save_app_itinerary_btn").click(function(){
			if(modify_page_locked){
				alert('申请人行程单信息被锁定，不能保存。请先解除锁定！');
			}else{
				$(this).text('通讯中，请稍候..');
				var url = get_root() + "Students/ajax_save_app_itinerary";
				var json_data = build_app_data_in_json("#app_itineray_form");
				$.post(
						url,
						json_data,
						function(data){
							//返回的是属于该组的customer列表, id:customer_name
							if(data==0){
								alert('对不起，您的行程单信息保存失败，请稍候再试或联系优势办！');
							}else if(data==1){
								alert('您的行程单信息保存成功！');
								$("#save_app_itinerary_btn").text('保存修改');
							}
						},
						'json'
				);
			}
		});
	}
	
	//申请人基础信息的处理,只能由老师负责修改学生的基本信息
	$("#modify_basic_app_btn").fancybox();
	//申请人家庭信息的处理,只能由老师负责修改学生的基本信息
	$("#modify_family_app_btn").fancybox();
	
	$("#short_message_send_btn").click(function(){
		var receiver_id = $("#ShortMessageReceiverId").val();
		var sender_id = $("#ShortMessageSenderId").val();
		var message_content = $("#ShortMessageContent").val();
		var url = get_root() + "Students/send_message_ajax";
		$("#icon_message_sending_refresh").show();
		$.post(
				url,
				{
					receiver_id:receiver_id,
					sender_id:sender_id,
					message_content:message_content
				},
				function(data){
					//返回的是属于该组的customer列表, id:customer_name
					if(data==0){
						alert('对不起，站内短信发送失败，请稍候再试！');
					}else if(data==1){
						alert('短信发送成功！');
						$.fancybox.close();
					}
					$("#icon_message_sending_refresh").hide();
				},
				'json'
		);
	});
	
	//学生上传自己所需提交的电子文档
	if(  $(".applicant_submit_file_btn").length > 0){
		$(".applicant_submit_file_btn").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//根据appid初始化表格，取得点击的a连接的id的值，代表了文件的类型
						$("#ApplicationFileDownloadFileId").val( $(itemArray[selectedIndex]).attr('id') );
					}
				}
		);
	};
});

/**
 * @param value : null means enable, 'disabled' means disable
 */
function toggle_family_app(value){
	$("#ApplicantFatherName").attr('disabled',value);
	$("#ApplicantFatherMobile").attr('disabled',value);
	$("#ApplicantFatherCompany").attr('disabled',value);
	$("#ApplicantMotherName").attr('disabled',value);
	$("#ApplicantMotherMobile").attr('disabled',value);
	$("#ApplicantMotherCompany").attr('disabled',value);
	$("#ApplicantEmergencyContact").attr('disabled',value);
	$("#ApplicantEmergencyMobile").attr('disabled',value);
	$("#ApplicantEmergencySpeakEn").attr('disabled',value);
	$("#ApplicantEmergencyRelation").attr('disabled',value);
	$("#ApplicantAddress").attr('disabled',value);
	family_app_locked = !family_app_locked;
}
/**
 * @param value : null means enable, 'disabled' means disable
 */

function lock_the_modify_page(){
	$("input").each(function(){
		$(this).attr('disabled','disabled');
	});
	$("select").each(function(){
		$(this).attr('disabled','disabled');
	});
};
//申请人各种表单的解锁与加锁
function toggle_app_form_input(value,form_name){
	$("input",form_name).each(function(){
		$(this).attr('disabled',value);
	});
	$("select",form_name).each(function(){
		$(this).attr('disabled',value);
	});
	modify_page_locked = !modify_page_locked;
}
function build_app_data_in_json(context){
	var json_data = {applicant_id:app_id,enquiry_id:enquiry_id};
	$("input",context).each(function(){
		json_data[$(this).attr('id')]=$(this).val();
	});
	$("select",context).each(function(){
		json_data[$(this).attr('id')]=$(this).val();
	});
	$("textarea",context).each(function(){
		json_data[$(this).attr('id')]=$(this).val();
	});
	if($(".cake_input_datetime",context).length>0){
		$(".cake_input_datetime",context).each(function(){
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
			json_data[key]=year+'-'+month+'-'+day+' '+hour+':'+minute+' '+meridian;
		});
	}
	if($(".cake_input_date",context).length>0){
		$(".cake_input_date",context).each(function(){
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