<div class="modal-header">
    <h4 class="modal-title">Registrar rol</h4>
</div>
<form id="formulario-crear" action="{{ route('tipo_curso.store') }}" method="POST" autocomplete="off">
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre">Nombre</label>
            <div class="col-sm-8">
                <input type="text" name="nombre" id="nombre" class="form-control" />
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
