<?php
class Perangkat{
 
    // database connection and table name
    private $conn;
    private $table_name = "perangkat";
 
    // object properties
    public $IdPerangkat;
    public $Nip;
    public $Nama;
    public $MacAddress;
   
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function readone(){
        $cekMac="SELECT perangkat where MacAddress=?";
        $stmt=$this->conn->prepare($cekMac);

        $stmt->bindParam(1, $this->MacAddress);
        $stmt->execute();
        return $stmt;
    }

    // read products
    function read(){
    
       // select all query
       $query = "SELECT p.IdPerangkat, p.Nip, pg.Nama, p.MacAddress from perangkat p, pegawai pg where p.Nip=pg.Nip";
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // execute query
       $stmt->execute();
    
       return $stmt;
    }

   // create product
    function create(){

        
    
       // query to insert record
       $query = "INSERT INTO
                   " . $this->table_name . "
               SET
                   Nip=:Nip, MacAddress=:MacAddress";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->Nip=htmlspecialchars(strip_tags($this->Nip));
       $this->MacAddress=htmlspecialchars(strip_tags($this->MacAddress));
    
       // bind values
       $stmt->bindParam(":Nip", $this->Nip);
       $stmt->bindParam(":MacAddress", $this->MacAddress);
    
       // execute query
       if($stmt->execute()){
           $this->IdPerangkat = $this->conn->lastInsertId();
           return true;
       }else{
           return false;
       }
   }

   // update the product
    function update(){
    
       // update query
       $query = "UPDATE
                   " . $this->table_name . "
               SET
                    Nip=:Nip, MacAddress=:MacAddress
               WHERE
                   IdPerangkat = :IdPerangkat";
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->IdPerangkat=htmlspecialchars(strip_tags($this->IdPerangkat));
       $this->Nip=htmlspecialchars(strip_tags($this->Nip));
       $this->MacAddress=htmlspecialchars(strip_tags($this->MacAddress));
    
       // bind new values
       $stmt->bindParam(":IdPerangkat", $this->IdPerangkat);
       $stmt->bindParam(":Nip", $this->Nip);
       $stmt->bindParam(":MacAddress", $this->MacAddress);
       
       // execute the query
       if($stmt->execute()){
           return true;
       }else{
           return false;
       }
   }

   // delete the product
    function delete(){
    
       // delete query
       $query = "DELETE FROM " . $this->table_name . " WHERE IdPerangkat = ?";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->IdPerangkat=htmlspecialchars(strip_tags($this->IdPerangkat));
    
       // bind id of record to delete
       $stmt->bindParam(1, $this->IdPerangkat);
    
       // execute query
       if($stmt->execute()){
           return true;
       }
    
       return false;
        
   }
}