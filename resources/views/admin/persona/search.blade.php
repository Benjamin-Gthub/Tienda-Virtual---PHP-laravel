<div class="card">
    <div class="card-header">
        <h3 class="card-title">Resultado de búsqueda</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="listado" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Provincia</th>
                    <th>Distrito</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>Nombres</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Dirección</th>
                    <th style="width: 200px">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        @if (is_null($item->distrito_id))
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        @else
                        <td>{{ $item->distrito->provincia->departamento->nombre }}</td>
                        <td>{{ $item->distrito->provincia->nombre }}</td>
                        <td>{{ $item->distrito->nombre }}</td>
                        @endif
                        <td>{{ $item->apellido_paterno }}</td>
                        <td>{{ $item->apellido_materno }}</td>
                        <td>{{ $item->nombres }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->celular }}</td>
                        <td>{{ $item->direccion }}</td>
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
                targets: 9,
                orderable: false,
                searchable: false
            }]
        });
    });
</script>
