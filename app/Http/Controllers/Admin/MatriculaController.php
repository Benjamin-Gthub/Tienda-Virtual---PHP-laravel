<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MatriculaController extends Controller
{
    public function index()
    {
        return view('admin.matricula.index');
    }

    public function search(Request $request)
    {
        $texto_busqueda = $request->input('texto_busqueda', '');
        $listado = Matricula::all();
        return view('admin.matricula.search', [
            'listado' => $listado
        ]);
    }

    public function create()
    {
        return view('admin.matricula.create');
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string|max:50',
        ];
        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $data = ["message" => 'Error en los datos, verificar', "errors" => $validator->errors()];
            return response()->json($data, 422);
        }

        try {
            $matricula = new Matricula();
            $matricula->nombre = $request->input('nombre');
            $matricula->save();
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
            $matricula = Matricula::find($id);
            if (is_null($matricula)) {
                return response()->json(["message" => 'Registro no encontrado'], 409);
            }
            return view('admin.matricula.edit', ['registro' => $matricula]);
        } catch (\Exception $error) {
            return response()->json(["message" => "Error en el sistema"], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $reglas = [
            'nombre' => 'required|string|max:50',
        ];
        $validator = Validator::make($request->all(), $reglas);
        if ($validator->fails()) {
            $data = ["message" => 'Error en los datos, verificar', "errors" => $validator->errors()];
            return response()->json($data, 422);
        }

        try {
            $matricula = Matricula::find($id);
            $matricula->nombre = $request->input('nombre');
            $matricula->save();
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
            $matricula = Matricula::find($id);
            if (is_null($matricula)) {
                return response()->json(['message' => 'Registro no existente'], 409);
            }
            $matricula->delete();
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
}
