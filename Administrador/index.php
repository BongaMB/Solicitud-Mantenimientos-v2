<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Mantenimiento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />

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

        /* Barra Superior (Navbar) */
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

        /* Menú Lateral (Sidenav) */
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

        /* Estilo especial para el botón de cerrar sesión */
        .logout-link i {
            color: var(--danger-color) !important;
        }

        .sidenav .divider {
            background-color: rgba(255,255,255,0.1);
            margin: 8px 0;
        }

        .subheader {
            color: var(--accent-color) !important;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px !important;
            letter-spacing: 1px;
            padding: 10px 32px 0 32px !important;
            line-height: 1.5;
        }

        /* Estilo para el Desplegable (Collapsible) */
        .sidenav .collapsible-header {
            background-color: transparent;
            border: none;
            padding: 0 32px !important;
            color: var(--text-light) !important;
        }
        
        .sidenav .collapsible-body {
            background-color: #1a232e;
            padding: 0;
        }

        .sidenav .collapsible-body li a {
            padding-left: 60px !important;
            font-size: 13px;
        }

        /* Contenido Principal */
        main {
            flex: 1 0 auto;
            padding: 30px;
        }

        /* Tarjetas (Cards) */
        .option-card {
            border-radius: 12px;
            padding: 50px 20px;
            background-color: #ffffff;
            border-bottom: 5px solid var(--accent-color);
            transition: all .3s ease;
            margin-bottom: 20px;
        }

        .option-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .option-icon {
            font-size: 70px;
            color: var(--accent-color);
        }

        .option-title {
            font-size: 1.3rem;
            font-weight: 500;
            margin-top: 20px;
            color: #37474f;
        }

        .catalog-section {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .btn-catalog {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-decoration: none;
            color: #37474f;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .btn-catalog i {
            color: var(--accent-color);
        }

        .btn-catalog:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-bottom: 3px solid var(--accent-color);
        }

        /* Responsivo: Pantallas pequeñas */
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
                <span class="white-text name" style="font-size: 1.4rem;">Panel Administrador</span>
                <span class="white-text email">Mantenimiento Correctivo</span>
                <div style="height: 20px;"></div>
            </div>
        </li>
        
        <li><a href="#"><i class="material-icons">dashboard</i>Inicio</a></li>
        
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header waves-effect">
                        <i class="material-icons">assignment</i>Solicitudes
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="../Solicitud_Correctivo/index.php"><i class="material-icons">add_circle</i>Nuevo Correctivo</a></li>
                            <li><a href="../Solicitud/index.php"><i class="material-icons">build</i>Orden de Trabajo</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>

        <li><div class="divider"></div></li>

        <li><a class="subheader">Catálogos</a></li>
        <li><a href="../Modalidad/index.php"><i class="material-icons">brightness_6</i>Modalidades</a></li>
        <li><a href="../Departamento/index.php"><i class="material-icons">account_balance</i>Departamentos</a></li>
        <li><a href="../Personal/index.php"><i class="material-icons">accessibility</i>Personal</a></li>
        <li><a href="../Areas/index.php"><i class="material-icons">view_module</i>Áreas</a></li>
        <li><a href="../Equipos/index.php"><i class="material-icons">devices</i>Equipos</a></li>
        <li><a href="../UbicacionesEquipos/index.php"><i class="material-icons">place</i>Ubicaciones</a></li>
        <li><a href="../Responsables/index.php"><i class="material-icons">transfer_within_a_station</i>Responsables</a></li>
        <li><a href="../TipoMantenimiento/index.php"><i class="material-icons">settings_applications</i>Tipos Mantenimiento</a></li>
        <li><a href="../Mantenimiento/index.php"><i class="material-icons">handyman</i>Gestión de Sistema</a></li>

        <li><div class="divider"></div></li>
        
        <li>
            <a href="../Login/index.php" class="waves-effect logout-link">
                <i class="material-icons">exit_to_app</i>Cerrar Sesión
            </a>
        </li>
    </ul>

    <main>
        <div class="container" style="width: 100%; max-width: 1200px;">
            <div class="row">
                <div class="col s12">
                    <h4 class="blue-grey-text text-darken-4">Panel de Control</h4>
                    <p class="grey-text text-darken-1">Bienvenido al sistema. Utilice el menú de la izquierda para navegar por los catálogos o las tarjetas centrales para acciones rápidas.</p>
                </div>
            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="col s12 m6">
                    <a href="../Solicitud_Correctivo/index.php" class="black-text">
                        <div class="option-card center-align">
                            <i class="material-icons option-icon">assignment_turned_in</i>
                            <div class="option-title">Solicitudes Correctivas</div>
                        </div>
                    </a>
                </div>
                <div class="col s12 m6">
                    <a href="../Solicitud/index.php" class="black-text">
                        <div class="option-card center-align">
                            <i class="material-icons option-icon">build</i>
                            <div class="option-title">Órdenes de Trabajo</div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="catalog-section">
                <h5 class="grey-text text-darken-2" style="font-size: 1.1rem; font-weight: 500;">Accesos Rápidos a Catálogos</h5>
                <div class="catalog-grid">
                    <a href="../Equipos/index.php" class="btn-catalog">
                        <i class="material-icons">devices</i> Maquinaria
                    </a>
                    <a href="../Areas/index.php" class="btn-catalog">
                        <i class="material-icons">place</i> Áreas
                    </a>
                    <a href="../Personal/index.php" class="btn-catalog">
                        <i class="material-icons">people</i> Empleados
                    </a>
                </div>
            </div>

        </div>
    </main>

    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Inicializar el Sidenav (Barra Lateral)
            var sideNavElems = document.querySelectorAll('.sidenav');
            var sideNavInstances = M.Sidenav.init(sideNavElems);
            var instance = sideNavInstances[0];

            // 2. Inicializar los desplegables (Collapsibles)
            var collapsibleElems = document.querySelectorAll('.collapsible');
            M.Collapsible.init(collapsibleElems);

            // Inicializar botones flotantes si fuera necesario
            var fabElems = document.querySelectorAll('.fixed-action-btn');
            M.FloatingActionButton.init(fabElems);

            // 3. Lógica para abrir/cerrar (Toggle)
            const btn = document.getElementById('toggle-btn');
            const body = document.body;

            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // En pantallas grandes (Desktop)
                if (window.innerWidth > 992) {
                    if (body.classList.contains('sidebar-closed')) {
                        body.classList.remove('sidebar-closed');
                        instance.open();
                    } else {
                        body.classList.add('sidebar-closed');
                        instance.close();
                    }
                } else {
                    // En pantallas pequeñas (Móvil) solo abre/cierra el menú flotante
                    if (instance.isOpen) {
                        instance.close();
                    } else {
                        instance.open();
                    }
                }
            });
        });
    </script>
</body>
</html>