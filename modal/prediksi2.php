<?php

class prediksi{

//fungsi knn
function knn($k){

$h0=$h1=$p=0;

//memanggil data ketetanggaan
include('koneksi.php');
$dataknn = $koneksi->prepare("SELECT class, jarak FROM `sorting` LIMIT :batas") or die ("Gagal");
$dataknn->BindParam(":batas",$k,PDO::PARAM_INT);
$dataknn->execute();
$duknn = $dataknn->fetchALL(PDO::FETCH_ASSOC);
//print_r($duknn);
if(!empty($duknn)){
    foreach($duknn as $rows){
        if($rows['class']==0){
            //menghitung skore kelas 0
            $h0=$h0+$rows['jarak'];
        }
        else{
            //menghitung skore kelas 1
            $h1=$h1+$rows['jarak'];
        }
    }
    echo '<td>';
    echo $h0;
    echo '</td>';
    echo '<td>';
    echo $h1;
    echo '</td>';
    //membandingkan skore kelas 0 dan kelas 1 
    if($h0>$h1){
        $p=0;
        echo '<td>';
        echo '<b>Tidak Stroke</b>';
        echo '</td>';
    }
    elseif($h0<$h1){
        $p=1;
        echo '<td>';
        echo '<b>Stroke</b>';
        echo '</td>';
    }
    else{
        $p=0;
        echo '<td>';
        echo '<b>Tidak Stroke</b>';
        echo '</td>';
    }
}
return $p;
}

//fungsi fuzzy knn
function fuzzyknn($k,$exp){
    
    $hi=$ho=$h0=$h1=$p=$bg=0;
    $u[][] = array();
    $a = new prediksi();
    
    //mencari banyak data per kelas di ketetanggaan
    $ho = $a->carikelaslimit0($k);
    $hi = $a->carikelaslimit1($k);

    // echo 'Nilai Ke 0 ';
    // echo $ho;
    // echo '<br> Nilai ke 1 ';
    // echo $hi;
    //mencari nilai keanggotaan
    for ($i=0; $i < 2; $i++) { 
        for ($j=0; $j < 2; $j++) { 
            if($i==$j){
                if($i==0){
                    $u[$i][$j]=0.51+($ho/$k)*0.49;
                }
                else{
                    $u[$i][$j]=0.51+($hi/$k)*0.49;
                }
            }
            else{
                if($i==0){
                    $u[$i][$j]=($hi/$k)*0.49;
                }
                else{
                    $u[$i][$j]=($ho/$k)*0.49;
                }
            }
        }
    }
    
    for ($i=0; $i < 2; $i++) { 
        for ($j=0; $j < 2; $j++) { 
            echo '<td>';
            echo number_format($u[$i][$j],3);
            echo '</td>';
        }
    }
    
    //memanggil data ketetanggaan
    include('koneksi.php');
    $datafuzzy = $koneksi->prepare("SELECT class, jarak FROM sorting LIMIT :batas") or die ("Gagal");
    $datafuzzy->BindParam(":batas",$k,PDO::PARAM_INT);
    $datafuzzy->execute();
    $dufuzzy = $datafuzzy->fetchALL(PDO::FETCH_ASSOC);
    if(!empty($dufuzzy)){
        foreach($dufuzzy as $rows){
            //menghitung derajat keanggotaan
            $h0=$h0+($u[0][$rows['class']]*pow($rows['jarak'],(-2/$exp-1)));
            $h1=$h1+($u[1][$rows['class']]*pow($rows['jarak'],(-2/$exp-1)));
            $bg=$bg+pow(($rows['jarak']),(-2/($exp-1)));
        }
        // echo 'Ketetanggaan 0 sblm di bagi  ';
        // echo $h0;
        // echo '<br>Ketetanggaan 1 sblm di bagi  ';
        // echo $h1;
        // echo '<br>Pembaginya  ';
        // echo $bg;
        
        $h0=$h0/$bg;
        $h1=$h1/$bg;
        // echo '<br>Ketetanggaan 0  ';
        // echo $h0;
        // echo '<br>Ketetanggaan 1  ';
        // echo $h1;
        //membandingkan nilai keanggotaan kelas 0 dan kelas 1
        echo '<td>';
        echo number_format($h0,3);
        echo '</td>';
        echo '<td>';
        echo number_format($h1,3);
        echo '</td>';
        if($h0>$h1){
            $p=0;
            echo '<td>';
            echo '<b>Tidak Stroke</b>';
            echo '</td>';
        }
        elseif($h0<$h1){
            $p=1;
            echo '<td>';
            echo '<b>Stroke</b>';
            echo '</td>';
        }
        else{
            $p=0;
            echo '<td>';
            echo '<b>Tidak Stroke</b>';
            echo '</td>';
        }
    }
    return $p;
}

//fungsi weighted neighbor knn
function weightedknn($k,$exp){
    include('koneksi.php');
    $w0=$w1=$h0=$h1=$p=$h00=$h11=0;

    $a = new prediksi();
    //mencari banyak data per kelas
    $ho = $a->carikelas(0);
    $hi = $a->carikelas(1);
    //mencari banyak data per kelas di ketetanggaan
    $h00 = $a->carikelaslimit0($k);
    $h11 = $a->carikelaslimit1($k);
    
    //mencari bobot setiap kelas
    // echo '<br>Ketetanggaan 0  ';
    //     echo $h00;
    //     echo '<br>Ketetanggaan 1  ';
    //     echo $h11;
    //     echo '<br>Ketetanggaan 0  ';
    //     echo $ho;
    //     echo '<br>Ketetanggaan 1  ';
    //     echo $hi;
    //memanggil data ketetanggaan
    $dataweighted = $koneksi->prepare("SELECT class, jarak FROM sorting LIMIT :batas") or die ("Gagal");
    $dataweighted->BindParam(":batas",$k,PDO::PARAM_INT);
    $dataweighted->execute();
    $duweighted = $dataweighted->fetchALL(PDO::FETCH_ASSOC);
    if(!empty($duweighted)){
        foreach($duweighted as $rows){
            if($rows['class']==0){
                //menghitung skore kelas 0
                $h0=$h0+$rows['jarak'];
            }
            else{
                //menghitung skore kelas 1
                $h1=$h1+$rows['jarak'];
            }
        }
    }
    if($h00!=0 && $h11!=0){

   $w0=1/pow(($ho/$h11),(1/$exp));
   $w1=1/pow(($hi/$h00),(1/$exp));
   echo '<td>';
   echo number_format($w0,3);
   echo '</td>';
   echo '<td>';
   echo number_format($w1,3);
   echo '</td>';
    
        echo '<td>';
        echo $h0;
        echo '</td>';
        echo '<td>';
        echo $h1;
        echo '</td>';
        //menghitung skore di kali bobot tiap kelas
        $h0=$h0*$w0;
        $h1=$h1*$w1;
        echo '<td>';
        echo number_format($h0,3);
        echo '</td>';
        echo '<td>';
        echo number_format($h1,3);
        echo '</td>';
        //mebandingkan skore kelas 0 dan kelas 1
        if($h0>$h1){
            $p=0;
            echo '<td>';
            echo '<b>Tidak Stroke</b>';
            echo '</td>';
        }
        else{
            $p=1;
            echo '<td>';
            echo '<b>Stroke</b>';
            echo '</td>';
        }
    }
    elseif($h00==0){
        $p=1;
        $w0=1/pow(($ho/$h11),(1/$exp));
        $w1=0;
        

        echo '<td>';
        echo number_format($w0,3);
        echo '</td>';
        echo '<td>';
        echo number_format($w1,3);
        echo '</td>';
        echo '<td>';
        echo $h0;
        echo '</td>';
        echo '<td>';
        echo $h1;
        echo '</td>';
        $h1=0;
        $h0=$h0*$w0;
        echo '<td>';
        echo $h0;
        echo '</td>';
        echo '<td>';
        echo $h1;
        echo '</td>';

        echo '<td>';
        echo '<b>Stroke</b>';
        echo '</td>';

    }
    else{
        $p=0;
        $w0=0;
        $w1=1/pow(($hi/$h00),(1/$exp));

        echo '<td>';
        echo number_format($w0,3);
        echo '</td>';
        echo '<td>';
        echo number_format($w1,3);
        echo '</td>';
        echo '<td>';
        echo $h0;
        echo '</td>';
        echo '<td>';
        echo $h1;
        echo '</td>';
        $h1=$h1*$w1;
        $h0=0;
        echo '<td>';
        echo $h0;
        echo '</td>';
        echo '<td>';
        echo $h1;
        echo '</td>';

        echo '<td>';
        echo '<b> Tidak Stroke</b>';
        echo '</td>';
    }
    return $p;
}

//fungsi mencari banyak data masing masing kelas
function carikelas($kelas){
    include('koneksi.php');
    $bk=0;
// echo $kelas;
    $kls = $koneksi->prepare("SELECT COUNT(class) AS class FROM data_latih where class=:kelas") or die ("Gagal mencari");
    $kls->BindParam(":kelas",$kelas,PDO::PARAM_INT);
    $kls->execute();
    $kel = $kls->fetchALL(PDO::FETCH_ASSOC);
    if(!empty($kel)){
        foreach($kel as $rows){
            $bk=$rows['class'];
        }
    }
     return $bk;
}

//fungsi mencari banyak data masing masing kelas 0 di ketetanggaan
function carikelaslimit0($l){
    include('koneksi.php');
    $bki0=0;

    $klslim0 = $koneksi->prepare("SELECT * FROM sorting LIMIT :lim") or die ("Gagal");
    $klslim0->BindParam(":lim",$l,PDO::PARAM_INT);
    $klslim0->execute();
    $kellim0 = $klslim0->fetchALL(PDO::FETCH_ASSOC);
    if(!empty($kellim0)){
        foreach($kellim0 as $rows){
            if($rows['class']==0){
                $bki0=$bki0+1;
            }
            
        }
    }
    return $bki0;
}
//fungsi mencari banyak data masing masing kelas 0 di ketetanggaan
function carikelaslimit1($lim){
    include('koneksi.php');
    $bki1=0;

    $klslim1 = $koneksi->prepare("SELECT * FROM sorting LIMIT :lim") or die ("Gagal");
    $klslim1->BindParam(":lim",$lim,PDO::PARAM_INT);
    $klslim1->execute();
    $kellim1 = $klslim1->fetchALL(PDO::FETCH_ASSOC);
    if(!empty($kellim1)){
        foreach($kellim1 as $rows){
            if($rows['class']==1){
                $bki1=$bki1+1;
            }
            
        }
    }
    return $bki1;
}

function bersih(){
    include('koneksi.php');
    //membersihkan tabel prediksi
    $kos = $koneksi->prepare("DELETE FROM prediksi") or die ("Gagal Membersihkan");
    $kos->execute();
}

//memasukan data hasil deteksi ke tabel prediksi
function masukknn($id,$kls,$de,$k){
    include('koneksi.php');
    $ma1 = $koneksi->prepare("INSERT INTO prediksi(id_datauji,class,knn,k) VALUES (:id,:kls,:de,:k)");
    $ma1->BindParam(":id",$id,PDO::PARAM_INT);
    $ma1->BindParam(":kls",$kls,PDO::PARAM_INT);
    $ma1->BindParam(":k",$k,PDO::PARAM_INT);
    $ma1->BindParam(":de",$de,PDO::PARAM_STR);
    $ma1->execute();
}

function masukfuzzy($id,$de,$k){
    include('koneksi.php');
    $ma2 = $koneksi->prepare("UPDATE prediksi SET fuzzy=:de WHERE id_datauji=:id AND k=:k");
    $ma2->BindParam(":id",$id,PDO::PARAM_INT);
    $ma2->BindParam(":de",$de,PDO::PARAM_STR);
    $ma2->BindParam(":k",$k,PDO::PARAM_INT);
    $ma2->execute();
}

function masukweighted($id,$de,$k){
    include('koneksi.php');
    $ma3 = $koneksi->prepare("UPDATE prediksi SET weigted=:de WHERE id_datauji=:id AND k=:k");
    $ma3->BindParam(":id",$id,PDO::PARAM_INT);
    $ma3->BindParam(":de",$de,PDO::PARAM_STR);
    $ma3->BindParam(":k",$k,PDO::PARAM_INT);
    $ma3->execute();
}

function hapus($id){
    include'koneksi.php';
    $hps = $koneksi->prepare("DELETE FROM prediksi WHERE id_datauji=:id");
    $hps->BindParam(":id",$id,PDO::PARAM_STR);
    $hps->execute();
}

function all(){
    include'koneksi.php';
    $all = $koneksi->prepare("SELECT * FROM prediksi");
    $all->execute();
    $alls = $all->fetchALL(PDO::FETCH_ASSOC);
    return $alls;
}

}

?>