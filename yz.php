<?php
if(!session_id()) session_start();
    include('main.php');

if(isset($_POST['code'])){
    if(strtolower($_POST['code'])==$_SESSION['code']){
        echo "正确";
    }
    else{
        echo "错误";
    }
}
?>