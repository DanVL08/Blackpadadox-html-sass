<?php

if (isset($_POST['submit'])){
    /**
     * Si no están llenos los campos, se regresa a contacto con un error
     */
    if (
        empty($_POST['nombre']) || 
        empty($_POST['email'])  || 
        empty($_POST['mensaje'])
    ){
        header('Location: ../contacto.html?llena-todos-los-campos');
        exit();
    } else {

        //DATOS DEL FORMULARIO A ENVIAR
        $info['nombre'] = $_POST['nombre'];
        $info['email']  = $_POST['email'];
        $info['telefono'] = $_POST['tel'];
        if (empty($_POST['tel'])){
            $info['telefono'] = "No ingresó numero de teléfono";
        } else {
            $info['telefono'] = $_POST['tel'];
        }
        $info['mensaje'] = $_POST['mensaje'];
        $info['ip'] = $_SERVER['REMOTE_ADD'];
        $info['fecha'] = date('d M  H:i:sz');
        /**
         * Solo para probar localmente
         */
        $mensaje =
        "
        <html>
        <body>
            <h3>Tu mensaje ha sido enviado</h3>
            <p><strong>Nombre:</strong> $info['nombre'] </p>
            <p><strong>Email:</strong> $info['email'] </p>
            <p><strong>Teléfono:</strong> $info['telefono'] </p>
            <p><strong>mensaje: <strong> $info['mensaje'] </p>
            <br>
            <p><strong>IP</strong>{$info['ip']}</p>
            <p><strong>IP</strong>{$info['fecha']}</p>
        </body>
        </html>
        ";

        /**
         * Envío real del formulario
         */

        $para = "daniellopez882017@gmail.com";
        $de = $para

        //Asunto del correo
        $asunto = "Hola, es mi primer correo -  Blackparadox";

        //Cabeceras que aparecen arriba de tus correos
        $headers = "From: $de\r\n";
        $headers.= "MIME-Version 1.0\r\n";
        $headers.= "Content-type: text/html; charset=utf8\r\n";

        //Mensaje
        //$mensaje es el Mensaje

        //Enviando el  formulario
        $enviar = mail($para,$asunto,$mensaje,$headers);
        if ($enviar) {
            //si se envio el correo
            echo "mensaje enviado!";
        } else {
            echo "Uppss! no se envio el mensaje";
            echo "<pre>";
            var_dump($enviar);
        }
    }


 } else {
    /**
     * Si no se manda el formulario, se regresa a contacto con un error
     */
    header('Location: ../contacto.html?error');
 }

 ?>
<br>
<a href="../contacto.html">Regresar</a>