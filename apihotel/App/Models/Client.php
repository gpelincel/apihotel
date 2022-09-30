<?php
namespace App\Models;

class Client{
  private static $table = 'cliente';

  public static function insert($data){
    $connPDO = new \PDO(DBDRIVE.':host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);

    $data['cep'] = str_replace('-', '', $data['cep']);
    $sql = 'INSERT INTO '.self::$table.' VALUES(0,:nome,:email,:cep,:estado,:cidade,:bairro,:logradouro,:numero)';
    $stmt = $connPDO->prepare($sql);
    $stmt->bindValue(":nome",$data['name']);
    $stmt->bindValue(":email",$data['email']);
    $stmt->bindValue(":cep",$data['cep']);
    $stmt->bindValue(":estado",$data['uf']);
    $stmt->bindValue(":cidade",$data['cidade']);
    $stmt->bindValue(":bairro",$data['bairro']);
    $stmt->bindValue(":logradouro",$data['logradouro']);
    $stmt->bindValue(":numero",$data['numero']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return 'Registro inserido com sucesso';
    } else {
      throw new \Exception("Falha ao inserir um registro!");
    }
    
    $connPDO = null;
  }

  public static function selectAll(){
    $connPDO = new \PDO(DBDRIVE.':host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);

    $sql = 'SELECT * FROM '.self::$table.' ORDER BY idcliente';
    $stmt = $connPDO->query($sql);

    if ($stmt->rowCount() > 0) {
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } else {
      throw new \Exception("Nenhum cliente encontrado!");
    }
    
    $connPDO = null;
  }
  public static function select(int $id){
    $connPDO = new \PDO(DBDRIVE.':host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);
    $sql = 'SELECT * FROM '.self::$table.' WHERE idcliente = :id';
    $stmt = $connPDO->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return $stmt->fetch(\PDO::FETCH_ASSOC);
    } else {
      throw new \Exception("Nenhum cliente encontrado!");
    }
    
    $connPDO = null;
  }

  public static function update($data){
    $connPDO = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
    $sql = 'UPDATE ' . self::$table . ' SET nome = :nome,email = :email, cep = :cep,estado = :estado,cidade = :cidade,bairro = :bairro,logradouro = :logradouro,numero = :numero WHERE idcliente = :id';
    $stmt = $connPDO->prepare($sql);
    $stmt->bindValue(":nome",$data['name']);
    $stmt->bindValue(":email",$data['email']);
    $stmt->bindValue(":cep",$data['cep']);
    $stmt->bindValue(":estado",$data['uf']);
    $stmt->bindValue(":cidade",$data['cidade']);
    $stmt->bindValue(":bairro",$data['bairro']);
    $stmt->bindValue(":logradouro",$data['logradouro']);
    $stmt->bindValue(":numero",$data['numero']);
    $stmt->bindValue(":id",$data['idcliente']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return "Cliente atualizado com sucesso";
    } else {
      throw new \Exception("Falha ao atualizar um cliente!");
    }
  }

  public static function delete($data){
    $connPDO = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

    $sql = 'DELETE FROM ' . self::$table . ' WHERE idcliente = :id';
    $stmt = $connPDO->prepare($sql);
    $stmt->bindValue(":id", $data['idcliente']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return "Cliente deletado com sucesso";
    } else {
      throw new \Exception("Falha ao deletar um cliente!");
    }
  }
}