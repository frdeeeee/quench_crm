/**
 * @Author: Justin Wang
 */
var current_shown_action = 0;
var money_return_current = null;
$(document).ready(function(){
	if($("#EnquiryModifyForm").length>0){
		$("#EnquiryModifyForm").validate({
			rules:{
				'data[Enquiry][slep_scores]':{digits:true,range:[0,67],maxlength:2},
				'data[Enquiry][grade]':{maxlength:4,minlength:4,range:[2012,2022],digits:true},
				'data[Enquiry][email]':{email:true,required:true},
				'data[Enquiry][mobile]':{digits:true,maxlength:11,minlength:8}
            },
            messages:{
            	'data[Enquiry][slep_scores]':"SLEP成绩设定范围：0-67分",
            	'data[Enquiry][grade]':"毕业年的格式不对",
            	'data[Enquiry][email]':'电子邮件的格式不对',
            	'data[Enquiry][mobile]':'手机的格式不对'
            }
		});
	}
	if($("#EnquiryAddForm").length>0){
		$("#EnquiryAddForm").validate({
			rules:{
				'data[Enquiry][grade]':{maxlength:4,minlength:4,range:[2012,2022],digits:true},
				'data[Enquiry][email]':{email:true,required:true},
				'data[Enquiry][mobile]':{digits:true,maxlength:11,minlength:8}
            },
            messages:{
            	'data[Enquiry][grade]':"毕业年的格式不对",
            	'data[Enquiry][email]':'电子邮件的格式不对',
            	'data[Enquiry][mobile]':'手机的格式不对'
            }
		});
	}
	
	//money return part for sales
	if($(".mr_trigger").length>0){
		$(".mr_trigger").editable({
			type:'text',
			submitBy:'blur',
			onEdit:begin_edit,
			onSubmit:after_edit
		});
	}
	//get the group selecter 
	$("#group_selector").change(function(){
		var group_id = $(this).val();
		var url = get_root() + "Customers/ajax_get_group";
		$("#icon_ajax_refresh").show();
		$.post(
				url,
				{group_id:group_id},
				function(data){
					//返回的是属于该组的customer列表, id:customer_name
					if(data.length>0){
						$.each(data,function(key,value){
							var opt = '<option value="'+data[key].Customer.id+'">'+data[key].Customer.name+'</option>';
							$("#customer_selector").append(opt);
							$("#customer_selector").removeAttr('disabled');
						});
					}
					$("#icon_ajax_refresh").hide();
				},
				'json'
		);
	});
	
	/*
	 * 用来原则用户的select，并触发的事件
	 */
	$("#WorkingLogCustomerId").change(function(){
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
						$("#contact_selector").html('<option value="">请选择联系人...</option>');
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
function after_edit(content){
	if(content.current!==money_return_current){
		//changed, update the value
		var enq_id = this.attr('id');
		var url = get_root()+"Enquiries/ajax_modify_money_return";
		$("#icon_ajax_refresh"+enq_id).show();
		$.post(
				url,
				{enq_id:enq_id,mr:content.current},
				function(data){
					//返回的json的结构是数组，所以必须循环，但是其中province和customertype的信息是重复的，因此只要取第一个就行了
					if(data==1){
						$("#icon_ajax_refresh"+enq_id).hide();
					}else{
						this.text(money_return_current);
					}
				},
				'json'
		);
	}
}
function begin_edit(content){
	money_return_current = content.current;
}