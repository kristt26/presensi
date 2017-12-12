<?php
$host   = "localhost";
$user   = "root";
$Pass   = "";
$db     = "presensi";
$Connection = mysql_connect($host, $user, $Pass);
if($Connection)
{
    $Opendb = mysql_select_db($db);
    if(!$Opendb)
    {
        echo"<script>alert('Database Tidak ditemuan')</script>";
    }
}else
echo"<script>alert('Connection Database Error')</script>";
?>