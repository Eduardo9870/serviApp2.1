<?php
include_once("security.php");
$config = str_replace("limpieza.php", "config.php", $_SERVER['SCRIPT_FILENAME']);
require_once($config);
$conn = mysqli_connect($host, $username, $password, $dbname);

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $queryDelete = "DELETE FROM servicios WHERE id = " . $id;
    $result = mysqli_query($conn, $queryDelete);
}
if (isset($_POST['update'])) {
    $idUpdate = $_POST['id'];
    $query = "SELECT name, email, tipo_servicio, proveedor, direccion, fecha, hora, descripcion_servicio FROM servicios WHERE id=$idUpdate";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $email = $row['email'];
        $tipo_servicio = $row['tipo_servicio'];
        $proveedor = $row['proveedor'];
        $direccion = $row['direccion'];
        $fecha = $row['fecha'];
        $hora = $row['hora'];
        $descripcion_servicio = $row['descripcion_servicio'];
    }
}

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tipo_servicio = $_POST['tipo_servicio'];
    $proveedor = $_POST['proveedor'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $descripcion_servicio = $_POST['descripcion_servicio'];
    $queryUpdate = "UPDATE servicios SET name='$name', email='$email', tipo_servicio='$tipo_servicio', proveedor='$proveedor', direccion='$direccion', fecha='$fecha', hora='$hora', descripcion_servicio='$descripcion_servicio' WHERE id=$id";
    $result = mysqli_query($conn, $queryUpdate);
}

$query = "SELECT * FROM servicios WHERE tipo_servicio IN ('limpieza de muebles', 'limpieza de hogar', 'lavado de automóviles') AND id_user =" . $_SESSION['id_user'];
$result = mysqli_query($conn, $query);
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>serviApp-Reserva</title>
</head>

<body class="p-5 m-5 border-0 bd-example container">
    <div class="container">
        <div class="alert alert-info" role="alert">
            <h1 class="text-center">Reservas mantenimiento:</h1>
        </div>
        <div class="container mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del cliente</th>
                        <th scope="col">Email</th>
                        <th scope="col">Servicios</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($servicios = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?= $servicios['id'] ?></td>
                                <td><?= $servicios['name'] ?></td>
                                <td><?= $servicios['email'] ?></td>
                                <td><?= $servicios['tipo_servicio'] ?></td>
                                <td><?= $servicios['proveedor'] ?></td>
                                <td><?= $servicios['direccion'] ?></td>
                                <td><?= $servicios['fecha'] ?></td>
                                <td><?= $servicios['hora'] ?></td>
                                <td><?= $servicios['descripcion_servicio'] ?></td>
                                <td>
                                    <form method="post" style="display: inline-block;">
                                        <input type="hidden" name="id" value="<?= $servicios['id'] ?>">
                                        <button class="btn btn-danger" type="submit" name="delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                    <form method="post" style="display: inline-block;">
                                        <input type="hidden" name="id" value="<?= $servicios['id'] ?>">
                                        <input class="btn btn-info" type="submit" name="update" value="Update">
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="container">
            <a href="home.php" class="btn btn-outline-info">Volver <i class="bi bi-reply-all"></i></a>
            <a href="reserva.php" class="btn btn-outline-primary">Reservar <i class="bi bi-arrow-right-square-fill"></i></a>
        </div>
        <?php
        if (isset($idUpdate)) {
        ?>
            <div class="container">
                <div class="alert alert-info" role="alert">
                    <h1 class="text-center">Actualizar reservas:</h1>
                </div>
                <form method="POST" class="container">
                    <input type="hidden" name="id" value="<?php echo $idUpdate; ?>">
                    <div class="mb-3 container">
                        <label class="form-label">Nombre del cliente:</label>
                        <input name="name" type="text" class="form-control" value="<?php echo $name; ?>" required>
                    </div>
                    <div class=" mb-3 container">
                        <label class="form-label">Email:</label>
                        <input name="email" type="email" class="form-control" value="<?php echo $email; ?>" required>
                    </div>
                    <div class=" mb-3 container">
                        <label class="form-label">Servicios:</label>
                        <select name="tipo_servicio" class="form-select" value="<?php echo $tipo_servicio; ?>" required>
                            <option value="">Seleccionar servicio</option>
                            <option value="Lavado de automóviles">Lavado de automóviles</option>
                            <option value="Mantenimiento de automóviles">Mantenimiento de automóviles</option>
                            <option value="Reparación de bicicletas">Reparación de bicicletas</option>
                            <option value="Reparación general">Reparación general</option>
                            <option value="Limpieza de hogar">Limpieza de hogar</option>
                            <option value="Limpieza muebles">Limpieza muebles</option>
                            <option value="Mantenimiento de bicicletas">Mantenimiento de bicicletas</option>
                        </select>
                    </div>
                    <div class="mb-3 container">
                        <label class="form-label">Proveedor:</label>
                        <input name="proveedor" type="text" class="form-control" value="<?php echo $proveedor; ?>" required>
                    </div>
                    <div class="mb-3 container">
                        <label class="form-label">Dirección:</label>
                        <input name="direccion" type="text" class="form-control" value="<?php echo $direccion; ?>" required>
                    </div>
                    <div class="mb-3 container">
                        <label class="form-label">Fecha:</label>
                        <input name="fecha" type="date" class="form-control" value="<?php echo $fecha; ?>" required>
                    </div>
                    <div class="mb-3 container">
                        <label class="form-label">Hora:</label>
                        <input name="hora" type="time" class="form-control" value="<?php echo $hora; ?>" required>
                    </div>
                    <div class="mb-3 container">
                        <label class="form-label">Descripción:</label>
                        <textarea name="descripcion_servicio" class="form-control" required><?php echo $descripcion_servicio; ?></textarea>
                    </div>
                    <div class="mb-3 container">
                        <input type="submit" name="save" value="Guardar cambios" class="btn btn-info">
                    </div>
                </form>
            </div>
        <?php
        }
        ?>
</body>

</html>