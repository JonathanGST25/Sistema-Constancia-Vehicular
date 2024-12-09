<?php
include("../conexion.php");

//RECUPERAR LA PÁGINA ACTUAL
if (isset($_GET["pagina"])) {
    $pagina_actual = $_GET["pagina"];
} else {
    $pagina_actual = 1;
}

//DEFINE LA CANTIDAD DE REGISTROS POR PÁGINA
$registros_por_pagina = 10;

//DEFINE LA CANTIDAD DE REGISTROS EN LA PÁGINA ACTUAL
$total_reg_pag_act = 0;

//RECUPERA EL ID DE LA DELEGACIÓN
$delegacionId = $_GET['delegacionId'];

$fechaRegistro = "";
$fechaCita = "";

//BÚSQUEDA POR FECHA DE REGISTRO DE LA CITA
if (isset($_GET['fechaRegistro']) && $_GET['fechaRegistro'] != '') {
    $fechaRegistro = $_GET['fechaRegistro'];
    $fechaCita = "";
    $consulta = "SELECT count(*) AS conteo FROM Citas, Delegaciones, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId 
    AND Citas.delegacionId = Delegaciones.delegacionId AND Citas.fechaRegistro = '$fechaRegistro' AND Delegaciones.delegacionId = '$delegacionId'";
    $resultado = mysqli_query($conexion, $consulta);
    $consulta = mysqli_fetch_array($resultado);
    $total_registros = $consulta['conteo'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    //CALCULA EL REGISTRO INICIAL Y FINAL DE LA PÁGINA ACTUAL
    $registro_inicial = ($pagina_actual - 1) * $registros_por_pagina;
    $registro_final = $registro_inicial + $registros_por_pagina - 1;

    $sql = "SELECT Citas.citaId, Citas.fechaRegistro, Citas.fechaCita, IFNULL(Citas.estatusPlataId, 0) estatusPlataId, IFNULL(Citas.reportePlataId, 0) reportePlataId, Catalogo_Marca.descripcion, Citas.estatusCitaId, Vehiculos.numeroSerie, Vehiculos.numeroPlacas, 
    Vehiculos.numeroMotor FROM Citas, Delegaciones, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId 
    AND Citas.delegacionId = Delegaciones.delegacionId AND Citas.fechaRegistro = '$fechaRegistro' AND Delegaciones.delegacionId = '$delegacionId' ORDER BY Citas.estatusCitaId ASC LIMIT  $registro_inicial, $registros_por_pagina";
    $resultCitas = mysqli_query($conexion, $sql);

    //OBTENER LA CANTIDAD DE REGISTROS A MOSTRAR EN LA PÁGINA ACTUAL
    $consultarRegistros = "SELECT COUNT(*) AS totalRegistros FROM Citas, Delegaciones, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId 
    AND Citas.delegacionId = Delegaciones.delegacionId AND Citas.fechaRegistro = '$fechaRegistro' AND Delegaciones.delegacionId = '$delegacionId' ORDER BY Citas.estatusCitaId ASC LIMIT  $registro_inicial, $registros_por_pagina";
    $resultRegistros = mysqli_query($conexion, $consultarRegistros);
    $row = mysqli_fetch_assoc($resultRegistros);

    $total_reg_pag_act = $row['totalRegistros'];
    
    //$total_reg_pag_act = mysqli_num_rows($resultCitas);
}

//BÚSQUEDA POR FECHA DE LA CITA
if (isset($_GET['fechaCita']) && $_GET['fechaCita'] != '') {
    $fechaRegistro = "";
    $fechaCita = $_GET['fechaCita'];
    $consulta = "SELECT count(*) AS conteo FROM Citas, Delegaciones, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId 
    AND Citas.delegacionId = Delegaciones.delegacionId AND Citas.fechaCita = '$fechaCita' AND Delegaciones.delegacionId = '$delegacionId'";
    $resultado = mysqli_query($conexion, $consulta);
    $consulta = mysqli_fetch_array($resultado);
    $total_registros = $consulta['conteo'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    //CALCULA EL REGISTRO INICIAL Y FINAL DE LA PÁGINA ACTUAL
    $registro_inicial = ($pagina_actual - 1) * $registros_por_pagina;
    $registro_final = $registro_inicial + $registros_por_pagina - 1;

    $sql = "SELECT Citas.citaId, Citas.fechaRegistro, IFNULL(Citas.estatusPlataId, 0) estatusPlataId, IFNULL(Citas.reportePlataId, 0) reportePlataId, Citas.fechaCita, Catalogo_Marca.descripcion, Citas.estatusCitaId, Vehiculos.numeroSerie, Vehiculos.numeroPlacas, 
    Vehiculos.numeroMotor FROM Citas, Delegaciones, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId 
    AND Citas.delegacionId = Delegaciones.delegacionId AND Citas.fechaCita = '$fechaCita' AND Delegaciones.delegacionId = '$delegacionId' ORDER BY Citas.estatusCitaId ASC LIMIT $registro_inicial, $registros_por_pagina";
    $resultCitas = mysqli_query($conexion, $sql);

    //OBTENER LA CANTIDAD DE REGISTROS A MOSTRAR EN LA PÁGINA ACTUAL
    $consultarRegistros = "SELECT COUNT(*) AS totalRegistros FROM Citas, Delegaciones, Vehiculos, Catalogo_Marca WHERE Vehiculos.vehiculoId = Citas.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId 
    AND Citas.delegacionId = Delegaciones.delegacionId AND Citas.fechaCita = '$fechaCita' AND Delegaciones.delegacionId = '$delegacionId' ORDER BY Citas.estatusCitaId ASC LIMIT $registro_inicial, $registros_por_pagina";
    $resultRegistros = mysqli_query($conexion, $consultarRegistros);
    $row = mysqli_fetch_assoc($resultRegistros);

    $total_reg_pag_act = $row['totalRegistros'];
    //$total_reg_pag_act = mysqli_num_rows($resultCitas);
}

if ($resultCitas) {
    //CREA LA ESTRUCTURA DE LA TABLA
    echo '<table class="table table-striped mb-0 text-center table-sm table-hover" id="tableCitas">';
    echo '<thead style="background-color: #002d72;" class="text-white">';
    echo '<tr class="col-lg-12 col-md-4 col-sm-12" style="vertical-align: middle; font-size: 15px;">';
    echo '<th scope="col" hidden>No.Cita</th>';
    echo '<th scope="col">Vehiculo</th>';
    echo '<th scope="col">No.Serie</th>';
    echo '<th scope="col">No.Placas</th>';
    echo '<th scope="col">No.Motor</th>';
    echo '<th scope="col">Estatus de la Cita</th>';
    echo '<th scope="col">Estatus plataforma</th>';
    echo '<th scope="col">Detalles de Cita</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    //OBTIENE LA INFORMACIÓN Y LA MUESTRA EN LA TABLA
    while ($fila = mysqli_fetch_assoc($resultCitas)) {
        echo '<tr class=" p-2 border-light rounded-circle">';
        echo '<td scope="row" hidden>' . $fila['citaId'] . '</td>';
        echo '<td scope="row" style="font-size: 13px;">' . $fila['descripcion'] . '</td>';
        echo '<td scope="row" style="font-size: 13px;">' . $fila['numeroSerie'] . '</td>';
        echo '<td scope="row" style="font-size: 13px;">' . $fila['numeroPlacas'] . '</td>';
        echo '<td scope="row" style="font-size: 13px;">' . $fila['numeroMotor'] . '</td>';

        //CONSULTAR ESTADO DE LA CITA
        $citaId = $fila['citaId'];
        $sql = "SELECT descripcion FROM Citas, Delegaciones, Catalogo_Estatus_Cita WHERE Citas.delegacionId = Delegaciones.delegacionId AND Delegaciones.delegacionId
        = '$delegacionId' AND Catalogo_Estatus_Cita.estatusCitaId = Citas.estatusCitaId AND Citas.citaId = '$citaId'";
        $resultEstatusCita = mysqli_query($conexion, $sql);
        $mostrarEstatusCita = mysqli_fetch_array($resultEstatusCita);

        if ($fila['estatusCitaId'] == 1) {
            echo '<td>
                    <a href="#" class="btn btn-sm btn-primary" style="width: 130px; font-size: 12px; pointer-events: none;">' . $mostrarEstatusCita['descripcion'] . '</a>
                </td>';
        } else if ($fila['estatusCitaId'] == 2) {
            echo '<td>
                    <a href="#" class="btn btn-sm btn-warning" style="width: 130px; font-size: 12px; pointer-events: none;">' . $mostrarEstatusCita['descripcion'] . '</a>
                </td>';
        } else if ($fila['estatusCitaId'] == 3) {
            echo ' <td>
                        <a href="#" class="btn btn-sm btn-success" style="width: 130px; font-size: 12px; pointer-events: none;">' . $mostrarEstatusCita['descripcion'] . '</a>
                </td>';
        } else if ($fila['estatusCitaId'] == 4) {
            echo '<td>
                    <a href="#" class="btn btn-sm btn-secondary" style="width: 130px; font-size: 12px; pointer-events: none;">' . $mostrarEstatusCita['descripcion'] . '</a>
                </td>';
        } else if ($fila['estatusCitaId'] == 16) {
            echo '<td>
                    <a href="#" class="btn btn-sm btn-danger" style="width: 130px; font-size: 12px; pointer-events: none;">' . $mostrarEstatusCita['descripcion'] . '</a>
                </td>';
        } else if($fila['estatusCitaId'] == 17){
            echo '<td>
                    <a href="#" class="btn btn-sm btn-danger" style="width: 130px; font-size: 12px; pointer-events: none;">' . $mostrarEstatusCita['descripcion'] . '</a>
                </td>';
        }

        $estatusPlataId = $fila['estatusPlataId'];
        $citaId = $fila['citaId'];

        //CONSULTAR ESTADO DE LA CITA EN PLATAFORMA
        if ($estatusPlataId != 0) {
            $sql = "SELECT descripcion FROM Citas, Delegaciones, Catalogo_Plata_Estatus WHERE Citas.delegacionId = Delegaciones.delegacionId AND Delegaciones.delegacionId
            = '$delegacionId' AND Catalogo_Plata_Estatus.estatusPlataId = Citas.estatusPlataId AND Citas.citaId = '$citaId'";
            $resultEstatusPlataforma = mysqli_query($conexion, $sql);
            $mostrarEstatusPlataforma = mysqli_fetch_array($resultEstatusPlataforma);
            if ($estatusPlataId == 1) {
                echo '<td>
                        <a href="#" class="btn btn-sm btn-success" style="width: 130px; font-size: 12px; pointer-events: none;">' . $mostrarEstatusPlataforma['descripcion'] . '</a>
                    </td>';
            } else if ($estatusPlataId == 2) {
                echo '<td>
                        <a href="#" class="btn btn-sm btn-primary" style="width: 130px; font-size: 12px; pointer-events: none;">' . $mostrarEstatusPlataforma['descripcion'] . '</a>
                     </td>';
            } else if ($estatusPlataId == 3) {
                echo '<td>
                        <a href="#" class="btn btn-sm btn-secondary" style="width: 130px; font-size: 12px; pointer-events: none;">' . $mostrarEstatusPlataforma['descripcion'] . '</a>
                    </td>';
            }
        } else {
            echo '<td scope="row"></td>';
        }

        echo '<td scope="row">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background:none; border:none;" onclick="consultarCitaEspecifica()"><i class="bi bi-eye-fill"></i>
                </button>
                <button type="button" style="background:none; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick="actualizarDatosCita()"><i class="bi bi-pen-fill"></i></button>
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
                <label class="justify-content-start mt-1 text-secondary">Mostrando '. min($registro_final + 1, $total_registros) . ' - ' . $registros_por_pagina . ' de un total de ' . $total_registros . ' registros</label>
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
        echo '<a class="page-link" href="citas_delegaciones_cp.php?fechaRegistro=' . $fechaRegistro . '&pagina=' . ($pagina_actual - 1) . '&fechaCita=' . $fechaCita . '" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>';
        echo '</li>';
    }
    //MUESTRA LOS NÚMEROS DE LAS PÁGINAS
    for ($i = 1; $i <= $total_paginas; $i++) {
        if ($pagina_actual == $i) {
            echo '<li class="page-item active"><a class="page-link" href="citas_delegaciones_cp.php?&fechaRegistro=' . $fechaRegistro . '&pagina=' . $i . '&fechaCita=' . $fechaCita . '">' . $i . '</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="citas_delegaciones_cp.php?fechaRegistro=' . $fechaRegistro . '&pagina=' . $i . '&fechaCita=' . $fechaCita . '">' . $i . '</a></li>';
        }
    }

    //MUESTRA EL BOTÓN "SIGUIENTE"
    if ($pagina_actual < $total_paginas) {
        echo '<li class="page-item">';
        echo '<a class="page-link" href="citas_delegaciones_cp.php?fechaRegistro=' . $fechaRegistro . '&pagina=' . ($pagina_actual + 1) . '&fechaCita=' . $fechaCita . '" aria-label="Previous">
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
