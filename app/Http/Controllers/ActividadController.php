<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codigo)
    {
        //Metodo estatico porque no hay que crear instancia de un objeto
        $actividades = Actividad::where('codigoEstudiante', $id) -> get();
        $data = json_encode([
            "data" => $actividades //json_encode sirve para convertir data en un objeto
        ]);
        return response($data, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Actividad = new Actividad();
        $Actividad->id = $request->input('id');
        $Actividad->descripcion = $request->input('descripcion');
        $Actividad->nota = $request->input('nota');
        $Actividad->codigoEstudiante = $request->input('codigoEstudiante');
        $Actividad->save();
        return response(json_encode([
            "data"=>"Actividad registrado"
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Actividad = Actividad::find($id);
        return response(json_encode([
            "data"=> $Actividad
        ]));
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
        $Actividad = Actividad::find($id);
        // $Actividad->id = $request->input('id');
        $Actividad->descripcion = $request->input('descripcion');
        $Actividad->nota = $request->input('nota');
        $Actividad->save();
        return response(json_encode([
            "data"=> "Registro actualizado"
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Actividad = Actividad::find($id);
        if(empty($Actividad)){
            return response(json_encode([
                "data"=> "el Actividad $Actividad no existe"
            ]), 404);
        }
        $Actividad->delete();
        return response(json_encode([
            "data"=> "Registro eliminado"
        ]));
    }
}
