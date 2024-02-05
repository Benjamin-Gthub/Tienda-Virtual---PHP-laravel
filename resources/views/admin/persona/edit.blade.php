<div class="modal-header">
    <h4 class="modal-title">Actualizar persona</h4>
</div>
<form id="formulario-editar" autocomplete="off">
    @method("PUT")
    @csrf
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="apellido_paterno">Apellido paterno</label>
            <div class="col-sm-8">
                <input type="text" value="{{ $registro->apellido_paterno }}" name="apellido_paterno"
                       id="apellido_paterno" class="form-control"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="apellido_materno">Apellido materno</label>
            <div class="col-sm-8">
                <input type="text" value="{{ $registro->apellido_materno }}" name="apellido_materno"
                       id="apellido_materno" class="form-control"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombres">Nombres</label>
            <div class="col-sm-8">
                <input type="text" value="{{ $registro->nombres }}" name="nombres" id="nombres"
                       class="form-control"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="email">Email</label>
            <div class="col-sm-8">
                <input type="email" value="{{ $registro->email }}" name="email" id="email"
                       class="form-control"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="celular">Celular</label>
            <div class="col-sm-8">
                <input type="text" value="{{ $registro->celular }}" name="celular" id="celular"
                       class="form-control"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="direccion">Dirección</label>
            <div class="col-sm-8">
                <input type="text" value="{{ $registro->direccion }}" name="direccion" id="direccion"
                       class="form-control"/>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> Cerrar
        </button>
        <button id="btn-submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
            Actualizar
        </button>
    </div>
</form>
<script>
    document.getElementById('formulario-editar').addEventListener('submit', function (evento) {
        evento.preventDefault();
        actualizar({{ $registro->id }});
    })
</script>
