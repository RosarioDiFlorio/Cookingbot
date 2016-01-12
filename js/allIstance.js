//Istanziazione wizard document ready
$(document).ready(function() {
    //Attivazione div al click
    showData();
});
//Restituisce i dati aggiornati
function showData() {
    $.post(jersey_path + "/getTodo", function(offerte, status) {
        stampaRisultati(offerte);
    });
}