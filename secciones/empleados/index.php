<?php include("../../bd.php"); 

if(isset( $_GET['txtID'] )){
    $txtID = (isset( $_GET['txtID'] )) ? $_GET['txtID']: "";
    $sentencia = $conexion->prepare("SELECT foto,cv FROM `tbl_empleados` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
    // print_r($registro_recuperado);

    if( isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!= "") {
        if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);
        }
    }
    if( isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!= "") {
        if(file_exists("./".$registro_recuperado["cv"])){
            unlink("./".$registro_recuperado["cv"]);
        }
    }
    $sentencia = $conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location: index.php?mensaje=".$mensaje);
}

$sentencia = $conexion->prepare("SELECT *,
(SELECT nombredelpuesto 
FROM tbl_puestos 
WHERE tbl_puestos.id=tbl_empleados.idpuesto  limit 1) as puesto
FROM `tbl_empleados`");
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php") ?>

<h1 class="mt-5">Empleado</h1>
<p>A continuacion te mostraremos la lista de empleados.</p>
<div class="card">
    <div class="card-header">
        <a name="" 
           id="" 
           class="btn btn-primary" 
           href="crear.php" 
           role="button">Crear Empleado</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista_tbl_empleados as $registro) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id']; ?></td>
                        <td><?php echo $registro['primernombre']; ?>
                            <?php echo $registro['segundonombre']; ?>
                            <?php echo $registro['primerapellido']; ?>
                            <?php echo $registro['segundoapellido']; ?>
                        </td>
                        <td> <img width="50" 
                                  src="<?php echo $registro['foto']; ?>" class="img-fluid rounded" alt="img" />
                        </td>
                        <td>
                            <a href="<?php echo $registro['cv']; ?>">
                            <?php echo $registro['cv']; ?>
                        </a>
                        </td>
                        <td><?php echo $registro['puesto']; ?></td>
                        <td><?php echo $registro['fechadeingreso']; ?></td>
                        <td><a class="btn btn-success" href="carta_recomendacion.php?txtID=<?php echo $registro['id']; ?>" role="button">Carta</a>
                        |
                        <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("../../templates/footer.php") ?>