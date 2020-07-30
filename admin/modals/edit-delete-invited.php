<!-- EDIT MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">INVITADO: "<span></span>"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_invited_info" data-modal="edit_modal">
                <div class="modal-body">
                    <!-- nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" data-name="nombre" placeholder="Escriba el nombre del invitado..." data-required="true">
                    </div>
                    <!-- apellido -->
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" data-name="apellido" placeholder="Escriba el apellido del invitado..." data-required="true">
                    </div>
                    <!-- descripcion -->
                    <div class="form-group">
                        <label for="descripcion">Descripcion:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" data-name="descripcion" placeholder="Escriba el descripcion del invitado..." data-required="true" cols="30" rows="5"></textarea>
                    </div>
                    <!-- imagen -->
                    <div class="form-group">
                        <label for="imagen_actual">Imagen actual</label><br>
                        <img class="img-adjusted" src="" id="imagen_actual" alt="imagen_actual" onerror="this.src='img/invitados/default-user.webp'">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen nueva</label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen">
                    </div>
                    <input type="hidden" name="id_invitado" id="id_invitado" data-name="id">
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
                <h5 class="modal-title">Eliminar invitado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete_invited" data-modal="delete_modal">
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar este invitado?</p>
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
