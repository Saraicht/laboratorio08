<?php include 'template/header.php';?>

<?php
    if (!isset($_GET['codigo'])) {
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once 'model/conexion.php';
    $codigo = $_GET['codigo'];

    // Utiliza el mismo nombre de columna en la base de datos
    $sentencia = $bd->prepare("select * from productos where id = ?;");
    $sentencia->execute([$codigo]);
    $producto = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Editar datos:</div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="txtNombre" required value="<?php echo $producto->Nombre; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio:</label>
                        <input type="text" class="form-control" name="txtPrecio" required value="<?php echo $producto->Precio; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad:</label>
                        <input type="text" class="form-control" name="txtCantidad" required value="<?php echo $producto->Cantidad; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoria:</label>
                        <input type="text" class="form-control" name="txtCategoria" required value="<?php echo $producto->Categoria; ?>">
                    </div>
                    
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $producto->id; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>
