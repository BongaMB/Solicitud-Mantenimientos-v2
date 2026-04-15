<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clasificaciones</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />

    <style>
        .timeline-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 20px 0;
            position: relative;
        }
        .timeline-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 5%;
            right: 5%;
            height: 2px;
            background-color: #e0e0e0;
            transform: translateY(-50%);
            z-index: 0;
        }
        .timeline-step {
            flex: 1;
            text-align: center;
            position: relative;
            cursor: default;
            z-index: 1;
        }
        .timeline-icon {
            width: 40px;
            height: 40px;
            background-color: #e0e0e0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .timeline-step.active .timeline-icon {
            background-color: #26a69a; /* Color Cyan de Materialize */
            color: white;
            transform: scale(1.1);
        }
        .timeline-step.active .timeline-label {
            font-weight: bold;
            color: #26a69a;
        }
        .timeline-label {
            font-size: 0.8em;
            color: #757575;
            display: block;
        }
    </style>
</head>
<body>
    <!--boton de regresar-->
    <div class="fixed-action-btn" style="bottom: 45px; left: 24px; width: 60px;">
  <a class="btn-floating btn-large grey darken-3" onclick="window.history.back()">
    <i class="material-icons">chevron_left</i>
  </a>
</div>

<!--                     Ventana modal como pantalla principal                       -->
<div id="ventanaModal" class="modal" style="display: block; position: relative; opacity: 1; transform: none;">
    <div class="modal-content">
        <h4>Solicitud Mantenimiento Correctivo</h4>

        <div class="timeline-container">
            <div class="timeline-step active" data-fase="1">
                <span class="timeline-icon"><i class="material-icons">assignment</i></span>
                <span class="timeline-label">1. Solicitud Creada</span>
            </div>
            <div class="timeline-step" data-fase="2">
                <span class="timeline-icon"><i class="material-icons">build</i></span>
                <span class="timeline-label">2. En Proceso</span>
            </div>
            <div class="timeline-step" data-fase="3">
                <span class="timeline-icon"><i class="material-icons">file_copy</i></span>
                <span class="timeline-label">3. Pendiente Doc.</span>
            </div>
            <div class="timeline-step" data-fase="4">
                <span class="timeline-icon"><i class="material-icons">done_all</i></span>
                <span class="timeline-label">4. Finalizada</span>
            </div>
        </div>
        

        

        <br>
        <form id="formulario" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" name="idCorr" id="idCorr">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <select name="idDep" id="idDep">
                        <option value="">Selecciona un Departamento</option>
                        <?php include_once("./LlenaSelectD.php"); ?>
                    </select>
                </div>
                <div class="input-field col s6">
                    <select name="id_area" id="id_area">
                        <option value="">Selecciona una Area</option>
                        <?php include_once("./LlenaSelectArea.php"); ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                   <select name="idPer" id="idPer">
                        <option value="">Selecciona el Personal</option>
                        <?php include_once("./LlenaSelectPer.php"); ?>
                    </select>
                </div>
                 <!-- <div class="file-field input-field col s6">
                    <div class="btn blue lighten-2">
                        <span>Adjuntar Archivo</span>
                        <input type="file" name="IMG" id="IMG" accept=".jpg, .jpeg, .png, .pdf">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="IMG" id="IMG" placeholder="Sube una foto o PDF como evidencia">
                    </div>
                </div>
                -->
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="date" name="fechaR" id="fechaR" class="validate" value="<?php date_default_timezone_set('America/Mexico_City'); echo date('Y-m-d'); ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="descrip" id="descrip" class="validate">
                    <label for="descrip" class="active">Descripcion del Mantenimiento:</label>
                </div>
            </div>
        </form>
        <!-- Botónes para mostrar la tabla -->
        <div class="center-align">
            <!-- Botón para mostrar la tabla -->
            <div class="center-align">
                <a class="btn blue lighten-2" onclick="irATabla()">Ver catálogo de departamentos</a>
            </div>

        </div>
    </div>
    <div class="modal-footer #80deea cyan lighten-3">
        <a id="btnGuardar" class="modal-action waves-effect waves-green btn-flat">Guardar</a>
    </div>
</div>

<!-- Catálogo oculto al inicio -->
<div id="catalogoDepartamentos" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col s12 ">
                <div class="card">
                   
                    <div class="card-content">
                        <span class="card-title">Registro de Solicitud de Mantenimiento</span>
                        <table id="dtTable" class="highlight bordered dataTable">
                            <thead>
                                <tr>
                                    <th>Departamento</th>
                                    <th>Area Solicitante</th>
                                    <th>Personal solicitante</th>
                                    <th>Fecha de Solicitud</th>
                                    <th>Descripcion</th>
                                    <th>Acciones</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php include_once("./CargaTabla.php"); ?>
                            </tbody>
                        </table>
                        <!-- Botón para volver al modal -->
                        <div class="center-align" style="margin-top: 20px;">
                            <!-- Botón para volver al modal -->
                            <div class="center-align" style="margin-top: 20px;">
                                <a class="btn grey lighten-1" onclick="irAModal()">Volver a la Solicitud</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>

<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/dataTables.materialize.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script> 
<script type="text/javascript" src="./Valida.js"></script>    
 
<script type="text/javascript">
    $(document).ready(function(){
        $('select').formSelect();
        $('.sidenav').sidenav();
        $(".dropdown-trigger").dropdown();

        // Detecta si la URL tiene ?vista=tabla
        const urlParams = new URLSearchParams(window.location.search);
         const vista = urlParams.get('vista');

        if (vista === 'tabla') {
                mostrarTabla();
            } else {
                mostrarModal(); // incluye 'modal' o sin parámetro
            }

    });

    function irATabla() {
        window.location.href = "index.php?vista=tabla";
    }
    function irAModal() {
    window.location.href = "index.php?vista=modal";
}


    function mostrarTabla() {
        document.getElementById('ventanaModal').style.display = 'none';
        document.getElementById('catalogoDepartamentos').style.display = 'block';
    }

    function mostrarModal() {
        document.getElementById('catalogoDepartamentos').style.display = 'none';
        document.getElementById('ventanaModal').style.display = 'block';
    }
</script>

</body>
</html>
