<?php
class GetMac{

    private $conn;

    public $_HASIL;
    public function __construct($db){
        $this->conn = $db;
    }

    function readMac()
    {
        $_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
        $_PERINTAH = "arp -a $_IP_ADDRESS";
        ob_start();
        system($_PERINTAH);
        $_HASIL = ob_get_contents();
        ob_clean();
        $_PECAH = strstr($_HASIL, $_IP_ADDRESS);
        $_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
        $_HASIL = substr($_PECAH_STRING[1], 0, 17);
        return $_HASIL;
    }    
}
?>