<?php ob_start() ?>
<?php

require_once("data/conexion.php");

if (isset($_POST["country"])) {



    $country_name = $_POST["country"];


    $stmt = Conexion::conectar()->prepare("SELECT country_name FROM soccer_country WHERE able=0"); 

    $stmt -> execute();

    $result_country = $stmt ->fetch();


    if(in_array($country_name, $result_country)){
        echo "<script> alert('existe')</script>";
    }
    else{
        $stmt = Conexion::conectar()->prepare("UPDATE soccer_country SET able =0 WHERE country_name = '$country_name'");
        $stmt -> execute();
        $result = $stmt ->rowCount() > 0;
        if(!$result){
            die("Qery fallo");
        }
        $index = "index.php";
        header('Location:'. $index);

    }
}
?>
<?php ob_end_flush();?>