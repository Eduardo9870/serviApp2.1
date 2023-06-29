<?php
?>
<section data-bs-version="5.1" class="menu menu1 cid-tzZUd7mXGf" once="menu" id="menu1-0">
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">

                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-7" href="home.php">serviApp</a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                    <li class="nav-item"><a class="nav-link link text-black show display-4" href="" aria-expanded="true">Contactos</a></li>
                </ul>
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                    <?php
                    if ($_SESSION['id_user'] == 1) {
                        echo '<li class="nav-item"><a class="nav-link link text-black show display-4" href="categorias.php" aria-expanded="true">Categorías</a></li>';
                    }
                    ?>
                </ul>

                <div class="navbar-buttons mbr-section-btn">
                    <a class="btn btn-primary display-4" href=""> <i class="bi bi-person-circle"> Perfil de usuario</i></a>
                </div>
                <div class="navbar-buttons mbr-section-btn"><a class="btn btn-primary display-4" href="logout.php">Cerrar sesión</a></div>
            </div>
        </div>
    </nav>
</section>