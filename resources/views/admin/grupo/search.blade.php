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
                    <th>Curso</th>
                    <th>Nombre</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de fin</th>
                    <th style="width: 200px">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td>{{ $item->curso->tipoCurso->nombre }}</td>
                        <td>{{ $item->curso->nombre }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ (isset($item->fecha_inicio)) ? $item->fecha_inicio->format('d/m/Y') : '' }}</td>
                        <td>{{ (isset($item->fecha_fin)) ? $item->fecha_fin->format('d/m/Y') : '' }}</td>
                        <td>
                            <button onclick="modalEditar({{ $item->id }})" class="btn btn-warning">Editar</button>
                            <button onclick="confirmarEliminar({{ $item->id }})" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
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
                targets: 5,
                orderable: false,
                searchable: false
            }]
        });
    });
</script>
