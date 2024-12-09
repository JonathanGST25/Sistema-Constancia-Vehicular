<?php
date_default_timezone_set('America/Mexico_City');
include('../conexion.php');

//RECUPERAR PÁGINA ACTUAL, SI NO LA PÁGINA POR DEFECTO ES 1
if (isset($_GET["pagina"])) {
    $pagina_actual = $_GET["pagina"];
} else {
    $pagina_actual = 1;
}

//DEFINE LA CANTIDAD DE REGISTROS POR PÁGINA
$registros_por_pagina = 10;

//DEFINE LA CANTIDAD DE REGISTROS DE LA PÁGINA ACTUAL
$total_reg_pag_act = 0;

//VARIABLES PARA BUSQUEDAS
$numeroVehiculo = "";

//BANDERA PARA SABER CUANDO SE EJECUTA LA CONSULTA
$bandera = 0;
$fechaHoy = DATE('Y-m-d');

//EN CASO DE BUSQUEDA POR CARACTERISTICAS DEL VEHICULO 
if (isset($_GET['search']) && $_GET['search']!='') {
    $numeroVehiculo = $_GET['search'];
    $consulta = "SELECT count(*) AS conteo FROM Citas, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND (Vehiculos.numeroPlacas LIKE '%$numeroVehiculo%' OR 
    Vehiculos.numeroSerie LIKE '%$numeroVehiculo%' OR Vehiculos.numeroMotor LIKE '%$numeroVehiculo%') AND Catalogo_Marca.marcaId = Vehiculos.marcaId AND Citas.estatusPlataId != 'NULL'";
    $resultado = mysqli_query($conexion, $consulta);
    $consulta = mysqli_fetch_array($resultado);
    $total_registros = $consulta['conteo'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    //CALCULA EL REGISTRO INICIAL Y FINAL DE LA PÁGINA ACTUAL
    $registro_inicial = ($pagina_actual - 1) * $registros_por_pagina;
    $registro_final = $registro_inicial + $registros_por_pagina - 1;

    $sql = "SELECT Citas.citaId, Catalogo_Marca.descripcion, Vehiculos.numeroSerie, Vehiculos.numeroPlacas, Vehiculos.numeroMotor, Citas.fecha_sol_plata, Citas.estatusPlataId, 
    IFNULL(Citas.reportePlataId, 0) reportePlataId FROM Citas, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND (Vehiculos.numeroPlacas LIKE '%$numeroVehiculo%' OR 
    Vehiculos.numeroSerie LIKE '%$numeroVehiculo%' OR Vehiculos.numeroMotor LIKE '%$numeroVehiculo%') AND Catalogo_Marca.marcaId = Vehiculos.marcaId AND Citas.estatusPlataId != 'NULL' ORDER BY Citas.fecha_sol_plata DESC LIMIT $registro_inicial, $registros_por_pagina";
    $resultCitas = mysqli_query($conexion, $sql);
    $bandera = 1;

    //OBTENER LA CANTIDAD DE REGISTROS A MOSTRAR EN LA PÁGINA ACTUAL
    $total_reg_pag_act = mysqli_num_rows($resultCitas);

}

