<?php 
    class Customer
    {
        
        public function __construct()
        {
            require 'Koneksi.php';
            $this->db = $koneksi;
        }

        public function read()
        {
            $sql = "SELECT * from tb_costumer";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        
        public function create($nama, $jk, $email, $password)
        {
            $sql = "INSERT into tb_costumer values('', '$nama', '$email', '$password', 'no-pict.png', '$jk', CURRENT_DATE)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function login($email, $password)
        {
            $sql = "SELECT * from tb_costumer where email='$email' and password = '$password'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
    }
    
?>