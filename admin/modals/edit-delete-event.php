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
            <form id="edit_event_info" data-modal="edit_modal">
                <div class="modal-body">
                    <!-- Nombre del evento -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-elementor"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nombre" name="nombre" data-name="nombre" placeholder="Nombre del evento..." data-required="true">
                    </div>
                    <!-- Fecha del evento -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" autocomplete="off" class="form-control datepickerSingle" id="fecha" name="fecha" data-name="fecha" placeholder="Fecha del evento..." data-required="true">
                    </div>
                    <!-- Hora del evento -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                        </div>
                        <input type="text" class="form-control timepicker" id="hora" name="hora" data-name="hora" placeholder="Hora del evento..." data-required="true">
                    </div>
                    <!-- Categoría del evento -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-award"></i></span>
                        </div>
                        <select class="form-control select2" data-placeholder="Seleccione una categoria" name="id_categoria" id="id_categoria" data-name="categoria" data-required="true">
                            <option value=""></option>
                            <?php $categorias = getCategories(); ?>
                            <?php if($categorias->num_rows > 0){ ?>
                                <?php while($dato = $categorias->fetch_assoc()){ ?>
                                    <option value="<?php echo $dato['id_categoria']; ?>"><?php echo $dato['cat_evento'] ?></option>
                                <?php }?>
                            <?php }?>
                        </select>
                    </div>
                    <!-- Categoría del evento -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                        </div>
                        <select class="form-control select2" data-placeholder="Seleccione un invitado" name="id_invitado" id="id_invitado" data-name="invitado" data-required="true">
                            <option value=""></option>
                            <?php $invitados = getInvitates(); ?>
                            <?php if($invitados->num_rows > 0){ ?>
                                <?php while($dato = $invitados->fetch_assoc()){ ?>
                                    <option value="<?php echo $dato['id_invitado']; ?>"><?php echo $dato['nombre']." ".$dato['apellido'] ?></option>
                                <?php }?>
                            <?php }?>
                        </select>
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
                <h5 class="modal-title">Eliminar evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete_event_admin" data-modal="delete_modal">
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar este evento?</p>
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
