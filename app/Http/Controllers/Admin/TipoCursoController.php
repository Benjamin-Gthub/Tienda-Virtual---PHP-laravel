<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class TipoCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tipo_curso.index');
    }

    public function search(Request $request)
    {
        $busqueda = $request->input('busqueda', '');
        // diplo -> diplo%, %diplo, %diplo%
        $listado = TipoCurso::where('nombre', 'LIKE', '%' . $busqueda . '%')->get();
        return view('admin.tipo_curso.search', ['listado' => $listado]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipo_curso.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar datos
        $reglas = [
            'nombre' => ['required', 'min:5', 'max:50'],
        ];

        $validacion = Validator::make($request->all(), $reglas);

        if ($validacion->fails()) {
            $data = ['message' => 'Error en la validación de datos', 'errores' => $validacion->errors()];
            return response()->json($data, 422); // Entidad improcesable
        }

        // guardar en la base de datos
        try {
            $tipo_curso = new TipoCurso();
            $tipo_curso->nombre = $request->input('nombre');
            $tipo_curso->save();

            // se registre en una tabla log

            $data = ['message' => 'Tipo de curso registrado correctamente'];
            return response()->json($data, 201); // Created
        } catch (\Exception $error) {
            Log::error(['usuario' => 'usuario_admin']);
            Log::error($error->getMessage());
            $data = ['message' => 'Error al registrar el tipo de curso'];
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registro = TipoCurso::find($id);
        return view('admin.tipo_curso.edit', [
            'registro' => $registro
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|min:5|max:50'
        ]);

        if ($validacion->fails()) {
            $data = ['message' => 'Error en la validación de datos', 'errores' => $validacion->errors()];
            return response()->json($data, 422); // Entidad improcesable
        }

        try {
            $tipo_curso = TipoCurso::find($id);
            $tipo_curso->nombre = $request->input('nombre');
            $tipo_curso->save();

            return response()->json(['message' => 'Tipo de curso actualizado correctamente'], 200);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            $data = ['message' => 'Error al actualizar el tipo de curso'];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tipo_curso = TipoCurso::find($id);
            $tipo_curso->delete();

            return response()->json(['message' => 'Tipo de curso eliminado correctamente'], 200);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            $data = ['message' => 'Error al eliminar el tipo de curso'];
            return response()->json($data, 500);
        }
    }
}
