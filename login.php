<!--
¿Qué es PDO en BBDD? Comenta sus ventajas.


PDO (PHP Data Objects) es una extensión de PHP que proporciona una interfaz uniforme para acceder a bases de datos desde aplicaciones PHP. 
Proporciona una capa de abstracción de acceso a datos, lo que significa que, independientemente de la base de datos que se esté utilizando, 
se usan las mismas funciones para realizar consultas y obtener datos.

Ventajas:

- Proporciona una capa de abstracción de acceso a datos.
- Seguridad y prevención de inyecciones SQL gracias a la utilización de consultas preparadas y vinculación de parámetros.
- Manejo mejorado de errores mediante el uso de excepciones.
- Permite a los desarrolladores utilizar características específicas de las bases de datos.
- Proporciona interfaces tanto orientadas a objetos como procedurales.

-->
<?php
session_start();

// Verifica si hay un mensaje en la URL
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';

// Muestra el mensaje si existe
if (!empty($mensaje)) {
    echo '<p style="color: red; text-align: center;"><b>' . $mensaje . '</b></p>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica Tema 9 - BBDD</title>
    <link rel="stylesheet" href="estilos/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="estilos/overhang.min.css" />
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="registroCode.php" method="post">
			<h1>Crear Cuenta</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>o usa tu correo electrónico para registrarte</span>
			<br>
			<input type="text" name="nombre" placeholder="Nombre" required/>
			<input type="email" name="correo" placeholder="Correo Electrónico" required/>
			<input type="password" name="contrasena" placeholder="Contraseña" required/>
			<br>
			<button type="submit">Registrarse</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form id="loginForm" action="validarCode.php" method="post">
			<h1>Iniciar sesión</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>o usa tu cuenta</span>
			<input type="email" name="correo" placeholder="Correo Electrónico" required/>
			<input type="password" name="contrasena" placeholder="Contraseña" required/>
			<a href="#">¿Olvidaste tu contraseña?</a>
			<button type="submit">Iniciar Sesión</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>¡Bienvenid@ de nuevo!</h1>
				<p>Para seguir conectad@ con nosotros, inicia sesión con tu información personal</p>
				<button class="ghost" id="signIn">Iniciar Sesión</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>¡Hola!</h1>
				<p>Ingresa tus datos personales y comienza tu aventura</p>
				<button class="ghost" id="signUp">Registrarse</button>
			</div>
		</div>
	</div>
</div>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="javascript/overhang.min.js"></script>
	<script src="javascript/app.js"></script>
</body>
</html>
