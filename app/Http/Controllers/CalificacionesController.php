<?php

namespace App\Http\Controllers;

use App\Calification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalificacionesController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id_t_materias' => 'required',
            'id_t_usuarios' => 'required',
            'calificacion' => 'required|numeric',
            'fecha_registro'=>'required|date_format:d/m/Y'
        ]);
    }
    public function store(Request $request){
        $this->validator($request->all())->validate();
        $calif = new Calification($request->all());
        if($calif->save()){
            return response()->json(["success"=>"ok","msg"=>"Calificación registrada"]);
        }else{
            return response()->json(["success"=>"fail","msg"=>"Error en el registro"]);
        }

    }
}
