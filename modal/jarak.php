<?php
function jarak(array $datauji, array $datlat, $range3, $range6, $range7, $id){
    //inisialisasi
    $jz=0;
    $jarak=0;
    $w=0;
    $z = array();
    //Perbandingan data uji dengan data latih
        for ($i=2; $i <=count($datauji) ; $i++) { 
            if($datauji[$i]<=3){
                if($datauji[$i]==$datlat[$i]){
                    $z[$i]=1;
                }
                else{
                    $z[$i]=0;
                }
            }
            else{
                //umur
                if($i==3){
                    if($datauji[$i]>$datlat[$i]){
                        $z[$i]=1-(($datauji[$i]-$datlat[$i])/$range3);
                    }
                    else{
                        $z[$i]=1-(($datlat[$i]-$datauji[$i])/$range3);
                    }
                }
                //gula
                if($i==6){
                    if($datauji[$i]>$datlat[$i]){
                        $z[$i]=1-(($datauji[$i]-$datlat[$i])/$range6);
                    }
                    else{
                        $z[$i]=1-(($datlat[$i]-$datauji[$i])/$range6);
                    }
                }
                //bmi
                if($i==7){
                    if($datauji[$i]>$datlat[$i]){
                        $z[$i]=1-(($datauji[$i]-$datlat[$i])/$range7);
                    }
                    else{
                        $z[$i]=1-(($datlat[$i]-$datauji[$i])/$range7);
                    }
                }
                
                
        }
    }
    //menghitung jumlah jarak kedekatan tiap atribut dan bobot jarak;
    for ($i=2; $i <=count($datauji) ; $i++) {
        if($z[$i]>0){
            $w=$w+1;
            $jz=$jz+$z[$i];
        }  
    }
    //menghitung jarak kedekatan data
    $jarak=$jz/$w;

    //memasukkan data jarak ke database
    include('koneksi.php');
    $a = $koneksi->prepare("UPDATE data_latih SET jarak=:jarak WHERE id=:id ") or die  ("Gagal Memasukkan data jarak");
    $a->BindParam(":jarak",$jarak);
    $a->BindParam(":id",$id);
    $a->execute();



    //mengembalikan nilai variabel jarak
    return $jarak;
}
?>