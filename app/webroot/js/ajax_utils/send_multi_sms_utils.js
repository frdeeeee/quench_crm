function Receiver(enquiry_id,e_name,e_mobile,e_mail){
		this.id = enquiry_id; 
		this.name = e_name;
		this.mobile = e_mobile;
		this.e_mail = e_mail;
	}
var sms_receivers = null;//所有的收信人,把对象当集合用，提高检索效率
var rec_index = 0; //表明有多少个收信人的整数值
var the_index = 0;
var is_using_text_template = false; //是否准许编辑短信内容输入框的开关
var is_allow_to_send = false; //是否准许发送短信的开关
var interval_handler = null;
var rec_wrapper = null;

$(document).ready(function(){
	if($("#shortcut_msg_box").length>0){
		$.fx.speeds._default = 1000;
		$("#shortcut_msg_box").dialog(
			{
				autoOpen: false,
				show: "blind",
				hide: "explode",
				open: function(event,ui){
					alert(event.target.id);
					
				}
			}
		);
	}
	//导出选择的学生的邮件地址供拷贝
	if($("#export_selected_emails").length>0){
		$("#export_selected_emails").click(function(){
			$("#shortcut_msg_box").dialog('open');
			return false;
		});
	}
	//群发短信的功能
	if(  $("#load_multi_sms_send_form_btn").length > 0){
		$("#load_multi_sms_send_form_btn").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//组装接收者对象
						get_receivers();
						//把收件人信息写出来
						rec_wrapper = $("#receivers_wrapper");
						rec_wrapper.html('');//先清空
						if(rec_index == 0){
							rec_wrapper.append('<p style="color:red">您没有选择收件人</p>');
						}else{
							var rec_list_text = '<p>';
							for(var key in sms_receivers){
								rec_list_text += sms_receivers[key].name + ",&nbsp;";
							}
							rec_list_text += '</p>';
							rec_wrapper.append(rec_list_text);
						}
						//加载内容完成
					}
				}
		);
	};
	//监听加载短信模板的工作
	if( $("#sms_load_template_btn").length > 0){
		$("#sms_load_template_btn").click(function(){
			if(is_using_text_template){
				//表示正在使用短信模板，用户准备切换到手写输入模式
				$("#SmsTextingTemplateId").attr('disabled','disabled');
				$("#SmsTextingTemplateContent").attr('disabled',null);
				is_using_text_template = false;
				$(this).text('加载短信模板');
			}else{
				//表示正在手写模式，想切换到模板模式
				var url = get_root() + "TextingTemplates/get_texting_templates_list_ajax";
				$("#icon_sms_sending_multi_refresh").show();
				$.post(
						url,
						null,
						function(data){
							//返回的短信模板的名值对
							if(data){
								//找到下来模板的select
								var slt = $("#SmsTextingTemplateId");
								slt.html('');
								slt.append('<option value="">请选择模板...</option>');
								for(var template_id in data){
									slt.append('<option value="'+template_id+'">'+data[template_id]+'</option>');
								}
								slt.attr('disabled',null);
								//不允许用户在输入框中输入内容了，原来输入的也要删除
								$("#SmsTextingTemplateContent").attr('disabled','disabled');
								$("#SmsTextingTemplateContent").val('');
								$("#sms_load_template_btn").text('停止使用短信模板');
								is_using_text_template = true;
								//开始监听模板选择框的change事件
								init_template_select();
							}
							$("#icon_sms_sending_multi_refresh").hide();
						},
						'json'
				);
			}
		});
	}
	//监听开始发送按钮
	if($("#sms_multi_send_btn").length > 0){
		$("#sms_multi_send_btn").click(function(){
			//先一个一个的发送，不采取批量的发送方式
			rec_wrapper = $("#receivers_wrapper");  //显示发送情况的地方
			rec_wrapper.text('');
			$("#SmsTextingTemplateContent").attr('disabled','disabled');  //不许在更改发送内容了
			var message_content = $("#SmsTextingTemplateContent").val();//把发送的内容放在外面，没有必要每次都解析一次
			var url = get_root() + "ShortMessages/send_multi_sms_ajax";
			//采用定时发送，间隔50毫秒
			interval_handler = setInterval(function(){
				if(the_index < rec_index){
					var receiver_mobile = sms_receivers[the_index].mobile + "a"; //取得收信人手机号
					$("#icon_sms_sending_multi_refresh").show();
					$.post(
							url,
							{
								the_index:the_index,  //这个指示标记，需要从服务器回传,用来指示结果是对哪个用户和手机的
								receiver_mobile:receiver_mobile,
								message_content:message_content
							},
							function(data){
								//返回的是属于该组的customer列表, id:customer_name
								if(data.string == -4){
									alert('对不起，您的短信帐号已经被停用！');
								}else if(data.result.string==1){
									rec_wrapper.append('<b style="color:green">'+ sms_receivers[data.the_index].name+"-成功,&nbsp;</b>");
								}else if(data.string == -6){
									alert('对不起，您的短信帐号余额不足！');
								}else if(data.string == -60){
									alert('对不起，当前时间不允许发送短信！');
								}else if(data.string == -100){
									alert('对不起，发送异常，请通知管理员或指尖传媒！');
								}else if(data.result.string == '-10'){
									rec_wrapper.append('<b style="color:red">'+ sms_receivers[data.the_index].name + ':'+ sms_receivers[data.the_index].mobile + "-无效手机号,&nbsp;</b>");
								}
								$("#icon_sms_sending_multi_refresh").hide();
							},
							'json'
					);
					the_index++;
				}else{
					clearInterval(interval_handler);
				}
			},500);
			
		});
	}
});

function get_receivers(){
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
			var e_mobile = $(this).attr('title');
			var rec = new Receiver(enquiry_id,e_name,e_mobile,e_mail);
			sms_receivers[rec_index] = rec;
			rec_index++;
		}
	});
};
//选择不同的模板，加载不同的内容
function init_template_select(){
	if(is_using_text_template){
		$("#SmsTextingTemplateId").change(function(){
			var template_id = $(this).val();
			var url = get_root() + "TextingTemplates/get_template_content_ajax";
			$("#icon_sms_sending_multi_refresh").show();
			$.post(
					url,
					{template_id:template_id},
					function(data){
						//返回的是短信模板的内容
						if(data.length>0){
							$("#SmsTextingTemplateContent").val(data);
						}
						$("#icon_sms_sending_multi_refresh").hide();
					},
					'json'
			);
		});
	}else{
		$("#SmsTextingTemplateId").unbind('change');
	}
}
