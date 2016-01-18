$(document).ready(function () {
			
				
			$("#btn-insert").click(function()
			{
				food = $("#food").val().trim();
				if(food != "")
				{	
					$.post( "API/search_food_API.php", { nameFood: food  })
					.done(function( data ) {
					console.log(data);
					});
				}
			})	
			



			
});
		
		
		
		