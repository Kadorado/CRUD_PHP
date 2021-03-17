<?php 

require_once("data/conexion.php");



if(isset(  $_GET['id'])){

$id= $_GET["id"];

$stmt = Conexion::conectar()->prepare("UPDATE soccer_country SET able =1  WHERE country_id = $id"); 

$stmt -> execute();

$result = $stmt ->rowCount() > 0;


    if(!$result){
        die("Qery fallo");
    }

    $index = "index.php";
    header('Location:'. $index);
     


}


?>

