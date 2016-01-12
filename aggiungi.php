<?php

//Controller di view
require_once dirname(__FILE__) . '/classes/Sessione.php';
//Check se collegato
$loggedin = Sessione::isLoggedIn(true);
if ($loggedin) {
    header("Location: login.php");
    die('');
}
//Variabile per attivare contesto della topbar
$is_aggiungi = true;
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="GRI">
    <meta name="author" content="GRITeam">
    <title>GRI - Get The Right Infrastructure</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Tema material design -->
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/material-fullpalette.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/roboto.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
    <!-- CSS Specifico della view-->
    <link href="css/aggiungi.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php
require_once ("components/topbar.php");
?>
    <div class="container">
        <div class="row text-center">
            <h2> Cosa vuoi aggiungere? </h2>
            <div class="bs-component well">
                <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                    <li class="active" id="h" onclick="cambia('Hosting')"><a href="#hostingtab" data-toggle="tab" aria-expanded="true">Hosting<div class="ripple-wrapper"></div></a></li>
                    <li id="d" onclick="cambia('Dedicato')"><a href="#dedicatotab" data-toggle="tab" aria-expanded="false" >Dedicato<div class="ripple-wrapper"></div></a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="hostingtab">
                         <h3>Hosting</h3>
                      <div class="form-group">
                           Nome
                           <div class="col-lg-12">
                             <input type="text" id="nomeH" class="form-control" />
                          </div>
                      </div>
                      <div class="form-group">
                             Antivirus
                              <div class="col-lg-12">
                             <input type="text" id="antivirusH" class="form-control" />
                             </div>
                      </div>
                      <div class="form-group">
                              Tipo Disco
                      <div class="col-lg-12">
                          <select id="tipodiscoH" class="form-control">
                            <option value="SSD">SSD</option>
                            <option value="HD">HD</option>
                          </select>
                      </div>
                      </div>
                      <div class="form-group">
                                 Capacità Disco(GB)
                                  <div class="col-lg-12">
                                 <input type="number" id="capacitaH" class="form-control" min="10"/>
                                 </div>
                      </div>
                      <div class="form-group">
                               Numero Domini
                               <div class="col-lg-12">
                               <input type="number" id="dominiH" class="form-control" min="1"/>
                                </div>
                      </div>
                      <div class="form-group">
                             Numero Email
                             <div class="col-lg-12">
                              <input type="number" id="emailH" class="form-control" min="1"/>
                               </div>
                      </div>
                      <div class="form-group">
                             Trasfer Rate(Mbit/s)
                             <div class="col-lg-12">
                             <input type="number" id="transferrateH" class="form-control" min="1" />
                              </div>
                      </div>
                      <div class="form-group">
                             Prezzo
                             <div class="col-lg-12">
                             <input type="number" id="prezzoH" class="form-control" />
                             </div>
                      </div>
                      <div class="form-group">
                              Sistema Operativo
                              <div class="col-lg-12">
                                <div class="radio radio-primary"><label><input type="radio" value="Windows" name="soH" id="Windows" />Windows</label></div>
                                <div class="radio radio-primary"><label><input type="radio" value="Linux" name="soH" checked="checked" id="Linux" />Linux</label></div>
                              </div>
                      </div>
                      <div class="form-group">
                           <div class="col-lg-12">
                            <hr>
                          </div>
                        </div>
                      <div class="form-group">
                            Backup
                             <div class="col-lg-12">
                                <div class="radio radio-primary"><label><input type="radio" value="Si" name="backupH" id="SiH" />Si</label></div>
                                <div class="radio radio-primary"><label><input type="radio" value="No" name="backupH" checked="checked" id="NoH" />No</label></div>
                             </div>
                      </div>
                            <input type="button" value="Invia" class="btn btn-primary btn-large" onclick="add('Hosting')" />
                  </div> <!-- fine prima tab -->
                  <div class="tab-pane fade" id="dedicatotab">
                        <h3 class="form-signin-heading">Dedicato</h3>
                        <div class="form-group">
                         Nome
                           <div class="col-lg-12">
                           <input type="text" id="nomeD" class="form-control" />
                           </div>
                        </div>
                        <div class="form-group">
                          Nome CPU
                            <div class="col-lg-12">
                            <input type="text" id="cpuD" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                          Tipo Disco
                            <div class="col-lg-12">
                             <select id="tipodiscoD" class="form-control">
                                <option value="SSD">SSD</option>
                                <option value="HD">HD</option>
                             </select>
                              </div>
                        </div>
                        <div class="form-group">
                         Capacità Disco(GB)
                             <div class="col-lg-12">
                            <input type="number" id="capacitaD" class="form-control" min="1"/>
                              </div>
                         </div>
                         <div class="form-group">
                          Clock CPU(Mhz)
                            <div class="col-lg-12">
                            <input type="number" id="clockcpuD" class="form-control" min="1"/>
                            </div>
                          </div>
                          <div class="form-group">
                         Numero Processori
                            <div class="col-lg-12">
                            <input type="number" id="processoriD" class="form-control" min="1"/>
                            </div>
                         </div>
                         <div class="form-group">
                         Quantità RAM(GB)
                            <div class="col-lg-12">
                            <input type="number" id="ramD" class="form-control" min="1" />
                            </div>
                         </div>
                         <div class="form-group">
                          Clock RAM(Mhz)
                          <div class="col-lg-12">
                            <input type="number" id="clockramD" class="form-control" min="1"/>
                          </div>
                        </div>
                        <div class="form-group">
                        Trasfer Rate(Mbit/s)
                          <div class="col-lg-12">
                           <input type="number" id="transferrateD" class="form-control" min="1"/>
                          </div>
                        </div>
                        <div class="form-group">
                         Prezzo
                          <div class="col-lg-12">
                            <input type="number" id="prezzoD" class="form-control" />
                          </div>
                        </div>
                        <div class="form-group">
                          Tipo CPU
                            <div class="col-lg-12">
                              <div class="radio radio-primary"><label><input type="radio" value="Intel" name="cpuD" id="Intel" />Intel</label></div>
                              <div class="radio radio-primary"><label><input type="radio" value="AMD" name="cpuD" checked="checked" id="AMD" />AMD</label></div>
                          </div>
                        </div>
                         <div class="form-group">
                           <div class="col-lg-12">
                            <hr>
                          </div>
                        </div>
                        <div class="form-group">
                        Backup
                          <div class="col-lg-12">
                            <div class="radio radio-primary"><label><input type="radio" value="Si" name="backupD" id="SiD" />Si</label></div>
                            <div class="radio radio-primary"><label><input type="radio" value="No" name="backupD" checked="checked" id="NoD" />No</label></div>
                          </div>
                        </div>
                        <div class="form-group">
                            Consigliato Per
                            <div class="col-lg-12">
                                <select id="DedicatedFor" class="form-control">
                                    <option value="hosting" selected="selected">Hosting</option>
                                    <option value="processing">Processing</option>
                                    <option value="storage">Storage</option>
                                </select>
                            </div>
                        </div>
                       <input type="button" value="Invia" class="btn btn-primary btn-large" onclick="add('Dedicated')" />
                  </div> <!-- fine seconda tab -->
                </div> <!-- fine tab wrapper -->
            </div> <!-- fine bs component -->
          </div> <!-- end row -->
    </div> <!-- /.container -->
<?php
require_once ("components/javascript-comune.php");
//Inclusione Javascript Comune
?>
    <!-- Script specifici di view -->
    <script src="js/aggiungi.js"></script>
  </body>
</html>