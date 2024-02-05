<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCurso extends Model
{
    use HasFactory;
    use SoftDeletes; // permite la eliminacion logica

    protected $table = 'tipo_cursos';

    // representacion de la relacion
    public function cursosHijo(){
        // $fila -> id = 1
        // SELECT * FROM cursos where tipo_curso_id =  1 -> [Objetos Curso, Objeto Curso, Objecto Curso]
        return $this->hasMany(Curso::class, 'tipo_curso_id');
    }
}
