/**
 * 这段程序是专门为了完成autocomple的搜索功能及其显示而编写的。
 * @Author: Justin Wang
 */
var highlight_item_index = -1;
$(document).ready(function(){
	//响应所有的具有class=need_auto_comp的输入input的事件
	if($("#SearchEnquiryName").length>0){
		var availableNames = [];
		$(".enq_name","#availble_enquiry_names").each(function(index){
			availableNames[index] = $(this).text();
		});
		$("#SearchEnquiryName").autocomplete({
		    source: availableNames
		});
	}
	
	if($("#SearchEnquirySchool").length>0){
		var availableSchools = [];
		$(".sch_name","#availble_school_names").each(function(index){
			availableSchools[index] = $(this).text();
		});
		$("#SearchEnquirySchool").autocomplete({
			source: availableSchools
		});
	}
	
	if($("#SearchApplicantJobEmployerAddress").length>0){
		var availableEmployerAddr = [];
		$(".emp_addr","#availble_employer_address").each(function(index){
			availableEmployerAddr[index] = $(this).text();
		});
		$("#SearchApplicantJobEmployerAddress").autocomplete({
			source: availableEmployerAddr
		});
	}
	
	if($("#SearchApplicantJobCompanyName").length>0){
		var availableCompanyNames = [];
		$(".com_name","#availble_employer_names").each(function(index){
			availableCompanyNames[index] = $(this).text();
		});
		$("#SearchApplicantJobCompanyName").autocomplete({
			source: availableCompanyNames
		});
	}
});