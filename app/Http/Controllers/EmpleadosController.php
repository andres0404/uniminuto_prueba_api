<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Implement\ImplementAddEmpleado;
use App\Http\Implement\ImplementUpdateEmpleado;

class EmpleadosController extends Controller
{

    private $_response_content_type = "application/json";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getEmpleados($id = null){
        $sqlWhere = "";
        if(!empty($id)){
            $sqlWhere = " WHERE id = $id";
        }
        return (new Response (json_encode(DB::select ("SELECT * FROM empleados $sqlWhere")),200) )
        ->header("content-type",$this->_response_content_type)
        ->header("Access-Control-Allow-Origin","*")
        ->header("Access-Control-Allow-Credentials","true")
        ->header("Access-Control-Allow-Methods", "OPTIONS, GET, POST,DELETE")
        ->header("Access-Control-Allow-Headers","Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
    }
    /**
     * Agregar/Actualizar empleado
     */
    public function setEmpleado(Request $data){
        $empleado = [
            "id" => $data->input("id"),
            "idfr" => $data->input("idfr"),
            "name" => $data->input("name"),
            "lastname" => $data->input("lastname"),
            "email" => $data->input("email"),
            "earn" => $data->input("earn")
        ];

        if(empty($empleado["id"])){
            $objEmpleado = new ImplementAddEmpleado();
        } else {
            $objEmpleado = new ImplementUpdateEmpleado();
        }
        $id = $objEmpleado->setEmpleado($empleado);
        return response()->json($this->getEmpleados($id))
        ->header("Access-Control-Allow-Origin","*")
        ->header("Access-Control-Allow-Credentials","true")
        ->header("Access-Control-Allow-Methods", "OPTIONS, GET, POST,DELETE")
        ->header("Access-Control-Allow-Headers","Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

    }

    public function deleteEmpleado($id){
        DB::delete("DELETE FROM empleados WHERE id = $id");
        return (new Response("{}",200))->header("content-type",$this->_response_content_type)
        ->header("Access-Control-Allow-Origin","*")
        ->header("Access-Control-Allow-Credentials","true")
        ->header("Access-Control-Allow-Methods", "DELETE, GET, POST")
        ->header("Access-Control-Allow-Headers","Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
    }
    
}
