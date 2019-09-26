<?php 
    class Order  
    {
        
        public function __construct()
        {
            require 'Koneksi.php';
            $this->db = $koneksi;
        }
        
        public function cekID($id)
        {
            $sql = "SELECT id_trans from tb_trans_rooms where id_trans='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount() < 1;
        }

        public function create($id, $cek_in, $cek_out, $id_costumer, $id_room, $total)
        {
            $sql = "INSERT into tb_trans_rooms values('$id', '$cek_in', '$cek_out', '$id_costumer',
                    '$id_room', '$total', 'Pending', CURRENT_TIMESTAMP)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function read_user($id)
        {
            $sql = "SELECT *, DATEDIFF(CURRENT_DATE, modify_date) as selisih_tgl from tb_trans_rooms where id_costumer = '$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function read_detail($id)
        {
            $sql = "SELECT *, DATEDIFF(CURRENT_DATE, modify_date) as selisih_tgl from tb_trans_rooms where id_trans = '$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function konfirmasi($id)
        {
            $sql = "UPDATE tb_trans_rooms set status_trans = 'waiting', modify_date = CURRENT_TIMESTAMP where id_trans='$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
    }
    
?>