<?php
namespace App\Controllers;

use App\Models\Rent;

class RentController{
    public function post(){
        return Rent::insert($_POST);
    }

    public function get(int $id = null){
        if($id){
            return Rent::select($id);
        }else{
            return Rent::selectAll();
        }
    }
    public function put(){
        $_PUT = json_decode(file_get_contents('php://input'), true);
        return Rent::payment($_PUT);
    }
}