function visibile(element) {
	element="#"+element;
	console.log(element);
    $(element).prop('disabled',false);
}

function scelte(scelta) {
    

    if (scelta == 'info') {
        console.log(scelta);
        
        lang = $("input[name=lang]:checked").val();
        name = $('#name').val().trim(); 
        food = $('#food').val().trim(); 
        ptime= $('#ptime').val().trim();
        ctime = $('#ctime').val().trim();
        numberp = $('#nopeople').val().trim();
        cuisine = $('#cuisine').val().trim();
        diet = $('#diet').val().trim();
        occasion = $('#occasion').val().trim();  
        course = $('#course').val().trim();
        dati = "name: "+name+ ", numberp: "+nopeople+", cuisine: "+cuisine+", diet: "+diet+", occasion: "+occasion+", course:"+ course+" Ptime:"+ptime+" Ctime:"+ctime;
        console.log(dati)

        $.post( "API/insert_recipe_API.php", { name: name, food: food, numberp: numberp, cuisine: cuisine, diet: diet, occasion: occasion, course: course, lang: lang, ptime: ptime, ctime: ctime})
            .done(function( data ) {
                console.log("Data Loaded: " + data );
                if(data=='error'){
            alert("Ricetta già esistente");
            return ;
        }
        else
        {
			$('#photo_id').val(name);
			console.log("NAME: "+name);
			console.log("HIDDEN: "+$('#photo_id').val());
			$('#info').hide();
			$('#ingredients').show();}
        });


            
		console.log("NAME: "+name);

        return;
    }
     
    //Implementare altra scelta
    if(scelta=='stages') {
    	console.log(scelta);
        
        n = +$('#nstep').val() +1;
        console.log(n);
        dati_step ="";
        name = $('#name').val().trim(); 
        for (i=1;i<n;i++)
        {   
            step = $('#step'+i).val();
            console.log("Step "+i+" "+step);
             // vado a inserire il food nel caso non esiste
            $.post( "API/insert_step_API.php", { step: step, i: i, name: name })
            .done(function( data ) {
                console.log("Data Loaded: " + data );
            });

        }

        console.log(dati_step);
		$('#stages').hide();
		$('#photo').show();
        return;
    }
    
    if(scelta=='ingredients') {
    	console.log(scelta);
        $('#ingredients').hide();
        $('#stages').show();
        // parte finale query 
        lang = $("input[name=lang]:checked").val();
        n = +$('#ningredient').val() +1;
        dati_ingredient ="";
        for (i=1;i<n;i++)
        {   
            ingredient = $('#ingredient'+i).val().trim();
            detail = $('#detail'+i).val().trim();
            quantity = $('#quantity'+i).val().trim();
            unit = $('#misurazione'+i).val().trim();
            mis = $('input[name=mis'+i+']:checked').val().trim();
            name = $('#name').val().trim();
            console.log("Ricetta: "+name+" Ingredient "+i+" "+ingredient +" Detail: "+detail+" Quantity: "+quantity+ " Unit: "+unit+" Mis: "+mis);

            //inserisci ingrediente con quantità
            $.post( "API/insert_ingredient_API.php", { ingredient: ingredient,detail: detail, quantity: quantity, unit: unit, mis: mis, name: name, i: i, lang: lang })
            .done(function( data ) {
                console.log("Data Loaded 2: " + data );
            });



        }
        return;
    }
}

function add(tipo){
    if (tipo == 'step') {
     n = +$('#nstep').val() +1;
     console.log(n);
     $('#nstep').val(n);
     stringa = "<div class='form-group'><h4>Step " +n+"</h4><div class='col-lg-12'><input type='text' id='step"+n+"' class='form-control' /></div></div>";
     $('#steps').append(stringa);
                        }
    else
    {
    n = +$('#ningredient').val() +1;
    console.log(n);
    $('#ningredient').val(n);
    stringa = "<div class='form-group'><i class="+'"fa fa-shopping-cart fa-3x"></i>'+"<h4>Ingredient "+n+"</h4><div class='col-lg-12'>Name <input type='text' id='ingredient"+n+"' />Detail <input type='text' id='detail"+n+"' /> Quantity <input type='number' id='quantity"+n+"' /> <input type='radio' name='mis"+n+"' value='unit' onclick="+'"show('+"'unit','"+n+"');"+'"'+"> Unit <input type='radio' name='mis"+n+"' value='metric' onclick="+'"'+"show('metric','"+n+"');"+'"'+"> Metric <input type='radio' name='mis"+n+"' value='imperial' onclick="+'"'+"show('imperial','"+n+"');"+'"'+"> Imperial <select id='misurazione"+n+"'' disabled></select></div></div>";
    $('#ingredients1').append(stringa);
    }
}

function remov(tipo){
    if(tipo =='step') {
    n = $('#nstep').val();
    if(n== '1') ;
        else{
            n =+$('#nstep').val()-1;
    console.log(n);
    $('#nstep').val(n);
    $('#steps .form-group:last-child').remove();
            }
                        }
    else{

        n = $('#ningredient').val();
    if(n== '1') ;
        else{
            n =+$('#ningredient').val()-1;
    console.log(n);
    $('#ningredient').val(n);
    $('#ingredients1 .form-group:last-child').remove();
            }
    }

}

function show(tipologia,numero) {

    codice = "#misurazione"+numero;
    console.log(tipologia+ numero);
    $(codice).prop('disabled',false);
    if(tipologia == 'unit') {
        console.log(tipologia);
        $(codice).empty().append('whatever');
        $(codice).append('<option value="unit">Unit</option>');
    }
    else
    if(tipologia == 'metric'){
        console.log(tipologia);
        $(codice).empty().append('whatever');
        $(codice).append('<option value="g">g</option>');
        $(codice).append('<option value="kl">kl</option>');
        $(codice).append('<option value="ml">ml</option>');
        $(codice).append('<option value="l">l</option>');
        }
    else
    if(tipologia == 'imperial'){
        console.log(tipologia);
        $(codice).empty().append('whatever');
        $(codice).append('<option value="tablespoon">tablespoon</option>');
        $(codice).append('<option value="teaspoon">teaspoon</option>');
        $(codice).append('<option value="cup">cup</option>');
        $(codice).append('<option value="pint">pint</option>');
        $(codice).append('<option value="ounce">ounce</option>');
        $(codice).append('<option value="pound">pound</option>');
        }   

}



