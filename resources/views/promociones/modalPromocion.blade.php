<div class="modal fade" id="modal-promocion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar promocion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('promocion.store')}}" onsubmit="return rellenaProductos()">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input id="productos" name="productos" type="hidden">



                    <div class="form-row">
                        <div class="col-5">

                            <div class="form-group">
                                <label for="message-text" class="col-form-label"><strong>Nombre:</strong></label>
                                <input type="text" class="form-control" id="nombre" name="nombre"   required/>
                            </div>
                            <div class="form-group">
                                <div class="form-row ">
                                    <label for="recipient-name" class="col-form-label" ><strong>Periodo:</strong></label>
                                </div>

                                <div class="form-row">
                                    <div class="col-6">
                                        <input class="form-control-static" id="datepicker" name="datepicker"  required />
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control-static" id="datepicker2" name="datepicker2"  required/>
                                    </div>
                                    <span id="fecha"></span>

                                </div>
                            </div>

                        </div>
                        <div class="col-7">
                            <div class="form-group">

                                <div class="form-row">
                                    <div class="col-8">

                                        <div class="form-row form-group">
                                            <label for="message-text" class="col-form-label"><strong>Productos:</strong></label>
                                            <select class="form-control" name="selectProductos" id="selectProductos" style="width: 100%;" required onchange="rellenarPrecio()"></select>
                                        </div>
                                        <div class="form-row form-group">
                                            <div class="col-6">
                                                <label for="message-text" class="col-form-label">Precio Original:</label>
                                                <input type="number" class="form-control" id="precioO" name="precioO"   disabled />
                                            </div>
                                            <div class="col-6">
                                                <label for="message-text" class="col-form-label"><strong>Descuento:</strong></label>
                                                <input type="number" class="form-control" id="porcentaje" name="porcentaje"  min="0" value="0" max="100" required onkeyup="calcularPromocionProducto()"/>
                                            </div>
                                        </div>
                                        <div class="form-row form-group">
                                            <div class="col-6">
                                                <label for="message-text" class="col-form-label">Stock:</label>
                                                <input type="number" class="form-control" id="stock" name="stock"   disabled/>
                                            </div>
                                            <div class="col-6">
                                                <label for="message-text" class="col-form-label">Precio Final:</label>
                                                <input type="text" class="form-control" id="precioF" name="precioF"   disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="message-text" class="col-form-label"><strong></strong></label>
                                        <img id="imgSalidaPromo" width="100%" height="155 px" src="" style="background-color: #ffc107;border-radius: 10px; border: 1px; border-color: #bc00ff; margin-bottom: 10px;"/>

                                        <!--div style="width: 100%; height: 155px; background-color: #ffc107; border-radius: 10px;">

                                        </div-->
                                        <br>
                                        <button class="btn btn-outline-success rounded-circle" type="button" onclick="agregarFila()" style="margin-left: 50px; width:50px; height: 50px;">-></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <table class="table table-dark" >
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Precio Original</th>
                                <th>Descuento</th>
                                <th>Precio Final</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tabla">

                            </tbody>
                        </table>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" >Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>
