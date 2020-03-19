<?php

class pengaturan{
//menampilkan data pengaturan
    function all(){
        include('koneksi.php');
        $all = $koneksi->prepare("SELECT * FROM aturan");
        $all->execute();
        $alls = $all->fetchALL(PDO::FETCH_ASSOC);
        return $alls;
    }

//mengupdate data pengaturan
    function update($exp,$k_awal,$k_akhir){
        include('koneksi.php');
        $upd = $koneksi->prepare("UPDATE aturan SET k_awal=:awal, k_akhir=:akhir ,eks=:eks WHERE id=1");
        $upd->BindParam(":awal",$k_awal,PDO::PARAM_STR);
        $upd->BindParam(":akhir",$k_akhir,PDO::PARAM_STR);
        $upd->BindParam(":eks",$exp,PDO::PARAM_STR);
        $upd->execute();
        $upds=$upd->rowCount();
        return $upds;
    }

//mereset data ke default
    function ulang(){
        include('koneksi.php');
        $ul = $koneksi->prepare("UPDATE aturan SET k_awal=3, k_akhir=3 ,eks=2 WHERE id=1");
        $ul->execute();
        $uls=$ul->rowCount();
        return $uls;
    }

//mengambil nilai ketetanggan awal
    function ambil(){
        include('koneksi.php');
        $bil = $koneksi->prepare("SELECT k_awal FROM aturan WHERE id=1");
        $bil->execute();
        $bils=$bil->fetchALL(PDO::FETCH_ASSOC);
        foreach ($bils as $kye) {
            $a = $kye['k_awal'];
        }
        return $a;
    }

}
?>