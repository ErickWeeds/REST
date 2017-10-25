<?php

namespace App\Http\Controllers;

use App\Calification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DateTime;
class CalificacionesController extends Controller
{
    /**
     * Get a validator for an incoming calification request.
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

    /**
     * Metodo que registra una nueva calificacion
     * @RequestMethod: POST
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        //Ejecutando validaciones sobre los datos enviados
        $this->validator($request->all())->validate();
        //Creando nuevo objeto de Calificacion
        $calif = new Calification($request->all());
        //Parseando la fecha a el formato correcto de MySQL
        $date = DateTime::createFromFormat('d/m/Y', $request->get('fecha_registro'));
        $calif->fecha_registro = $date;
        if($calif->save()){
            //Si el objeto de calificacion se almacena correctamente
            return response()->json(["success"=>"ok","msg"=>"Calificación registrada"]);
        }else{
            //Si el objeto de calificacion no se almacena
            return response()->json(["success"=>"fail","msg"=>"Error en el registro"]);
        }

    }

    /**
     * Metodo para listar las calificaciones de un alumno
     * @RequestMethod GET
     * @param Request $request
     * @param $alumno El id del alumno sobre el que se buscaran las calificaciones
     */
    public function show(Request $request, $alumno){
        //Query de consulta a base de datos
        $calificaciones = DB::table('t_califications')
            ->join('t_alumnos',function($join){
                $join->on('t_alumnos.id_t_usuarios','=','t_califications.id_t_usuarios');
            })
            ->join('t_materias',function($join){
                $join->on('t_materias.id_t_materias','=','t_califications.id_t_usuarios');
            })->select('t_alumnos.nombre','t_alumnos.ap_paterno','t_materias.nombre as materia','t_califications.calificacion','t_califications.fecha_registro')
            ->where('t_califications.id_t_usuarios','=',$alumno)->get();
        //TODO: Cambiar query por Eloquent
        //Obteniendo promedio
        $sumatoria = 0;
        $index = 0;
        foreach($calificaciones as $calificacion){
            $sumatoria += $calificacion->calificacion;
            //parseando fecha a d/m/Y
            $calificaciones[$index]->fecha_registro =  DateTime::createFromFormat('Y-m-d', $calificaciones[$index]->fecha_registro)->format('d/m/Y');
            $index++;
        }
        $promedio = $sumatoria/count($calificaciones);
        $calificaciones[] = ["promedio"=>$promedio];
        return response()->json($calificaciones);
    }
    
}
