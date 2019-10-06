
<div class="modal fade" id="modal-producto-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('producto.update', 0)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {!! method_field("PUT") !!}
                <div class="modal-body container">
                    <div class="row">
                        <input type="hidden" id="idP" name="idP"/>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="" class="col-form-label"><strong>Nombre</strong></label>
                                <input id="nombreE" name="nombreE" type="text" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label"><strong>Descripcion</strong></label>
                                <textarea id="descripcionE" name="descripcionE" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label"><strong>Stock</strong></label>
                                <input id="stockE" name="stockE" type="number" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label"><strong>Precio</strong></label>
                                <input id="precioE" name="precioE" type="number" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <label for="" class="col-form-label"><strong></strong></label>
                            <img id="imgSalidaE" width="100%" height="250 px" src="" style="background-color: #ffc107;border-radius: 10px; border: 1px; border-color: #bc00ff; margin-bottom: 10px;"/>
                            <!--div style="background-color: #ffc107;border-radius: 10px; border: 1px; border-color: #bc00ff; width: 100%; height: 250px">

                            </div-->
                            <br>
                            <!--button class="btn btn-outline-info " type="button">Cambiar</button-->
                            <input type="file" id="imagenPE" name="imagenPE">
                        </div>
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
