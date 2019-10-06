
@include("venta.modalEmail")
<div class="modal fade" id="modal-correo-nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=" exampleModalLabel">Seleccione el email para enviar la factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('venta.factura')}}" >
                    {{ csrf_field() }}
                        <input type="hidden" id="idVenta", name="idVenta">
                        <input type="hidden" id="accion", name="accion">
                        <div class="form-group{{ $errors->has('emails') ? ' has-error' : '' }}">
                            <label for="recipient-name" class="form-control-plaintext">Correo:</label>
                            <div class="">
                                <select id="emails" name="emails" class="form-control" value="{{ old('emails') }}" required autofocus style="width: 100%;" ></select>
                                @if ($errors->has('emails'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('emails') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>