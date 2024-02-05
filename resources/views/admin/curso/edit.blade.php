<div class="modal-header">
    <h4 class="modal-title">Actualizar curso</h4>
</div>
<form id="formulario-editar" autocomplete="off">
    @method("PUT")
    @csrf
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="tipo_curso_id">Tipo de curso</label>
            <div class="col-sm-8">
                <select name="tipo_curso_id" id="tipo_curso_id" class="form-control" >
                    <option value="">[--SELECCIONE--]</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre">Nombre</label>
            <div class="col-sm-8">
                <input type="text" value="{{ $registro->nombre }}" name="nombre" id="nombre" class="form-control" />
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> Cerrar
        </button>
        <button id="btn-submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
            Actualizar</button>
    </div>
</form>
<script>
    document.getElementById('formulario-editar').addEventListener('submit', function(evento) {
        evento.preventDefault();
        actualizar({{ $registro->id }});
    })
</script>
