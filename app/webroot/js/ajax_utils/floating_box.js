var floating_box_width = 100;
var floating_box_height = 0;
var box_extended = true;
$(document).ready(function(){
	if($("#floating_box").length>0){
		var box = $("#floating_box");
		floating_box_height = box.height();
		box.css('left',window.innerWidth-floating_box_width-60);
	}
	if($("#toggle_floating_box").length>0){
		$("#toggle_floating_box").click(function(){
			if(box_extended){
				box_extended = false;
				$("#toggle_floating_box").text("+");
				//$("#floating_box").css('height','40px');
				$("#floating_box").height(12);
			}else{
				box_extended = true;
				$("#toggle_floating_box").text("x");
				$("#floating_box").height(floating_box_height);
			}
		});
	}
});