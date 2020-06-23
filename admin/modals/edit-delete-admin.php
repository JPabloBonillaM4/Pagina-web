<!-- EDIT MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">USUARIO: <span></span></h5>
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
                            <input type="text" class="form-control" id="user" name="user" data-name="usuario" placeholder="Usuario">
                        </div>
                        <!-- correo -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="mail" class="form-control" id="email" name="email" data-name="correo electrónico" placeholder="Correo electrónico">
                        </div>
                        <!-- nombre -->
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" data-name="nombre" placeholder="Escriba nombre completo...">
                        </div>
                        <input type="hidden" name="id" id="id" data-name="id">
                        <input type="hidden" name="action" value="edit" id="action" data-name="action">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                <h5 class="modal-title">DELETE MODAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Eliminar</button>
            </div>
        </div>
    </div>
</div>
