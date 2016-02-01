$(document).ready(function(){
	$(".btn-ingredients").hide();
	$(".btn-words").hide();
	$(".btn-subs").hide();
	$("#substitutions").hide();
	
})

var offset = 0;

function getRecipesByIngredients(num){
    $("#results").html("");
   offset = offset + num;
   if(offset < 0)offset = 0;
   if(num == 0)offset = 0;
   lang = $("input[name=lang]:checked").val();
    npeople = $('#npeople').val();
    n = +$('#ningredient').val() +1;
    cuisine = $('#cuisine').val().trim();
    diet = $('#diet').val().trim();
    occasion = $('#occasion').val().trim();
    course = $('#course').val().trim();
    input ="";
	liquidMeasure = $('#liquidMeasure').val();
	solidMeasure = $('#solidMeasure').val();
    for (i=1;i<n;i++)
    {   
            ingredient = $('#ingredient'+i).val().trim();
           // quantity = $('#quantity'+i).val().trim();
            //unit = $('#misurazione'+i).val().trim();
            //mis = $('input[name=mis'+i+']:checked').val().trim();
            input=input+ingredient+";";
    }
        console.log(npeople+" "+input);

        $.post( "API/get_recipes_API.php", {liquidMeasure:liquidMeasure,solidMeasure:solidMeasure,type: "ingredients", lang:lang,npeople: npeople, input: input, cuisine: cuisine, diet: diet, occasion: occasion, course: course,offset:offset})
            .done(function( data ) {
				hideAllButton();
                console.log("Data Loaded: " + data );
                $('#results').append(data);
				$(".btn-ingredients").show();
	
	
        });

}


function getRecipesByWords(num){
    $("#results").html("");
    offset = offset + num;
	if(offset < 0)offset = 0;
	 if(num == 0)offset = 0;
	console.log(offset);
	lang = $("input[name=lang]:checked").val();
	console.log(lang);
	npeople = $('#npeopleWords').val();
    input = $('#words').val().trim();
    cuisine = $('#cuisine').val().trim();
    diet = $('#diet').val().trim();
    occasion = $('#occasion').val().trim();
    course = $('#course').val().trim();
	console.log(course);
	liquidMeasure = $('#liquidMeasure').val();
	solidMeasure = $('#solidMeasure').val();
	
    $.post( "API/get_recipes_API.php", {liquidMeasure:liquidMeasure,solidMeasure:solidMeasure, type: "words", lang:lang ,npeople: npeople, input: input, cuisine: cuisine, diet: diet, occasion: occasion, course: course,offset:offset})
            .done(function( data ) {
				hideAllButton();
                console.log("Data Loaded: " + data );
                $('#results').append(data);
				$("#btn-ingredients").hide();
				$(".btn-words").show();
        });
	
}



function getRecipesBySubstitutions(num){
    $("#results").html("");
   offset = offset + num;
   if(offset < 0)offset = 0;
   if(num == 0)offset = 0;
   lang = $("input[name=lang]:checked").val();
    npeople = $('#npeople').val();
    n = +$('#ningredient').val() +1;
    cuisine = $('#cuisine').val().trim();
    diet = $('#diet').val().trim();
    occasion = $('#occasion').val().trim();
    course = $('#course').val().trim();
    input ="";
	liquidMeasure = $('#liquidMeasure').val();
	solidMeasure = $('#solidMeasure').val();
    for (i=1;i<n;i++)
    {   
            ingredient = $('#substitution'+i).val().trim();
           // quantity = $('#quantity'+i).val().trim();
            //unit = $('#misurazione'+i).val().trim();
            //mis = $('input[name=mis'+i+']:checked').val().trim();
            input=input+ingredient+";";
    }
        console.log(npeople+" "+input);

        $.post( "API/get_possible_subs_API.php", {liquidMeasure:liquidMeasure,solidMeasure:solidMeasure,type: "ingredients", lang:lang,npeople: npeople, input: input, cuisine: cuisine, diet: diet, occasion: occasion, course: course,offset:offset})
            .done(function( data ) {
				hideAllButton();
                console.log("Data Loaded: " + data );
                $('#results').append(data);
				$(".btn-subs").hide();
	
	
        });

}




function visibile(element) {
	element="#"+element;
	console.log(element);
    $(element).prop('disabled',false);
}



/*
 Il parametro "tipo" deve essere il tipo di ingrediente o sostituzione da aggiungere, in inglese plurale
 
 ESEMPIO:
 tipo = ingredients
 ningredients => id contenente numero di ingredienti inseriti
 ingredients1 => id dove aggiungere gli ingredienti
 ingredientX => campo aggiunto con numero X  ( si fa prendendo ingredients e togliendo "s")
*/
function add(tipo){
    
    n = +$('#n'+tipo).val() +1;
    console.log(n);
    $('#n'+tipo).val(n);
	str = tipo.substr(0,tipo.length -1); //tolgo la "s"
	console.log(str);
    stringa = "<div class=\"form-group\"><i class=\"fa fa-shopping-cart fa-2x\"></i><div><span class=\"heading\" for=\"comment\">Ingredient"+n+"</span></div><input type='text'  class=\"ingredients\" id='"+str+""+n+"' /></div>";
    $('#'+tipo+'1').append(stringa);
	setUpTypeahed();
    
}

function remov(tipo){
    

     n = $('#n'+tipo).val();
    if(n > '1')
	{
 
		n =+$('#n'+tipo).val()-1;
		console.log(n);
		$('#n'+tipo).val(n);
		$('#'+tipo+'1 .form-group:last-child').remove();
     }
    

}

function visible(name1,name2,name3,tipo){
		$("#tipo").empty();
       // console.log(name1+name2);
        $('#'+name1).show();
        $('#'+name2).hide();
		$('#'+name3).hide();
		$("#tipo").append(tipo);
}


function openRecipe(val)
{	
	
	window.open(val);
	
}

function hideAllButton()
{	
	$(".btn-subs").hide();
	$(".btn-words").hide();
	$(".btn-ingredients").hide();
	
}