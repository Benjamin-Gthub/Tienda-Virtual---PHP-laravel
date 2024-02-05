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
                @foreach ($listado as $item)
                    <tr>
                        <td>{{ $item->nombre_tipo }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td class="text-center">
                            @if (!is_null($item->imagen))
                                <img src="{{ asset($item->obtenerUrlImagen()) }}" width="200" />
                            @else
                                --no imagen--
                            @endif
                        </td>
                        <td>
                            <button onclick="modalEditar({{ $item->id }})" class="btn btn-warning">Editar</button>
                            <button onclick="confirmarEliminar({{ $item->id }})"
                                class="btn btn-danger">Eliminar</button>
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
                targets: 3,
                orderable: false,
                searchable: false
            }]
        });
    });
</script>
