<?php
if (empty($_POST["oculto"]) || empty($_POST["txtNombre"]) || empty($_POST["txtPrecio"]) || empty($_POST["txtCantidad"])
     || empty($_POST["txtCategoria"]) || empty($_POST["txtCelular"]) || empty($_FILES["foto"])) {
    $mensaje = 'Falta el siguiente campo(s): ';
    
    if (empty($_POST["oculto"])) {
        $mensaje .= 'Falta campo Oculto, ';
    }
    if (empty($_POST["txtNombre"])) {
        $mensaje .= 'Falta campo Nombre, ';
    }
    
    if (empty($_POST["txtPrecio"])) {
        $mensaje .= 'Falta campo Precio, ';
    }
    if (empty($_POST["txtCantidad"])) {
        $mensaje .= 'Falta campo Cantidad, ';
    }
    if (empty($_POST["txtCategoria"])) {
        $mensaje .= 'Falta campo Categoría, ';
    }
    if (empty($_POST["txtCelular"])) {
        $mensaje .= 'Falta campo Celular, ';
    } elseif (empty($_FILES["foto"])) {
        $mensaje = 'Falta campo foto';
    }
    
    $mensaje = rtrim($mensaje, ', '); 
    header('Location: index.php?mensaje=' . urlencode($mensaje));
    exit();
}

include_once 'model/conexion.php';

// Obtener los valores del formulario
$Nombre = $_POST['txtNombre'];
$Precio = $_POST['txtPrecio'];
$Cantidad = $_POST['txtCantidad'];
$Categoria = $_POST['txtCategoria'];
$Celular = $_POST['txtCelular'];

$tamanoArchivo = $_FILES['foto']['size'];
$imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
$binariosImagen = fread($imagenSubida, $tamanoArchivo);

// Conexión a la base de datos (debes definir la variable $bd)

// Consulta de inserción
$sentencia = $bd->prepare("INSERT INTO productos (Nombre, Precio, Cantidad, Categoria,Celular, Imagen) VALUES (?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$Nombre, $Precio, $Cantidad, $Categoria,$Celular, $binariosImagen]);

if ($resultado === true) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
?>
