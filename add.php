<?php ob_start() ?>
<?php

require_once("data/conexion.php");

if (isset($_POST["country"])) {



    $country_name = $_POST["country"];


    $stmt = Conexion::conectar()->prepare("SELECT country_name FROM soccer_country WHERE able=0"); 

    $stmt -> execute();

    $result_country = $stmt ->fetchAll();



    $flag= false;
    foreach($result_country as $dato):
        if ($country_name==$dato["country_name"]){
            $flag=true;
        }
        endforeach;

    if($flag){

        ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>;

        <script> swal("Ya has agregado este país").then(
            function(){
                window.location='/TORNEO'
            }

        ) </script>;
        <?php
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




