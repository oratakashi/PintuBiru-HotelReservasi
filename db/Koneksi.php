<?php
    try{
        $koneksi = new PDO('mysql:host=remotemysql.com:3306;dbname=spNhWmF9wq', 'spNhWmF9wq', 'udQIrZdAPp');
    }catch(PDOException $e){
        echo "<p style='color:red'>Koneksi Error..</p>";
    }
?>