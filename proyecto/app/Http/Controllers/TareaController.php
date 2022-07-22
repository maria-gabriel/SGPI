<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Proyecto;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function crud(Request $request)
    {
        $respuesta = [];
        $err = "Hubo un problema. Consulte un administrador.";
        try {
            if ($request->has('index')) {
                if ($request->index == "load") {
                    $proy = Tarea::where('id_user', Auth::user()->id)->get(['id AS DT_RowId', 'tareas.*']);
                    $respuesta['data'] = $proy;
                    return response()->json($respuesta);
                } elseif ($request->index == "get") {
                    $proy = Tarea::where('id_user', Auth::user()->id)->where('id_proyecto', $request->id_proyecto)->get(['id AS DT_RowId', 'tareas.*']);
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
                    $proy = new Tarea();
                    $proy->nombre = $request->nombre;
                    $proy->descripcion = $request->descripcion;
                    $proy->inicio = $request->inicio;
                    $proy->id_proyecto = $request->id_proyecto;
                    $proy->final = $request->final;
                    $proy->id_user = Auth::user()->id;
                    $proy->estado = "En curso";
                    $proy->save();
                    $nuevo = Tarea::orderBy('created_at', 'desc')->first();
                    $respuesta['data'][0] = $nuevo;
                    return response()->json($respuesta);
                } elseif ($request->index == "remove") {
                    $proy = Tarea::where('id', $request->id)->delete();
                    $data = Tarea::all();
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
                    $proy = Tarea::where('id', $request->id)->get()->last();
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
    //
    public function index()
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $tareas = Tarea::where('id_user', Auth::user()->id)->get();
        return view('tareas.index', compact('bg', 'tareas'));
    }

    public function create(Proyecto $proyecto)
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        return view('tareas.create', compact('bg', 'proyecto'));
    }

    public function save(Request $request)
    {
        $respuesta = [];
        if ($request->has('index')) {
            $tar = Tarea::where('id_user', Auth::user()->id)->where('id_proyecto', $request->id_proyecto)->get(['id AS DT_RowId', 'tareas.*']);
            $respuesta['data'] = $tar;
            return response()->json($respuesta);
        } else {
            $tar = new Tarea();
            $tar->nombre = $request->nombre;
            $tar->descripcion = $request->descripcion;
            $tar->inicio = $request->inicio;
            $tar->final = $request->final;
            $tar->responsable = Auth::user()->id;
            $tar->id_proyecto = $request->id_proyecto;
            $tar->id_area = Auth::user()->area;
            $tar->id_user = Auth::user()->id;
            $tar->estado = "En curso";
            $tar->save();
            $nuevo = Tarea::orderBy('created_at', 'desc')->where('id_user', Auth::user()->id)->where('id_proyecto', $request->id_proyecto)->first();
            $respuesta['data'][0] = $nuevo;
            return response()->json($respuesta);
        }
    }

    public function remove(Request $request)
    {
        $tar = Tarea::where('id', $request->id)->delete();
        $data = Tarea::all();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $respuesta = [];
        $tar = Tarea::where('id', $request->id)->get()->last();
        $tar->id = $request->id;
        $tar->nombre = $request->nombre;
        $tar->descripcion = $request->descripcion;
        $tar->inicio = $request->inicio;
        $tar->final = $request->final;
        $tar->update();
        $respuesta['data'][0] = $tar;
        return response()->json($respuesta);
    }
}
