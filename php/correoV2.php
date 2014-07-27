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
    $asunto= "Soporte Alcaldía de Uré";
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
    $mail->Host = "smtp.gmail.com"; //servidor de SMTP de Gmail
    $mail->Username = "josewen079@gmail.com"; //Aquí pon tu correo de Gmail
    $mail->Password = "wenseslaomedellin"; //Aquí pon tu contraseña de Gmail
    
    // Configuración cabeceras del mensaje
    $mail->CharSet = "UTF-8";
    //$mail->IsHTML(true); //Se indica que el cuerpo del correo tendrá formato HTML
    $mail->MsgHTML($mensaje); //Se indica que el cuerpo del correo tendrá formato HTML
    $mail->From = $de; //Remitente del correo
    $mail->FromName = "Gestor Documental Alcaldía de Uré"; //Nombre del Remitente
    $mail->Subject = $asunto; //Asunto del correo
    $mail->AddAddress("jose-wenseslao@outlook.com","Ing. José Wenseslao"); //Destinatario #1
    //$mail->AddAddress("jose_wen_079@hotmail.com","Ing. Rodrigo García"); //Destinatario #2
    //$mail->AddCC("usuariocopia@correo.com","Nombre copia 1"); //Destinatario copia
    //$mail->AddBCC("usuariocopiaoculta@correo.com","Nombre copia Oculta"); //Destinatario copia oculta
    //$mail->AddReplyTo('replyto@email.com', 'Gdocumentos Alcadía de Uré'); //Responder al correo..
    
    // Creamos en una variable el cuerpo, contenido HMTL, del correo
    $mail->WordWrap = 50; //Numero de Columnas
    $mail->Body = $mensaje; //Contenido del correo
    
    // Enviar el correo
    if ($mail->Send()) { //Enviamos el correo por PHPMailer
        echo "Correo enviado Exitosamente :)";
    }else {
        echo "Ocurrió un Error al enviar el Correo :'( Error: ".$mail->ErrorInfo;
    }
}
?>