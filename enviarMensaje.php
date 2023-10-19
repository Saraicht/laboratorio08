<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion, pro.id_productos, per.Nombre, per.Precio, per.Cantidad, per.Categoria, per.Celular, per.Imagen
  FROM promociones pro 
  INNER JOIN productos per ON per.id = pro.id_productos 
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$productos = $sentencia->fetch(PDO::FETCH_OBJ);

$url = 'https://api.green-api.com/waInstance7103865748/SendMessage/66e86585ee3a4f9ca8dcb4671966076dfdc025656f2245f98a';
$message = "Estimado(a) " . strtoupper($productos->Nombre) . ". No se pierda " . strtoupper($productos->promocion) . ", válido solo por " . $productos->duracion;

$data = [
    "chatId" => "51" . $productos->Celular . "@c.us",
    "message" => $message
];
$options = array(
    'http' => array(
        'method'  => 'POST',
        'content' => json_encode($data),
        'header' =>  "Content-Type: application/json\r\n" .
            "Accept: application/json\r\n"
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result);
header('Location: agregarPromocion.php?codigo=' . $productos->id_productos);
?>
