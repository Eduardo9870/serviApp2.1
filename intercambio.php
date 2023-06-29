<?php
include_once("security.php");
$config = str_replace("intercambio.php", "config.php", $_SERVER['SCRIPT_FILENAME']);
require_once($config);
$conn = mysqli_connect($host, $username, $password, $dbname);

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $queryDelete = "DELETE FROM intercambio WHERE id = " . $id;
    $result = mysqli_query($conn, $queryDelete);
}


if (isset($_POST['create'])) {
    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $descripcion_producto = $_POST['descripcion_producto'];
    $contacto = $_POST["contacto"];
    $id_user = $_SESSION['id_user'];
    $queryInsert = "INSERT INTO intercambio (nombre_producto, precio_producto, descripcion_producto, contacto, id_user) VALUES ('" . $nombre_producto . "','" . $precio_producto . "','" . $descripcion_producto . "', '".$contacto."', '" . $id_user . "')";
    $result = mysqli_query($conn, $queryInsert);
}

if (isset($_POST['update'])) {
    $idUpdate = $_POST['id'];
    $query = "SELECT nombre_producto, precio_producto, descripcion_producto, contacto FROM intercambio WHERE id=$idUpdate";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nombre_producto = $row['nombre_producto'];
        $precio_producto = $row['precio_producto'];
        $descripcion_producto = $row['descripcion_producto'];
        $contacto = $row['contacto'];
    }
}

if(isset($_POST['save'])){
    $id = $_POST['id'];
    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $descripcion_producto = $_POST['descripcion_producto'];
    $contacto = $_POST['contacto'];
    $query = "UPDATE intercambio SET nombre_producto='$nombre_producto', precio_producto='$precio_producto', descripcion_producto='$descripcion_producto', contacto = '$contacto' WHERE id=$id";
    mysqli_query($conn, $query);
}

$query = "SELECT intercambio.*, user.username FROM intercambio INNER JOIN user ON intercambio.id_user = user.id WHERE intercambio.id_user =" . $_SESSION['id_user'];
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Site made with Mobirise Website Builder v5.8.4, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.8.4, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="description" content="">
    <title>serviApp</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/parallax/jarallax.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets(1)/mobirise/css/mbr-additional.css" type="text/css">
</head>
<body>
    
<?php
    include_once("menu.php");
    ?>
<div class="container mt-5">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Agregar nuevo intercambio
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo intercambio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="container">
                        <div class="mb-3 container">
                            <label class="form-label">Nombre del intercambio:</label>
                            <input name="nombre_producto" type="text" class="form-control" value="" required>
                        </div>
                        <div class="mb-3 container">
                            <label class="form-label">Precio del producto para el intercambio:</label>
                            <input name="precio_producto" type="text" class="form-control" value="" required>
                        </div>
                        <div class="mb-3 container">
                            <label class="form-label">Descripcion del producto para el intercambio:</label>
                            <input name="descripcion_producto" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3 container">
                            <label class="form-label">Contacto del proveedor del intercambio:</label>
                            <input name="contacto" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="create" class="btn btn-primary">Agregar producto <i class="bi bi-save"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="alert alert-info" role="alert">
            <h1 class="text-center">Intercambios:</h1>
        </div>
        <table class="table" id="intercambio_table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del producto</th>
                    <th scope="col">Precio del producto para el intercambio</th>
                    <th scope="col">Descripción del producto para el intercambio</th>
                    <th scope="col">Contacto del proveedor del intercambio</th>
                    <th scope="col">Usuario que realiza la solicitud de intercambio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($intercambio = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $intercambio['id']; ?></td>
                            <td><?php echo $intercambio['nombre_producto']; ?></td>
                            <td><?php echo $intercambio['precio_producto']; ?></td>
                            <td><?php echo $intercambio['descripcion_producto']; ?></td>
                            <td><?php echo $intercambio['contacto']; ?></td>
                            <td><?php echo $intercambio['username']; ?></td>
                            <td>
                                <form method="post" style="display: inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $intercambio['id']; ?>">
                                    <button class="btn btn-danger" type="submit" name="delete"><i class="bi bi-trash"></i></button>
                                </form>
                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $intercambio['id']; ?>">Actualizar</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal<?php echo $intercambio['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar producto para el intercambio</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="alert alert-info" role="alert">
                                                <h1 class="text-center">Actualizar producto:</h1>
                                            </div>
                                            <form method="POST" class="container">
                                                <input type="hidden" name="id" value="<?php echo $intercambio['id']; ?>">
                                                <div class="mb-3 container">
                                                    <label class="form-label">Nombre del intercambio:</label>
                                                    <input name="nombre_producto" type="text" class="form-control" value="<?php echo $intercambio['nombre_producto']; ?>" required>
                                                </div>
                                                <div class="mb-3 container">
                                                    <label class="form-label">Precio del producto para el intercambio:</label>
                                                    <input name="precio_producto" type="text" class="form-control" value="<?php echo $intercambio['precio_producto']; ?>" required>
                                                </div>
                                                <div class="mb-3 container">
                                                    <label class="form-label">Descripcion del producto para el intercambio:</label>
                                                    <input name="descripcion_producto" type="text" class="form-control" value="<?php echo $intercambio['descripcion_producto']; ?>" required>
                                                </div>
                                                <div class="mb-3 container">
                                                    <label class="form-label">Contacto del proveedor del intercambio:</label>
                                                    <input name="contacto" type="int" class="form-control" value="<?php echo $intercambio['contacto']; ?>" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" name="save" class="btn btn-primary">Guardar cambios <i class="bi bi-save"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    echo '<tr><td colspan="5">No hay intercambios disponibles</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<!-- JS DataTable -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<!-- Inicialización JS -->
<script>
    $(document).ready(function() {
        $('#intercambio_table').DataTable();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>