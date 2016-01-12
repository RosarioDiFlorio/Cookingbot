//Funzioni lanciate al ready del DOM
$(document).ready(function() {
    getBestSuggestions();
});
/* Restituisce le migliori offerte */
function getBestSuggestions() {
    $.post(jersey_path + "/getBest", function(offerte, status) {
        stampaRisultati(offerte);
    });
}