<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\TipoCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
{
    public function index()
    {
        return view('admin.grupo.index');
    }

    public function search(Request $request)
    {
        $texto_busqueda = $request->input('texto_busqueda', '');
        $listado = Grupo::where('nombre', 'LIKE', '%' . $texto_busqueda . '%')->get();
        return view('admin.grupo.search', [
            'listado' => $listado
        ]);
    }

    public function create()
    {
        $tipos = TipoCurso::all();
        return view('admin.grupo.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $reglas = [
            'tipo_curso_id' => 'required|',
            'curso_id' => 'required|',
            'nombre' => 'required|string|max:50',
            'fecha_inicio' => 'nullable|date_format:Y-m-d',
            'fecha_fin' => 'nullable|date_format:Y-m-d',
        ];
        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $data = ["message" => 'Error en los datos, verificar', "errors" => $validator->errors()];
            return response()->json($data, 422);
        }

        try {
            $grupo = new Grupo();
            $grupo->curso_id = $request->input('curso_id');
            $grupo->nombre = $request->input('nombre');
            $grupo->fecha_inicio = $request->input('fecha_inicio');
            $grupo->fecha_fin = $request->input('fecha_fin');
            $grupo->save();
            $data = ["message" => 'Registrado correctamente'];
            return response()->json($data, 201);
        } catch (\Exception $error) {
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
        try {
            $grupo = Grupo::find($id);
            if (is_null($grupo)) {
                return response()->json(["message" => 'Registro no encontrado'], 409);
            }
            $tipos = TipoCurso::all();
            $curso = $grupo->curso;
            $tipo = $curso->tipoCurso;
            $cursos = $tipo->cursos;
            return view('admin.grupo.edit', ['registro' => $grupo, 'curso' => $curso, 'tipo' => $tipo, 'cursos' => $cursos, 'tipos' => $tipos]);
        } catch (\Exception $error) {
            return response()->json(["message" => "Error en el sistema"], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $reglas = [
            'tipo_curso_id' => 'required|',
            'curso_id' => 'required|',
            'nombre' => 'required|string|max:50',
            'fecha_inicio' => 'nullable|date_format:Y-m-d',
            'fecha_fin' => 'nullable|date_format:Y-m-d',
        ];
        $validator = Validator::make($request->all(), $reglas);
        if ($validator->fails()) {
            $data = ["message" => 'Error en los datos, verificar', "errors" => $validator->errors()];
            return response()->json($data, 422);
        }

        try {
            $grupo = Grupo::find($id);
            $grupo->curso_id = $request->input('curso_id');
            $grupo->nombre = $request->input('nombre');
            $grupo->fecha_inicio = $request->input('fecha_inicio');
            $grupo->fecha_fin = $request->input('fecha_fin');
            $grupo->save();
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
        try {
            $grupo = Grupo::find($id);
            if (is_null($grupo)) {
                return response()->json(['message' => 'Registro no existente'], 409);
            }
            $grupo->delete();
            $data = ["message" => 'Eliminado correctamente'];
            return response()->json($data, 200);
        } catch (\TypeError $error) {
            Log::error($error->getMessage());
            $data = ["message" => 'Error del sistema, no se pudo eliminar'];
            return response()->json($data, 500);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            $data = ["message" => 'Error del sistema, no se pudo eliminar'];
            return response()->json($data, 500);
        }
    }
}
