<?php ob_start() ?>
<?php

use function PHPSTORM_META\type;

require_once("data/conexion.php");

function ultimo_index (){
    $stmt = Conexion::conectar()->prepare("SELECT country_id FROM soccer_country ORDER BY country_id DESC LIMIT 1");
    $stmt -> execute();
    return $stmt -> fetch();
}

function insert_country($datos, $tabla){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (country_id, country_abbr, country_name, able) VALUES (:id, :abrr, :name_country, 0)");
    $stmt -> bindParam(":id",$datos["id"],PDO::PARAM_STR);
    $stmt -> bindParam(":abrr",$datos["abrr"],PDO::PARAM_STR);
    $stmt -> bindParam(":name_country",$datos["name_country"],PDO::PARAM_STR);

    if($stmt -> execute()){
        return "Ok";
    }
    else{
        return "Error";
    }
}


if (isset($_POST["country_new"])) {
    $country_name = $_POST["country_new"];
    $stmt = Conexion::conectar()->prepare("SELECT country_name FROM soccer_country WHERE able=0 OR able=1"); 
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
        $last_id = ultimo_index();
        $last_num = (int)$last_id[0]; 
         $datos = array(
        "id" => $last_num+1,
        "abrr" => $_POST["abbr_new"],
        "name_country" => $_POST["country_new"]
        );
        insert_country($datos, "soccer_country");
        $index = "index.php";
        header('Location:'. $index);
    }
}




?>
<?php ob_end_flush();?>



