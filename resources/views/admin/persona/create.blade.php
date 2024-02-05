<div class="modal-header">
    <h4 class="modal-title">Registrar persona</h4>
</div>
<form id="formulario-crear" action="{{ route('tipo_curso.store') }}" method="POST" autocomplete="off">
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="apellido_paterno">Apellido paterno</label>
            <div class="col-sm-8">
                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="apellido_materno">Apellido materno</label>
            <div class="col-sm-8">
                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombres">Nombres</label>
            <div class="col-sm-8">
                <input type="text" name="nombres" id="nombres" class="form-control" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="email">Email</label>
            <div class="col-sm-8">
                <input type="email" name="email" id="email" class="form-control" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="celular">Celular</label>
            <div class="col-sm-8">
                <input type="text" name="celular" id="celular" class="form-control" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="direccion">Dirección</label>
            <div class="col-sm-8">
                <input type="text" name="direccion" id="direccion" class="form-control" />
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> Cerrar
        </button>
        <button id="btn-submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
            Registrar</button>
    </div>
</form>
<script>
    document.getElementById('formulario-crear').addEventListener('submit', function(evento) {
        evento.preventDefault();
        guardar();
    })
    // $(function() {
    //     $.validator.setDefaults({
    //         submitHandler: function() {
    //             guardar();
    //         }
    //     });
    //     $("#formulario-crear").validate({
    //         rules: {
    //             nombre: {
    //                 required: true,
    //                 maxlength:50
    //             }
    //         },
    //         errorElement: 'span',
    //         errorPlacement: function(error, element) {
    //             error.addClass('invalid-feedback');
    //             element.parent().append(error);
    //         },
    //         highlight: function(element, errorClass, validClass) {
    //             $(element).addClass('is-invalid');
    //         },
    //         unhighlight: function(element, errorClass, validClass) {
    //             $(element).removeClass('is-invalid');
    //         }
    //     })
    // });
</script>
