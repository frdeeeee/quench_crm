var exports_selector_hide = true;
$(document).ready(function(){
	//給运营经理提供的为学生指定运营老师的功能按钮的响应函数
	if($("#assign_students_to_operation_assistant_btn").length>0){
		$("#assign_students_to_operation_assistant_btn").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//set the value of mobile of receiver取得手机号并设置到发信表单中
						scan_all();
						student_names_wrapper = $("#student_names_wrapper"); //显示被选择的学生姓名的
						student_ids_wrapper = $("#student_ids_wrapper"); //保存被选择的学生id的input
						if(rec_index == 0){
							student_names_wrapper.append('<p style="color:red">您没有选择申请学生</p>');
						}else{
							student_names_wrapper.html('');
							var rec_list_text = '<p>';
							var rec_enquiry_id_hidden_text = '';
							for(var key in sms_receivers){
								rec_list_text += sms_receivers[key].name + ";";
								rec_enquiry_id_hidden_text += sms_receivers[key].id + ",";
							}
							rec_list_text += '</p>';
							student_names_wrapper.append(rec_list_text);
							//去掉最后一个逗号
							rec_enquiry_id_hidden_text = rec_enquiry_id_hidden_text.substr(0,rec_enquiry_id_hidden_text.length-1);
							student_ids_wrapper.val(rec_enquiry_id_hidden_text);
						}
					}
				}
		);
	}
	
	if($("#export_to_excel_file").length>0){
		$("#export_to_excel_file").click(function(){
			if(exports_selector_hide){
				var top = $(this).offset().top+32;
				var left = $(this).offset().left;
				$('#exports_selector').attr("tabindex","-1");
				$('#exports_selector').css('top',top).css('left',left).slideDown(100);
				exports_selector_hide = false;
				$('#exports_selector').focus();
				$('#exports_selector').blur(function(){
					setTimeout(function(){
						$('#exports_selector').slideUp(100);
						exports_selector_hide = true;
					}, 200);
				});
			}else{
				$('#exports_selector').slideUp(100);
				exports_selector_hide = true;
				$('#exports_selector').unbind('blur');
			}
		});
	}
	
	if($("#export_selected_emails_btn").length>0){
		$("#export_selected_emails_btn").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//set the value of mobile of receiver取得手机号并设置到发信表单中
						scan_all();
						rec_wrapper = $("#shortcuts_content");
						if(rec_index == 0){
							rec_wrapper.append('<p style="color:red">您没有选择收件人</p>');
						}else{
							rec_wrapper.html('');
							var rec_list_text = '<p>';
							for(var key in sms_receivers){
								rec_list_text += sms_receivers[key].e_mail + ";<br>";
							}
							rec_list_text += '</p>';
							rec_wrapper.append(rec_list_text);
						}
					}
				}
		);
	}
	if($("#export_selected_mobiles_btn").length>0){
		$("#export_selected_mobiles_btn").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//set the value of mobile of receiver取得手机号并设置到发信表单中
						scan_all();
						rec_wrapper = $("#shortcuts_content");
						if(rec_index == 0){
							rec_wrapper.append('<p style="color:red">您没有选择申请人</p>');
						}else{
							rec_wrapper.html('');
							var rec_list_text = '<p>';
							for(var key in sms_receivers){
								rec_list_text += sms_receivers[key].name + ":" + sms_receivers[key].mobile + ";<br>";
							}
							rec_list_text += '</p>';
							rec_wrapper.append(rec_list_text);
						}
					}
				}
		);
	}
});
function scan_all(){
	//先清空当前的队列
	sms_receivers = new Object();
	rec_index = 0;
	$(".select_itmes").each(function(){
		//先检查该人是否被选中
		if($(this).attr('checked') == 'checked'){
			//被选中的添加到队列中
			var enquiry_id = $(this).attr('id').substr(12); //select_item_ 前12个字符不要
			var e_name = $("#e_name"+enquiry_id).text();
			var e_mail = $("#email_addr_"+enquiry_id).text();
			var e_mobile = $("#mobile_nb_"+enquiry_id).text();
			var rec = new Receiver(enquiry_id,e_name,e_mobile,e_mail);
			sms_receivers[rec_index] = rec;
			rec_index++;
		}
	});
};