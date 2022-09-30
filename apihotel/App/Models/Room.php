<?php
namespace App\Models;

class Room{
  private static $table = 'quarto';

  public static function insert($data){
    $connPDO = new \PDO(DBDRIVE.':host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);

    $sql = 'INSERT INTO '.self::$table.' VALUES(0,:floor,:number,:hotel_rate,0)';
    $stmt = $connPDO->prepare($sql);
    $stmt->bindValue(":floor",$data['floor']);
    $stmt->bindValue(":number",$data['number']);
    $stmt->bindValue(":hotel_rate",$data['hotel_rate']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return 'Quarto cadastrado com sucesso';
    } else {
      throw new \Exception("Falha ao inserir um registro!");
    }
    
    $connPDO = null;
  }

  public static function selectAll(){
    $connPDO = new \PDO(DBDRIVE.':host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);

    $sql = 'SELECT * FROM '.self::$table.' WHERE alugado = 0';
    $stmt = $connPDO->query($sql);

    if ($stmt->rowCount() > 0) {
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } else {
      throw new \Exception("Nenhum quarto encontrado!");
    }
    
    $connPDO = null;
  }
  public static function select(int $id){
    $connPDO = new \PDO(DBDRIVE.':host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);
    $sql = 'SELECT * FROM '.self::$table.' WHERE idquarto = :id';
    $stmt = $connPDO->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return $stmt->fetch(\PDO::FETCH_ASSOC);
    } else {
      throw new \Exception("Nenhum quarto encontrado!");
    }
    
    $connPDO = null;
  }

  public static function update($data){
    $connPDO = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
    $sql = 'UPDATE ' . self::$table . ' SET andar = :floor,numero = :number, diaria = :hotel_rate WHERE idquarto = :idquarto';
    $stmt = $connPDO->prepare($sql);
    $stmt->bindValue(":floor",$data['floor']);
    $stmt->bindValue(":number",$data['number']);
    $stmt->bindValue(":hotel_rate",$data['hotel_rate']);
    $stmt->bindValue(":idquarto",$data['idquarto']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return "Quarto atualizado com sucesso";
    } else {
      throw new \Exception("Falha ao atualizar um quarto!");
    }
  }

  public static function delete($data){
    $connPDO = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

    $sql = 'DELETE FROM ' . self::$table . ' WHERE idquarto = :idquarto';
    $stmt = $connPDO->prepare($sql);
    $stmt->bindValue(":idquarto", $data['idquarto']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return "Quarto deletado com sucesso";
    } else {
      throw new \Exception("Falha ao deletar um quarto!");
    }
  }
}