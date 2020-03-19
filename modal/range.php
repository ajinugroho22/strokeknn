<?php
class rangee{

    function rangeum($datauji){
        include('koneksi.php');
            //mengambil data maksimal umur dan minimal umur dari database
            //setelah itu membandingkan dengan data uji data maksimal dan minimalnya
            $dl = $koneksi->prepare("SELECT MAX(umur) AS MAX, MIN(umur) AS MIN FROM data_latih") or die ("Gagal");
            $dl->execute();
            $dlt = $dl->fetchALL(PDO::FETCH_ASSOC);
            if(!empty($dlt)){
                foreach($dlt as $rows){
                    $MAX=$rows['MAX'];
                    $MIN=$rows['MIN'];
                }
                if($MAX<$datauji){
                    $MAX=$datauji;
                }
                if($MIN>$datauji){
                    $MIN=$datauji;
                }
                //menghitung jarak data
                $selisih=$MAX-$MIN;
            }
        //mengembalikan nilai variabel selisih
        return $selisih;
    }

    function rangegul($datauji){
        include('koneksi.php');
            //mengambil data maksimal gula dan minimal gula dari database
            //setelah itu membandingkan dengan data uji data maksimal dan minimalnya
            $dgu = $koneksi->prepare("SELECT MAX(gula) AS MAX, MIN(gula) AS MIN FROM data_latih") or die ("Gagal");
            $dgu->execute();
            $dgul = $dgu->fetchALL(PDO::FETCH_ASSOC);
            if(!empty($dgul)){
                foreach($dgul as $rows){
                    $MAX=$rows['MAX'];
                    $MIN=$rows['MIN'];
                }
                if($MAX<$datauji){
                    $MAX=$datauji;
                }
                if($MIN>$datauji){
                    $MIN=$datauji;
                }
                //menghitung jarak data
                $selisih=$MAX-$MIN;
            }
        //mengembalikan nilai variabel selisih
        return $selisih;
    }

    function rangebmi($datauji){
        include('koneksi.php');
        //mengambil data maksimal bmi dan minimal bmi dari database
            //setelah itu membandingkan dengan data uji data maksimal dan minimalnya
            $dbm = $koneksi->prepare("SELECT MAX(bmi) AS MAX, MIN(bmi) AS MIN FROM data_latih") or die ("Gagal");
            $dbm->execute();
            $dbmi = $dbm->fetchALL(PDO::FETCH_ASSOC);
            if(!empty($dbmi)){
                foreach($dbmi as $rows){
                    $MAX=$rows['MAX'];
                    $MIN=$rows['MIN'];
                }
                if($MAX<$datauji){
                    $MAX=$datauji;
                }
                if($MIN>$datauji){
                    $MIN=$datauji;
                }
                //menghitung jarak data
                $selisih=$MAX-$MIN;
            }
        //mengembalikan nilai variabel selisih
        return $selisih;
    }
}


?>