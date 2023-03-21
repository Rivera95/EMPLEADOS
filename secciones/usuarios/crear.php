<?php include("../../bd.php"); 
   
    if($_POST){
    $usuario = (isset($_POST['usuario']) ? $_POST['usuario']:  "" );
    $password = (isset($_POST['password']) ? $_POST['password']:  "" );
    $correo = (isset($_POST['correo']) ? $_POST['correo']:  "" );
    $sentencia=$conexion->prepare("INSERT INTO tbl_usuarios (id,usuario,password,correo)
                                   VALUES (null, :usuario,:password,:correo)");
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->execute();
    $mensaje = "Registro Agregado";
    header("Location: index.php?mensaje=".$mensaje);
    }

?>
<?php include("../../templates/header.php") ?>

<h2 class="mt-5">Formulario para la creacion de usuarios</h2>
<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
             <!-- <label for="primernombre" class="form-label">Primer Nombre</label> -->
             <input type="text"
               class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre Usuario">
            </div>

            <div class="mb-3">
             <!-- <label for="primernombre" class="form-label">Primer Nombre</label> -->
             <input type="password"
               class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Ingresa el password">
            </div>

            <div class="mb-3">
             <!-- <label for="primernombre" class="form-label">Primer Nombre</label> -->
             <input type="email"
               class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Ingresa el correo">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    
</div>

<?php include("../../templates/footer.php") ?>