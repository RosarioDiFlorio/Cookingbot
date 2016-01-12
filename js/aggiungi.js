function add(tipo) {
    if (tipo == "Hosting") {
        var nome = $('#nomeH').val();
        var so = $('input[name=soH]:checked').val();
        var antivirus = $('#antivirusH').val();
        var tipodisco = $('#tipodiscoH').val();
        var capacitadisco = $('#capacitaH').val();
        var domini = $('#dominiH').val();
        var email = $('#emailH').val();
        var transferrate = $('#transferrateH').val();
        var backup = $('input[name=backupH]:checked').val();
        if(backup == "Si")
                backup = "true";
            else backup = "false";
        var prezzo = $('#prezzoH').val();
        if (nome=="" || so=="" || antivirus=="" || tipodisco =="" || capacitadisco=="" || domini=="" || email=="" || transferrate=="" || prezzo=="" ) {
            alert("Si prega di inserire tutti i parametri");return;}
            var parametri = {
                name: nome,
                so: so,
                antivirus: antivirus,
                typedisk: tipodisco,
                capacitydisk: capacitadisco,
                numdomini: domini,
                numemail: email,
                transferrate: transferrate,
                backup: backup,
                price: prezzo
            };
            $.post("scripts/aggiungiHosting.php", parametri, function(data, status) {
                lanciaNotifica("success","Aggiunta",nome + " è stato aggiunto");
            });
        }
        else if (tipo == "Dedicated") {
            var nome = $('#nomeD').val();
            var tipocpu = $('input[name=cpuD]:checked').val();
            var nomecpu = $('#cpuD').val();
            var tipodisco = $('#tipodiscoD').val();
            var capacitadisco = $('#capacitaD').val();
            var clockcpu = $('#clockcpuD').val();
            var numeroprocessori = $('#processoriD').val();
            var ram = $('#ramD').val();
            var clockram = $('#clockramD').val();
            var transferrate = $('#transferrateD').val();
            var backup = $('input[name=backupD]:checked').val();
			 if(backup == "Si")
                backup = "true";
            else backup = "false";
            var prezzo = $('#prezzoD').val();
		    var DedicatedFor = $('#DedicatedFor').val();
            var parametri = {
                name: nome,
                typecpu: tipocpu,
                namecpu: nomecpu,
                DedicatedFor : DedicatedFor,
                typedisk: tipodisco,
                capacitydisk: capacitadisco,
                clockcpu: clockcpu,
                numbproc: numeroprocessori,
                capram: ram,
                clockram: clockram,
                transferrate: transferrate,
                backup: backup,
                price: prezzo,
            };
            $.post("scripts/aggiungiDedicato.php", parametri, function(data, status) {
                lanciaNotifica("success","Aggiunta",nome + " è stato aggiunto");
            });
        }
}

function cambia(tipo) {
    if (tipo == "Hosting") {
        $('#h').css({
            "color": "black"
        });
        $('#d').css({
            "text-decoration": "none"
        });
    }
    if (tipo == "Dedicated") {
        $('#d').css({
            "text-decoration": "underline"
        });
        $('#h').css({
            "text-decoration": "none"
        });
    }
}