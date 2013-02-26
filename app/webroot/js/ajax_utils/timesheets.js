$(document).ready(function(){
	$("#checkin_trigger").click(function(){
		var url = get_root() + 'Timesheets/checkin';
		$.post(
				url,
				{},
				function(data){
					if(data.result==1){
						alert('Your checkin has been saved.');
					}else if(data.result==0){
						alert('Checkin failed, please try again.');
					}else if(data.result==2){
						alert('You have checked in today.');
					}
				},
				'json'
		);
	});
	$("#checkout_trigger").click(function(){
		var url = get_root() + 'Timesheets/checkout';
		$.post(
				url,
				{},
				function(data){
					if(data.result==1){
						alert('Your checkout has been saved.');
					}else if(data.result==0){
						alert('Checkout failed, please try again.');
					}else if(data.result==2){
						alert('You have checked out today.');
					}else if(data.result==3){
						alert("You have not checked in today, please check in first.");
					}
				},
				'json'
		);
	});
});