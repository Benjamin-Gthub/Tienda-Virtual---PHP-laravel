<option value="">[--SELECCIONE--]</option>
@foreach($cursos as $curso)
    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
@endforeach
