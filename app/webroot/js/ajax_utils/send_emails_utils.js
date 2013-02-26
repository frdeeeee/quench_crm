$(document).ready(function(){
	//加载因故取消表格
	if($("a[rel=fancy_app_cancel_group]").length > 0){
		$("a[rel=fancy_app_cancel_group]").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						$("#EnquiryId").val( itemArray[selectedIndex].title );
						$("#cancel_app_name").text( $("#e_name"+itemArray[selectedIndex].title).text() );
					}
				}
		);
	}
	//发送邮件的功能
	if($("a[rel=fancy_email_trigger_group]").length > 0){
		$("a[rel=fancy_email_trigger_group]").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						//set the value of mobile of receiver取得手机号并设置到发信表单中
						$("#EmailAddress").val( $("#email_addr_"+itemArray[selectedIndex].title).text() );
						$("#EmailSubject").val( $("#e_name"+itemArray[selectedIndex].title).text() + ',你好！' );
						
					}
				}
		);
		
		$("#email_send_btn").click(function(){
			var receiver_addr = $("#EmailAddress").val(); //取得收信人手机号
			var receiver_subject = $("#EmailSubject").val(); //取得邮件的标题
			var email_content = $("#EmailContent").val(); //取得邮件的内容
			var url = get_root() + "ShortMessages/send_email_ajax";
			$("#icon_email_sending_refresh").show();
			$.post(
					url,
					{
						receiver_addr:receiver_addr,
						receiver_subject:receiver_subject,
						email_content:email_content
					},
					function(data){
						if(data==1){
							alert('邮件发送成功！');
							$.fancybox.close();
						}else{
							alert('邮件发送失败，请稍候再试或者联系管理员！');
						}
						$("#icon_email_sending_refresh").hide();
					},
					'json'
			);
		});
	}
});