<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php'; 

$codigo = $_GET['codigo'];


$sentencia_promociones = $bd->prepare("DELETE FROM promociones WHERE id_productos = ?;");
$resultado_promociones = $sentencia_promociones->execute([$codigo]);


if ($resultado_promociones === TRUE) {
    $sentencia_productos = $bd->prepare("DELETE FROM productos WHERE id = ?;");
    $resultado_productos = $sentencia_productos->execute([$codigo]);

    if ($resultado_productos === TRUE) {
        header('Location: index.php?mensaje=eliminado');
    } else {
        header('Location: index.php?mensaje=error'); 
    }
} else {
    header('Location: index.php?mensaje=error'); 
}
?>
