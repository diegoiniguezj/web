<?php

    if (empty($_POST["name"])) {
        exit("Falta el nombre");
    }
    if (empty($_POST["email"])) {
        exit("Falta el correo");
    }
    if (empty($_POST["message"])) {
        exit("Falta el mensaje");
    }

    $nombre = $_POST["name"];
    $correo = $_POST["email"];
    $tema = $_POST["subject"]; 
    $mensaje = $_POST["message"];

    $correo = filter_var($correo, FILTER_VALIDATE_EMAIL);
    if (!$correo) {
        echo "Correo inválido. Intenta con otro correo.";
        exit;
    }

    $asunto = "Nuevo mensaje desde sitio web";

    $datos = "De: $nombre\nCorreo: $correo\nTema: $tema\nMensaje: $mensaje";
    $mensaje = "Has recibido un mensaje desde el formulario de contacto de tu sitio web. Aquí están los detalles:\n\n$datos";
    $destinatario = "dij1980@hotmail.com"; # aquí la persona que recibirá los mensajes
    
    $encabezados = "Envía: contacto@cerezadigital.com\r\n"; # El remitente, debe ser un correo de tu dominio de servidor
    $encabezados .= "De: $nombre <" . $correo . ">\r\n";
    $encabezados .= "Remitente: $nombre <$correo>\r\n";
    $resultado = mail($destinatario, $asunto, $mensaje, $encabezados);

    if ($resultado) {
        echo "Mensaje enviado, ¡Gracias por contactarme!";
    } else {
        echo "Tu mensaje no se ha enviado. Intenta de nuevo.";
    }

?>