<div class="card">
    <div class="card-header">
        <h3 class="card-title">Resultado de búsqueda</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="listado" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Tipo de curso</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th style="width: 200px">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $listado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->nombre_tipo); ?></td>
                        <td><?php echo e($item->nombre); ?></td>
                        <td class="text-center">

                                --no imagen--
                        </td>
                        <td>
                            <button onclick="modalEditar(<?php echo e($item->id); ?>)" class="btn btn-warning">Editar</button>
                            <button onclick="confirmarEliminar(<?php echo e($item->id); ?>)"
                                class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<script>
    $(function() {
        $('#listado').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                targets: 3,
                orderable: false,
                searchable: false
            }]
        });
    });
</script>
<?php /**PATH C:\laragon\www\isicursos\resources\views/admin/curso/search.blade.php ENDPATH**/ ?>