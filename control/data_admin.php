<?php
class dataadmin{
    
    //Fungsi untuk mencari data
    function view($use){
        include('koneksi.php');
        $view = $koneksi->prepare("SELECT * FROM `log` WHERE username=:user");
        $view->BindParam(":user",$use,PDO::PARAM_STR_CHAR);
        $view->execute();
        $views=$view->rowCount();
        return $views;
    }

    //Fungsi untuk menampilkan semua data
    function all(){
        include('koneksi.php');
        $all = $koneksi->prepare("SELECT * FROM `log`");
        $all->execute();
        $alls = $all->fetchALL(PDO::FETCH_ASSOC);
        return $alls;
    }

    //fungsi untuk menghapus daya
    function delete($id){
        include('koneksi.php');
        $del = $koneksi->prepare("DELETE FROM `log` WHERE username=:key");
        $del->BindParam(":key",$id,PDO::PARAM_STR);
        $del->execute();
        if($del->rowCount()==0){
            return 0;
        }
        else{
            return 1;
        }
    }

    //fungis untuk memasukkan data
    function input($use,$pas){
        include('koneksi.php');
        $inp = $koneksi->prepare("INSERT INTO `log`(username,password) VALUES(:user,:pass)");
        $inp->BindParam(":user",$use,PDO::PARAM_STR_CHAR);
        $inp->BindParam(":pass",$pas,PDO::PARAM_STR_CHAR);
        $inp->execute();
        if($inp->rowCount()==0){
            return 0;
        }
        else{
            return 1;
        }
    }

    //untuk mengecek data
    function cekdata($use,$pas){
        include('koneksi.php');
        $cek = $koneksi->prepare("SELECT * FROM `log` WHERE username=:user AND `password`=:pass");
        $cek->BindParam(":user",$use,PDO::PARAM_STR_CHAR);
        $cek->BindParam(":pass",$pas,PDO::PARAM_STR);
        $cek->execute();
        $ceks = $cek->fetchALL(PDO::FETCH_ASSOC);
        return $ceks;
    }

    //untuk mengecek data
    function update($use,$pas){
        include('koneksi.php');
        $cek = $koneksi->prepare("UPDATE `log` SET password=:pass WHERE username=:user");
        $cek->BindParam(":user",$use,PDO::PARAM_STR_CHAR);
        $cek->BindParam(":pass",$pas,PDO::PARAM_STR);
        $cek->execute();
        $ceks = $cek->fetchALL(PDO::FETCH_ASSOC);
        return $ceks;
    }
}
?>