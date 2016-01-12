//Istanziazione wizard document ready
$(document).ready(function() {
    //Attivazione div al click
    $('input.toggler[type="checkbox"]').click(function() {
        if ($(this).attr("value") == "price") {
            $("#pricediv").slideToggle();
        }
        if ($(this).attr("value") == "hd") {
            $("#hddiv").slideToggle();
        }
        if ($(this).attr("value") == "ram") {
            $("#ramdiv").slideToggle();
        }
        if ($(this).attr("value") == "backup") {
            $("#backupdiv").slideToggle();
        }
        if ($(this).attr("value") == "cpu") {
            $("#cpudiv").slideToggle();
        }
    });
});
//Apre i div necessari quando si clicca sull'offerta
function toggleAll() {
    if (!$("#pricediv").is(":visible")) $('input.toggler[value="price"]').click();
    if (!$("#hddiv").is(":visible")) $('input.toggler[value="hd"]').click();
    if (!$("#ramdiv").is(":visible")) $('input.toggler[value="ram"]').click();
    if (!$("#backupdiv").is(":visible")) $('input.toggler[value="backup"]').click();
    if (!$("#cpudiv").is(":visible")) $('input.toggler[value="cpu"]').click();
}
//Aggiorna il valore selezionato
function update(target, value) {
    $('#' + target).html($('#' + value).val());
}
//Controller per inviare i dati al controller Advanced
function submitData() {
    var stringarichiesta = "";
    if ($("#valueprezzo").is(":visible")) stringarichiesta += "&price=" + $('#valueprezzo').html();
    if ($("#valueharddisk").is(":visible")) stringarichiesta += "&capacityDisk=" + $('#valueharddisk').html();
    if ($("#hddiv").is(":visible")) {
        if ($('#SSD').is(':checked')) stringarichiesta += "&typeDisk=SSD";
        else if ($('#HD').is(':checked')) stringarichiesta += "&typeDisk=HD";
    }
    if ($("#valueram").is(":visible")) stringarichiesta += "&capacityRam=" + $('#valueram').html();
    if ($("#backupdiv").is(":visible")) {
        if ($('#BackupSi').is(':checked')) stringarichiesta += "&backup=Si";
        else if ($('#BackupNo').is(':checked')) stringarichiesta += "&backup=No";
    }
    if ($("#valueprocessore").is(":visible")) stringarichiesta += "&clockCpu=" + $('#valueprocessore').html();
    if ($("#valueramclock").is(":visible")) stringarichiesta += "&clockRam=" + $('#valueramclock').html();
    if ($("#cpudiv").is(":visible")) {
        if ($('#AMD').is(':checked')) stringarichiesta += "&typeCpu=AMD";
        else if ($('#Intel').is(':checked')) stringarichiesta += "&typeCpu=Intel";
    }
    if ($("#numcore").is(":visible")) stringarichiesta += "&numbCore=" + $('#numcore').val();
    //Rimozione primo carattere(&) per la richiesta POST
    stringarichiesta = stringarichiesta.substring(1);
    console.log(stringarichiesta);
    var parametri = {
        stringa: stringarichiesta,
    };
    $.post(jersey_path + "/suggest", parametri, function(offerte, status) {
        //Azzeramento dei risultati
        $('#risultati').html('');
        //Se c'è almeno un risultato
        if (offerte[0] != null) {
            stampaRisultati(offerte);
        } else $('#risultati').html("<h3>Nessun risultato trovato.</h3>");
    });
}
/* Restituisce i suggerimenti in base allo scopo indicato */
function getBasicSuggestions(tipo) {
    var parametri = {
        tipo: tipo,
    };
    $.post(jersey_path + "/suggestBasic", parametri, function(offerte, status) {
        stampaRisultati(offerte);
    });
}
/* Funzione per inserire i dati dell'infrastruttura all'interno del wizard avanzato */
function upValue(riferimento) {
    toggleAll();
    var json = $(riferimento).find('input').val();
    var campi = json.split("&");
    for (var i = 0; i < campi.length; i++) {
        var valori = campi[i].split("=");
        if ((valori[0] == 'hd') || (valori[0] == 'backup') || (valori[0] == 'proc')) {
            if (valori[0] == 'backup') {
                valori[1] = 'Backup' + valori[1];
            }
            $("#" + valori[1]).prop("checked", true);
        } else {
            $('#' + valori[0]).val(valori[1]);
            update('value' + valori[0], valori[0]);
        }
    }
}