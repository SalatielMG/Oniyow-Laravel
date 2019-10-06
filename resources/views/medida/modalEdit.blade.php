<div class="modal fade" id="modal-medidaEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=" exampleModalLabel">Unidad de Medida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-modal" method="POST" action="{{ route('updateOtro') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="idE" name="idE">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Materia:</label>
                        <input type="text" class="form-control" id="nombreE" name="nombreE" value="" >
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="aceptarE">Aceptar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>