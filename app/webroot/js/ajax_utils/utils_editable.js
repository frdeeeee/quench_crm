var current_d160 = null;
var slep_current = -1;

$(document).ready(function(){
	if($(".d160_trigger").length>0){
		$(".d160_trigger").editable({
			type:'select',
			options:{0:'未做好',1:'已做好'},
			onEdit:begin_d160_edit,
			onSubmit:after_d160_edit
		});
	}
	//页面端ajax修改是否提交报名表
	if($(".app_form_trigger").length>0){
		$(".app_form_trigger").editable({
			type:'select',
			options:{0:'未提交',1:'已提交'},
			onEdit:begin_d160_edit,
			onSubmit:after_app_from_edit
		});
	}
	//页面端ajax修改slep
	if($(".slep_trigger").length>0){
		$(".slep_trigger").editable({
			type:'text',
			submitBy:'blur',
			onEdit:begin_slep_edit,
			onSubmit:after_slep_edit
		});
	}
	//页面端ajax修改slep
	if($(".slep_exam_date_trigger").length>0){
		$(".slep_exam_date_trigger").editable({
			type:'text',
			submitBy:'blur',
			onEdit:begin_slep_edit,
			onSubmit:after_slep_exam_date_edit
		});
	}
});
//SLEP处理函数－－开始
function begin_slep_edit(content){
	slep_current = content.current;
}
function after_slep_edit(content){
	if(content.current!==slep_current){
		//changed, update the value
		var enq_id = this.attr('id');
		enq_id = enq_id.substr(4);
		var url = get_root()+"Enquiries/ajax_modify_slep_score";
		$("#icon_ajax_refresh"+enq_id).show();
		$.post(
				url,
				{enq_id:enq_id,slep_scores:content.current},
				function(data){
					//返回的json代表更新数据库是否成功
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
//SLEP处理函数－－结束

function after_slep_exam_date_edit(content){
	if(content.current!==slep_current){
		//changed, update the value
		var enq_id = this.attr('id');
		enq_id = enq_id.substr(15);
		var url = get_root()+"Enquiries/ajax_modify_slep_exam_date";
		$("#icon_ajax_refresh_ed"+enq_id).show();
		$.post(
				url,
				{enq_id:enq_id,exam_date:content.current},
				function(data){
					//返回的json代表更新数据库是否成功
					if(data==1){
						$("#icon_ajax_refresh_ed"+enq_id).hide();
					}else{
						this.text(money_return_current);
					}
				},
				'json'
		);
	}
}

function begin_d160_edit(content){
	if(this.attr('id')>0){
		current_d160 = content.current;
	}else{
		return false;
	}
};
//更新是否提交报名表状态的方法
function after_app_from_edit(content){
	if(content.current!==current_d160){
		//changed, update the value
		var enq_id = this.attr('id');
		var url = get_root()+"Enquiries/ajax_modify_app_form_status";
		$("#icon_ajax_refresh"+enq_id).show();
		var app_form_value = 0;
		if(content.current=='已提交'){
			app_form_value=1;
		}
		$.post(
				url,
				{enq_id:enq_id,is_app_form_submit:app_form_value},
				function(data){
					//返回的json的结构是数组，所以必须循环，但是其中province和customertype的信息是重复的，因此只要取第一个就行了
					if(data==1){
						//更新成功
						if(content.current==1){
							$(this).text('已提交');
						}else{
							$(this).text('未提交');
						}
						current_d160=null;
					}else{
						alert('更新失败，请稍候再试！');
					}
					$("#icon_ajax_refresh"+enq_id).hide();
				},
				'json'
		);
	}
};

function after_d160_edit(content){
	if(content.current!==current_d160){
		//changed, update the value
		var app_visa_id = this.attr('id');
		var url = get_root()+"ApplicantVisas/ajax_modify_d160";
		$("#icon_ajax_refresh"+app_visa_id).show();
		var new_d160_value = 0;
		if(content.current=='已做好'){
			new_d160_value=1;
		}
		$.post(
				url,
				{app_visa_id:app_visa_id,d160:new_d160_value},
				function(data){
					//返回的json的结构是数组，所以必须循环，但是其中province和customertype的信息是重复的，因此只要取第一个就行了
					if(data==1){
						//更新成功
						if(content.current==1){
							$(this).text('已做好');
						}else{
							$(this).text('未做好');
						}
						current_d160=null;
					}else{
						alert('更新失败，请稍候再试！');
					}
					$("#icon_ajax_refresh"+app_visa_id).hide();
				},
				'json'
		);
	}
};