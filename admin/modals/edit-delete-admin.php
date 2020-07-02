<!-- EDIT MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">USUARIO: "<span></span>"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_admin_info" data-modal="edit_modal">
                <div class="modal-body">
                        <!-- usuario -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="user" name="user" data-name="usuario" placeholder="Usuario" data-required="true">
                        </div>
                        <!-- contraseña -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control change_password" id="password" name="password" data-name="contraseña" placeholder="Contraseña">
                            <div class="input-group-append">
                                <button class="btn btn-info show_password" type="button"> <span class="fa fa-eye-slash icon_show_password"></span> </button>
                            </div>
                        </div>
                        <!-- correo -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="mail" class="form-control" id="email" name="email" data-name="correo electrónico" placeholder="Correo electrónico" data-required="true">
                        </div>
                        <!-- nombre -->
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" data-name="nombre" placeholder="Escriba nombre completo..." data-required="true">
                        </div>
                        <input type="hidden" name="id" id="id" data-name="id">
                        <input type="hidden" name="action" value="edit" id="action" data-name="action">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary resetForm" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- DELETE MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="delete_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete_user_admin" data-modal="delete_modal">
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar este usuario?</p>
                    <input type="hidden" name="id" id="id_delete">
                    <input type="hidden" name="action" id="action_delete" value="delete">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
