<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\TipoCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CursoController extends Controller
{
    public function index()
    {
        return view('admin.curso.index');
    }

    public function search(Request $request)
    {
        $texto_busqueda = $request->input('texto_busqueda', '');
        // $listado = Curso::where('nombre', 'LIKE', '%' . $texto_busqueda . '%')->get();
        $listado = Curso::join('tipo_cursos', 'cursos.tipo_curso_id', '=', 'tipo_cursos.id')
            ->where('cursos.nombre', 'LIKE', '%' . $texto_busqueda . '%')
            ->select('cursos.*', 'tipo_cursos.nombre AS nombre_tipo')
            ->get();
        // $listado = DB::select("select `cursos`.* ,`tipo_cursos`.`nombre` as `nombre_tipo`
        // from `cursos` inner join `tipo_cursos` on `cursos`.`tipo_curso_id` = `tipo_cursos`.`id`
        // where `cursos`.`nombre` LIKE ? and `cursos`.`deleted_at` is null;", ["%" . $texto_busqueda . "%"]);
        // ->toSql();
        // return response($listado, 200);
        return view('admin.curso.search', [
            'listado' => $listado
        ]);
    }

    public function create()
    {
        $tipos = TipoCurso::all();
        return view('admin.curso.create', ['tipos' => $tipos]);
    }

    public function store(Request $request)
    {
        $reglas = [
            'tipo_curso_id' => 'required',
            'nombre' => 'required|string|max:50',
        ];
        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $data = ["message" => 'Error en los datos, verificar', "errors" => $validator->errors()];
            return response()->json($data, 422);
        }

        DB::beginTransaction();
        try {
            $curso = new Curso();
            $curso->nombre = $request->input('nombre');
            $curso->tipo_curso_id = $request->input('tipo_curso_id');
            if (!is_null($request->file('imagen'))) {
                $ruta_imagen = $request->file('imagen')->store('public/cursos');
                $curso->imagen = $ruta_imagen;
            }
            $curso->save();
            DB::commit();
            $data = ["message" => 'Registrado correctamente'];
            return response()->json($data, 201);
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error($error->getMessage());
            $data = ["message" => 'Error del sistema, no se pudo guardar'];
            return response()->json($data, 500);
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $tipos = TipoCurso::all();
        try {
            $curso = Curso::find($id);
            if (is_null($curso)) {
                return response()->json(["message" => 'Registro no encontrado'], 409);
            }
            return view('admin.curso.edit', ['registro' => $curso, 'tipos' => $tipos]);
        } catch (\Exception $error) {
            return response()->json(["message" => "Error en el sistema"], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $reglas = [
            'tipo_curso_id' => 'required',
            'nombre' => 'required|string|max:50',
        ];
        $validator = Validator::make($request->all(), $reglas);
        if ($validator->fails()) {
            $data = ["message" => 'Error en los datos, verificar', "errors" => $validator->errors()];
            return response()->json($data, 422);
        }

        try {
            $curso = Curso::find($id);
            $curso->nombre = $request->input('nombre');
            $curso->save();
            $data = ["message" => 'Actualizado correctamente'];
            return response()->json($data, 200);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            $data = ["message" => 'Error del sistema, no se pudo actualizar'];
            return response()->json($data, 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $curso = Curso::find($id);
            if (is_null($curso)) {
                return response()->json(['message' => 'Registro no existente'], 409);
            }
            $curso->delete();
            $data = ["message" => 'Eliminado correctamente'];
            DB::commit(); // confirmar cambios
            return response()->json($data, 200);
        } catch (\TypeError $error) {
            DB::rollBack();
            Log::error($error->getMessage());
            $data = ["message" => 'Error del sistema, no se pudo eliminar'];
            return response()->json($data, 500);
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error($error->getMessage());
            $data = ["message" => 'Error del sistema, no se pudo eliminar'];
            return response()->json($data, 500);
        }
    }

    public function cargarPorTipo($tipo_curso_id)
    {
        $cursos = Curso::where('tipo_curso_id', $tipo_curso_id)->get();
        return view('admin.curso.portipo', compact('cursos'));
    }
}
