function showSubstitutions(nome,lang)
		{
			//alert(" " + nome);
			$.post( "API/get_substitution_API.php", {nameFood:nome})
            .done(function( data ) {
				console.log("Data Loaded: " + data );
				 $('#header').empty();
				$('#content').empty();
                $('#header').append(nome);
				$('#content').append(data);
				$("#myModal").modal()
				$(".rating").rating();
				$( ".rating").on('rating.change', function(event, value, caption) {
										console.log(value);
										console.log(caption);
										console.log( $( this ).attr("id"));
										var id = $( this ).attr("id");
										console.log(id);
										$.post( "API/insert_vote_substitution_API.php", { nomeSub: id , voto: value  })
											.done(function( data ) 
											{
														showSubstitutions(nome,lang);
												
											})
									});
        });
			
		}
		
		
	function addSubstitution(food)
{
	window.open("addSubstitution.php?food=" + food)
	
}