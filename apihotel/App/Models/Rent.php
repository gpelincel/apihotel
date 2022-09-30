<?php
namespace App\Models;

class Rent{
    private static $reserva = "reserva";
    private static $quarto = "quarto";
    private static $cliente = "cliente";

    public static function insert($data){
        $connPDO = new \PDO(DBDRIVE.':host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);

        $dataDiff = strtotime($data['entrydate']) - strtotime(date('Y-m-d'));

        $entryDepartureDate = (strtotime($data['departuredate']) - strtotime($data['entrydate']))/ (24*60*60);
// Tempo está em segundo

        if($dataDiff >= 0){
            if($entryDepartureDate > 0){
                $selectDiaria = $connPDO->prepare("SELECT * FROM ".self::$quarto." WHERE idquarto = :idroom");
                $selectDiaria->bindValue(":idroom", $data['idroom']);
                $selectDiaria->execute();
                $fetch = $selectDiaria->fetch(\PDO::FETCH_ASSOC);
                $bill = $entryDepartureDate * $fetch['diaria'];

                $stmt = $connPDO->prepare("INSERT INTO ".self::$reserva." VALUES(0, :idroom, :idclient, :entrydate, :departuredate, :bill, 0)");
                $stmt->bindValue(":idroom", $data['idroom']);
                $stmt->bindValue(":idclient", $data['idclient']);
                $stmt->bindValue(":entrydate", $data['entrydate']);
                $stmt->bindValue(":departuredate", $data['departuredate']);
                $stmt->bindValue(":bill", $bill);
                $stmt->execute();

                if($stmt->rowCount() > 0){    
                    $updateQuarto = $connPDO->query("UPDATE ".self::$quarto." SET alugado = 1 WHERE idquarto = ".$data['idroom']);
                    return "Quarto reservado com sucesso!"; 
                }else{
                    throw new \Exception("Erro");
                }
            }else{
                throw new \Exception("Data de saida tem que se maior que 0 dias");
            }
        } else{
            throw new \Exception("Nao pode ser marcada para datas anteriores que hoje");
        }

        

        $connPDO = null;
    }  


    public static function selectAll(){
        $connPDO = new \PDO(DBDRIVE.':host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);
        $sql = "SELECT * FROM ".self::$reserva." INNER JOIN ".self::$quarto." ON ".self::$reserva.".idquarto = ".self::$quarto.".idquarto INNER JOIN ".self::$cliente." ON ".self::$reserva.".idcliente = ".self::$cliente.".idcliente";
        $stmt = $connPDO->query($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            throw new \Exception("Não há nenhum registro.");
        }

        $connPDO = null;
    }

    public static function payment($data){
        $connPDO = new \PDO(DBDRIVE.':host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);
        $sqlUpdate = "UPDATE ".self::$quarto." SET alugado = 0 WHERE idquarto = :idquarto";
        $stmt = $connPDO->prepare($sqlUpdate);
        $stmt->bindValue(':idquarto', $data['idquarto']);
        $stmt->execute();
       

        $sqlUpdate1 = "UPDATE ".self::$reserva." SET pago = 1 WHERE idreserva = :idreserva";
        $stmt1 = $connPDO->prepare($sqlUpdate1);
        $stmt1->bindValue(':idreserva', $data['idreserva']);
        $stmt1->execute();
    

        if($stmt1->rowCount() > 0){
            return "Pagamento feito com sucesso!";
        }else{
            throw new \Exception("Houve um erro, tente mais tarde.");
        }
        $connPDO = null;

    }

}
