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

 <!--boton de regresar-->
    <div class="fixed-action-btn" style="bottom: 45px; left: 24px; width: 60px;">
  <a class="btn-floating btn-large grey darken-3" onclick="window.history.back()">
    <i class="material-icons">chevron_left</i>
  </a>
</div>


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
                                <th>Nombre del equipo</th>
                                <th>tipo de equipo</th>
                                <th>Marca</th>
                                <th>modelo</th>
                                <th>serial</th>
                                <th>Ubicacion</th>
                                <th>estado</th>
                                <th>fecha de Adquicision</th>
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
        <h4>Detalles Equipos</h4>
        <br>
        <form id="formulario" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" name="idEq" id="idEq">
                    <input type="text" name="nom" id="nom" class="validate">
                    <label class="active" for="nom">Nombre del Equipo:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="idTip" id="idTip">
                        <option value="">Selecciona una opcion</option>
                        <?php
                           include_once("./LlenaSelecttip.php");
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="marca" id="marca" class="validate">
                    <label for="marca" class="active">Marca del equipo:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="modelo" id="modelo" class="validate">
                    <label for="modelo" class="active">Modelo del equipo:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="serial" id="serial" class="validate">
                    <label for="serial" class="active">Serial:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="id_ubicacion" id="id_ubicacion">
                        <option value="">Selecciona una opcion</option>
                        <?php
                           include_once("./LlenaSelectUbi.php");
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">   
                <div class="input-field col s12">
                    <input type="text" name="estado" id="estado" class="validate">
                    <label for="estado" class="active">Estado del Equipo:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="date" name="fechaad" id="fechaad" class="validate">
                    <label for="fechaad" class="active" type="date">Fecha Adquisicion:</label>
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