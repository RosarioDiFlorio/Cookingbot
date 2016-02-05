$(document).ready(function() {
	
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var alertHidden 	= true;
	
	$("#success").hide();
	$(".alert").hide();
	
	
	
	
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
          
			$(wrapper).append('<div class="col-sm-12"><i class="glyphicon glyphicon-plus-sign smallSpaceTop"></i><div class="heading">food</div> <input class="ingredients " type="text" name="mytext[]" onfocus="$(this).css(\'background\',\'\');" /> <div class="heading">quantity</div> <div class="col-sm-4"></div><div class="col-sm-4"><input type="number" min="0" class="form-control"  name="quantity[]" /> <input type="radio" name="mis'+x+'" value="unit" onclick="show(\'unit\',' + x + '	);"> Unit <input type="radio" name="mis'+x+'" value="metric" onclick="show(\'metric\',' + x + ');"> Metric <input type="radio" name="mis'+x+'" value="imperial" onclick="show(\'imperial\',' + x + ');"> Imperial <select id="misurazione' + x + '"  disabled> </select></div></div>');
			$('input.ingredients').typeahead({
                name: 'ingredients',
                local: locale
			})
		}
    });
    
	//inserisco 2 campi in più di default;
	/*$(add_button).click();
	$(add_button).click();
	*/
    /*$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
		$(this).parent('div').remove(); x--;
    })*/
	
	$(".remove_field").click(function(){
		 if(x > 1)
		 {
			// console.log("remove");
			$(".input_fields_wrap").children("div")[x-1].remove();
			x--;
		 }
	});
	
	//recupero delle informazioni
	$("#btn-insert").click(function(e){
		e.preventDefault(); 
		flag = false;
		food = $("#sel1").val();
		qRes = $("[name=qantityResult]").val();
		console.log(food);
		subs = Array();
		quantity = Array();
		i = 0;
		$("[name='mytext[]']").each(function() {
   			valore = $(this).val();
			subs[i] = valore;
			if(subs[i].trim() == ""){
			$(this).css("background","red");
			flag = true;
			}
			i++;
		});
		
		i=0;
		$("[name='quantity[]']").each(function() {
   			valore = $(this).val();
			quantity[i] = valore;
			i++;
		});
		
		//r = getRandomInt(10000,10000000000) * getRandomInt(2,1000);
		//ingredientList = food + "_sub_" + r;
		
		
		// hash value of ingredients 
		hashValue = Math.abs(food.hashCode());
		for(i=0;i<subs.length;i++)
		{
			hashValue += Math.abs(subs[i].hashCode());

		}
		
		ingredientList = hashValue;
		
		console.log(ingredientList);
		
		fakeIngredient = Array();
		for(i=0;i<subs.length;i++){
			fakeIngredient[i] = ingredientList + "_" + subs[i];
			//console.log(subs[i] + "-" + quantity[i]);
			//console.log(fakeIngredient[i]);
		}
		console.log(qRes);
		
		
		for(i =0 ; i < x;i++)
		{	
			val = $("#misurazione" + (i + 1)).val();
			//console.log("misura: " + val);
			quantity[i] = quantity[i] + " " + val;
			//console.log(quantity[i]);
		}
		
		qRes = qRes + " " + $("#misurazioneResult").val();
		console.log("quantità risultante: " + qRes);
		if(flag){
			if(alertHidden){
				$(".alert").show();
				alertHidden = false;
			}
			
		}else{
			//invio i dati
			
			ing = "";
			quan = "";
			fakeIng = "";
			
			for(i = 0; i <fakeIngredient.length;i++)
			{
				ing+=  subs[i] + "#";
				quan += quantity[i] + "#";
				fakeIng += fakeIngredient[i] + "#";
				
				
			}
			console.log(ing);
			
			console.log(quan);
			
			console.log(fakeIng);
			
			misType  = Array();
			for(i = 0 ; i < x;i++)
			{	
			val = $("[name='mis" + (i + 1) + "']:checked").val();
			misType[i] = val;
			console.log("type: " + misType[i]);
			
			}
		
			misResult = $("[name='misResult']:checked").val();
			
			console.log("res: " + misResult);
			
			arrMisType = "";
			for(i = 0; i < misType.length;i++)
			{
				arrMisType +=  misType[i] + "#";
				
				
				
			}
			 myApp.showPleaseWait(); //apro la dialog di loading
			$.post( "API/insert_substitution_API.php", { nameFood: food , quantityResult : qRes , ing : ing , quantity : quan, fakeIng: fakeIng, ingList : ingredientList , misResult : misResult ,typeMis : arrMisType})
				.done(function( data ) {
					myApp.hidePleaseWait(); // chiudo la dialog di loading
					console.log("Success: " + data);
					$("#success").show();
					$("#contMain").hide();
					if(data.trim() == ''){

					$.toaster({
            title: 'Congratulation',
            priority: 'success',
            message: 'Your substitution was insert with success!',
        });

				}
				else
				{

					$.toaster({
            title: 'Error',
            priority: 'danger',
            message: 'Your substituion was not insert!',
        });
					return ;
				}
				
			});
		}

	})
	
	
	$("#btn").click(function(e){
		e.preventDefault(); 
		flag = false;
		food = $("#sel1").val();
		qRes = $("[name=qantityResult]").val();
		console.log(food);
		subs = Array();
		quantity = Array();
		i = 0;
		$("[name='mytext[]']").each(function() {
   			valore = $(this).val();
			subs[i] = valore;
			if(subs[i].trim() == ""){
			$(this).css("background","red");
			flag = true;
			}
			i++;
		});
		
		i=0;
		$("[name='quantity[]']").each(function() {
   			valore = $(this).val();
			quantity[i] = valore;
			i++;
		});
		
		for(i =0 ; i < x;i++)
		{	
			val = $("#misurazione" + (i + 1)).val();
			//console.log("misura: " + val);
			quantity[i] = quantity[i] + " " + val;
			//console.log(quantity[i]);
		}
		
		qRes = qRes + " " + $("#misurazioneResult").val();
		console.log("quantità risultante: " + qRes);
		if(flag){
			if(alertHidden){
				$(".alert").show();
				alertHidden = false;
			}
			
		}else{
			//invio i dati
			
			ing = "";
			quan = "";
			fakeIng = "";
			$("#subsFoodModal").empty(); //svuoto
			for(i = 0; i <subs.length;i++)
			{
				ing =  subs[i];
				quan = quantity[i] ;
				
				$("#subsFoodModal").append('<div class="subsModal">');
				if(i > 0)
				$("#subsFoodModal").append('<i class="glyphicon glyphicon-plus"></i>');
				
				$("#subsFoodModal").append('<div><h3><strong>'+ing+' - '+quan+'</strong></h3></div>	</div>');

				console.log(quan);
				
			}
			
			
			misType  = Array();
			for(i = 0 ; i < x;i++)
			{	
			val = $("[name='mis" + (i + 1) + "']:checked").val();
			misType[i] = val;
			console.log("type: " + misType[i]);
			
			}
		
			misResult = $("[name='misResult']:checked").val();
			
			console.log("res: " + misResult);
			
			arrMisType = "";
			for(i = 0; i < misType.length;i++)
			{
				arrMisType +=  misType[i] + "#";
				
				
				
			}
				
			//mostro il modale di riassunto
			console.log(food + " - " + qRes);
			$("#nameFoodModal").empty(); //svuoto
			$("#nameFoodModal").append('<h3><strong>'+food+' - '+qRes+'</h3></strong>');
			
			$("#modalResume").modal();
		}
			
	
	})
	
	$("#btn-reload").click(function(){
		
		location.reload();
	})
	
	$("input").focus(function(){
		
		if(!alertHidden){
				$(".alert").hide();
				alertHidden = true;
			}
		
	})
	
	// Returns a random integer between min (included) and max (excluded)
	// Using Math.round() will give you a non-uniform distribution!
	function getRandomInt(min, max) {
	  return Math.floor(Math.random() * (max - min)) + min;
	}
	
	function toggleColor(el){
		$(this).css("background","red");
	}
	
	
	String.prototype.hashCode = function(){
	var hash = 0;
	if (this.length == 0) return hash;
	for (i = 0; i < this.length; i++) {
		char = this.charCodeAt(i);
		hash = ((hash<<5)-hash)+char;
		hash = hash & hash; // Convert to 32bit integer
	}
	return hash;
}
	
});