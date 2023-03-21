<?php include("../../bd.php"); 
   
    if($_POST){
    
    // Recolectamos los datos del metodo POST
    $nombredelpuesto=(isset($_POST['nombredelpuesto']) ? $_POST['nombredelpuesto']:  "" );
    // Insertamos los datos
    $sentencia=$conexion->prepare("INSERT INTO tbl_puestos(id,nombredelpuesto) VALUES (null, :nombredelpuesto)");
    // Asignando los valores que vienen del metodo POST
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia->execute();
    $mensaje = "Registro Agregado";
    header("Location: index.php?mensaje=".$mensaje);
    }

?>
<?php include("../../templates/header.php") ?>

<h2 class="mt-5">Formulario para la creacion de puesto</h2>
<div class="card">
    <div class="card-header">
        Puesto
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
             <!-- <label for="primernombre" class="form-label">Primer Nombre</label> -->
             <input type="text"
               class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre Puesto">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    
</div>

<?php include("../../templates/footer.php") ?>