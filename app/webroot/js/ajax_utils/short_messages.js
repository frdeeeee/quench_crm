var stop_auto_check_new_message = false;
$(document).ready(function(){
	//
	if( $("#send_message_btn").length > 0 ){
		$("#send_message_btn").fancybox();
		//页面的按时自动查询是否有新的短信,120000代表2分钟检查一次
		setInterval(function(){
			if( !stop_auto_check_new_message && !($("#new_message_alert").length>0) ){
				var url = get_root() + "ShortMessages/get_new_message";
				$.post(
						url,
						{},
						function(data){
							//返回的是有没有新的短消息
							if(data>0){
								$("#message_box_menu").append('<span class="alert badge alert_red" id="new_message_alert">新</span>');
								stop_auto_check_new_message = true;//有新信息，则显示后停止继续查询
							}
						},
						'json'
				);
			}
		},120000);
	}
	
	//get the group selecter 
	$("#short_message_send_btn").click(function(){
		var receiver_id = $("#ShortMessageReceiverId").val();
		var sender_id = $("#ShortMessageSenderId").val();
		var message_content = $("#ShortMessageContent").val();
		var url = get_root() + "ShortMessages/add";
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
						alert('站内短信发送成功！');
						$.fancybox.close();
					}
					$("#icon_message_sending_refresh").hide();
				},
				'json'
		);
	});
});
function get_root(){
	return "http://"+document.location.hostname+"/";
}