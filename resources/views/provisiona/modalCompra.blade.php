<div class="modal fade " id="modal-provisiona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title" id=" exampleModalLabel">Comprar al proveedor</label>
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
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Precio:</label>
                        <input type="number" class="form-control" step="0.1" id="precio" value="1"  />
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad" min="1" value="1" onkeyup="calculaTotalModalProvisiona()" onblur="calculaTotal()" />
                        <span id="msjC"></span>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Total:</label>
                        <input type="text" class="form-control" id="total" disabled="" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardaMateriaDentroProvisiona()">Aceptar</button>
            </div>
        </div>
    </div>
</div>