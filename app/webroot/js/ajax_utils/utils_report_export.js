$(function(){
	$("#export_enq_btn").click(function(){
		$("#EnquirySelectFieldsForm").attr('action','/Reports/report_by_enquiry').submit();
	});
	
	$("#save_query_fields_btn").click(function(){
		//显示隐藏输入名称文本框
		$("#temp_useful_url_name_wrapper").toggle();
	});
	
	$("#submit_query_fields_btn").click(function(){
		$("#EnquiryUsefulUrlName").val($("#temp_useful_url_name").val());
		$("#EnquirySelectFieldsForm").attr('action','/Reports/save_my_fields_url').submit();
	});
});