<div class="modal-header">
    <h4 class="modal-title">Actualizar grupo de curso</h4>
</div>
<form id="formulario-editar" autocomplete="off">
    @method("PUT")
    @csrf
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="tipo_curso_id">Tipo de curso</label>
            <div class="col-sm-8">
                <select onchange="cargarCursos()" name="tipo_curso_id" id="tipo_curso_id" class="form-control">
                    <option value="">[--SELECCIONE--]</option>
                    @foreach($tipos as $item)
                        <option
                            {{ ($item->id == $tipo->id) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="curso_id">Cursos</label>
            <div class="col-sm-8">
                <select name="curso_id" id="curso_id" class="form-control">
                    <option value="">[--SELECCIONE--]</option>
                    @foreach($cursos as $item)
                        <option
                            {{ ($item->id == $curso->id) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre">Nombre</label>
            <div class="col-sm-8">
                <input type="text" value="{{ $registro->nombre }}" name="nombre" id="nombre" class="form-control"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="fecha_inicio">Fecha de inicio</label>
            <div class="col-sm-8">
                <input type="date" value="{{ (isset($registro->fecha_inicio)) ? $registro->fecha_inicio->format('Y-m-d') : '' }}" name="fecha_inicio"
                       id="fecha_inicio" class="form-control"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="fecha_fin">Fecha de fin</label>
            <div class="col-sm-8">
                <input type="date"
                       value="{{ (isset($registro->fecha_fin)) ? $registro->fecha_fin->format('Y-m-d') : '' }}"
                       name="fecha_fin" id="nombre" class="form-control"/>
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
