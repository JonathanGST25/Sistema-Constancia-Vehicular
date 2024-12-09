<!-- PAGINACION --->
<div class="row mt-3 mx-auto form-group">
    <?php
    if ($conteo > 0) {
    ?>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <label class="justify-content-start mt-1 text-secondary">Mostrando <?php echo $conteo ?> de <?php echo $conteo ?> registros</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 text-center">
            <p>Página <?php echo $pagina ?> de <?php echo $paginas ?> </p>
        </div>
    <?php
    } else {
    ?>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <label class="justify-content-start mt-1 text-secondary">No hay registros a mostrar.</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 text-center">
            <p>Información no disponible.</p>
        </div>
    <?php
    }
    ?>

    <div class="col-lg-4 col-md-4 col-sm-6 d-flex justify-content-end">
        <label>Refrescar</label>
        <button type="button" style="border: none; background: none;" class="d-flex justify-content-right mt-1" id="refrescar">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
            </svg>
        </button>
    </div>

    <div class="d-flex justify-content-end col-lg-6-col-md-6 col-sm-12">
        <label class="text-secondary" id="fecha_consulta">Última hora de actualización: <?php echo substr($fecha_consulta_cita, -8) ?></label>
    </div>

    <div class="col-lg-12 col-md-4 col-sm-6 alig-items-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <?php if ($pagina > 1) { ?>
                        <!-- PAGINACION PARA BUSCAR VEHICULO POR PLACAS O NÚMERO DE SERIE -->
                        <?php
                        if (isset($_GET['numeroVehiculo'])) {
                        ?>
                            <a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $pagina - 1 ?>&numeroVehiculo=<?php echo $numeroVehiculo ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        <?php
                        } else if (isset($_GET['fechaRegistroCita'])) {
                        ?>
                            <!-- PAGINACION PARA BUSCAR POR FECHA DE REGISTRO -->
                            <a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $pagina - 1 ?>&fechaRegistroCita=<?php echo $fechaRegistroCita ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        <?php
                        } else if (isset($_GET['fechaCita'])) {
                        ?>
                            <!-- PAGINACION PARA BUSCAR POR FECHA DE LA CITA -->
                            <a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $pagina - 1 ?>&fechaCita=<?php echo $fechaCita ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        <?php
                        } else {
                        ?>
                            <a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $pagina - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        <?php
                        }
                        ?>

                </li>
            <?php } ?>

            <?php
            $numeroInicio = 1;

            if (($pagina - 4) > 1) {
                $numeroInicio = $pagina - 4;
            }

            $numeroFin = $numeroInicio + 9;

            if ($numeroFin > $paginas) {
                $numeroFin = $paginas;
            }

            for ($x = $numeroInicio; $x <= $numeroFin; $x++) {
                if (isset($_GET['numeroVehiculo'])) {
                    if ($pagina == $x) {
            ?>
                        <li class="page-item active"><a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $x ?>&numeroVehiculo=<?php echo $numeroVehiculo ?>"><?php echo $x ?></a></li>
                    <?php
                    } else {
                    ?>
                        <!-- PAGINACION PARA BUSCAR VEHICULO POR PLACAS O NÚMERO DE SERIE -->
                        <li class="page-item"><a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $x ?>&numeroVehiculo=<?php echo $numeroVehiculo ?>"><?php echo $x ?></a></li>
                    <?php

                    }
                } else if (isset($_GET['fechaRegistroCita'])) {
                    if ($pagina == $x) {
                    ?>
                        <!-- PAGINACION PARA BUSCAR POR FECHA DE REGISTRO -->
                        <li class="page-item active"><a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $x ?>&fechaRegistroCita=<?php echo $fechaRegistroCita ?>"><?php echo $x ?></a></li>
                    <?php
                    } else {
                    ?>
                        <!-- PAGINACION PARA BUSCAR POR FECHA DE REGISTRO -->
                        <li class="page-item"><a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $x ?>&fechaRegistroCita=<?php echo $fechaRegistroCita ?>"><?php echo $x ?></a></li>
                    <?php
                    }
                } else if (isset($_GET['fechaCita'])) {
                    if ($pagina == $x) {
                    ?>
                        <!-- PAGINACION PARA BUSCAR POR FECHA DE LA CITA -->
                        <li class="page-item active"><a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $x ?>&fechaCita=<?php echo $fechaCita ?>"><?php echo $x ?></a></li>
                    <?php
                    } else {
                    ?>
                        <!-- PAGINACION PARA BUSCAR POR FECHA DE LA CITA -->
                        <li class="page-item"><a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $x ?>&fechaCita=<?php echo $fechaCita ?>"><?php echo $x ?></a></li>
                    <?php
                    }
                } else {
                    if ($pagina == $x) {
                    ?>
                        <!-- PAGINACION PARA MOSTRAR TODOS LOS RESULTADOS -->
                        <li class="page-item active"><a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $x ?>"><?php echo $x ?></a></li>
                    <?php
                    } else {
                    ?>
                        <!-- PAGINACION PARA MOSTRAR TODOS LOS RESULTADOS -->
                        <li class="page-item"><a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $x ?>"><?php echo $x ?></a></li>
            <?php
                    }
                }
            }
            ?>

            <?php if ($pagina < $paginas) { ?>

                <?php
                if (isset($_GET['numeroVehiculo'])) {
                ?>
                    <!-- PAGINACION PARA BUSCAR VEHICULO POR PLACAS O NÚMERO DE SERIE -->
                    <li class="page-item">
                        <a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $pagina + 1 ?>&numeroVehiculo=<?php echo $numeroVehiculo ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php
                } else if (isset($_GET['fechaRegistroCita'])) {
                ?>
                    <!-- PAGINACION PARA BUSCAR POR FECHA DE REGISTRO -->
                    <li class="page-item">
                        <a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $pagina + 1 ?>&fechaRegistroCita=<?php echo $fechaRegistroCita ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php
                } else if (isset($_GET['fechaCita'])) {
                ?>
                    <!-- PAGINACION PARA BUSCAR POR FECHA DE LA CITA -->
                    <li class="page-item">
                        <a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $pagina + 1 ?>&fechaCita=<?php echo $fechaCita ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php
                } else {
                ?>
                    <!-- PAGINACION PARA MOSTRAR TODOS LOS RESULTADOS -->
                    <li class="page-item">
                        <a class="page-link" href="./citas_delegacion.php?pagina=<?php echo $pagina + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
            </ul>
        </nav>
    </div>
</div>
<!-- FIN PAGINACION -->