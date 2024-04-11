<?php
if(isset($_POST['login'])){
    if(empty($correo && $contraseña)){
        echo "<p class='completar'>*Completa los campos </p>";
    }
}
