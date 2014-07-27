<?php
sleep(1);
$x=$_REQUEST['id'];
//Enviar correo
if($x=="send"){   
    sleep(1);
    //Recibiendo Datos enviados desde el formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $comentario = $_POST['comentario'];
    //Capturar Fecha y hora del envio
    date_default_timezone_set('America/Bogota');
    $fecha =date('Y-m-d');
    $hora =date('H:i:s');
    //Información para el envio del E-Mail
    $de= $correo;
    $para= 'josewen079@gmail.com,jose-wenseslao@outlook.com';
    $asunto= 'Soporte Alcaldía de Uré';
    $mensaje= $comentario;
    $cabeceras= "MIME-Version: 1.0\r\n";
    $cabeceras.= "Content-type: text/html; charset=iso-8859-1\r\n";
    $cabeceras.= "FROM: '".$de."'\r\n";
    $cabeceras.= "Reply-To: '".$de."'\r\n";
    
    $enviado = mail($para, $asunto, $mensaje, $cabeceras);
    if ($enviado) {
        $respuesta= "Correo enviado Exitosamente :)";
        //Como es una variable que no exite, Para que no mande alertas, avisos o mensajes el PHP por no estar definida lo mismo que @
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        //Si respuesta esta definida
        if (isset($respuesta)) {
           echo $respuesta; 
        }
        
    }else {
        $respuesta= "Ocurrió un Error al enviar el Correo :'(";
        //Como es una variable que no exite, Para que no mande alertas, avisos o mensajes el PHP por no estar definida lo mismo que @
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        //Si respuesta esta definida
        if (isset($respuesta)) {
           echo $respuesta; 
        }
    };
}
?>