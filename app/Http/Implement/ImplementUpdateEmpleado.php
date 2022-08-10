<?php

namespace App\Http\Implement;
use App\Http\Interfaces\InterfaceEmpleado;
use Illuminate\Support\Facades\DB;


class ImplementUpdateEmpleado implements InterfaceEmpleado{

    

    public function setEmpleado(array $emp){
        return DB::update(
            "UPDATE empleados SET idfr = '{$emp["idfr"]}',name='{$emp["name"]}',lastname='{$emp["lastname"]}',email='{$emp["email"]}',earn={$emp["earn"]} WHERE id = ?",
            [$emp["id"]]
        );
    }

}

