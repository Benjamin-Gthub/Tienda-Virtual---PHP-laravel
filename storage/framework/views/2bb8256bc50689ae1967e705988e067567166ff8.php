<div class="modal-header">
    <h4 class="modal-title">Registrar curso</h4>
</div>
<form id="formulario-crear" action="<?php echo e(route('tipo_curso.store')); ?>" method="POST" autocomplete="off">
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="tipo_curso_id">Tipo de curso</label>
            <div class="col-sm-8">
                <select name="tipo_curso_id" id="tipo_curso_id" class="form-control" >
                    <option value="">[--SELECCIONE--]</option>
                    <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tipo->id); ?>"><?php echo e($tipo->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre">Nombre</label>
            <div class="col-sm-8">
                <input type="text" name="nombre" id="nombre" class="form-control" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="imagen">Imagen</label>
            <div class="col-sm-8">
                <input type="file" name="imagen" id="imagen" class="form-control" />
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
</script>
<?php /**PATH C:\laragon\www\isicursos\resources\views/admin/curso/create.blade.php ENDPATH**/ ?>