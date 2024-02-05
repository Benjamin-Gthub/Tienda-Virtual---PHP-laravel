<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cursos';

    public function obtenerUrlImagen()
    {
        return str_replace("public", "storage", $this->imagen);
    }

    // relacion de pertenencia de Curso -> TipoCurso

    public function tipoCursoPadre(){
        // select * from tipo_cursos where id = 1
        return $this->belongsTo(TipoCurso::class, 'tipo_curso_id');
    }


}
