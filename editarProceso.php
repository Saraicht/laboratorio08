<?php
if (!isset($_POST['codigo'])) {
    header('Location: index.php?mensaje-error');
    exit();
}

include 'model/conexion.php';

$codigo = $_POST['codigo'];
$Nombre = $_POST['txtNombre'];
$Precio = $_POST['txtPrecio'];
$Cantidad = $_POST['txtCantidad'];
$Categoria = $_POST['txtCategoria'];


$sentencia = $bd->prepare("UPDATE productos SET Nombre = ?, Precio = ?, Cantidad = ?, Categoria = ? WHERE id = ?");
$resultado = $sentencia->execute([$Nombre, $Precio, $Cantidad, $Categoria, $codigo]);

if ($resultado == TRUE) {
    header('Location: index.php?mensaje=editado');
} else {
    header('Location: index.php?mensaje-error');
    exit();
}
?>
