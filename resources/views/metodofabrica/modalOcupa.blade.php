<div class="modal fade" id="modal-provisiona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title" id=" exampleModalLabel">Cantida</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Materia:</label>
                        <input type="text" class="form-control" id="nombre" value="" disabled="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Unidad de medida:</label>
                        <input type="text" class="form-control" id="medida" value="" disabled="">
                    </div>
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Cantidad a Ocupar de la Materia:</label>
                        <input type="number" class="form-control" id="cantidad" min="1" value="1"  />
                        <span id="msjC"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardaMateriaDentroMetodo()">Aceptar</button>
            </div>
        </div>
    </div>
</div>