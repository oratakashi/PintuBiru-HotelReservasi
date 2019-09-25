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
            $sql = "SELECT id_order from tb_trans_rooms where id_order='$id'";
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
    }
    
?>