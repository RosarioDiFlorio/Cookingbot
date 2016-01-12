//Path al percorso di Jersey
var jersey_path = "http://localhost:8080/com.unisa.jersey.gricore";
//Istanziazioni DOM
$(document).ready(function() {
    $.material.init();
});
/* Crea l'html dell'offerta inviata */
function buildOfferMarkup(offer,id) {
    //Markup generico
    var dettagli = "";
    var classe = 'hosting"';
    var tipoofferta = 'Hosting';
    var icona = '<i class="mdi-file-cloud"></i>'; //Icona di default hosting
    //Backup Si/no
    if(offer['backup'] == "true")
        offer['backup'] = "Si";
    else
        offer['backup'] = "No";
    //Verifica se l'offerta è un hosting
    if (offer['SO'] != undefined) {
        if(offer.numbdomains == 10000)
            offer.numbdomains = "Illimitati";
        if(offer.numbemails == 10000)
            offer.numbemails = "Illimitati";
        dettagli = '<span class="nome"><strong>Nome</strong>: ' + offer.Name + '</span>' +
        '<span class="numdomini"><strong>Numero Domini</strong>: ' + offer.numbdomains +
        '</span>' + '<span class="numemail"><strong>Numero Email</strong>: ' + offer.numbemails + '</span>' +
        '<span class="sistemaop"><strong>Sistema operativo</strong>: ' + offer.SO + '</span>' +
        '<span class="antivirus"><strong>Antivirus</strong>: ' + offer.antivirus + '</span>' +
        '<span class="backup"><strong>Backup</strong>: ' + offer.backup + '</span>' +
        '<span class="banda"><strong>TransferRate</strong>: '+ offer.transferRate+ ' Mbit/s</span>' +
        '<span class="disco"><strong>TipoDisco</strong>: ' + offer.typeDisk + '</span>' +
        '<span class="capacita"><strong>Capacità</strong>: '+ offer.capacityDisk+ ' GB</span>' +
        '<span class="prezzo"><strong>Prezzo</strong>: '+ offer.price+ ' /mese</span>';
    } else if (offer['clockRam'] != undefined) {
        //Icona a seconda dello scopo del dedicato
        switch(offer.DedicatedFor) {
            case "hosting" :
                icona = '<i class="mdi-file-cloud"></i>';
                break;
            case "storage":
                icona = '<i class="fa fa-hdd-o"></i>';
                break;
            case "processing":
                icona = '<i class="mdi-hardware-memory"></i>';
                break;
        }

        json='prezzo='+offer.price+
        '&nome=' + offer.nome +
        '&harddisk='+offer.capacityDisk+
        '&hd='+offer.typeDisk+
        '&ram='+offer.capacityRam+
        '&ramclock='+offer.clockRam+
        '&backup='+offer.backup+
        '&processore='+offer.clockCpu+
        '&numcore='+offer.numbCore+
        '&proc='+offer.typeCpu;

        tipoofferta = "Dedicato";
        classe = 'dedicated dedicatedpoint" onclick=upValue(this)';
        dettagli = '<span class="nome"><strong>Nome</strong>: ' + offer.Name + '</span>' +
        '<span class="tipocpu"><strong>TipoCPU</strong>: '+ offer.typeCpu+ '</span>' +
        '<span class="nomecpu"><strong>NomeCPU</strong>: '+ offer.nomeCpu+ '</span>' +
        '<span class="clock"><strong>ClockCPU</strong>: '+ offer.clockCpu+ ' Mhz</span>' +
        '<span class="numcore"><strong>Numero Processori</strong>: '+ offer.numbCore+ '</span>' +
        '<span class="disco"><strong>TipoDisco</strong>: '+ offer.typeDisk+ '</span>' +
        '<span class="capacita"><strong>Capacità</strong>: '+ offer.capacityDisk+ ' GB</span>' +
        '<span class="ram"><strong>RAM</strong>: '+ offer.capacityRam+ ' GB</span>' +
        '<span class="clockram"><strong>ClockRam</strong>: '+ offer.clockRam+ ' Mhz</span>' +
        '<span class="backup"><strong>Backup</strong>: '+ offer.backup+ '</span>' +
        '<span class="banda"><strong>TransferRate</strong>: '+ offer.transferRate+ ' Mbit/s</span>' +
        '<span class="consigliato"><strong>Consigliato per</strong>: '+ offer.DedicatedFor+ '</span>' +
        '<span class="prezzo"><strong>Prezzo</strong>: '+ offer.price+ ' /mese</span>' +
        '<button class="btn btn-primary" onclick=buildOfferObject("'+offer.Name+'"); >Dettagli</button>' +
		'<input type="hidden" id="'+offer.Name+'json" value="'+json+'" />';
		}
    else {
        console.log(offer);
        return "Offerbuilderror";
    }
    //Tasto mostra commenti
    dettagli += '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick=mostraCommenti("'+encodeURIComponent(offer.Name)+'"); > Feedback</button>';
    //Aggiunta tasto Elimina se ok
    if(is_admin)
        dettagli += '<button type="button" class="btn btn-danger" onclick=elimina("'+offer.Name+'") > Elimina</button>';
    //Gestione Rating
    if((offer.rating != undefined) && (offer.rating != null))
    dettagli += '<input id="'+offer.Name+'rating" type="number" value="'+offer.rating+'" readonly="true" class="rating" min=1 max=5 step=1 data-size="xs">'
    return '<div class="panel boxofferta col-md-3 panel-default '+classe+' id="'+offer.Name+'" >' +
            '<div class="panel-body">'+
                '<div class="intestazione">'+
                    icona +'<h3>'+tipoofferta+'</h3>'+
                '</div>' + '<div class="dettagli">' + dettagli +'</div></div></div>';
}
// Mostra i commenti
function mostraCommenti(nomeIstanza) {
	nomeIstanza=decodeURIComponent(nomeIstanza);
    var parametri = {
        nome : nomeIstanza
    };
    var apiurl = jersey_path + "/getComments";
    $('#modalecommenti').modal("show");
    //Pulizia dei vecchi valori
    $("#corpocommenti").html("<h4>Nessun commento disponibile</h4>");
    document.getElementById("titolocommenti").innerHTML="<b>Feedback sull'offerta "+nomeIstanza+"</b>";
    var result="";
    $.ajax({
        type: "POST",
        dataType: "json",
        url: apiurl,
        data: parametri,
        complete: function(commenti) {
            //Riassegnazione per tipo JSON
            var commenti = JSON.parse(commenti.responseText);
            if (commenti[0] != null) {
                $.each(commenti, function(i, item) {
                    if (item.nome != "Nessuno")
                        var ratingstars = '<input type="number" value="'+item.rating+'" readonly="true" class="rating" min=1 max=5 step=1 data-size="xs">';
                        result += "<div class=\"panel panel-default\"><div class=\"panel-body\"><span class=\"commenttitle\"><b>"+item.nome+"</b>"+ ratingstars +"</b></span><span class=\"commenttext\">"+ item.haCommentato +"</span></div></div>";
                });
            }
            $("#corpocommenti").html(result);
            //Attivazione del rating
            $("#corpocommenti .rating").rating();
        }
    });
    //Aggiunta tasto di commento
    if(is_logged)
        $('#footercommenti').html('<button type="button" class="btn btn-primary" onclick=apriModaleCommento("'+encodeURIComponent(nomeIstanza)+'");>Lascia un tuo feedback</button>');
}
// Costruisce un oggetto buildOffer prendendo la stringa di caratteristiche di un'offerta
function buildOfferObject(riferimento) {
    var json = $("#" + riferimento + "json").val();
    var campi= json.split("&");
    var oggetto = {};
    for(var i=0;i<campi.length;i++) {
        var valori= campi[i].split("=");
        oggetto["" + valori[0]] = valori[1];
    }
    paintOfferGraph(oggetto);
}
// Costruisce il grafico dell'offerta ricevendo un oggetto di tipo Offer(vedi funzione precedente)
function paintOfferGraph(offer) {
    $('#modale').modal('show');
    notImp = 1;
    Imp = 4;
    veryImp = 8;
    //Fetching offerta
    clock_cpu = offer.processore;
    core_cpu = offer.numcore;
    clock_ram = offer.ramclock;
    cap_ram = offer.ram;
    cap_disk = offer.harddisk;
    typeDisk = offer.hd;
    if (typeDisk == "SSD") {
        typeDisk = 500;
    } else typeDisk = 250;
    storage = clock_ram * notImp + cap_ram * notImp + clock_cpu * notImp + core_cpu * notImp + cap_disk * veryImp + typeDisk * notImp;
    hosting = clock_ram * notImp + cap_ram * veryImp + clock_cpu * veryImp + core_cpu * veryImp + cap_disk * notImp + typeDisk * veryImp;
    processing = clock_ram * veryImp + cap_ram * notImp + clock_cpu * veryImp + core_cpu * veryImp + cap_disk * notImp + typeDisk * veryImp;
    $(function() {
        $("#graphcontainer").highcharts({
            chart: {
                polar: true,
                type: 'line'
            },
            title: {
                text: offer.nome,
                x: -80
            },
            pane: {
                size: '80%'
            },
            xAxis: {
                categories: ['Hosting', 'Storage', 'Processing'],
                tickmarkPlacement: 'on',
                lineWidth: 0
            },
            yAxis: {
                gridLineInterpolation: 'polygon',
                lineWidth: 0,
                min: 0
            },
            tooltip: {
                shared: true,
                pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
            },
            legend: {
                align: 'right',
                verticalAlign: 'top',
                y: 70,
                layout: 'vertical'
            },
            series: [{
                name: 'Rank',
                data: [hosting, storage, processing],
                pointPlacement: 'on'
            }, ]
        });
    });
}
/* Stampa a schermo i risultati */
function stampaRisultati(offerte) {
    //Azzeramento dei risultati
    $('#risultati').html('');
    //Inizializzazioni
    var riga = '<div class="heading"><h2>Infrastrutture Disponibili</h2></div><div class="row">';
    var counter = 1;
    $.each(offerte, function(i, item) {
        riga += buildOfferMarkup(item,i);
        //Se ho stampato una riga intera(4 elementi) o sono arrivato alla fine della stampa, stampa un elemento row
        if((counter == 4) || (i == (offerte.length - 1))) {
            riga += "</div>";
            $(riga).appendTo('#risultati').fadeIn('show');
            riga = '<div class="row">';
            counter = 0;
        }
        counter++;
    });
    //Gestione rating
    $(".rating").rating();
}
//Controller per inviare i dati al controller Advanced
function apriModaleCommento(nomeIstanza) {
  $('#modalevoto').modal('show');
  $('#titolovota').html('Lascia un feedback per ' + nomeIstanza);
  $("#NomeIstanzaText").val(nomeIstanza);
}
//Controller per votare
function vota()
{
	var nomeIstanza= $("#NomeIstanzaText").val();
    var Commento = $('#message-text').val();
    var Voto = $('#votodato').val();
    var parametri = {
        nomeIstanza: nomeIstanza,
        Commento:Commento,
        Voto:Voto,
    };
    $.post("scripts/vota.php", parametri, function(offerte, status) {
        if(offerte == "false")
            lanciaNotifica("danger","Errore","Hai già votato questa offerta.");
        else {
            //Refresh commenti per l'istanza
            $('#modalevoto').modal('hide');
            mostraCommenti(nomeIstanza);
            lanciaNotifica("success","Votazione","Il tuo feedback è stata ricevuto.");
        }
    });
}
//Controller per inviare i dati al controller Advanced
function elimina(nomeIstanza) {
    var r = confirm("Sei sicuro di voler eliminare l'offerta " + nomeIstanza);
        if (r == true) {
            var parametri = {
                nomeIstanza: nomeIstanza,
            };
            $.post("scripts/delete.php", parametri, function(offerte, status) {
                lanciaNotifica("success","Cancellazione","L'offerta " + nomeIstanza + " è stata eliminata.");
                $('#' + nomeIstanza).remove();
            });
        }
}
//Lancia una notifica a schermo
function lanciaNotifica(tipo,titolo,messaggio) {
    $.toaster({
            priority : tipo,
            title : titolo,
            message : messaggio,
        }
    );
}