<?php
namespace App\Controllers;

use App\Models\Client;

class ClientController{
  public function post(){
    return Client::insert($_POST);
  }

  public function get($id = null){
    if ($id) {
      return Client::select($id);
    } else {
      return Client::selectAll();
    }    
  }

  public function put(){
    $_PUT = json_decode(file_get_contents('php://input'), true);
    return Client::update($_PUT);
  }

  public function delete(){
    $_DELETE = json_decode(file_get_contents('php://input'), true);
    return Client::delete($_DELETE);
  }
}
?>