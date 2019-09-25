<?php 
    /**
     * Script WebService untuk menghandle request secara async
     * 
     * async adalah proses yang terjadi secara background
     * dan dapat melakukan proses berkali2 tanpa mengganggu proses utama
     * 
     * Semua proses instansiasi class di handle oleh method _getClass. jadi tidak perlu melakukan 
     * instansiasi class seperti $class_name = new ClassName(); di ganti menjadi _getClass('ClassName');
     * dan langsung menjalankan chain method
     * 
     * Chain method adalah proses menjalankan method secara berantai dalam satu waktu
     * 
     * created by Oratakashi Nhamako (https://github.com/oratakashi)
     * 
     * Note :   Silahkan beri masukan sekiranya penjelasan di documentation salah / kurang tepat
     *          karena saya hanya manusia biasa yang punya salah dan khilaf
     */
    session_start();
    spl_autoload_register(function($class){
        require_once '../db/' . $class . '.php';
    });
    function _getClass($class_name){
        if(file_exists('../db/'.$class_name.'.php')){
            $obj = new $class_name;
            return $obj;
        }else{
            echo "<p style='color:red; font-size:38px'>Nama Class tidak ditemukan di folder DB ! , Mohon periksa parameter di _getClass !</p>";
        }
    }
    if(!empty($_GET['request'])){
        /**
         * Jika yang di request detail data :
         */
        if($_GET['request']=='detail'){
            if($_GET['modules']=='administrator'){
                $data = _getClass('Admin')->read_admin_detail($_GET['id']);
                if($data->rowCount()>0){
                    echo json_encode($data->fetch(PDO::FETCH_ASSOC));
                }else{
                    $result['status'] = 500;
                    $result['messages'] = 'Data Empty';
                }
            }elseif($_GET['modules']=='kamar'){
                $data = _getClass('Kamar')->read_detail($_GET['id']);
                if($data->rowCount()>0){
                    echo json_encode($data->fetch(PDO::FETCH_ASSOC));
                }else{
                    $result['status'] = 500;
                    $result['messages'] = 'Data Empty';
                }
            }elseif($_GET['modules']=='food'){
                $data = _getClass('Resto')->read_detail($_GET['id']);
                if($data->rowCount()>0){
                    echo json_encode($data->fetch(PDO::FETCH_ASSOC));
                }else{
                    $result['status'] = 500;
                    $result['messages'] = 'Data Empty';
                }
            }
        }
        /**
         * Jika yang di request id :
         */
        elseif($_GET['request']=='id'){
            if($_GET['modules']=='kamar'){
                $data = _getClass('Kamar')->getLastID();
                echo json_encode($data->fetch(PDO::FETCH_ASSOC));
            }elseif($_GET['modules']=='order'){
                $position = 0;
                $id_order = "";
                while(true){
                    //Max 999 Pesanan dalam satu hari
                    if($position<10){
                        $id_order = "INV".date('ymd')."00".$position;
                        if(_getClass('Order')->cekID($id_order)){
                            break;
                        }
                    }elseif($position<100){
                        $id_order = "INV".date('ymd')."0".$position;
                        if(_getClass('Order')->cekID($id_order)){
                            break;
                        }
                    }elseif($position<1000){
                        $id_order = "INV".date('ymd').$position;
                        if(_getClass('Order')->cekID($id_order)){
                            break;
                        }
                    }else{
                        break;
                    }
                }
                
                $result = array();

                if($id_order != ""){
                    $result['id_order'] = $id_order;
                }else{
                    $result['id_order'] = "null";
                }

                echo json_encode($result);
            }
        }
        /**
         * Jika yang di request perintah delete :
         */
        elseif($_GET['request']=='delete'){
            if($_GET['modules']=='kamar'){
                /**
                 * Melakukan penghapusan foto yang bersangkutan
                 */
                $photos = _getClass('Kamar')->read_photo($_GET['id'])->fetchAll(PDO::FETCH_ASSOC);

                /**
                 * Looping data photos
                 */
                foreach ($photos as $row) {
                    if(file_exists("../media/kamar/".$row['photos'])){
                        unlink("../media/kamar/".$row['photos']);
                        _getClass('Kamar')->delete_photo($row['id_photos']);
                    }
                }

                $result = array();

                if(_getClass('Kamar')->delete_kamar($_GET['id'])){
                    $result['status'] = 200;
                    $result['messages'] = 'Delete Success';
                }else{
                    $result['status'] = 500;
                    $result['messages'] = 'Server Error!';
                }

                echo json_encode($result);
            }elseif($_GET['modules']=='food'){
                $data = _getClass('Resto')->read_detail($_GET['id'])->fetch(PDO::FETCH_ASSOC);
                if(file_exists("../media/food/".$data['photo'])){
                    unlink("../media/food/".$data['photo']);
                }
                $result = array();
                if(_getClass('Resto')->delete($_GET['id'])){
                    $result['status'] = 200;
                    $result['messages'] = 'Delete Success';
                }else{
                    $result['status'] = 500;
                    $result['messages'] = 'Server Error!';
                }
                echo json_encode($result);
            }
        }
        /**
         * Jika yang di request salah :
         */
        else{
            $result['status'] = 500;
            $result['messages'] = 'Wrong Request';

            echo json_encode($result);
        }
    }else{
        $result['status'] = 500;
        $result['messages'] = 'Wrong Request';

        echo json_encode($result);
    }
?>