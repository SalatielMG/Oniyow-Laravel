<div class="modal fade" id="modal-correo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=" exampleModalLabel">Nuevo email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('email.store')}}" >
                    <div class="form-group{{ $errors->has('emailnuevo') ? ' has-error' : '' }}">
                        <label for="recipient-name" class="form-control-plaintext">Correo:</label>
                        <div class="">
                            <input type="email" class="form-control" id="emailnuevo" name="emailnuevo" placeholder="algo@algo.algo" value="{{ old('emailnuevo') }}" required autofocus  required >
                              @if ($errors->has('emailnuevo'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('emailnuevo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="ajaxNuevoEmail('{{route('datoFiscal.creaNuevoCorreo')}}')">Aceptar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>