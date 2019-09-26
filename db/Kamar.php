<?php 
    class Kamar 
    {
        public function __construct()
        {
            require 'Koneksi.php';
            $this->db = $koneksi;
        }

        public function read()
        {
            $sql = "SELECT * from tb_room";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        public function read_limit($limit)
        {
            $sql = "SELECT * from tb_room limit $limit";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function read_detail($id)
        {
            $sql = "SELECT * from tb_room where id_room='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function read_photo($id)
        {
            $sql = "SELECT * from tb_photos where id_room='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        public function read_photo_limit($id, $limit)
        {
            $sql = "SELECT * from tb_photos where id_room='$id' limit $limit";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        
        public function getLastID()
        {
            $sql = "SELECT id_room from tb_room order by id_room DESC limit 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function update($id, $nama_room, $jml_kamar, $size_dewasa, $size_anak, $jml_tersedia, 
            $kasur_ranjang, $kasur_single, $harga)
        {
            $sql = "UPDATE tb_room set nama_room = '$nama_room', jml_kamar = '$jml_kamar', 
            size_dewasa = '$size_dewasa', size_anak = '$size_anak', jml_tersedia='$jml_tersedia', harga='$harga' where id_room='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function create($id, $nama_room, $jml_kamar, $size_dewasa, $size_anak, $jml_tersedia, 
            $kasur_ranjang, $kasur_single, $harga)
        {
            $sql = "INSERT into tb_room values('$id', '$nama_room', '$jml_kamar', '$size_dewasa',
            '$size_anak', '$jml_tersedia', '$kasur_ranjang', '$kasur_single', '$harga')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function insertImage($id, $image)
        {
            $sql = "INSERT into tb_photos values('', '$id', '$image')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function delete_kamar($id)
        {
            $sql = "DELETE from tb_room where id_room = '$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function delete_photo($id)
        {
            $sql = "DELETE from tb_room where id_photos = '$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
    }
    
?>