$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var alertHidden 	= true;
	
	$(".alert").hide();
	
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            // $(wrapper).append('<div>food<input type="text" name="mytext[]" onfocus="$(this).css(\'background\',\'white\'); " /><br /> quantity<input type="text"  name="quantity[]" /><a href="#" class="remove_field">Remove</a></div>'); //add input box
			
			$(wrapper).append('<div><p class="heading"></p><i class="glyphicon glyphicon-plus-sign minIcon"></i><h3 class="heading">food</h3><input class="form-control" type="text" name="mytext[]" onfocus="$(this).css(\'background\',\'\');" /><h3 class="heading">quantity</h3><input type="text"  class="form-control" name="quantity[]" /></div>'); //add input box

		}
    });
    
    /*$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
		$(this).parent('div').remove(); x--;
    })*/
	
	$(".remove_field").click(function(){
		 if(x > 1)
		 {
			$(".input_fields_wrap").find("div")[x-1].remove();
			x--;
		 }
	});
	
	//recupero delle informazioni
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
		
		r = getRandomInt(10000,10000000000) * getRandomInt(2,1000);
		ingredientList = food + "_sub_" + r;
		console.log(ingredientList);
		fakeIngredient = Array();
		for(i=0;i<subs.length;i++){
			fakeIngredient[i] = ingredientList + "_" + subs[i];
			console.log(subs[i] + "-" + quantity[i]);
			console.log(fakeIngredient[i]);
		}
		console.log(qRes);
		if(flag){
			if(alertHidden){
				$(".alert").show();
				alertHidden = false;
			}
			
		}
		
		

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
	
});