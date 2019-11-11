<?php
class VPD{
    private $conn;
    private $table_name = "dataset";

    public $id;
    public $Date;
    public $Tapc;
    public $Eapc;    
    public $user_id;
    public $Taos;
    public $Eaos;
    public $cdate;
    public $limit = null;
    public function __construct($db){
        $this->conn = $db;
    }

    function read($limit = null){

        if($limit != null){
            $query = "select * from " . $this->table_name. " where user_id = 1 limit ". $limit;
        }
        else{
            $query = "select * from " . $this->table_name. " where user_id = 1";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readOne(){
        $query = "select * from ". $this->table_name . " where id = ? limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row["id"];
        $this->Date = $row["Date"];
        $this->Tapc = $row["Tapc"];
        $this->Eapc = $row["Eapc"];
        $this->Taos = $row["Taos"];
        $this->user_id = $row["user_id"];
        $this->cdate = $row["cdate"];

    }
}

?>