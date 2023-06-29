<?php
include_once("security.php");
$config = str_replace("categorias.php", "config.php", $_SERVER['SCRIPT_FILENAME']);
require_once($config);
$conn = mysqli_connect($host, $username, $password, $dbname);

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $queryDelete = "DELETE FROM categoria WHERE id = " . $id;
    $result = mysqli_query($conn, $queryDelete);
}


if (isset($_POST['create'])) {
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion_categoria = $_POST['descripcion_categoria'];
    $reglas = $_POST['reglas'];
    $id_user = $_SESSION['id_user'];
    $queryInsert = "INSERT INTO categoria (nombre_categoria, descripcion_categoria, reglas, id_user) VALUES ('" . $nombre_categoria . "','" . $descripcion_categoria . "','" . $reglas . "', '" . $id_user . "')";
    $result = mysqli_query($conn, $queryInsert);
}

if (isset($_POST['update'])) {
    $idUpdate = $_POST['id'];
    $query = "SELECT nombre_categoria, descripcion_categoria, reglas FROM categoria WHERE id=$idUpdate";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nombre_categoria = $row['nombre_categoria'];
        $descripcion_categoria = $row['descripcion_categoria'];
        $reglas = $row['reglas'];
    }
}

if(isset($_POST['save'])){
    $id = $_POST['id'];
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion_categoria = $_POST['descripcion_categoria'];
    $reglas = $_POST['reglas'];
    $query = "UPDATE categoria SET nombre_categoria='$nombre_categoria', descripcion_categoria='$descripcion_categoria', reglas='$reglas' WHERE id=$id";
    mysqli_query($conn, $query);
}

$query = "SELECT * FROM categoria where id_user =" . $_SESSION['id_user'];
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
    Agregar nueva categoría
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva categoría</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" class="container">
                <div class="mb-3 container">
                    <label class="form-label">Nombre de la categoría:</label>
                    <input name="nombre_categoria" type="text" class="form-control" value="" required>
                </div>
                <div class="mb-3 container">
                    <label class="form-label">Descripción de la categoría:</label>
                    <input name="descripcion_categoria" type="text" class="form-control" value="" required>
                </div>
                <div class="mb-3 container">
                    <label class="form-label">Reglas para la categoría:</label>
                    <input name="reglas" type="text" class="form-control" required>
                </div>
            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="create" class="btn btn-primary">Agregar categoría <i class="bi bi-save"></i></button>
                </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="alert alert-info" role="alert">
                <h1 class="text-center">Categorias:</h1>
            </div>
        <table class="table" id="categoria_table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre de la categoría</th>
                    <th scope="col">Descripción de la categoría</th>
                    <th scope="col">Reglas de la categoría</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($categoria = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $categoria['id']; ?></td>
                            <td><?php echo $categoria['nombre_categoria']; ?></td>
                            <td><?php echo $categoria['descripcion_categoria']; ?></td>
                            <td><?php echo $categoria['reglas']; ?></td>
                            <td>
                                <form method="post" style="display: inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
                                    <button class="btn btn-danger" type="submit" name="delete"><i class="bi bi-trash"></i></button>
                                </form>
                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $categoria['id']; ?>">Update</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal<?php echo $categoria['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar categoría</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="alert alert-info" role="alert">
                                                <h1 class="text-center">Actualizar categoría:</h1>
                                            </div>
                                            <form method="POST" class="container">
                                                <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
                                                <div class="mb-3 container">
                                                    <label class="form-label">Nombre de la categoría</label>
                                                    <input name="nombre_categoria" type="text" class="form-control" value="<?php echo $categoria['nombre_categoria']; ?>" required>
                                                </div>
                                                <div class="mb-3 container">
                                                    <label class="form-label">Descripción de la categoría:</label>
                                                    <input name="descripcion_categoria" type="text" class="form-control" value="<?php echo $categoria['descripcion_categoria']; ?>" required>
                                                </div>
                                                <div class="mb-3 container">
                                                    <label class="form-label">Reglas de la categoría:</label>
                                                    <input name="reglas" type="text" class="form-control" value="<?php echo $categoria['reglas']; ?>" required>
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
                    echo '<tr><td colspan="5">No hay categorías disponibles</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
        <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- JS DataTable -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <!-- Inicialización JS -->
    <script>
    $(document).ready(function () {
        $('#categoria_table').DataTable();
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>