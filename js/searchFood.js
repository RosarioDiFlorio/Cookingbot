$(document).ready(function () {
			
			$("#btn-subs").hide();
			
			$("#btn-insert").click(function()
			{	
				var food = $("#food").val().trim();
				if(food != "")
				{	
					$.post( "API/search_food_API.php", { nameFood: food  })
					.done(function( data ) 
					{		
						$("#toAppend").empty();
						if(data != "")
						{
							
							//console.log(data);
							var json = $.parseJSON(data);
							res = json['results'];
							foods = res['bindings'];
							if(foods.length == 0)
							{
								$("#toAppend").append('<div><h2>food not found</h2></div>');
								return;
							}
							$("#toAppend").append('<div class="heading"><h2>'+food+'</h2></div>');
							
							kcal = 0;
							kj = 0;
							divisore = 0;
							if(foods.length > 2)
							{
									//faccio una media
								
									for(i=0;i<foods.length;i++)
									{
										//cerco le kilocalorie
										str = foods[i].energy['value'];
										var n = str.search(/kcal/);
										if(n > 0)
										{
											tmp = str.substr(0, n);
											console.log(tmp);
											kcal = kcal + parseInt(tmp);
											
										}
										//cerco i kj
										var n = str.search(/kj/);
										if(n > 0)
										{
											tmp = str.substr(0, n);
											console.log(tmp);
											kj = kj + parseInt(tmp);
											
										}
									}
								
								
							
							console.log("kc: "+kcal + " - kj: " + kj  );
							
							if(foods.length % 2 == 0)
								divisore = foods.length / 2;
							
							kcal = kcal / divisore;
							kj = kj / divisore;

							$("#toAppend").append('<div><h3>'+kcal+'kcal</h3></div>');
							$("#toAppend").append('<div><h3>'+kj+'kj</h3></div>');
							}else{
								//ciclo i foods
								for(i=0;i<foods.length;i++)
								{
										//console.log(foods[i].food);
										//console.log(foods[i].energy);
										$("#toAppend").append('<div><h3>'+foods[i].energy['value']+'</h3></div>');
								}	
							}
							$("#btn-subs").show();
						}//fine if	
					
					})//fine function
				}
			})	//fine btn-insert
			
		$("#btn-subs").click(function()
		{	var food = $("#food").val().trim();
				if(food != "")
				{	
					console.log("btn-subs");
					$.post( "API/get_substitution_API.php", { nameFood: food  })
							.done(function( data ) 
							{
								$("#toAppendSubs").empty();
								//console.log(data);
								$("#toAppendSubs").append(data);
								
							})
				}
		})//fine btn-sub
});
		
		
		
		