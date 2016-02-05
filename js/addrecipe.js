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
        if( name == "")
        {
            console.log("name empty");
            $('#name').focus();
            return ;

        }
        food = $('#food').val().trim(); 
        if( food == "")
        {
            console.log("food empty");
            $('#food').focus();
            return ;

        }

        ptime= $('#ptime').val().trim();
        ctime = $('#ctime').val().trim();
        numberp = $('#nopeople').val().trim();

         if( numberp < 1)
        {
            console.log("number empty");
            $('#nopeople').focus();
            return ;

        }
        cuisine = $('#cuisine').val().trim();
        diet = $('#diet').val().trim();
        occasion = $('#occasion').val().trim();  
        course = $('#course').val().trim();
        dati = "name: "+name+ ", numberp: "+nopeople+", cuisine: "+cuisine+", diet: "+diet+", occasion: "+occasion+", course:"+ course+" Ptime:"+ptime+" Ctime:"+ctime;
        console.log(dati)
		 myApp.showPleaseWait(); //apro la dialog di loading
        $.post( "API/insert_recipe_API.php", { name: name, food: food, numberp: numberp, cuisine: cuisine, diet: diet, occasion: occasion, course: course, lang: lang, ptime: ptime, ctime: ctime})
            .done(function( data ) {
				myApp.hidePleaseWait(); // chiudo la dialog di loading
                console.log("Data Loaded: " + data );
                if(data.trim()=='error'){
                $.toaster({
            title: 'Error',
            priority: 'danger',
            message: 'This recipe already exists!',
        });
            return ;
        }
        else if(data.trim() == '')
        {
            $.toaster({
            title: 'Congratulation',
            priority: 'success',
            message: "Your recipe's infos were insert with success!",
        });
			$('#photo_id').val(name);
			console.log("NAME: "+name);
			console.log("HIDDEN: "+$('#photo_id').val());
			$('#info').hide();
			$('#ingredients').show();}
            else
                {

                    $.toaster({
            title: 'Error',
            priority: 'danger',
            message: "Your recipe's info were not insert!",
        });
                    return ;
                }
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
        for (i=1;i<n;i++)
        {   
            step = $('#step'+i).val();
			step = step.trim();
			console.log("step: " + step);
            if( step ==''){
                console.log('error stepempty');
                $('#step'+i).focus();
                return ;
            }
        }
        name = $('#name').val().trim(); 
        for (i=1;i<n;i++)
        {   
            step = $('#step'+i).val();
            
            console.log("Step "+i+" "+step);
			lang = $("input[name=lang]:checked").val();
             // vado a inserire il food nel caso non esiste
			 
			 myApp.showPleaseWait(); //apro la dialog di loading
            $.post( "API/insert_step_API.php", { step: step, i: i, name: name, lang:lang})
            .done(function( data ) {
				myApp.hidePleaseWait(); // chiudo la dialog di loading
                console.log("Data Loaded: " + data );
                if(data.trim() == ''){

                    $.toaster({
            title: 'Congratulation',
            priority: 'success',
            message: 'Your steps were insert with success!',
        });
                    $('#stages').hide();
        $('#photo').show();

                }
                else
                {

                    $.toaster({
            title: 'Error',
            priority: 'danger',
            message: 'Your steps were not insert!',
        });
                    return ;
                }
            });

        }

        console.log(dati_step);
		
        return;
    }
    
    if(scelta=='ingredients') {
    	console.log(scelta);
         n = +$('#ningredient').val() +1;
        for (i=1;i<n;i++)
        {   
            ingredient = $('#ingredient'+i).val().trim();
            if( ingredient ==''){
                console.log('error ingredient empty');
                $('#ingredient'+i).focus();
                return ;
            }
            detail = $('#detail'+i).val().trim();
            quantity = $('#quantity'+i).val().trim();
            if( quantity <= 0){
                console.log('error quantity ');
                $('#quantity'+i).focus();
                return ;
            }
        }
        
        // parte finale query 
        lang = $("input[name=lang]:checked").val();
       
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
			myApp.showPleaseWait(); //apro la dialog di loading
            //inserisci ingrediente con quantità
            $.post( "API/insert_ingredient_API.php", { ingredient: ingredient,detail: detail, quantity: quantity, unit: unit, mis: mis, name: name, i: i, lang: lang })
            .done(function( data ) {
				myApp.hidePleaseWait(); //chiudo la dialog di loading
                console.log("Data Loaded 2: " + data );
                if(data.trim() == ''){

                    $.toaster({
            title: 'Congratulation',
            priority: 'success',
            message: 'Your ingredients were insert with success!',
        });
                    $('#ingredients').hide();
        $('#stages').show();

                }
                else
                {

                    $.toaster({
            title: 'Error',
            priority: 'danger',
            message: 'Your ingredients were not insert!',
        });
                    return ;
                }
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
     stringa = "<div class='form-group'><h4>Step " +n+"</h4><div ><textarea class=\"form-control\" rows=\"5\" id=\"step"+n+"\"></textarea></div></div>";
     $('#steps').append(stringa);
                        }
    else
    {
    n = +$('#ningredient').val() +1;
    console.log(n);
    $('#ningredient').val(n);
    stringa = "<div class=\"form-group col-xs-12\"><i class=\"fa fa-shopping-cart fa-3x\"></i><h4>Ingredient"+n+"</h4><div class=\"col-lg-12\"><div class=\"col-sm-4\"><div>Name</div><input type=\"text\" id=\"ingredient"+n+"\" class=\"ingredients\"/></div><div class=\"col-sm-4\">Detail<input type='text' id=\"detail"+n+"\" class=\"form-control\" /></div><div class=\"col-sm-4\">Quantity <input type='number' id=\"quantity"+n+"\" class=\"form-control\" /> <input type='radio' name=\"mis"+n+"\" value='unit' onclick=\"show('unit','"+n+"');\" checked> Unit 	<input type='radio' name=\"mis"+n+"\" value='metric' onclick=\"show('metric','"+n+"');\" > 	Metric <input type='radio' name=\"mis"+n+"\" value='imperial' onclick=\"show('imperial','"+n+"');\"> Imperial<select id=\"misurazione"+n+"\" disabled><option value=\"unit\">Unit</option></select></div></div></div>";
	$('#ingredients1').append(stringa);
	setUpTypeahed(); //re-init typeahed
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

function suctoa(){

            $.toaster({
            title: 'Congratulation',
            priority: 'success',
            message: 'Your recipe was inserts with success!',
        });
}

