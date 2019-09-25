<?php
    try{
        $koneksi = new PDO('mysql:host=localhost;dbname=myHotel', 'root', '');
    }catch(PDOException $e){
        echo "<p style='color:red'>Koneksi Error..</p>";
    }
?>