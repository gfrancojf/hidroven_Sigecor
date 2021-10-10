<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\docs\seguimientos;
use App\Models\User;

class SegController extends Controller
{
      public function deleteSeg($id)
    {
        $seguimiento = seguimientos::find($id);
        $seguimiento->delete();
        return back();
    }
    public function editSeg(Request $request, $id)
    {
        $seguimiento = seguimientos::find($id);
        $seguimiento->accion = $request->accion;
        $seguimiento->bandeja_de = $request->bandeja_de;
        $seguimiento->instruccion = $request->instruccion;
        $seguimiento->estatus = $request->estatus;
        $seguimiento->save();

        if ($seguimiento->tipo_c == 0) {
            return redirect('/recibidos');
        } else {
            return redirect('/enviadas');
        }
    }
    public function vistaEdit($id)
    {
        $doc = seguimientos::find($id);

        $usuarios = User::latest('id')->get();
        foreach ($usuarios as $user) {
            if($user->id >= 3){
                $users[] = $user;
            }
        }
        
        return view('user/editSeg', compact('doc', 'users'));
    }
}
