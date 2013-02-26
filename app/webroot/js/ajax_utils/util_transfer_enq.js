$(document).ready(function(){
	//加载因故取消表格
	if($("a[rel=fancy_enq_transfer_group]").length > 0){
		$("a[rel=fancy_enq_transfer_group]").fancybox(
				{
					'showNavArrows':false,
					'titleShow':false,
					'onStart':function(itemArray, selectedIndex, selectedOpts){
						$("#EnquiryId").val( itemArray[selectedIndex].title );
					}
				}
		);
	}
});