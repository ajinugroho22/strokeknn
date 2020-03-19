<?php
function bmi($tinggi,$berat){
    $bmi=0.0;
    $bmi=number_format($berat/pow(($tinggi/100),2),1);
    return $bmi;
}
?>