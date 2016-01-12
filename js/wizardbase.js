function scelte(scelta) {
    var stringarichiesta;
    if ((scelta == 'WebSite') || (scelta == 'Gaming') || (scelta == 'Cloud')) {
        $("#sceltautente").val(scelta);
        $('#scopo').hide();
        $('#budget').show();
        return;
    }
    //Implementare altra scelta
    if((scelta=='LowBudget') || (scelta=='HighBudget')) {
        $("#sceltautente1").val(scelta);
        $('#budget').hide();
        $('#performance').show();
        return;
    }
    //Implementare altra scelta
    if((scelta=='LowPerformance') || (scelta=='HighPerformance')) {
        $("#sceltautente2").val(scelta);
        $('#performance').hide();
        var purpose = $("#sceltautente").val();
        var budget = $("#sceltautente1").val();
        var performance = $('#sceltautente2').val();
        var parametri = {
            Purpose : purpose,
            Budget : budget,
            Performance : performance
        }
        $.post(jersey_path + "/getPurpose", parametri, function(offerte, status) {
            if(offerte.length == 0)
              $('#risultati').html("<h2>Nessuna offerta disponibile</h2><a href=\"wizardbase.php\">Fai un'altra ricerca</a>");
            else {
                stampaRisultati(offerte);
                $('#risultati').append("<a href=\"wizardbase.php\">Fai un'altra ricerca</a>");
            }
        });
    }
}