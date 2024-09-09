<?php    

 include "qrlib.php";

  
 $backColor = 0xFFFFFF;
 $foreColor = 0x000000;
 
 $hash = md5($data);
 $secretCode = substr($hash, 0, 12);
 $safe_qr_filename = 'qr/qr-'.$promo.'-'.$secretCode.'.png';


if (!file_exists($safe_filename)) {
    QRcode::png($data, $safe_qr_filename, "L", 26, 0, 2, $backColor, $foreColor); // можно делать SVG
}



 

 ?>
