<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Proyecto;
use App\Models\Tarea;

class ProyectoController extends Controller
{

    public function crud(Request $request)
    {
        $respuesta = [];
        $err = "Hubo un problema. Consulte un administrador.";
        try {
            if ($request->has('index')) {
                if ($request->index == "load") {
                    $proy = Proyecto::where('id_user', Auth::user()->id)->get(['id AS DT_RowId', 'proyectos.*']);
                    $respuesta['data'] = $proy;
                    return response()->json($respuesta);
                } elseif ($request->index == "save") {
                    if ($request->nombre == '') {
                        $err = "Ingrese el nombre.";
                    } elseif ($request->descripcion == '') {
                        $err = "Ingrese la descripción.";
                    } elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->inicio) != 1) {
                        $err = "Fecha inicio inválida.";
                    } elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->final) != 1) {
                        $err = "Fecha final inválida.";
                    }
                    $proy = new Proyecto();
                    $proy->nombre = $request->nombre;
                    $proy->descripcion = $request->descripcion;
                    $proy->inicio = $request->inicio;
                    $proy->final = $request->final;
                    $proy->id_user = Auth::user()->id;
                    $proy->estado = "En curso";
                    $proy->save();
                    $nuevo = Proyecto::orderBy('created_at', 'desc')->first();
                    $respuesta['data'][0] = $nuevo;
                    return response()->json($respuesta);
                } elseif ($request->index == "remove") {
                    $proy = Proyecto::where('id', $request->id)->delete();
                    $data = Proyecto::all();
                    return response()->json($data);
                } elseif ($request->index == "update") {
                    if ($request->nombre == '') {
                        $err = "Ingrese el nombre.";
                    } elseif ($request->descripcion == '') {
                        $err = "Ingrese la descripción.";
                    } elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->inicio) != 1) {
                        $err = "Fecha inicio inválida.";
                    } elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->final) != 1) {
                        $err = "Fecha final inválida.";
                    }
                    $proy = Proyecto::where('id', $request->id)->get()->last();
                    $proy->id = $request->id;
                    $proy->nombre = $request->nombre;
                    $proy->descripcion = $request->descripcion;
                    $proy->inicio = $request->inicio;
                    $proy->final = $request->final;
                    if ($proy->estado != '') {
                        $proy->estado = $request->estado;
                    }
                    $proy->update();
                    $respuesta['data'][0] = $proy;
                    return response()->json($respuesta);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $err, 'code' => $e], 404);
        }
    }

    public function graphic(Proyecto $proyecto){
        $bg = Custom::where('id_user', 3)->get()->last();
        $tareas = Tarea::where('id_proyecto', $proyecto->id);
        return view('proyectos.graphic',compact('bg','proyecto','tareas'));     
     }
}
