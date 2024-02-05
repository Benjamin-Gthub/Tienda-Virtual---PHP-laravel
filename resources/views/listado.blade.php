<table style="border: 1px solid black">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha de creación</th>
        </tr>
    </thead>
    <tbody>
        {{-- $fila ->Objeto de la clase TipoCurso --}}
        @foreach ($lista as $fila)
            <tr>
                <td>{{ $fila->nombre }}</td>
                <td>{{ $fila->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
