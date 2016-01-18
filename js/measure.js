	
	
	
	function show(tipologia,numero) {

		codice = "#misurazione"+numero;
		//console.log(tipologia+ numero);
		$(codice).prop('disabled',false);
		if(tipologia == 'unit') {
			console.log(tipologia);
			$(codice).empty().append('whatever');
			$(codice).append('<option value="unit">Unit</option>');
		}
		else
		if(tipologia == 'metric'){
			//console.log(tipologia);
			$(codice).empty().append('whatever');
			$(codice).append('<option value="g">g</option>');
			$(codice).append('<option value="kl">kl</option>');
			$(codice).append('<option value="ml">ml</option>');
			$(codice).append('<option value="l">l</option>');
			}
		else
		if(tipologia == 'imperial'){
			//console.log(tipologia);
			$(codice).empty().append('whatever');
			$(codice).append('<option value="tablespoon">tablespoon</option>');
			$(codice).append('<option value="teaspoon">teaspoon</option>');
			$(codice).append('<option value="cup">cup</option>');
			$(codice).append('<option value="pint">pint</option>');
			$(codice).append('<option value="ounce">ounce</option>');
			$(codice).append('<option value="pound">pound</option>');
			}   

	}

	