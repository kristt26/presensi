<?php
class HariLibur{
 
    // database connection and table name
    private $conn;
    private $table_name = "harilibur";
 
    // object properties
    public $IdHari;
    public $TglLibur;
    public $Keterangan;
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
       // select all query
       $query = "SELECT * from " . $this->table_name . "";
    
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
                   TglLibur=:TglLibur, Keterangan=:Keterangan";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->TglLibur=htmlspecialchars(strip_tags($this->TglLibur));
       $this->Keterangan=htmlspecialchars(strip_tags($this->Keterangan));
      
       // bind values
       $stmt->bindParam(":TglLibur", $this->TglLibur);
       $stmt->bindParam(":Keterangan", $this->Keterangan);
    
       // execute query
       if($stmt->execute()){
           $this->IdHari = $this->conn->lastInsertId();
           return true;
       }else{
           return false;
       }
   }


   //Update Bidang
   function update(){
    
       // update query
       $query = "UPDATE
                   " . $this->table_name . "
               SET
                    TglLibur=:TglLibur, 
                    Keterangan=:Keterangan                  
               WHERE
                   IdHari = :IdHari";
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->IdHari=htmlspecialchars(strip_tags($this->IdHari));
       $this->TglLibur=htmlspecialchars(strip_tags($this->TglLibur));
       $this->Keterangan=htmlspecialchars(strip_tags($this->Keterangan));
    
       // bind new values
       $stmt->bindParam(":IdHari", $this->IdHari);
       $stmt->bindParam(":NamaBidang", $this->TglLibur);
       $stmt->bindParam(":Keterangan", $this->Keterangan);
    
       // execute the query
       if($stmt->execute()){
           return true;
       }else{
           return false;
       }
   }

   // delete the Bidang
   function delete(){
    
       // delete query
       $query = "DELETE FROM " . $this->table_name . " WHERE IdBidang = ?";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->IdBidang=htmlspecialchars(strip_tags($this->IdBidang));
    
       // bind id of record to delete
       $stmt->bindParam(1, $this->IdBidang);
    
       // execute query
       if($stmt->execute()){
           return true;
       }
    
       return false;
        
   }

}