<?php


namespace App\Http\Implement;

use App\Http\Interfaces\InterfaceEmpleado;
use Illuminate\Support\Facades\DB;

class ImplementAddEmpleado implements InterfaceEmpleado{

    public function setEmpleado(array $emp){
        DB::insert(
            "INSERT INTO empleados (idfr,name,lastname,email,earn) 
            VALUES ('{$emp["idfr"]}','{$emp["name"]}','{$emp["lastname"]}','{$emp["email"]}',{$emp["earn"]});"
        );
        $res = DB::select("SELECT LAST_INSERT_ID() last");
        return $res[0]->last;
    }
    
}