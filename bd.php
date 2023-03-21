<?php 

$servidor="localhost"; // 127.0.0.1
$baseDeDatos='app';
$usuario="root";
$password="";

try {
    $conexion= new PDO(
        "mysql:host=$servidor;
        dbname=$baseDeDatos",
        $usuario,
        $password);
} catch (Exception $th) {
    echo $th->getMessage();
}

?>