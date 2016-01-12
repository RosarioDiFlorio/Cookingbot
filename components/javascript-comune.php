<?php
    //Lo script non si può contattare dall'esterno
    if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
        exit();
?>
<script type="text/javascript">
    var is_admin = false;
    var is_logged = false;
    <?php
    if(isset($loggedin) && ($loggedin === true))
        echo "is_logged = true;";
    if(Sessione::isAdmin())
        echo "is_admin = true;";
    ?>
</script>
<!-- Librerie necessarie -->
<script src="js/lib/jquery-1.11.3.min.js"></script>
<script src="js/lib/bootstrap.min.js"></script>
<script src="js/lib/material.min.js"></script>
<script src="js/lib/ripples.min.js"></script>
<script src="js/lib/star-rating.min.js"></script>
<script src="js/lib/jquery.toaster.js"></script>
<!-- Codice client comune a tutte -->
<script src="js/common.js"></script>
<!-- Mostra commenti -->
<div class="modal fade" id="modalecommenti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="titolocommenti">Feedback</h4>
            </div>
            <div class="modal-body" id="corpocommenti" ></div>
            <div class="modal-footer" id="footercommenti"></div>
        </div>  <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
</div>
<!-- Voto -->
<div class="modal fade" id="modalevoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titolovota">Dai una valutazione</h4>
      </div>
      <div class="modal-body">
		<input type="hidden" id="NomeIstanzaText" />
        <form>
          <div class="form-group">
            <label for="votodato" class="control-label">Valutazione:</label>
            <input id="votodato" type="number" class="rating" min=1 max=5 step=0.5 data-size="xs">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Testo personalizzato:</label>
            <textarea class="form-control" placeholder="Immetti il tuo commento" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="vota()">Invia</button>
      </div>
    </div>
  </div>
</div>