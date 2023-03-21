<?php  include("../../bd.php");  

if(isset( $_GET['txtID'] )){

    $txtID = (isset( $_GET['txtID'] )) ? $_GET['txtID']: "";
    $sentencia = $conexion->prepare("SELECT *, 
    (SELECT nombredelpuesto 
    FROM tbl_puestos 
    WHERE tbl_puestos.id=tbl_empleados.idpuesto  limit 1) as puesto
    FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // print_r($registro);
    $primernombre = $registro["primernombre"];
    $segundonombre = $registro["segundonombre"];
    $primerapellido = $registro["primerapellido"];
    $segundoapellido = $registro["segundoapellido"];

    $nombreCompleto = $primernombre . " " . $segundonombre . " " . $primerapellido  . " " . $segundoapellido;
    $foto = $registro["foto"];
    $cv = $registro["cv"];
    $idpuesto = $registro["idpuesto"];
    $puesto = $registro["puesto"];
    $fechadeingreso = $registro["fechadeingreso"];

    $fechaInicio = new DateTime($fechadeingreso);
    $fechaFin = new DateTime(date('Y-m-d'));
    $diferencia = date_diff($fechaInicio,$fechaFin);
}
ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Recomendacion</title>
</head>
<body>
    
    <h1>Carta de Recomendación Laboral</h1>
    <p>Santiago de Cali, Colombia <strong> <?php echo date('d-m-Y'); ?> </strong></p>
    <p>A quien pueda interesar: </p>
    <p>Reciba un cordial y respetuoso saludo</p>

    A través de este medio hago conocimiento que Sr(a) 
    <strong><?php echo $nombreCompleto; ?></strong>,
    
    Quien laboro en la empresa xxx durante <strong><?php echo $diferencia->y; ?> Año(s), </strong>
    Es un ciudadano que Demostrado ser un gran trabajador,
    <br>
    Competitivo fiel y complido con sus deberes, siempre mostro confianza y por ende lo recomendamos
    <p>Durante estos años laboro como <strong><?php echo $puesto; ?></strong>
    por tal motivo sugiero que tome esta recomendacion, ya que confio plenamente en su trabajo
    </p>
    <p></p>
    Atentamente:
    <br>
    <strong>Cristian Rivera</strong>

</body>
</html>

<?php 

$HTML = ob_get_clean();
require_once("../../libs/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));
$dompdf->setOptions($opciones);

$dompdf->loadHtml($HTML);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment"=>false));

?>