<?php
    $server = "localhost";
    $username = "m3116085";
    $password = "0wrjcgvC";
    $database = "m3116085_db_new_monitoring";

    $koneksi = mysqli_connect("$server","$username","$password","$database");
    if($koneksi == TRUE){
        // echo "Terhubung ke Database";
    }
    else{
        echo "Tidak Terhubung";
    }
?>