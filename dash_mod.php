<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="./home2.php">
            <center>
                <span><img src="./img/icons/fge-icon.png" width="100"></span>
                <span class="align-middle">
                    <h4 style="font-weight: bold; color:white ">Fiscalía General del Estado de Guerrero</h4>
                </span>
            </center>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Menú
            </li>
            <!--<li class="sidebar-item" id="home">
                <a class="sidebar-link" href="./home.php">
                    <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Inicio</span>
                </a>
            </li>-->

            <?php

            if ($_SESSION['rolUsuario'] == 1 || $_SESSION['rolUsuario'] == 2) {
            ?>
                <li class="sidebar-item" id="gestionCitas">
                    <a class="sidebar-link" href="./gestionCitas.php">
                        <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Inicio</span>
                    </a>
                </li>

                <div class="dropdown-divider"></div>
                <?php
                if ($_SESSION['rolUsuario'] == 1) {
                ?>
                    <li class="sidebar-item" id="gestion_delegaciones">
                        <a class="dropdown-item sidebar-link" href="delegaciones.php">
                            <i class="align-middle" data-feather="settings"></i><span class="align-middle">Configuración</span>
                        </a>
                    </li>

                    <li class="sidebar-item" id="habilitar_horarios">
                        <a class="dropdown-item sidebar-link" href="./establecer_horarios.php">
                            <i class="align-middle" data-feather="toggle-right"></i><span class="align-middle">Habilitar Horarios</span>
                        </a>
                    </li>

                    <li class="sidebar-item" id="inhabilitar_horarios">
                        <a class="dropdown-item sidebar-link" href="./inhabilitar_horarios.php">
                            <i class="align-middle" data-feather="toggle-left"></i><span class="align-middle">Inhabilitar Días</span>
                        </a>
                    </li>
                <?php
                } else if ($_SESSION['rolUsuario'] == 2) {

                ?>
                    <li class="sidebar-item" id="gestion_citas">
                        <a class="dropdown-item sidebar-link" href="citas_delegaciones_cp.php">
                            <i class="align-middle" data-feather="list"></i><span class="align-middle">Gestión de Citas</span>
                        </a>
                    </li>
                <?php
                }
            } else if ($_SESSION['rolUsuario'] == 3) {

                ?>

                <li class="sidebar-item" id="gestionPlataforma">
                    <a class="sidebar-link" href="./gestionPlataforma.php">
                        <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Inicio</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>

                <li class="sidebar-item" id="gestion_solicitudes">
                    <a class="dropdown-item sidebar-link" href="./gestion_solicitudes_plataforma.php">
                        <i class="align-middle" data-feather="list"></i><span class="align-middle">Gestión de solicitudes</span>
                    </a>
                </li>
            <?php
            }
            ?>



            <!--<li class="sidebar-item active" id="btn1">
                <a class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <span class="align-middle"><i class="align-middle" data-feather="chevron-down"></i>DELEGACIONES</span>
                </a>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <ul class="sidebar-nav">
                        <li class="sidebar-item">
                            <a class="dropdown-item sidebar-link" href="delegaciones.php">
                                <span class="align-middle">Gestión delegación</span>
                            </a>
                        </li>
                        <li class="sidebar-item" id="g_delegacion">
                            <a class="dropdown-item sidebar-link" href="citas_delegacion.php">
                                <span class="align-middle">Gestión de Citas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>-->
        </ul>
    </div>
</nav>

<script>
    let btn1 = document.getElementById("btn1");
    let btn2 = document.getElementById("btn2");
    btn1.onclick = seleccion1;
    btn2.onclick = seleccion2;

    function seleccion1(evento) {
        let clase = btn1.className;
        if (clase == "sidebar-item") {
            btn1.className = "sidebar-item active";
        } else {
            btn1.className = "sidebar-item";
        }
    }

    function seleccion2(evento) {
        let clase = btn2.className;
        if (clase == "sidebar-item") {
            btn2.className = "sidebar-item active";
        } else {
            btn2.className = "sidebar-item";
        }
    }
</script>