<?php include 'template/header.php'; ?>

<?php
include_once "model/conexion.php";
$sentencia = $bd->query("SELECT * FROM productos");
$productos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <!-- inicio alerta -->
            <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'falta') { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Rellena todos los campos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'registrado') { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Registrado!</strong> Se agregaron los datos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Vuelve a intentar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'editado') { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Cambiado!</strong> Los datos fueron actualizados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'eliminado') { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Eliminado!</strong> Los datos fueron borrados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <!-- fin alerta -->

            <div class="card" >
                <div class="card-header">
                    Lista de productos
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Imagen</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $row) { ?>
                                <tr>
                                    <td scope="row"><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['Nombre']; ?></td>
                                    <td><?php echo $row['Precio']; ?></td>
                                    <td><?php echo $row['Cantidad']; ?></td>
                                    <td><?php echo $row['Categoria']; ?></td>
                                    <td><?php echo $row['Celular']; ?></td>
                                    <td><img width="100" src="data:image/jpg;base64,<?php echo base64_encode($row['Imagen']); ?>"></td>
                                    <td><a class="text-success" href="editar.php?codigo=<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td><a class="text-primary" href="agregarPromocion.php?codigo=<?php echo $row['id']; ?>"><i class="bi bi-cursor"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?php echo $row['id']; ?>"><i class="bi bi-trash"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos:
                </div>
                <form enctype="multipart/form-data" class="p-4" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio:</label>
                        <input type="text" class="form-control" name="txtPrecio" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad:</label>
                        <input type="text" class="form-control" name="txtCantidad" autofocus required>
                    </div>

                    <div class="row">
                     <div class="col-sm-12">
                    <div class="mb-3">
                    <label for="categorias" class="form-label">Categorias *</label>
                    <select name="txtCategoria" id="categorias" class="form-control" required>
                            <option value="electronico">electronico</option>
                            <option value="cocina">cocina</option>
                            <option value="jugueteria">jugueteria</option>
                            <option value="vestimenta">vestimenta</option>
                            <option value="deportes">deportes</option>
                    </select>
                    </div>   
                    </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Celular:</label>
                        <input type="text" class="form-control" name="txtCelular" autofocus required>
                    </div>
                    <div class="mb-3">
                    <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="file" name="foto" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<?php include 'template/footer.php' ?>