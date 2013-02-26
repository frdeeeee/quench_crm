/**
 * @Author: Justin Wang
 */
var current_shown_action = 0;
$(document).ready(function(){
	
	$("#customer_selector").change(function(){
		var customer_id = $(this).val();
		var url = get_root()+"Customers/ajax_get_customer";
		$("#icon_ajax_refresh").show();
		$.post(
				url,
				{customer_id:customer_id},
				function(data){
					//返回的json的结构是数组，所以必须循环，但是其中province和customertype的信息是重复的，因此只要取第一个就行了
					if(data.length>0){
						$("#province_id").val("所在地："+data[0].Province.name+"-"+data[0].Customer.city);
						$("#customer_type").val("客户类别："+data[0].CustomerType.name);
							//"Contact":{"name":"contact_name","id":"contact_id"}
							//把所取得的contact插入到联系人选择框contact_selector中
						$.each(data,function(key,value){
							var opt = '<option value="'+data[key].Contact.id+'">'+data[key].Contact.name+'</option>';
							$("#contact_selector").append(opt);
							$("#contact_selector").removeAttr('disabled');
						});
					}
					$("#icon_ajax_refresh").hide();
				},
				'json'
		);
	});
	$("#contact_selector").change(function(){
		var contact_id = $(this).val();
		var url = get_root()+"Contacts/ajax_get_contact";
		$("#icon_ajax_refresh").show();
		$.post(
				url,
				{contact_id:contact_id},
				function(data){
					//返回的json的结构是数组，所以必须循环，但是其中province和customertype的信息是重复的，因此只要取第一个就行了
					if(data){
						$("#contact_phone").text('电话：'+data.Contact.office+' 传真:'+data.Contact.fax+' 手机:'+data.Contact.mobile);
						$("#contact_dept").text('部门名称: '+data.Contact.department);
						$("#contact_manager").text('上级领导： '+data.Contact.manager);
						$("#contact_email").text('邮件: '+data.Contact.email);
					}
					$("#icon_ajax_refresh").hide();
				},
				'json'
		);
	});
});