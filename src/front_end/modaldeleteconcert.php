<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="modaldeleteconcert" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Eliminar concierto</h3>
        </div>
        <div class="modal-body">
          <h5>Vas a eliminar este concierto. ¿Estás seguro?</h5>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-md-5"><form action="<?php echo $deleter ?>" method="POST"><input type="hidden" id="idconcert-modal" name="idconcert" value=""/><button type="submit" class="btn btn-danger btn-block" name="deleteconcert">SÍ, QUIERO ELIMINARLO</button></form></div>
                <div class="col-md-2"></div>
                <div class="col-md-5"><button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button></div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>