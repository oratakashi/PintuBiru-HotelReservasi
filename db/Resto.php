<?php 
    class Resto
    {
        public function __construct()
        {
            require 'Koneksi.php';
            $this->db = $koneksi;
        }

        public function read()
        {
            $sql = "SELECT * from tb_foods";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        
        public function read_detail($id)
        {
            $sql = "SELECT * from tb_foods where id_food='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function update($id, $nama, $harga, $kategori, $deskripsi)
        {
            $sql = "UPDATE tb_foods set nama_food='$nama', harga='$harga', kategori='$kategori',
                    deskripsi = '$deskripsi' where id_food='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        
        public function create($nama, $harga, $kategori, $deskripsi, $photo)
        {
            $sql = "INSERT into tb_foods values('', '$nama', '$harga', '$kategori', '$deskripsi', '$photo')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function delete($id)
        {
            $sql = "DELETE from tb_foods where id_food='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
    }
    
?>