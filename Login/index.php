<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de Sesión - Mantenimiento</title>
    
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />

    <style>
        :root {
            --bg-color: #f4f7f6;       /* Fondo del panel */
            --accent-color: #00bfa5;   /* Turquesa del panel */
            --accent-hover: #00a08a;   
            --text-dark: #263238;      /* Texto oscuro del panel */
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            justify-content: center; /* Centrado vertical */
            margin: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* Diseño de la tarjeta */
        .login-card {
            border-radius: 12px;
            padding: 20px 10px;
            background-color: #ffffff;
            border-bottom: 5px solid var(--accent-color); /* Borde inferior característico de tus tarjetas */
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            margin-top: 0;
        }

        .logo-icon {
            font-size: 60px;
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        h4 {
            color: var(--text-dark);
            font-size: 1.6rem;
            font-weight: 500;
            margin-top: 0;
            margin-bottom: 35px;
        }

        /* Estilos de los inputs de Materialize para que coincidan con el color turquesa */
        .input-field input[type=text]:focus,
        .input-field input[type=password]:focus {
            border-bottom: 1px solid var(--accent-color) !important;
            box-shadow: 0 1px 0 0 var(--accent-color) !important;
        }

        .input-field input[type=text]:focus + label,
        .input-field input[type=password]:focus + label {
            color: var(--accent-color) !important;
        }

        .input-field label {
            color: #78909c;
        }

        /* Botón de ingreso */
        .btn-login {
            background-color: var(--accent-color) !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            height: 45px !important;
            line-height: 45px !important;
            font-weight: 500 !important;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0, 191, 165, 0.3) !important;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: var(--accent-hover) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 191, 165, 0.4) !important;
        }
        
        /* Ocultar iconos prefix nativos para un look más limpio */
        .input-field .prefix {
            display: none;
        }
        .input-field .prefix ~ input,
        .input-field .prefix ~ label {
            margin-left: 0 !important;
            width: 100% !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row" style="margin-bottom: 0;">
            <div class="col s12 m8 offset-m2 l4 offset-l4">
                
                <div class="card login-card center-align">
                    <div class="card-content">
                        <i class="material-icons logo-icon">admin_panel_settings</i>
                        <h4>Iniciar Sesión</h4>
                        
                        <form action="valida.php" method="POST">
                            <div class="input-field left-align">
                                <input id="correo" name="correo" type="text" class="validate" required>
                                <label for="correo">Correo electrónico</label>
                            </div>
                            
                            <div class="input-field left-align">
                                <input id="contra" name="contra" type="password" class="validate" required>
                                <label for="contra">Contraseña</label>
                            </div>
                            
                            <button class="btn waves-effect waves-light btn-login" type="submit">
                                Ingresar
                            </button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>
</body>
</html>