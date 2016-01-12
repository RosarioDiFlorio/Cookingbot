function visibile(element) {
	element="#"+element;
	console.log(element);
    $(element).prop('disabled',false);
}

function scelte(scelta) {
    

    if (scelta == 'info') {
        console.log(scelta);
        $('#info').hide();
        $('#ingredients').show();
        name = $('#name').val(); 
        nopeople = $('#nopeople').val()
        cusin = $('#cusin').val()
        diet = $('#diet').val()
        occasion = $('#occasion').val()    
        dati_info = "Name: "+name+ " Number People: "+nopeople+" Cusin: "+cusin+" Diet: "+diet+" occasion: "+occasion;
        console.log(dati_info)
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
            console.log("Step "+i+" "+$('#step'+i).val());
        }

        console.log(dati_step);
        return;
    }
    
    if(scelta=='ingredients') {
    	console.log(scelta);
        $('#ingredients').hide();
        $('#stages').show();
        // parte finale query 
        n = +$('#ningredient').val() +1;
        dati_ingredient ="";
        for (i=1;i<n;i++)
        {   
            console.log("Ingredient "+i+" "+$('#ingredient'+i).val()+ " Quantity: "+$('#quantity'+i).val()+ " Unit: "+$('#misurazione'+i).val());
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
    stringa = "<div class='form-group'><i class="+'"fa fa-shopping-cart fa-3x"></i>'+"<h4>Ingredient "+n+"</h4><div class='col-lg-12'>Name <input type='text' id='ingredient"+n+"' /> Quantity <input type='number' id='quantity"+n+"' /> <input type='radio' name='mis' value='unit' onclick="+'"show('+"'unit','"+n+"');"+'"'+"> Unit <input type='radio' name='mis' value='metric' onclick="+'"'+"show('metric','"+n+"');"+'"'+"> Metric <input type='radio' name='mis' value='imperial' onclick="+'"'+"show('imperial','"+n+"');"+'"'+"> Imperial <select id='misurazione"+n+"'' disabled></select></div></div>";
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



