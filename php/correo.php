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
    $de = $correo;
    //Capturar Fecha y hora del envio
    date_default_timezone_set('America/Bogota');
    $fecha =date('Y-m-d');
    $hora =date('H:i:s');
    //Información para el envio del E-Mail
    $asunto= "Trabaje con Nosotros";
    $mensaje= '<div align="center">
                <table width="80%" align="center" cellspacing="5">
                  <tr>
                    <td width="20%" align="right"><strong>Solicitante:</strong></td>
                    <td width="80%" colspan="3">'.$nombres.' '.$apellidos.'</td>
                  </tr>
                  <tr>
                    <td align="right"><strong>E-mail:</strong></td>
                    <td colspan="3">'.$correo.'</td>
                  </tr>
                  <tr>
                    <td align="right"><strong>Teléfono:</strong></td>
                    <td colspan="3">'.$telefono.'</td>
                  </tr>
                  <tr>
                    <td align="right"><strong>Asunto:</strong></td>
                    <td colspan="3">'.$asunto.': Enviado el día '.$fecha.' a las '.$hora.'</td>
                  </tr>
                  <tr>
                    <td align="right"><strong>Solicitud:</strong></td>
                    <td colspan="3" rowspan="2" align="left" valign="top">
                        <div align="justify">
                            '.$comentario.'
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </div>';
    
    $ruta="../hojas/";//Ruta donde se cargará el archivo
    foreach ($_FILES as $key) { //Asigno el archivo a $key
        if($key["error"]== UPLOAD_ERR_OK){ //Verifico: Valor: 0; No hay error, archivo subido con éxito.
            $archivo_temp = $key["tmp_name"]; //Nombre temporar del archivo que se está cargando
            $nombre_archivo = $key["name"]; //Nombre real del archivo
            $destino_server = $ruta.$nombres." ".$apellidos.".pdf"; //Destino en el servidor
            //Ahora buscar la extención del archivo
            $dividir = explode(".", $nombre_archivo);//Dividir el nombre de su extencion
            $extencion = end($dividir);//Ahora toma el ultimo array es decir el nombre de la extencion
            
            if($extencion == "pdf" || $extencion == "PDF"){
                if(move_uploaded_file($archivo_temp, $destino_server)){
                    //Incluir la clase PHPmailer
                    include_once("class.phpmailer.php");
                    include_once("class.smtp.php");
                    
                    // Crear una nueva  instancia de PHPMailer habilitando el tratamiento de excepciones
                    $mail = new PHPMailer();    //Creamos un objeto de tipo PHPMailer
                    
                    // Configuramos el protocolo SMTP con autenticación
                    $mail->IsSMTP();    //Protocolo SMTP
                    $mail->SMTPAuth = true; //Autentificación en el SMTP
                    
                    // Configuración del servidor SMTP
                    $mail->SMTPSecure = "ssl"; //SSL security socket layer
                    $mail->Port = 465; //Puerto seguro del servidor SMTP
                    $mail->Host = "mail.contadorjavierdurango.com"; //servidor de SMTP de Gmail
                    $mail->Username = "Trabaje@contadorjavierdurango.com"; //Aquí pon tu correo de Gmail
                    $mail->Password = "lolita123"; //Aquí pon tu contraseña de Gmail
                    
                    // Configuración cabeceras del mensaje
                    $mail->CharSet = "UTF-8";
                    //$mail->IsHTML(true); //Se indica que el cuerpo del correo tendrá formato HTML
                    $mail->MsgHTML($mensaje); //Se indica que el cuerpo del correo tendrá formato HTML
                    $mail->From = $de; //Remitente del correo
                    $mail->FromName = "Aspirante a Trabaje con Nosotros"; //Nombre del Remitente
                    $mail->Subject = $asunto; //Asunto del correo
                    $mail->AddAddress("Contacto@contadorjavierdurango.com","Contador Javier Durango"); //Destinatario #1
                    //$mail->AddAddress("jose_wen_079@hotmail.com","Ing. Rodrigo García"); //Destinatario #2
                    //$mail->AddCC("usuariocopia@correo.com","Nombre copia 1"); //Destinatario copia
                    //$mail->AddBCC("usuariocopiaoculta@correo.com","Nombre copia Oculta"); //Destinatario copia oculta
                    //$mail->AddReplyTo('replyto@email.com', 'Gdocumentos Alcadía de Uré'); //Responder al correo..
                    
                    // Creamos en una variable el cuerpo, contenido HMTL, del correo
                    $mail->WordWrap = 50; //Numero de Columnas
                    $mail->Body = $mensaje; //Contenido del correo
                    $mail->AddAttachment($destino_server);//Adjuntamos el archivo al correo
                    
                    // Enviar el correo
                    if ($mail->Send()) { //Enviamos el correo por PHPMailer
                        echo "<h5>Correo enviado Exitosamente :)</h5>";
                    }else {
                        echo "<h6>Ocurrió un Error al enviar el Correo :'( Error: </h6>".$mail->ErrorInfo;
                    }
                }else {
                    echo "<h6>Ocurrió un Error al cargar el archivo :'( Error: </h6>";
                }
            }else {
                echo "<h6>No es un formato PDF valido :'(</h6>";
            }
        }
    }
        
}
?>