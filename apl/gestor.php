<?php
session_start();

// Verificar si existe la clave 'username' en la sesión
$usuario = isset($_SESSION['usernameAdmin']) ? $_SESSION['usernameAdmin'] : $_SESSION['usernameAdmin'] = "AdministradorTest";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Personasl</title>
    <style>
        .whiteText {
            color: white;
        }

        .center {
            text-align: center;
        }

        .adminContainer {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .main-container {
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            padding: 20px 10px;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
            background-color: #34495e;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .sidebar ul li:hover {
            background-color: #1abc9c;
            color: white;
        }

        .contenido {
            margin-left: 270px;
            /* Espacio para la sidebar */
            padding: 20px;
            flex: 1;
        }

        .form-container {
            background-color: #f4f4f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #1abc9c;
            outline: none;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: rgb(71, 78, 76);
        }

        .oculto {
            display: none;
        }

        .mostrando {
            display: block;
        }

        .botonesCRUD {
            margin-top: 10px;
        }

        .botonCrear {
            background-color: rgb(6, 112, 91);
        }

        .botonEliminar {
            background-color: rgb(189, 27, 9);
        }

        .botonModificar {
            background-color: rgb(188, 153, 12);
        }

    </style>
</head>
<?php
session_start();

// Verificar si existe la clave 'username' en la sesión
$usuario = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$tipoUsuario = isset($_SESSION['tipo']) ? $_SESSION['tipo'] : NULL;
?>
<body class="adminContainer">
    <div class="main-container">
        <div class="sidebar">
            <h1 class="whiteText">Bienvenido a tu área personal</h1>
            <?php echo "<h3 class='whiteText'>$usuario</h3>"; ?>
            <ul>
                <ul>
                    <li onclick="toggleContenido(1)">Gestionar Gestores</li>
                    <li onclick="toggleContenido(2)">Gestionar Usuarios</li>
                    <li onclick="toggleContenido(3)">Gestionar tus datos de inicio de sesión</li>
                    <br>
                    <li onclick="window.location.href = 'index.php'">Volver al Inicio</li>
                </ul>

            </ul>
        </div>

        <div class="contenido">
            <h2 class="center" id="mensajeEnter">Panel de administración. Desde aquí puedes administrar tu tienda online.</h2>
            <?php if (isset($_GET['creado'])) echo "<div class='mensajeDevuelta center'>Usuario creado con éxito</div>"; ?>
            <div class="form-container formulario-1 oculto">
                <h2>Formulario de Creación de Gestores</h2>
                <form action="/crearUsuarios.php" method="post">
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" id="username" name="usuarioGestor" required>
                    </div>
                    <div class="form-group">
                        <label for="identifier">Identificador Numérico</label>
                        <input type="number" id="identifier" name="idGestor" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="contraseñaGestor" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Nombre y Apellidos</label>
                        <input type="text" id="fullname" name="nombreGestor" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="emailGestor" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono de Contacto</label>
                        <input type="tel" id="phone" name="telContactoGestor" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="crearGestor" value="1" class="botonesCRUD botonCrear">Crear Gestor</button>
                        <button type="submit" name="eliminarGestor" value="1" class="botonesCRUD botonEliminar">Eliminar Gestor</button>
                        <button type="submit" name="modificarGestor" value="1" class="botonesCRUD botonModificar">Modificar Gestor</button>
                    </div>
                </form>
            </div>

            <!--FORMULARIO CLIENTES-->
            <div class="form-container formulario-2 oculto">
                <h2>Formulario de Creación de Clientes</h2>
                <form action="/crearUsuarios.php" method="post">
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="identifier">Identificador Numérico</label>
                        <input type="number" id="identifier" name="identifier" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Nombre y Apellidos</label>
                        <input type="text" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono de Contacto</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Dirección Postal</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="crearCliente" value="1" class="botonesCRUD botonCrear">Crear Cliente</button>
                        <button type="submit" name="eliminarCliente" value="1" class="botonesCRUD botonEliminar">Eliminar Cliente</button>
                        <button type="submit" name="modificarCliente" value="1" class="botonesCRUD botonModificar">Modificar Cliente</button>
                    </div>
                </form>
            </div>



            <!--FORMULARIO AMINISTRADOR-->
            <div class="form-container formulario-3 oculto">
                <h2>Formulario de Modificación de los datos del Admin </h2>
                <form action="/crear-gestor" method="post">
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="modificarAdmin" value="1" class="botonesCRUD botonModificar">Modificar Datos</button>
                    </div>
                </form>
            </div>


        </div>



    </div>

    </div><!--final div contenido-->
    <script>
        //mostrar el contenido en función del item seleccionado en el sidebar
        function toggleContenido(num) {
            var allForms = document.querySelectorAll('.form-container');
            allForms.forEach(function(form) {
                form.classList.add('oculto');
            });

            var selectedForm = document.querySelector('.formulario-' + num);
            selectedForm.classList.remove('oculto');
        }
    </script>
</body>

</html>