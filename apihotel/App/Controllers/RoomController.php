<?php
namespace App\Controllers;

use App\Models\Room;

class RoomController{
  public function post(){
    return Room::insert($_POST);
  }

  public function get($id = null){
    if ($id) {
      return Room::select($id);
    } else {
      return Room::selectAll();
    }    
  }

  public function put(){
    $_PUT = json_decode(file_get_contents('php://input'), true);
    return Room::update($_PUT);
  }

  public function delete(){
    $_DELETE = json_decode(file_get_contents('php://input'), true);
    return Room::delete($_DELETE);
  }
}
?>