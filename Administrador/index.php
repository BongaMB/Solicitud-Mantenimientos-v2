<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú Principal de Mantenimiento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />

  <style>
    body{
      background-color:#f5f5f5;
    }
    .menu-container{
      margin-top:60px;
    }
    .option-card{
      border:3px solid #00bfa5;
      border-radius:8px;
      padding:40px 20px;
      cursor:pointer;
      transition:box-shadow .3s, transform .3s;
      background-color:#ffffff;
    }
    .option-card:hover{
      box-shadow:0 10px 25px rgba(0,0,0,0.15);
      transform:translateY(-4px);
    }
    .option-icon{
      font-size:70px;
      color:#00bfa5;
      margin-bottom:15px;
    }
    .option-title{
      font-size:18px;
      font-weight:500;
      color:#333333;
    }
  </style>
</head>
<body>

  <div class="container menu-container center-align">
       <div class="fixed-action-btn click-to-toggle"  style="bottom: 45px; right: 24px;">
  <!-- BOTÓN PRINCIPAL DEL MENÚ -->
  <a class="btn-floating btn-large red">
    <i class="material-icons">menu</i>
  </a>

  <!-- OPCIONES DEL MENÚ -->
  <ul>
    <li>
      <a id="Dep" href="../Modalidad/index.php" class="btn-floating Red lighten-2">
        <i class="material-icons">brightness_6</i>
      </a>
    </li>
    <li>
      <a id="Mod" href="../Departamento/index.php" class="btn-floating Red lighten-2">
        <i class="material-icons">account_balance</i>
      </a>
    </li>
    <li>
      <a id="Per" href="../Personal/index.php" class="btn-floating Red lighten-2">
        <i class="material-icons">accessibility</i>
      </a>
    </li>
    <li>
      <a id="Resp" href="../Responsables/index.php" class="btn-floating Red lighten-2">
        <i class="material-icons">transfer_within_a_station</i>
      </a>
    </li>
    <li>
      <a id="TipoM" href="../TipoMantenimiento/index.php" class="btn-floating Red lighten-2">
        <i class="material-icons">build</i>
      </a>
    </li>
    <li>
      <a id="Areas" href="../Areas/index.php" class="btn-floating Red lighten-2">
        <i class="material-icons">view_module</i>
      </a>
    </li>
    <li>
      <a id="Areas" href="../Equipos/index.php" class="btn-floating Red lighten-2">
        <i class="material-icons">devices</i>
      </a>
    </li>
    <li>
      <a id="Areas" href="../Mantenimiento/index.php" class="btn-floating Red lighten-2">
        <i class="material-icons">handyman</i>
      </a>
    </li>
    <li>
      <a id="Areas" href="../Mantenimiento/index.php" class="btn-floating Red lighten-2">
        <i class="material-icons">handyman</i>
      </a>
    </li>
  </ul>
</div>



    <h4 class="black-text">Menú Principal de Mantenimiento</h4>

    

    <div class="row" style="margin-top:40px;">
      <!-- Tarjeta 1 -->
      <div class="col s12 m6">
        <a href="../Solicitud_Correctivo/index.php" class="black-text">
          <div class="option-card">
            <i class="material-icons option-icon">assignment_turned_in</i>
            <div class="option-title">Solicitudes de Mantenimiento Correctivo</div>
          </div>
        </a>
      </div>

      <!-- Tarjeta 2 -->
      <div class="col s12 m6">
        <a href="../Solicitud/index.php" class="black-text">
          <div class="option-card">
            <i class="material-icons option-icon">build</i>
            <div class="option-title">Orden de Trabajo de Mantenimiento</div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <!-- Materialize JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    M.FloatingActionButton.init(elems, {
      hoverEnabled: false  // abre con click, mejor para móvil
    });
  });
</script>

</body>
</html>
