<div class="card">
    <div class="card-header">
        <h3 class="card-title">Resultado de búsqueda</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="tabla-contenido" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cursos</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $listado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($fila->nombre); ?></td>
                        <td>
                            <ul>
                                <?php $__currentLoopData = $fila->cursosHijo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($curso->nombre); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </td>
                        <td>
                            <button onclick="modalEditar(<?php echo e($fila->id); ?>)" class="btn btn-warning">Editar</button>
                            <button onclick="confirmarEliminar(<?php echo e($fila->id); ?>)"
                                class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nombres</th>
                    <th>Cursos</th>
                    <th>Opciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
    $(function() {
        $('#tabla-contenido').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                targets: 1,
                orderable: false,
                searchable: false
            }]
        });
    });
</script>
<?php /**PATH C:\laragon\www\isicursos\resources\views/admin/tipo_curso/search.blade.php ENDPATH**/ ?>