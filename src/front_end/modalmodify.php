<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="passconfirm" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirma tu contraseña para modificar el perfil</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pass">Introduce tu contraseña:</label>
                        <input type="password" class="form-control" name="pass1" placeholder="" required>
                    </div>
                    <?php 
                    switch($usertype)
                    {
                        case 1: ?><button id="modificar-perfil" type="submit" name="modificar_perfil_fan" class="btn btn-success btn-block">Confirmar</button><?php ; break;
                        case 2: ?><button id="modificar-perfil" type="submit" name="modificar_perfil_banda" class="btn btn-success btn-block">Confirmar</button><?php ; break;
                        case 3: ?><button id="modificar-perfil" type="submit" name="modificar_perfil_local" class="btn btn-success btn-block">Confirmar</button><?php ; break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>