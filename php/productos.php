<?php
$fatal=[];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mandar"])) {
    $cantidad = $_POST["cantidad"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $subtotal = $_POST["subtotal"];
   //

    // Validación de datos
    if (empty($nombre) || $precio <= 0 || $cantidad < 0) {
        $fatal[]= "completa todos los datos";
    }else if(empty($cantidad) || empty($nombre) || empty($descripcion) || empty($precio) ||empty($subtotal)){
        $fatal[]= "aseegurate que todo este correcto";
    }elseif(!is_numeric($cantidad)){
        $fatal[]="debe ser un valor numerico";
    }elseif($cantidad <= 0){
        $fatal[]="debe ser positivo";
    }elseif(!filter_var($cantidad, FILTER_VALIDATE_INT)){
        $fatal[]="debe ser numero entero";
    }elseif($cantidad < 1 || $cantidad > 100){
        $fatal[]="el rango debe de ser entre 1 y 100";
    }elseif(!is_numeric($precio)){
        $fatal[]="debe ser un valor numerico";
    }elseif($precio <= 0){
        $fatal[]="debe ser positivo"; 
    }elseif(!preg_match('/^\d+(\.\d{2})?$/', $precio)) {
        $fatal[]="debe tener 2 decimales";
    }elseif(!is_numeric($subtotal)){
        $fatal[]="debe ser un valor numerico";
    }elseif($subtotal <= 0){
        $fatal[]="debe ser positivo"; 
    }elseif(!preg_match('/^\d+(\.\d{2})?$/', $precio)) {
        $fatal[]="debe tener 2 decimales";
    }else{
        if(empty($fatal)){
            $producto = "$cantidad|$nombre|$descripcion|$precio|$subtotal";
        file_put_contents("listproducts.txt", "$producto\n", FILE_APPEND);
        header("Location: productos.php"); // Redirige a la página de productos después de agregar el producto
        exit;
        }
    }
           
    foreach($fatal as $error){
        echo "<div class='error'>$error</div>";
    }
    // $total = $precio * $cantidad;

     // Creamos una nueva fila para el producto
     $nueva_fila = "<tr>";
     $nueva_fila .= "<td>$cantidad</td>";
     $nueva_fila .= "<td>$nombre</td>";
     $nueva_fila .= "<td>Descripción del producto</td>"; 
     $nueva_fila .= "<td>$precio</td>";
     $nueva_fila .= "<td>$subtotal</td>";
     //$nueva_fila .= "<td><button class='eliminar'>Eliminar</button></td>"; 
     $nueva_fila .= "</tr>";
 
     // Agregamos la nueva fila al archivo de productos
     file_put_contents("listproducts.txt", $nueva_fila.PHP_EOL, FILE_APPEND);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/productos.css">
    <title>Datos de productos</title>
</head>
<body>
    <nav class="main">
        <img src="../img/logo.png" >
        <ul>
            <li><a href="#">Inicio></a></li>
            <li><a href="#">Sobre Nosotros></a></li>
            <li><a href="#">Iniciar sesión></a></li>
            <li><a href="#">Registrarse></a></li>
            <li><a href="#">Ver perfil></a></li>
        </ul>
    </nav>
    <!-- Formulario para agregar un nuevo producto -->
    <form class="formulario"  method="post">
        <h2>Agregar Productos</h2>
        Cantidad: <input type="number" name="cantidad" min="0" /><br>
        Nombre: <input type="text" name="nombre"><br>
        Descripción: <input type="text" name="descripcion"><br>
        Precio: <input type="number" name="precio" step="0.01" /><br>
        Total: <input type="number" name="subtotal" min="0" step="0.01" /><br>
        
        
        <input type="submit" value="Agregar Producto" name="mandar" />
    </form>

    <!-- Lista de productos -->
    <!--<div class="tit">
        <h3>Lista de Productos</h3>
    </div>-->
    <!--
    <?php
            //include("agregar_productos.php");
        ?>-->
    <table id="table" border="1">
        <tr>
            <th>Cantidad</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
        <?php
        // Leer los productos del archivo y mostrarlos en la tabla
        $productos = file("listproducts.txt", FILE_IGNORE_NEW_LINES);
        foreach ($productos as $producto) {
            $data= explode("|", $producto);
            if(count($data)==5){
                list($cantidad, $nombre, $descripcion, $precio, $subtotal) = explode("|", $producto);
                if(!empty($cantidad) && !empty($nombre) && !empty($precio) && !empty($subtotal)){
                    echo "<tr>";
                    echo "<td>$cantidad</td>";
                    echo "<td>$nombre</td>";
                    echo "<td>$descripcion</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$subtotal</td>";
                    echo "</tr>";
                }
               
            }else{

              // echo "<tr><td colspan='6'>Error de la data del producto: $producto</td></tr>";
            }
           
        }
        ?>
    </table> 

    <div class="imprimir">
        <a href="../lme_garcia_josue/fpdf/PruebaV.php" target="_blank"/>Imprimir</a>
    </div>
    <div class="limpiar">
        <button type="button" id="Limpiar" onclick="limpiarTabla()"> Limpiar</button>
        <!--
    <?php
    /*
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["producto"])) {
            $producto_a_eliminar = $_POST["producto"];
        
            // Leer el archivo de productos
            $productos = file("productos.txt");
        
            // Eliminar el producto del array de productos
            $productos_actualizados = array_diff($productos, array($producto_a_eliminar));
        
            // Escribir los productos actualizados de vuelta al archivo
            file_put_contents("productos.txt", implode("", $productos_actualizados));
        
            // Redirigir de vuelta a la página de productos
            header("Location: productos.php");
            exit;
        }
        */
        
    ?>-->
    <script>
         function limpiarTabla() {
            var table = document.getElementById("table");
            var rowCount = table.rows.length;
            // Empezamos desde 1 para omitir la fila de encabezado
            for (var i = 1; i < rowCount; i++) {
                table.deleteRow(1);
            }
        }
        </script>


    </body>
</html>
        
   