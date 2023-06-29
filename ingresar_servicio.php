<?php
include_once("security.php");
$config = str_replace("ingresar_servicio.php", "config.php", $_SERVER['SCRIPT_FILENAME']);
require_once($config);
$conn = mysqli_connect($host, $username, $password, $dbname);

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $queryDelete = "DELETE FROM servicio WHERE id = " . $id;
    $result = mysqli_query($conn, $queryDelete);
}

if (isset($_POST['create'])) {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $valor = $_POST['valor'];
    $usuario = $_SESSION['usuario'];
    $contacto = $_SESSION['contacto'];
    $queryInsert = "INSERT INTO servicio (nombre, categoria, valor, usuario, contacto) VALUES ('$nombre', '$categoria', '$valor', '$usuario', '$contacto')";
    $result = mysqli_query($conn, $queryInsert);
}

if (isset($_POST['update'])) {
    $idUpdate = $_POST['id'];
    $query = "SELECT nombre, categoria, valor FROM servicio WHERE id = $idUpdate";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row['nombre'];
        $categoria = $row['categoria'];
        $valor = $row['valor'];
    }
}

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $valor = $_POST['valor'];
    $query = "UPDATE servicio SET nombre = '$nombre', categoria = '$categoria', valor = '$valor' WHERE id = $id";
    mysqli_query($conn, $query);
}

$query = "SELECT * FROM servicio WHERE usuario = '" . $_SESSION['usuario'] . "'";
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
            Agregar nuevo servicio
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo servicio</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" class="container">
                            <div class="mb-3 container">
                                <label class="form-label">Nombre del servicio:</label>
                                <input name="nombre" type="text" class="form-control" value="" required>
                            </div>
                            <div class="mb-3 container">
                                <label class="form-label">Categoría:</label>
                                <select name="categoria" class="form-control" required>
                                    <option value="">Seleccione una categoría</option>
                                    <?php
                                    $query = "SELECT id, nombre_categoria FROM categoria";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $idCategoria = $row['id'];
                                        $nombreCategoria = $row['nombre_categoria'];
                                        echo '<option value="' . $idCategoria . '">' . $nombreCategoria . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3 container">
                                <label class="form-label">Valor del servicio:</label>
                                <input name="valor" type="text" class="form-control" required>
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
            <h1 class="text-center">Servicios:</h1>
        </div>
        <table class="table" id="ingresar_servicio_table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del servicio</th>
                    <th scope="col">Categoría del servicio</th>
                    <th scope="col">Valor del servicio</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($servicio = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $servicio['id']; ?></td>
                            <td><?php echo $servicio['nombre']; ?></td>
                            <td><?php echo $servicio['categoria']; ?></td>
                            <td><?php echo $servicio['valor']; ?></td>
                            <td><?php echo $servicio['usuario']; ?></td>
                            <td><?php echo $servicio['contacto']; ?></td>
                            <td>
                                <form method="post" style="display: inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $servicio['id']; ?>">
                                    <button class="btn btn-danger" type="submit" name="delete"><i class="bi bi-trash"></i></button>
                                </form>
                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $servicio['id']; ?>">Actualizar</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal<?php echo $servicio['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar servicios</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="alert alert-info" role="alert">
                                                <h1 class="text-center">Actualizar servicio:</h1>
                                            </div>
                                            <form method="POST" class="container">
                                                <input type="hidden" name="id" value="<?php echo $servicio['id']; ?>">
                                                <div class="mb-3 container">
                                                    <label class="form-label">Nombre del servicio:</label>
                                                    <input name="nombre" type="text" class="form-control" value="<?php echo $servicio['nombre']; ?>" required>
                                                </div>
                                                <div class="mb-3 container">
                                                    <label class="form-label">Categoría del servicio:</label>
                                                    <select name="categoria" class="form-control" required>
                                                        <?php
                                                        $query = "SELECT id, nombre_categoria FROM categoria";
                                                        $result = mysqli_query($conn, $query);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            // ...
                                                            $selected = ($row['id'] == $servicio['categoria']) ? 'selected' : '';
                                                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['nombre_categoria'] . '</option>';
                                                            // ...
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 container">
                                                    <label class="form-label">Valor del servicio:</label>
                                                    <input name="valor" type="int" class="form-control" value="<?php echo $servicio['valor']; ?>" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" name="save" class="btn btn-primary">Guardar cambios<i class="bi bi-save"></i></button>
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
                    echo '<tr><td colspan="5">No hay servicios disponibles</td></tr>';
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
        $(document).ready(function() {
            $('#ingresar_servicio_table').DataTable();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>