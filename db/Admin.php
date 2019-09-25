<?php
    /**
     * Class Admin berfungsi untuk menghandle Table User
     * Table user digunakan untuk menyimpan pengguna halaman administrator
     * 
     * ada dua level user di aplikasi ini yaitu Administrator dan Costumer
     */
    class Admin
    {
        public function __construct()
        {
            require 'Koneksi.php';
            $this->db = $koneksi;
        }
        public function login($email, $password)
        {   
            $password = sha1($password);
            $sql = "SELECT * from tb_user where email = '$email' and password = '$password'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        public function read()
        {
            $sql = "SELECT * from tb_user";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        public function read_admin_detail($id)
        {
            $sql = "SELECT * from tb_user where id_admin = '$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        public function create($nama, $email, $password)
        {
            $sql = "INSERT into tb_user values('', '$nama', '$email', '$password', 'no-pict.png')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        public function update($id, $nama, $email, $password)
        {
            $sql = "UPDATE tb_user set nama='$nama', email='$email', password='$password' where id_admin='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        public function delete($id)
        {
            $sql = "DELETE from tb_user WHERE id_admin='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
    }
?>