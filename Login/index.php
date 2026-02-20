<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de sesion</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3 l4 offset-l4">
                <div class="card">
                    <div class="card-content center-align">
                        <h4 class="blue-text text-darken-2">
                            <i class="material-icons large">lock</i><br>Inicio de sesion!
                        </h4>
                        
                        <form action="valida.php" method="POST">
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="correo" name="correo" type="text" class="validate" required>
                                <label for="correo">correo</label>
                            </div>
                            
                            <div class="input-field">
                                <i class="material-icons prefix">vpn_key</i>
                                <input id="contra" name="contra" type="password" class="validate" required>
                                <label for="contra">Contraseña</label>
                            </div>
                            
                            <button class="btn waves-effect waves-light btn-large blue darken-2 btn-block" type="submit">
                                <i class="material-icons left">login</i>
                                Ingresar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        M.AutoInit();  // Inicializa componentes Materialize
    </script>
</body>
</html>
