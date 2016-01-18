$(document).ready(function() {
	
    var alertHidden 	= true;
$(".alert").hide();
$("#success").hide();	
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
	
	
	shopping = $("#shopping").val().trim();
	console.log(shopping);
	if(shopping == '1')flag = true;
	7
	kjaul =  $("#kjaul").val().trim();
	kcal =  $("#kcal").val().trim();
	
	if(flag){
		if(alertHidden){
				$(".alert").show();
				alertHidden = false;
			}
		
	}
	else
	{
		$.post( "API/insert_food_API.php", { nameFood: food , kc : kcal , kj : kjaul , shop: shopping })
			.done(function( data ) {
				console.log("Success: " + data);
			$("#contain").hide();
			$("#success").show();
			
		});
		
	}		
	
})

$("#btn-reload").click(function()
{	
	location.reload();
})

});