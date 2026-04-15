<?php
session_start();

// Validar que el usuario haya iniciado sesión correctamente
if (!isset($_SESSION['correo'])) {
    header("Location: ../Login/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Órdenes de Trabajo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>

    <style>
        :root {
            --sidebar-color: #263238; 
            --accent-color: #00bfa5;   
            --text-light: #eceff1;
            --sidebar-width: 300px;
            --danger-color: #ff5252;
        }

        body {
            background-color: #f4f7f6;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            margin: 0;
            padding: 0;
            transition: padding-left 0.3s ease;
            padding-left: var(--sidebar-width);
        }

        body.sidebar-closed {
            padding-left: 0;
        }

        /* Barra Superior */
        .top-navbar {
            background: #ffffff;
            height: 65px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 997;
        }

        .menu-toggle {
            cursor: pointer;
            color: #37474f;
            display: flex;
            align-items: center;
        }

        .nav-title {
            margin-left: 20px;
            font-weight: 500;
            font-size: 1.3rem;
            color: #263238;
        }

        /* Menú Lateral */
        .sidenav {
            width: var(--sidebar-width) !important;
            background-color: var(--sidebar-color);
            border: none;
            transition: transform 0.3s ease;
        }

        .sidenav li a {
            color: var(--text-light) !important;
            font-weight: 300;
            display: flex;
            align-items: center;
            padding: 0 32px;
        }

        .sidenav li a i {
            color: var(--accent-color) !important;
            margin-right: 15px;
        }

        .logout-link i {
            color: var(--danger-color) !important;
        }

        .sidenav .divider {
            background-color: rgba(255,255,255,0.1);
            margin: 8px 0;
        }

        /* Contenido Centrado */
        main {
            flex: 1 0 auto;
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Tarjeta de Acción */
        .option-card {
            border-radius: 12px;
            padding: 50px 20px;
            background-color: #ffffff;
            border-bottom: 5px solid var(--accent-color);
            transition: all .3s ease;
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
        }

        .option-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .option-icon {
            font-size: 80px;
            color: var(--accent-color);
        }

        .option-title {
            font-size: 1.5rem;
            font-weight: 500;
            margin-top: 20px;
            color: #37474f;
        }

        @media only screen and (max-width : 992px) {
            body { padding-left: 0; }
            .sidenav { transform: translateX(-105%); }
        }
    </style>
</head>
<body>

    <div class="top-navbar">
        <a href="#" id="toggle-btn" class="menu-toggle">
            <i class="material-icons medium">menu</i>
        </a>
        <span class="nav-title">Gestión de Mantenimiento</span>
    </div>

    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li>
            <div class="user-view">
                <div class="background" style="background-color: #1a232e;"></div>
                <div style="height: 20px;"></div>
                <span class="white-text name" style="font-size: 1.2rem;">Órdenes de Trabajo</span>
                <span class="white-text email"><?php echo $_SESSION['correo']; ?></span>
                <div style="height: 20px;"></div>
            </div>
        </li>
        
        <li><div class="divider"></div></li>
        
        <li>
            <a href="../Login/cerrar_sesion.php" class="waves-effect logout-link">
                <i class="material-icons">exit_to_app</i>Cerrar Sesión
            </a>
        </li>
    </ul>

    <main>
        <div class="container center-align">
            <div class="row">
                <div class="col s12">
                    <a href="index.php" class="black-text">
                        <div class="option-card center-align">
                            <i class="material-icons option-icon">build</i>
                            <div class="option-title">Orden de Trabajo de Mantenimiento</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/materialize.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sideNavElems = document.querySelectorAll('.sidenav');
            var sideNavInstances = M.Sidenav.init(sideNavElems);
            var instance = sideNavInstances[0];

            const btn = document.getElementById('toggle-btn');
            const body = document.body;

            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (window.innerWidth > 992) {
                    if (body.classList.contains('sidebar-closed')) {
                        body.classList.remove('sidebar-closed');
                        instance.open();
                    } else {
                        body.classList.add('sidebar-closed');
                        instance.close();
                    }
                } else {
                    instance.isOpen ? instance.close() : instance.open();
                }
            });
        });
    </script>
</body>
</html>