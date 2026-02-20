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

<!-- Colocar su código a partir de este comentario -->
<div class="container">
    <div class="row">
        <div class="col s12 ">
            <div class="card">
                <a id="add" class="btn-floating btn-large waves-effect waves-light right blue lighten-2">
                    <i class="material-icons">add</i>
                </a>
                <a id="Dep" href="../Solicitud/index.php" class="btn-floating btn-large waves-effect waves-light right blue lighten-2">
                        <i class="material-icons" color="green">chevron_left</i>
                </a>
                <div class="card-content">
                    <span class="card-title">Catálogo de Responsable</span>
                    <table id="dtTable" class="highlight bordered dataTable">
                        <thead>
                            <tr>
                                <th>Nombre del responsable</th>
                                <th>Correo Electronico</th>
                                <th>Telefono</th>
                                <th>Encargado</th>
                                <th>Puesto del Responsable</th>
                                <th>Nombre del departamento responsable</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                include_once("./CargaTabla.php");  
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>

<!--                     Ventana modal                       -->
<div id="ventanaModal" class="modal">
    <div class="modal-content">
        <h4>Detalles Departamento</h4>
        <br>
        <form id="formulario" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" name="idRes" id="idRes">
                    <input type="text" name="nombreRes" id="nombreRes" class="validate">
                    <label class="active" for="nombreRes">Nombre del Responsable:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="correo" id="correo" class="validate">
                    <label class="active" for="correo">Correo Electronico:</label>
                </div>
                <div class="input-field col s6">
                    <input type="tel" name="tel" id="tel" class="validate">
                    <label class="active" for="tel">Telefono:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="encar" id="encar" class="validate">
                    <label for="encar" class="active">Encargado:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="PR" id="PR" class="validate">
                    <label for="PR" class="active">Puesto del Responsable</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="idDep" id="idDep">
                        <option value="">Selecciona una opcion</option>
                        <?php
                           include_once("./LlenaSelect.php");
                        ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer  #80deea cyan lighten-3">
        <a id="btnGuardar" class="modal-action waves-effect waves-green btn-flat">Guardar</a>
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
        });
    </script> 
</body>
</html>