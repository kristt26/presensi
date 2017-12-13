<?php
class Absen{
 
    // database connection and table name
    private $conn;
    private $table_name = "absen";
 
    // object properties
    public $Nip;
    public $TglAbsen;
    public $JamDatang;
    public $JamPulang;
    public $Keterangan;
    public $Email;
    public $Password;
    public $DariTanggal;
    public $SampaiTanggal;
    public $JamAbsen;
    public $JamAbsenPulang;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function getWeeks($date, $rollover)
    {
      
    }

    //read one record
    function readOneMac(){
        $cekMac="SELECT p.Nip, p.Nama, b.MacAddress from pegawai p, perangkat b where p.Nip=b.Nip and p.Email=? and p.Password=? and b.MacAddress=?";
        $stmt=$this->conn->prepare($cekMac);

        $stmt->bindParam(1, $this->Email);
        $stmt->bindParam(2, $this->Password);
        $stmt->bindParam(3, $this->MacAddress);
        $stmt->execute();
        return $stmt;
    }

    //Logout 
    function Log()
    {
        session_start();
        session_unset();
        session_destroy();
        return true;
    }




    function readOne(){
        
           // select all query
           $query = "SELECT * from " . $this->table_name . " where Nip=? and TglAbsen=?";
        
           // prepare query statement
           $stmt = $this->conn->prepare($query);
           $stmt->bindParam(1, $this->Nip);
           $stmt->bindParam(2, $this->TglAbsen);
        
           // execute query
           $stmt->execute();
        
           return $stmt;
    }


    // read products
    function read(){
    
       // select all query
       $query = "SELECT * from " . $this->table_name . " where Nip=? and TglAbsen>? and TglAbsen<?";
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
       $stmt->bindParam(1, $this->Nip);
       $stmt->bindParam(2, $this->DariTanggal);
       $stmt->bindParam(3, $this->SampaiTanggal);
    
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
                   Nip=:Nip, TglAbsen=:TglAbsen, JamDatang=:JamDatang, Keterangan=:Keterangan";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->Nip=htmlspecialchars(strip_tags($this->Nip));
       $this->TglAbsen=htmlspecialchars(strip_tags($this->TglAbsen));
       $this->JamDatang=htmlspecialchars(strip_tags($this->JamDatang));
       $this->JamPulang=htmlspecialchars(strip_tags($this->JamPulang));
       $this->Keterangan=htmlspecialchars(strip_tags($this->Keterangan));
       
       // bind values
       $stmt->bindParam(":Nip", $this->Nip);
       $stmt->bindParam(":TglAbsen", $this->TglAbsen);
       $stmt->bindParam(":JamDatang", $this->JamDatang);
       $stmt->bindParam(":Keterangan", $this->Keterangan);
       
       // execute query
       if($stmt->execute()){
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
                    JamPulang=:JamPulang 
               WHERE
                   Nip = :Nip and TglAbsen=:TglAbsen";
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->Nip=htmlspecialchars(strip_tags($this->Nip));
       $this->JamPulang=htmlspecialchars(strip_tags($this->JamPulang));
       $this->TglAbsen=htmlspecialchars(strip_tags($this->TglAbsen));
    
       // bind new values
       $stmt->bindParam(":Nip", $this->Nip);
       $stmt->bindParam(":JamPulang", $this->JamPulang);
       $stmt->bindParam(":TglAbsen", $this->TglAbsen);
      
    
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
       $query = "DELETE FROM " . $this->table_name . " WHERE Nip = ?";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->Nip=htmlspecialchars(strip_tags($this->Nip));
    
       // bind id of record to delete
       $stmt->bindParam(1, $this->Nip);
    
       // execute query
       if($stmt->execute()){
           return true;
       }
    
       return false;
        
   }
}