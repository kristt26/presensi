<?php
class StatusAbsen{
 
    // database connection and table name
    private $conn;
    private $table_name = "keteranganabsen";
 
    // object properties
    public $Id;
    public $Nip;
    public $Jenis;
    public $TglPengajuan;
    public $TglMulai;
    public $TglSelesai;
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


    function readByDate($tgl, $Nipp){
        
           // select all query
           $query = "SELECT * from " . $this->table_name . "
           WHERE Nip=? and TglMulai<=? and TglSelesai>=?";
        
           // prepare query statement
           $stmt = $this->conn->prepare($query);
        
           $tgl=htmlspecialchars(strip_tags($tgl));
           
           $stmt->bindParam(1, $Nipp);
            $stmt->bindParam(2, $tgl);
            $stmt->bindParam(3, $tgl);
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
                   Nip=:Nip, Jenis=:Jenis, TglPengajuan=:TglPengajuan, TglMulai=:TglMulai, TglSelesai=:TglSelesai, Keterangan=:Keterangan";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->Nip=htmlspecialchars(strip_tags($this->Nip));
       $this->Jenis=htmlspecialchars(strip_tags($this->Jenis));
       $this->TglPengajuan=htmlspecialchars(strip_tags($this->TglPengajuan));
       $this->TglMulai=htmlspecialchars(strip_tags($this->TglMulai));
       $this->TglSelesai=htmlspecialchars(strip_tags($this->TglSelesai));
       $this->Keterangan=htmlspecialchars(strip_tags($this->Keterangan));
      
       // bind values
       $stmt->bindParam(":Nip", $this->Nip);
       $stmt->bindParam(":Jenis", $this->Jenis);
       $stmt->bindParam(":TglPengajuan", $this->TglPengajuan);
       $stmt->bindParam(":TglMulai", $this->TglMulai);
       $stmt->bindParam(":TglSelesai", $this->TglSelesai);
       $stmt->bindParam(":Keterangan", $this->Keterangan);
    
       // execute query
       if($stmt->execute()){
           $this->Id = $this->conn->lastInsertId();
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
                    Jenis=:Jenis, 
                    TglPengajuan=:TglPengajuan,
                    TglMulai=:TglMulai,
                    TglSelesai=:TglSelesai,
                    Keterangan=:Keterangan          
               WHERE
                   Id = :Id";
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->Id=htmlspecialchars(strip_tags($this->Id));
       $this->Jenis=htmlspecialchars(strip_tags($this->Jenis));
       $this->TglPengajuan=htmlspecialchars(strip_tags($this->TglPengajuan));
       $this->TglMulai=htmlspecialchars(strip_tags($this->TglMulai));
       $this->TglSelesai=htmlspecialchars(strip_tags($this->TglSelesai));
       $this->Keterangan=htmlspecialchars(strip_tags($this->Keterangan));
    
       // bind new values
       $stmt->bindParam(":Id", $this->Id);
       $stmt->bindParam(":Jenis", $this->Jenis);
       $stmt->bindParam(":TglPengajuan", $this->TglPengajuan);
       $stmt->bindParam(":TglMulai", $this->TglMulai);
       $stmt->bindParam(":TglSelesai", $this->TglSelesai);
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
       $query = "DELETE FROM " . $this->table_name . " WHERE Id = ?";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->Id=htmlspecialchars(strip_tags($this->Id));
    
       // bind id of record to delete
       $stmt->bindParam(1, $this->Id);
    
       // execute query
       if($stmt->execute()){
           return true;
       }
    
       return false;
        
   }

}