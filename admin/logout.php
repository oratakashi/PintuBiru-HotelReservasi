<?php 
    echo "Mohon tunggu sebentar!";
    session_start();
    session_destroy();
    header('location: login.html');
?>