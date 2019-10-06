
<div class="modal fade" id="modal-producto-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('producto.store')}}" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="modal-body container">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="" class="col-form-label"><strong>Nombre</strong></label>
                                <input id="nombre" name="nombre" type="text" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label"><strong>Descripcion</strong></label>
                                <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label"><strong>Stock</strong></label>
                                <input id="stock" name="stock" type="number" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label"><strong>Precio</strong></label>
                                <input id="precio" name="precio" type="number" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <label for="" class="col-form-label"><strong></strong></label>
                            <img id="imgSalida" width="100%" height="250 px" src="" style="background-color: #ffc107;border-radius: 10px; border: 1px; border-color: #bc00ff; margin-bottom: 10px;"/>
                            <!--div style="background-color: #ffc107;border-radius: 10px; border: 1px; border-color: #bc00ff; width: 100%; height: 250px">

                            </div-->
                            <br>
                                <!--button class="btn btn-outline-info " type="button">Cambiar</button-->
                            <input type="file" id="imagenP" name="imagenP">
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
