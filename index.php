<?php 
    include('main.php');
    $a=new YZM();
    $b=$a->returnz();
    header('Content-type:image/png');
    imagepng($b);
    imagedestroy($b);
?>