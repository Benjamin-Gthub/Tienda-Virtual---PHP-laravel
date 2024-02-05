<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PersonaController extends Controller
{
    public function index()
    {
        return view('admin.persona.index');
    }

    public function search(Request $request)
    {
        $texto_busqueda = $request->input('texto_busqueda', '');
        $listado = Persona::where('apellido_paterno', 'LIKE', '%' . $texto_busqueda . '%')
            ->orWhere('apellido_materno', 'LIKE', '%' . $texto_busqueda . '%')
            ->orWhere('nombres', 'LIKE', '%' . $texto_busqueda . '%')
            ->get();
        return view('admin.persona.search', [
            'listado' => $listado
        ]);
    }

    public function create()
    {
        return view('admin.persona.create');
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombres' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'celular' => 'required|string|max:20',
            'direccion' => 'required|string|max:70',
        ];
        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $data = ["message" => 'Error en los datos, verificar', "errors" => $validator->errors()];
            return response()->json($data, 422);
        }

        try {
            $persona = new Persona();
            $persona->apellido_materno = $request->input('apellido_materno');
            $persona->apellido_paterno = $request->input('apellido_paterno');
            $persona->nombres = $request->input('nombres');
            $persona->email = $request->input('email');
            $persona->celular = $request->input('celular');
            $persona->direccion = $request->input('direccion');
            $persona->save();
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
            $persona = Persona::find($id);
            if (is_null($persona)) {
                return response()->json(["message" => 'Registro no encontrado'], 409);
            }
            return view('admin.persona.edit', ['registro' => $persona]);
        } catch (\Exception $error) {
            return response()->json(["message" => "Error en el sistema"], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $reglas = [
            'nombres' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'celular' => 'required|string|max:20',
            'direccion' => 'required|string|max:70',
        ];
        $validator = Validator::make($request->all(), $reglas);
        if ($validator->fails()) {
            $data = ["message" => 'Error en los datos, verificar', "errors" => $validator->errors()];
            return response()->json($data, 422);
        }

        try {
            $persona = Persona::find($id);
            $persona->apellido_materno = $request->input('apellido_materno');
            $persona->apellido_paterno = $request->input('apellido_paterno');
            $persona->nombres = $request->input('nombres');
            $persona->email = $request->input('email');
            $persona->celular = $request->input('celular');
            $persona->direccion = $request->input('direccion');
            $persona->save();
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
            $persona = Persona::find($id);
            if (is_null($persona)) {
                return response()->json(['message' => 'Registro no existente'], 409);
            }
            $persona->delete();
            $data = ["message" => 'Eliminado correctamente'];
            DB::commit();
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

    public function reportePdf(Request $request)
    {
        try {
            $texto_busqueda = $request->input('texto_busqueda', '');
            $listado = Persona::where('apellido_paterno', 'LIKE', '%' . $texto_busqueda . '%')
                ->orWhere('apellido_materno', 'LIKE', '%' . $texto_busqueda . '%')
                ->orWhere('nombres', 'LIKE', '%' . $texto_busqueda . '%')
                ->get();
            require resource_path('exports/persona/listadoPdf.php');
            return response()->json(['url' => asset('storage/exports/persona/listado.pdf')]);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Error al generar el PDF'], 500);
        }
    }
}
