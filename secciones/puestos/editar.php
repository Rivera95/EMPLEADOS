<?php include("../../bd.php"); 

 if(isset( $_GET['txtID'] )){
    $txtID = (isset( $_GET['txtID'] )) ? $_GET['txtID']: "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_puestos 
                                     WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombredelpuesto = $registro["nombredelpuesto"];
}

if($_POST){
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID']: "";
    $nombredelpuesto = (isset($_POST['nombredelpuesto']) ? $_POST['nombredelpuesto']:  "" );
    $sentencia = $conexion->prepare("UPDATE tbl_puestos 
                                   SET nombredelpuesto=:nombredelpuesto 
                                   WHERE id=:id");
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $mensaje = "Registro Actualizado";
    header("Location: index.php?mensaje=".$mensaje);
    }
?>

<?php include("../../templates/header.php") ?>

<h2 class="mt-5">Formulario para editar un puesto</h2>
<div class="card">
    <div class="card-header">
        Puesto
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
            <label for="txtID" class="form-label">Id</label>
                <input value="<?php echo $txtID; ?>" type="text" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
            </div>
            <div class="mb-3">
            <label for="primernombre" class="form-label">Nombre Puesto</label>
                <input type="text" value="<?php echo $nombredelpuesto; ?>"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId">
            </div>

            <button type="submit" class="btn btn-success">Editar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    
</div>

<?php include("../../templates/footer.php") ?>