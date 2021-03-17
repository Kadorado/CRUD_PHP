<?php 
require_once("data/conexion.php");
include("includes/header.php"); ?>

<div class="container p-4">

    <div class="row">
        <div class="col-md-4">
            <div class="card card-body">
                <h6>Agregar país</h6>


                <form action="create_2.php" method="POST">
                    <select class="form-control" data-show-subtext="true" data-live-search="true" name="country">
                    <?php
                        $stmt = Conexion::conectar()->prepare("SELECT * FROM soccer_country WHERE able=1 OR able=0");
                         $stmt -> execute();
                         $result =$stmt -> fetchAll();
                        ?>
                         <?php foreach($result as $dato):?>
                        <option data-subtext=""><?php echo $dato["country_name"]; ?></option>
                         <?php endforeach ?>

                    </select>
                    <input type="submit" class="btn btn-success btn-block mt-4" name="add_country" value="Agregar país"> 

                </form>


            </div>

            <div class="card card-body">
            <form action="create.php" method="POST" >
                <h6>Agregar un nuevo Pais</h6>
                <div class="form-group">
                    <input type="text" name="country_new" class="form-control" placeholder="Nuevo Pais">
                 </div>


                 <div class="form-group">
                    <input type="text" name="abbr_new" class="form-control" placeholder="Abreviatura">
                 </div>

                 <input type="submit" class="btn btn-success btn-block mt-4" name="add_country_new" value="Agregar nuevo país"> 


                </form>
                </div>


        </div>

        <div class="col-md-8">
            <h6>Tabla país</h6>
            <table class="table table-bordered"  >

            <thead>
                <tr>
                    <th>Abreviatura Pais</th>
                    <th>Nombre pais</th>
                    <th>Acciones</th>

                </tr>


            </thead>
             <tbody>
                <?php
                $stmt = Conexion::conectar()->prepare("SELECT * FROM soccer_country WHERE able=0" );

                $stmt -> execute();

                $result =$stmt -> fetchAll();

                ?>

                <?php foreach($result as $dato):?>
                <tr>
                    <td> <?php echo  $dato["country_abbr"] ?>
                    </td>
                    <td> <?php echo  $dato["country_name"] ?>
                    </td>
                    <td>
                    <a href="edit.php?id=<?php echo $dato["country_id"] ?>" class="btn btn-secondary" > <i class="fas fa-marker  fa-lg" ></i>
                    </a>
                    <a href="delete.php?id=<?php echo  $dato["country_id"]?>" id="btnDeleteCountry" idCountry="<?php echo  $dato["country_id"]?>" class="btn btn-danger" > <i class="far fa-trash-alt  fa-lg"></i> </a>
                    </td>
                </tr>



                <?php endforeach ?>
            </tbody>
            </table >
        </div>

    </div>

</div>




<?php include("includes/footer.php")?>
