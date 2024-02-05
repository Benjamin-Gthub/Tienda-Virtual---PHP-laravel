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
                @foreach ($listado as $fila)
                    <tr>
                        <td>{{ $fila->nombre }}</td>
                        <td>
                            <ul>
                                @foreach ($fila->cursosHijo as $curso)
                                    <li>{{ $curso->nombre }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <button onclick="modalEditar({{ $fila->id }})" class="btn btn-warning">Editar</button>
                            <button onclick="confirmarEliminar({{ $fila->id }})"
                                class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
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
