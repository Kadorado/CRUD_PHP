<?php ob_start() ?>
<?php

require_once("data/conexion.php");

if (isset($_GET["id"])) {



    $id = $_GET["id"];

    $stmt = Conexion::conectar()->prepare("SELECT * FROM soccer_country WHERE country_id=$id");

    $stmt -> execute();

    $result = $stmt -> fetch();

    if($stmt ->rowCount() == 1){
        $country_name= $result["country_name"];
        $country_abrr= $result["country_abbr"];
    }

    if (isset($_POST["actualizar"])){
        $id = $_GET['id'];
        $country_name_new= $_POST["country_name_new"];
        $country_abrr_new = $_POST["country_abbr_new"];

        echo $country_abrr_new;
        echo $country_name_new;

        $stmt = Conexion::conectar()->prepare("UPDATE soccer_country SET country_name = '$country_name_new',country_abbr='$country_abrr_new' WHERE country_id =$id");
        $stmt -> execute();

        $index = "index.php";
        header('Location:'. $index);


    }




}
?>
<?php ob_end_flush();?>



<?php
include("includes/header.php")
?>


<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
            <form action="edit.php?id=<?php echo $_GET["id"];?> " method="POST">
                <div class="form-group">
                    <input type="text" name ="country_name_new" value="<?php echo $country_name ?>" class="form-control" placeholder="Actuliza Pais">
                </div>

                <div class="form-group">
                    <input type="text" name ="country_abbr_new" value="<?php echo $country_abrr ?>" class="form-control" placeholder="Actuliza Abreviación">
                </div>

                <button class="btn btn-success" name="actualizar">Actualizar</button>
            </form>
            </div>
        </div>
</div>

</div>


<?php
include("includes/footer.php")
?>
