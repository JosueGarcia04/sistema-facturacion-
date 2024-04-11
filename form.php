<?php
if(isset($_POST['login'])){
    $error= '';
    $correo = $_POST['email']; 
    $contraseña = $_POST['contra'];
  
    if ($correo == "josueusuario@gmail.com" && $contraseña == "usuario123") {
        echo "bienvenido josue";
        header('Location: ../lme_garcia_josue/php/productos.php');
    }else{
        $error= "datos incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lme_garcia_josue/css/form.css">
    <title>Formulario de Datos de Usuario</title>
</head>
<body>
    <nav class="main">
        <img src="../lme_garcia_josue/img/logo.png">
        <ul>
            <li><a href="#">Inicio></a></li>
            <li><a href="#">Sobre Nosotros></a></li>
            <li><a href="#">Iniciar sesión></a></li>
            <li><a href="#">Registrarse></a></li>
            <li><a href="#">Ver perfil></a></li>
        </ul>
    </nav>
    <form action="" method="post">
        <h2>Ingrese sus datos:</h2>
        <div class="user_input">
            <span>Email:</span>
            <input type="text" name="email" placeholder="email"/><br>
        </div>
        <div class="password_input">
            <span>contraseña:</span>
            <input type="password" name="contra" placeholder="contraseña"/><br>
        </div>
        <input type="submit" value="Guardar" name="login" />
        <?php
            include("php/incompletos.php");
        ?>
    </form>
</body>
</html>
