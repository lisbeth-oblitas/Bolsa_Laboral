<?php
include("../includes/conectar.php");
$conexion = conectar();

$id = $_GET['id'];

$sql = "DELETE FROM empresas WHERE id='$id'";

mysqli_query($conexion, $sql) or die("Error al eliminar usuario.");

header("Location: listar_usuarios.php");
?>