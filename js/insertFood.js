$(document).ready(function() {
	
    var alertHidden 	= true;
$(".alert").hide();
	
	$("input").focus(function(){
		
		if(!alertHidden){
				$(".alert").hide();
				alertHidden = true;
			}
		
	})
	
$("#btn-insert").click(function()
{
	flag = false;
	
	food = $("#food").val().trim();
	if(food == "")flag = true;
	
	if(flag){
		if(alertHidden){
				$(".alert").show();
				alertHidden = false;
			}
		
	}
	else
	{
		$.post( "API/insert_food_API.php", { nameFood: food })
			.done(function( data ) {
				console.log("Data Loaded: " + data );
		});
		
	}		
	
})


});