<!-- EDIT MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EVENTO: "<span></span>"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_category_info" data-modal="edit_modal">
                <div class="modal-body">
                    <!-- nombre -->
                    <div class="form-group">
                        <label for="cat_evento">Nombre:</label>
                        <input type="text" class="form-control" id="cat_evento" name="cat_evento" data-name="nombre" placeholder="Escriba el nombre de la subcategoria..." data-required="true">
                    </div>
                    <!-- icono -->
                    <div class="form-group">
                        <label for="icono">Icono: <i id="exist"></i></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="input-group-text h-100"><i class="fa fa-address-book"></i></span>
                            </div>
                            <input type="text" class="form-control iconPicker" id="icono" name="icono" autocomplete="off" data-name="icono" placeholder="Seleccione su icono" data-required="true">
                        </div>
                    </div>
                    <input type="hidden" name="id_categoria" id="id_categoria" data-name="id">
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
                <h5 class="modal-title">Eliminar categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete_category_admin" data-modal="delete_modal">
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar esta categoria?</p>
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