//CARGAR TODAS LAS CITAS EN GENERAL
if ($bandera != 1) {
    $numeroVehiculo = "";
    $consulta = "SELECT count(*) AS conteo FROM Citas, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId AND
    Citas.estatusPlataId != 'NULL' AND DATE(Citas.fecha_sol_plata) = '$fechaHoy'";
    $resultado = mysqli_query($conexion, $consulta);
    $consulta = mysqli_fetch_array($resultado);
    $total_registros = $consulta['conteo'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    //CALCULA EL REGISTRO INICIAL Y FINAL DE LA PÁGINA ACTUAL
    $registro_inicial = ($pagina_actual - 1) * $registros_por_pagina;
    $registro_final = $registro_inicial + $registros_por_pagina - 1;

    $sql = "SELECT Citas.citaId, Catalogo_Marca.descripcion, Vehiculos.numeroSerie, Vehiculos.numeroPlacas, Vehiculos.numeroMotor, Citas.fecha_sol_plata, Citas.estatusPlataId, 
    IFNULL(Citas.reportePlataId, 0) reportePlataId FROM Citas, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId 
    AND Citas.estatusPlataId != 'NULL' AND DATE(Citas.fecha_sol_plata) = '$fechaHoy' ORDER BY Citas.fecha_sol_plata DESC LIMIT $registro_inicial, $registros_por_pagina";
    $resultCitas = mysqli_query($conexion, $sql);

    //OBTENER LA CANTIDAD DE REGISTROS A MOSTRAR EN LA PÁGINA ACTUAL
    $total_reg_pag_act = mysqli_num_rows($resultCitas);
}

//VALIDACIÓN PARA MOSTRAR EL RESULTADO
if ($resultCitas) {
    //CREA LA ESTRUCTURA DE LA TABLA
    echo '<table class="table table-striped mb-0 text-center table-sm table-hover" id="solicitudesCitas">';
    echo '<thead style="background-color: #002d72;" class="text-white">';
    echo '<tr class="col-lg-12 col-md-4 col-sm-12" style="vertical-align: middle; font-size: 15px;">';
    echo '<th scope="col">Vehiculo</th>';
    echo '<th scope="col">No.Serie</th>';
    echo '<th scope="col">No.Placas</th>';
    echo '<th scope="col">No.Motor</th>';
    echo '<th scope="col">Fecha de Solicitud</th>';
    echo '<th scope="col">Estatus de la Cita</th>';
    echo '<th scope="col">Detalles de Cita</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    //MUESTRA LOS DATOS EN LA TABLA
    while ($fila = mysqli_fetch_assoc($resultCitas)) {

        /*if($fila['estatusPlataId'] == 1){
            echo '<tr class=" p-2 border-light rounded-circle" style="background: #F1F5FC;">';
        }else{
            echo '<tr class=" p-2 border-light rounded-circle">';
        }*/
        echo '<tr class=" p-2 border-light rounded-circle">';
        echo '<td scope="row" hidden>'. $fila['citaId'] .'</td>';
        echo '<td scope="row" style="font-size: 13px;">' . $fila['descripcion'] . '</td>';
        echo '<td scope="row" style="font-size: 13px;">' . $fila['numeroSerie'] . '</td>';
        echo '<td scope="row" style="font-size: 13px;">' . $fila['numeroPlacas'] . '</td>';
        echo '<td scope="row" style="font-size: 13px;">' . $fila['numeroMotor'] . '</td>';
        echo '<td scope="row" style="font-size: 13px;">' . $fila['fecha_sol_plata'] . '</td>';

        //MOSTRAR ESTILO BOTON DEPENDIENDO DEL ESTADO DE LA CITA EN PLATAFORMA
        if ($fila['estatusPlataId'] == 1) {
            echo '<td>
                    <a href="#" class="btn btn-sm btn-primary" style="width: 130px; font-size: 12px; pointer-events: none;">SOLICITUD RECIBIDA</a>
                </td>';
        } else if ($fila['estatusPlataId'] == 2) {
            echo ' <td>
                        <a href="#" class="btn btn-sm btn-success" style="width: 130px; font-size: 12px; pointer-events: none;">EN TRÁMITE</a>
                </td>';
        }else if($fila['estatusPlataId'] == 3){
            echo '<td>
                    <a href="#" class="btn btn-sm btn-secondary" style="width: 130px; font-size: 12px; pointer-events: none;">CONCLUIDO</a>
                </td>';
        }

        echo '<td scope="row" class="position-relative">';
        if($fila['estatusPlataId'] == 1){
            echo '<span class="position-absolute alerta top-0 start-100 p-1 translate-middle badge rounded-circle bg-danger">
                    +1
                    <span class="visually-hidden">unread messages</span>
                </span>';
        }
            echo '<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background:none; border:none;" onclick="consultarCitaEspecifica()"><i class="fas fa-eye"></i>
                </button>
            </td>';
        echo '</tr>';
    }

    //PAGINACIÓN DE REGISTROS
    if ($total_registros <= 0) {
        echo '<td colspan="11">
                <center><label>No existe información disponible o registros en la base de datos.</label></label></center>
            </td>';
    }
    echo '</tbody>';
    echo '</table>';

    echo '<div class="row mt-3 mx-auto form-group">';
    if ($total_registros > 0) {
        echo '<div class="col-lg-4 col-md-4 col-sm-6">
                <label class="justify-content-start mt-1 text-secondary">Mostrando ' . $total_reg_pag_act . ' - ' .$registros_por_pagina .' de un total de ' . $total_registros . ' registros</label>
            </div>';
        echo '<div class="col-lg-4 col-md-4 col-sm-6 text-center">
                <p>Página ' . $pagina_actual . ' de ' . $total_paginas . '</p>
            </div>';
    } else {
        echo '<div class="col-lg-4 col-md-4 col-sm-6">
                <label class="justify-content-start mt-1 text-secondary">No hay registros a mostrar.</label>
            </div>';

        echo '<div class="col-lg-4 col-md-4 col-sm-6 text-center">
                <p>Información no disponible.</p>
            </div>';
    }

    echo '<div class="col-lg-12 col-md-4 col-sm-6 alig-items-center">';
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination justify-content-center">';

     //MUESTRA EL BOTÓN "ANTERIOR"
     if ($pagina_actual > 1) {
        echo '<li class="page-item">';
        echo '<a class="page-link" href="gestion_solicitudes_plataforma.php?search=' . $numeroVehiculo . '&pagina=' . ($pagina_actual - 1) . '" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>';
        echo '</li>';
    }

    //LIMITAR EL NÚMERO DE CUADROS DE PÁGINAS
    $numeroInicio = 1;

    if (($pagina_actual - 4) > 1) {
        $numeroInicio = $pagina_actual - 4;
    }

    $numeroFin = $numeroInicio + 9;

    if ($numeroFin > $total_paginas) {
        $numeroFin = $total_paginas;
    }

    //MUESTRA LOS NÚMEROS DE LAS PÁGINAS
    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        if ($pagina_actual == $i) {
            echo '<li class="page-item active"><a class="page-link" href="gestion_solicitudes_plataforma.php?search=' . $numeroVehiculo . '&pagina=' . $i . '">' . $i . '</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="gestion_solicitudes_plataforma.php?search=' . $numeroVehiculo . '&pagina=' . $i . '">' . $i . '</a></li>';
        }
    }

     //MUESTRA EL BOTÓN "SIGUIENTE"
     if ($pagina_actual < $total_paginas) {
        echo '<li class="page-item">';
        echo '<a class="page-link" href="gestion_solicitudes_plataforma.php?search=' . $numeroVehiculo . '&pagina=' . ($pagina_actual + 1) . '" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span></a>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
    echo '</div>';
    echo '</div>';

    mysqli_close($conexion);

}

?>
