<?php include("../../bd.php"); 

 if(isset( $_GET['txtID'] )){
    $txtID = (isset( $_GET['txtID'] )) ? $_GET['txtID']: "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios 
                                     WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];
}

if($_POST){
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID']: "";
    $usuario = (isset($_POST['usuario']) ? $_POST['usuario']:  "" );
    $password = (isset($_POST['password']) ? $_POST['password']:  "" );
    $correo = (isset($_POST['correo']) ? $_POST['correo']:  "" );
    $sentencia = $conexion->prepare("UPDATE tbl_usuarios 
                                   SET usuario =:usuario, 
                                   password=:password,
                                   correo =:correo
                                   WHERE id=:id");
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $mensaje = "Registro Actualizado";
    header("Location: index.php?mensaje=".$mensaje);
    // print_r($_POST);
}

?>

<?php include("../../templates/header.php") ?>

<h2 class="mt-5">Formulario para la Ediccion del usuario</h2>
<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
            <!-- <label for="txtID" class="form-label">Id</label> -->
                <input value="<?php echo $txtID; ?>" type="text" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
            </div>
            <div class="mb-3">
             <!-- <label for="primernombre" class="form-label">Primer Nombre</label> -->
             <input type="text" value="<?php echo $usuario; ?>"
               class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre Usuario">
            </div>

            <div class="mb-3">
             <!-- <label for="primernombre" class="form-label">Primer Nombre</label> -->
             <input type="password" value="<?php echo $password; ?>"
               class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Ingresa el password">
            </div>

            <div class="mb-3">
             <!-- <label for="primernombre" class="form-label">Primer Nombre</label> -->
             <input type="email" value="<?php echo $correo; ?>"
               class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Ingresa el correo">
            </div>

            <button type="submit" class="btn btn-success">Editar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    
</div>

<?php include("../../templates/footer.php") ?>