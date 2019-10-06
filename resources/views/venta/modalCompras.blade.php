
<div class="modal fade" id="modal-compras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar al carrito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group" id="promocion">
            <h2 for="recipient-name" class="col-form-label" id="tituloPromo" style="font-weight: bold; text-align: center"></h2>
            <span style="text-align: center;" id = "periodo"></span>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Producto:</label>
            <input type="text" class="form-control" id="nombre" value="" disabled="">
          </div>
          <input type="hidden" id="idProducto">

          <div id="descuento">
            <div class="form-group" >
              <div class="form-row">
                <div class="col">
                  <label for="message-text" class="col-form-label">Precio Original  :</label>
                  <input type="number" class="form-control" step="0.1" id="precioOriginal" value="" disabled="" />

                </div>
                <div class="col">
                  <label for="message-text" class="col-form-label"><span class="badge badge-danger">Descuento</span></label>
                  <input type="text" class="form-control"  id="porcentaje" value="" disabled="" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label"><span class="badge badge-primary">Precio Final</span></label>
              <input type="number" class="form-control" step="0.1" id="precioFinal" value="" disabled="" />
            </div>
          </div>

          <div id="normal" class="form-group">
            <label for="message-text" class="col-form-label">Precio:</label>
            <input type="number" class="form-control" step="0.1" id="precio" value="" disabled="" />

          </div>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Cantidad:</label>
            <input type="number" class="form-control" id="cantidad" min="1" value="1" onkeyup="calculaTotal()" onblur="calculaTotal()" />
            <span id="msjC"></span>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Total:</label>
            <input type="text" class="form-control" id="total" disabled="" />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="comprar()">Aceptar</button>
      </div>
    </div>
  </div>
</div>