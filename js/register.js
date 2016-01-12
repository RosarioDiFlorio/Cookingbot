$(document).ready(function() {
    $.material.init();
    $('#registerme').click(function(e) {
    	richiediRegistrazione();
    });
});
//Funzione per la registrazione
function richiediRegistrazione() {
	var password = $('#inputPassword').val();
	var email = $('#inputEmail').val();
	var confirmpassword = $('#confirmPassword').val();
	if(password != confirmpassword) {
		$('#registerresponse').html(buildResponseDiv("danger","Le password non coincidono"));
		return;
	}
	var parametri = {
		email : email,
		password : password
	}
	$.ajax({
  		type: "POST",
  		dataType: "json",
  		url: "scripts/creaUtente.php",
  		data: parametri,
  		success: function(msg){
  			$('#registerresponse').html(buildResponseDiv("success","Il tuo account è stato creato!"));
  		},
  		error: function(XMLHttpRequest, textStatus, errorThrown) {
  			var response = JSON.parse(XMLHttpRequest.responseText);
  			$('#registerresponse').html(buildResponseDiv("danger",response['error']));
  		}
	});
}
//Costruzione dell'alert per la registrazione
function buildResponseDiv(type,text) {
	return '<div class="alert alert-dismissable alert-'+type+'"><button type="button" class="close" data-dismiss="alert">×</button>'+
		text + '</div>';
}