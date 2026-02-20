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
</head>
<body>

<!--                     Ventana modal como pantalla principal                       -->
<div id="ventanaModal" class="modal" style="display: block; position: relative; opacity: 1; transform: none;">
    <div class="modal-content">
        <h4>Orden de Trabajo de Mantenimiento</h4>
        

        <br>
        <form id="formulario" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" name="idSoli" id="idSoli">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <select name="idModalidad" id="idModalidad">
                        <option value="">Selecciona una Modalidad</option>
                        <?php include_once("./LlenaSelectM.php"); ?>
                    </select>
                </div>
                <div class="input-field col s6">
                    <select name="idDep" id="idDep">
                        <option value="">Selecciona un Departamento</option>
                        <?php include_once("./LlenaSelectD.php"); ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                   <select name="id_Man" id="id_Man">
                        <option value="">Selecciona un Mantenimiento</option>
                        <?php include_once("./LlenaSelectMa.php"); ?>
                    </select>
                </div>
                <div class="input-field col s6">
                    <select name="idRes" id="idRes">
                        <option value="">Selecciona un Responsable</option>
                        <?php include_once("./LlenaSelectR.php"); ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="date" name="fechaR" id="fechaR" class="validate">
                    <label for="fechaR" class="active" >Fecha de Realizacion:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="descrip" id="descrip" class="validate">
                    <label for="descrip" class="active">Descripcion del Mantenimiento:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <select name="encar" id="encar">
                        <option value="idDep">Selecciones un jefe de departamento:</option>
                        <?php include_once("./LlenaSelectEnc.php");?>
                    </select>
                </div>
                <div class="file-field input-field col s6">
                    <div class="btn blue lighten-2">
                        <span>Adjuntar Archivo</span>
                        <input type="file" name="IMG" id="IMG" accept=".jpg, .jpeg, .png, .pdf">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="IMG" id="IMG" placeholder="Sube una foto o PDF como evidencia">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="EM" id="EM" class="validate">
                    <label for="EM" class="active">Evaluacion del Mantenimiento:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="obser" id="obser" class="validate">
                    <label for="obser" class="active">Obcervaciones:</label>
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
                        <span class="card-title">Registro de ordenes de Mantenimiento</span>
                        <table id="dtTable" class="highlight bordered dataTable">
                            <thead>
                                <tr>
                                    <th>Modalidad del Mantenimiento</th>
                                    <th>Departamento Asignado</th>
                                    <th>tipo de Servicio</th>
                                    <th>Responsable</th>
                                    <th>fecha de realizacion</th>
                                    <th>Descripcion</th>
                                    <th>Jefe Departamento</th>
                                    <th>Evaluacion</th>
                                    <th>Obcervaciones</th>
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
