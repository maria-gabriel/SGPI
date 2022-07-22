<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom;
use Illuminate\Support\Facades\Auth;
use App\Models\Tarea;
use App\Models\Subtarea;

class SubtareaController extends Controller
{
    public function crud(Request $request)
    {
        $respuesta = [];
        $err = "Hubo un problema. Consulte un administrador.";
        try {
            if ($request->has('index')) {
                if ($request->index == "load") {
                    $proy = Subtarea::where('id_user', Auth::user()->id)->get(['id AS DT_RowId', 'subtareas.*']);
                    $respuesta['data'] = $proy;
                    return response()->json($respuesta);
                } elseif ($request->index == "get") {
                    $proy = Subtarea::where('id_user', Auth::user()->id)->where('id_tarea', $request->id_tarea)->get(['id AS DT_RowId', 'subtareas.*']);
                    $respuesta['data'] = $proy;
                    return response()->json($respuesta);
                }elseif ($request->index == "save") {
                    if ($request->nombre == '') {
                        $err = "Ingrese el nombre.";
                    } elseif ($request->descripcion == '') {
                        $err = "Ingrese la descripción.";
                    } elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->inicio) != 1) {
                        $err = "Fecha inicio inválida.";
                    } elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->final) != 1) {
                        $err = "Fecha final inválida.";
                    }
                    $proy = new Subtarea();
                    $proy->nombre = $request->nombre;
                    $proy->descripcion = $request->descripcion;
                    $proy->inicio = $request->inicio;
                    $proy->id_tarea = $request->id_tarea;
                    $proy->final = $request->final;
                    $proy->id_user = Auth::user()->id;
                    $proy->estado = "En curso";
                    $proy->save();
                    $nuevo = Subtarea::orderBy('created_at', 'desc')->first();
                    $respuesta['data'][0] = $nuevo;
                    return response()->json($respuesta);
                } elseif ($request->index == "remove") {
                    $proy = Subtarea::where('id', $request->id)->delete();
                    $data = Subtarea::all();
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
                    $proy = Subtarea::where('id', $request->id)->get()->last();
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
    public function index(){
       $bg = Custom::where('id_user', 3)->get()->last();
       $subtareas = Subtarea::where('id_user', Auth::user()->id)->get();
       return view('subtareas.index',compact('bg','subtareas'));     
    }

    public function create(Tarea $tarea){
       $bg = Custom::where('id_user', 3)->get()->last();
       return view('subtareas.create',compact('bg','tarea'));     
    }

    public function save(Request $request){
      $respuesta = [];
      if($request->has('index')){
        $tar = Subtarea::where('id_user', Auth::user()->id)->where('id_tarea', $request->id_tarea)->get(['id AS DT_RowId', 'subtareas.*']);
          $respuesta['data'] = $tar;
          return response()->json($respuesta);
      }else{
          $tar = new Subtarea();
          $tar->nombre = $request->nombre;
          $tar->descripcion = $request->descripcion;
          $tar->inicio = $request->inicio;
          $tar->final = $request->final;
          $tar->responsable = Auth::user()->id;
          $tar->id_tarea = $request->id_tarea;
          $tar->id_user = Auth::user()->id;
          $tar->estado = "En curso";
          $tar->save();
          $nuevo = Subtarea::orderBy('created_at', 'desc')->where('id_user', Auth::user()->id)->where('id_tarea', $request->id_tarea)->first();
          $respuesta['data'][0] = $nuevo;
          return response()->json($respuesta);
         }
      
     }

     public function remove(Request $request){
         $tar=Subtarea::where('id',$request->id)->delete();
         $data = Subtarea::all();
         return response()->json($data);
     }

     public function update(Request $request){
         $respuesta = [];
         $tar = Subtarea::where('id', $request->id)->get()->last();
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
