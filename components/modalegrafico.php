<?php
    //Lo script non si può contattare dall'esterno
    if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
        exit();
?>
<div id="modale" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div id="graphcontainer"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>