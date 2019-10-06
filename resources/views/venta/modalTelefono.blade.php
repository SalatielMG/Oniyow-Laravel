<div class="modal fade" id="modal-telefono" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=" exampleModalLabel">Nuevo Telefono</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('email.store')}}" >
                    <div class="form-group{{ $errors->has('telefononuevo') ? ' has-error' : '' }}">
                        <label for="recipient-name" class="form-control-plaintext">Telefono:</label>
                        <div class="">
                            <input type="number" class="form-control" id="telefononuevo" name="telefononuevo" placeholder="9711207450" value="{{ old('telefononuevo') }}" required autofocus  required >
                            @if ($errors->has('telefononuevo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefononuevo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="ajaxNuevoTelefono('{{route('datoFiscal.creaNuevoTelefono')}}')">Aceptar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>