$(document).ready(function(){
	//download files upload form
	if( $(".load_download_file_add_form_btn").length > 0 ){
		$(".load_download_file_add_form_btn").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						$("#the_project_name").text( '您在上传一个"'+itemArray[selectedIndex].title +'"的模版文件' );
						$("#DownloadFileProjectId").val(itemArray[selectedIndex].name);
					}
				}		
		);
	}
	
	if( $(".df_name_modify_trigger").length > 0 ){
		$(".df_name_modify_trigger").fancybox(
			{
				'showNavArrows':false,
				'titleShow':false,
				'onStart':function(itemArray, selectedIndex, selectedOpts){
					//set the value of mobile of receiver取得手机号并设置到发信表单中
					var df_id = itemArray[selectedIndex].title ;
					$("#DownloadFileIdModified").val(df_id);
					//检查这个纪录是否由关连的下载链接
					if($("#df_name_"+df_id+" a").length>0){
						$("#DownloadFileTitleModified").val( $("#df_name_"+df_id+" a").text() );
					}
					else{
						$("#DownloadFileTitleModified").val( $.trim($("#df_name_"+df_id).text()) );
					}
					if($("#df_notes_"+df_id).length>0){
						$("#download_file_notes").val( $("#df_notes_"+df_id).text() );
					}
				}
			}
		);
	}
	
	$("#df_name_modify_btn").click(function(){
		var url = get_root() + "DownloadFiles/modify";
		var id = $("#DownloadFileIdModified").val();
		var title = $("#DownloadFileTitleModified").val();
		var notes = $("#download_file_notes").val();
		$.post(
				url,
				{
					id:id,
					title:title,
					notes:notes
				},
				function(data){
					if(data==0){
						alert('修改失败，请稍候再试或者联系管理员！');
					}else{
						alert('修改成功！');
						$.fancybox.close();
						update_df_name_notes(data);//服务器返回模版的id
					}
				},
				'json'
		);
	});
});
//用来更新页面上的模版名称的内容
function update_df_name_notes(df_id){
	if($("#df_name_"+df_id+" a").length>0){
		$("#df_name_"+df_id+" a").text($("#DownloadFileTitleModified").val());
	}else{
		$("#df_name_"+df_id).text($("#DownloadFileTitleModified").val());
	}
	$("#df_notes_"+df_id).text($("#download_file_notes").val());
}
//验证模版上传表格
function validate_upload_file_form(){
	var has_file = true;
	/*
	//var has_title = true;
	if($("#fileupload").val() == ''){
		has_file = false;
	}
	
	if($("#DownloadFileTitle").val() == ''){
		has_title = false;
	}
	*/
	if(has_file){
		return true;
	}else{
		alert('请至少选择一个文件上传，或者输入文件说明');
		return false;
	}
}