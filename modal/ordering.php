<?php
class ordering{


function order(){
    include('koneksi.php');
    //mengambil data id,class,jarak dari tabel data latih secara descending
    $order = $koneksi->prepare("SELECT id,class,jarak FROM data_latih ORDER BY jarak DESC") or die ("Gagal");
    $order->execute();
    $or = $order->fetchALL(PDO::FETCH_ASSOC);
    if(!empty($or)){
        foreach($or as $rows){
            //memasukkan data ke tabel sorting
            $in = $koneksi->prepare("INSERT INTO sorting (no_data_latih,class,jarak) VALUES (:id,:class,:jarak)") or die ("Gagal");
            $in->BindParam(":jarak",$rows['jarak'],);
            $in->BindParam(":id",$rows['id']);
            $in->BindParam(":class",$rows['class']);
            $in->execute();
        }   
    }
}

function bersih(){
    include('koneksi.php');
    //membersihkan tabel sorting
    $kos = $koneksi->prepare("DELETE FROM sorting") or die ("Gagal Membersihkan");
    $kos->execute();
}

function all(){
    include('koneksi.php');
    //memanggil semua
    $all= $koneksi->prepare("SELECT * FROM sorting") or die ("Gagal Membersihkan");
    $all->execute();
    $alls = $all->fetchALL(PDO::FETCH_ASSOC);
    return $alls;
}
}

?>