<?php
class Pegawai{
 
    // database connection and table name
    private $conn;
    private $table_name = "pegawai";
 
    // object properties
    public $Nip;
    public $Nama;
    public $Alamat;
    public $Kontak;
    public $Sex;
    public $IdBidang;
    public $NamaBidang;
    public $Jabatan;
    public $Pangkat;
    public $Email;
    public $Password;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read one product
    function readByBidang()
    {
        $query = "SELECT p.Nip, p.Nama, p.Alamat, p.Kontak, p.Sex, b.IdBidang,b.NamaBidang, p.Jabatan, p.Email from pegawai p, bidang b where p.IdBidang=b.IdBidang and p.IdBidang=?";
        $stmtByBidang = $this->conn->prepare($query);

        $this->IdBidang=htmlspecialchars(strip_tags($this->IdBidang));

        $stmtByBidang->bindParam(1, $this->IdBidang);
        $stmtByBidang->execute();

        return $stmtByBidang;

    }

    // read products
    function read(){
    
       // select all query
       $query = "SELECT p.Nip, p.Nama, p.Alamat, p.Kontak, p.Sex, b.IdBidang,b.NamaBidang, p.Jabatan, p.Pangkat, p.Email from pegawai p, bidang b where p.IdBidang=b.IdBidang";
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // execute query
       $stmt->execute();
    
       return $stmt;
    }


    function readOne(){
        
           // select all query
           $query = "SELECT Nip, Nama, Alamat, Kontak, Sex, Jabatan, IdBidang, Pangkat, Email from pegawai where Nip=?";
        
           // prepare query statement
           $stmt = $this->conn->prepare($query);

           $this->Nip=htmlspecialchars(strip_tags($this->Nip));

           $stmt->bindParam(1, $this->Nip);
        
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
                   Nip=:Nip, Nama=:Nama, Alamat=:Alamat, Kontak=:Kontak, Sex=:Sex, IdBidang=:IdBidang, Jabatan=:Jabatan, Pangkat=:Pangkat, Email=:Email, Password=:Password";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->Nip=htmlspecialchars(strip_tags($this->Nip));
       $this->Nama=htmlspecialchars(strip_tags($this->Nama));
       $this->Alamat=htmlspecialchars(strip_tags($this->Alamat));
       $this->Kontak=htmlspecialchars(strip_tags($this->Kontak));
       $this->Sex=htmlspecialchars(strip_tags($this->Sex));
       $this->IdBidang=htmlspecialchars(strip_tags($this->IdBidang));
       $this->Jabatan=htmlspecialchars(strip_tags($this->Jabatan));
       $this->Pangkat=htmlspecialchars(strip_tags($this->Pangkat));
       $this->Email=htmlspecialchars(strip_tags($this->Email));
       $this->Password=htmlspecialchars(strip_tags($this->Password));
    
       // bind values
       $stmt->bindParam(":Nip", $this->Nip);
       $stmt->bindParam(":Nama", $this->Nama);
       $stmt->bindParam(":Alamat", $this->Alamat);
       $stmt->bindParam(":Kontak", $this->Kontak);
       $stmt->bindParam(":Sex", $this->Sex);
       $stmt->bindParam(":IdBidang", $this->IdBidang);
       $stmt->bindParam(":Jabatan", $this->Jabatan);
       $stmt->bindParam(":Pangkat", $this->Pangkat);
       $stmt->bindParam(":Email", $this->Email);
       $stmt->bindParam(":Password", $this->Password);
    
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
                    Nama=:Nama, 
                    Alamat=:Alamat, 
                    Kontak=:Kontak, 
                    Sex=:Sex, 
                    IdBidang=:IdBidang, 
                    Jabatan=:Jabatan,
                    Pangkat=:Pangkat, 
                    Email=:Email
               WHERE
                   Nip = :Nip";
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->Nip=htmlspecialchars(strip_tags($this->Nip));
       $this->Nama=htmlspecialchars(strip_tags($this->Nama));
       $this->Alamat=htmlspecialchars(strip_tags($this->Alamat));
       $this->Kontak=htmlspecialchars(strip_tags($this->Kontak));
       $this->Sex=htmlspecialchars(strip_tags($this->Sex));
       $this->IdBidang=htmlspecialchars(strip_tags($this->IdBidang));
       $this->Jabatan=htmlspecialchars(strip_tags($this->Jabatan));
       $this->Pangkat=htmlspecialchars(strip_tags($this->Pangkat));
       $this->Email=htmlspecialchars(strip_tags($this->Email));
    
       // bind new values
       $stmt->bindParam(":Nip", $this->Nip);
       $stmt->bindParam(":Nama", $this->Nama);
       $stmt->bindParam(":Alamat", $this->Alamat);
       $stmt->bindParam(":Kontak", $this->Kontak);
       $stmt->bindParam(":Sex", $this->Sex);
       $stmt->bindParam(":IdBidang", $this->IdBidang);
       $stmt->bindParam(":Jabatan", $this->Jabatan);
       $stmt->bindParam(":Pangkat", $this->Pangkat);
       $stmt->bindParam(":Email", $this->Email);
    
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
       }else
       {
            return false;
       }
    
       
        
   }
}