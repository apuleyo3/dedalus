<!DOCTYPE html>
<?php
include $_SERVER['DOCUMENT_ROOT']."/sys/jsondecode.php";

ob_start();
session_start();

$msg = '';
$factory = getJSON('/sys/settings.json', 'factory');

if($factory == 'no')
{
    $usr = getJSON('/sys/settings.json', 'custom_user');
    $pass = getJSON('/sys/settings.json', 'custom_pass');
}
else
{
    $usr = getJSON('/sys/settings.json', 'user');
    $pass = getJSON('/sys/settings.json', 'pass');
}

$admin = getJSON('/sys/settings.json', 'admin');
$apass = getJSON('/sys/settings.json', 'apass');
$version = getJSON('/sys/settings.json', 'version');


$_POST['username'] = md5($_POST['username']);
$_POST['password'] = md5($_POST['password']);
            
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
				
    if ($_POST['username'] == $usr && $_POST['password'] == $pass) {
        $_SESSION['valid'] = true;
        $_SESSION['username'] = 'admin';
        $session_val = 1;
    }
    else if($_POST['username'] == $admin && $_POST['password'] == $apass){
        $_SESSION['valid'] = true;
        $_SESSION['username'] = $usr;
        $session_val = 2;
    }
    else 
    {
        $msg = 'Usuario y/o contraseña inválida, por favor intente de nuevo';
        $session_val = 0;
    }
}
        

/*GENERAL VARIABLES*/

$localIP = shell_exec('hostname -I');
$groupIP = explode(" ", $localIP, 2);
$localIP = $groupIP[0];
$workIP = $_SERVER['REMOTE_ADDR'];
$initIP = getJSON();
?>
<html class="client-nojs" dir="ltr">
<?php if($session_val == 0): ?>
<head><title>IFS <?php echo $version; ?></title>
<script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
<link rel="icon" type="image/png" href="/images/favicon.png" />
<link rel="stylesheet" href="css/login.css" />
<script>
jQuery(document).ready(function(){

});
</script>
</head>
<body>
<div id="login-wrapper">
    <div id="login-inner-wrap">
        <div id="login-gen">
            <div id="logo"></div>
            <span id="copyright">ICARUS FLIGHT SYSTEM <?php echo $version; ?></span>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <span>Por favor ingrese el nombre de usuario y contraseña, que le fue entregado con la licencia de este producto</span>
                <input type="text" id="user" placeholder="Usuario"  name="username"/>
                <input type="password" id="pass" placeholder="Contraseña" name="password"/>
                <button id="send-pass"  type="submit" name="login" name = "login">Login</button>
            </form>
            <?php if($msg): ?>
                <div id="msg-block"><?php echo $msg; ?></div>
            <?php endif ?>
            <div id="icarus-logo"></div>
        </div>
    </div>
</div>
</body>
<?php elseif($session_val == 2): ?>
<head><title>IFS Admin panel <?php echo $version; ?></title>
<script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="js/admin.js" type="text/javascript"></script>
<link rel="icon" type="image/png" href="/images/favicon.png" />
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/admin.css" />
<link rel="stylesheet" href="css/balloon.min.css" />
<body>
<div id="reboot-overlay" class="smooth" style="opacity:0;"></div>
<header>
<div id="logo"><img src="images/ifslogo.png"></div><div id="title">SERVICE DASHBOARD<span class="version"><?php echo $version; ?></span></div>
<div id="self-ip" class="smooth" aria-label="IP del Icarus FS" data-balloon-pos="left"><div id="icon-eth"><img src="images/ethernet.png" width="24" /></div><span><?php echo $localIP; ?></span><div id="cip" class="men-icon system" aria-label="Cambiar IP" data-balloon-pos="down"><img src="/images/edit.png" width="18" /></div></div>
<?php
    $a0 = 0;
    $b0 = 0;
    $services = shell_exec('service ifsand status');
    $instrum = shell_exec('service ifstrum status');
    $sysblock = explode(PHP_EOL, $system);
    
    if(strlen($services) > 0)
    {
        $services = explode(PHP_EOL, $services);
        $a0 = 1;
    }

    if(strlen($instrum) > 0)
    {
        $instrum = explode(PHP_EOL, $instrum);
        $b0 = 1;
    }
?>
</header>
<aside id="system-status">
<span class="hardware-model"><span class="cup-v"><?php echo shell_exec("cat /proc/cpuinfo | grep  'model name' | sed 's/^.*: //' | head -1"); ?></span><span class="icarus-model"> ICARUS FLIGHT SYSTEM BASED MODEL</span></span>
</aside>
<div id="main-wrapper">
        <div id="main">
            <div id="system-specs" class="output-sec">
            <div class="dash-elem">
                <h2 class="dash-title">Anunciadores</h2>
                <?php if($a0 == 1): ?>
                    <span class="service-status"><ul><?php foreach($services as $key => $value){if($key < 3){echo '<li class="service-val">'.$value.'</li>';}} ?></ul></span>
                <?php else: ?>
                    <span class="service-status">El servicio no se encuentra activo, por favor reinicie el sistema o revise el log del sistema.</span>
                <?php endif ?>
            </div>
            <div class="dash-elem">
                <h2 class="dash-title">Instrumentos</h2>
                <?php if($b0 == 1): ?>
                    <span class="service-status"><ul><?php foreach($instrum as $key => $value){if($key < 3){echo '<li class="service-val">'.$value.'</li>';}} ?></ul></span>
                <?php else: ?>
                    <span class="service-status">El servicio no se encuentra activo, por favor reinicie el sistema o revise el log del sistema.</span>
                <?php endif ?>
            </div>
            </div>
            <div id="contest" class="output-sec">
                    <div id="output-board" class="inout-dashboard">
                        <div class="left-panel dash-elem">
                        <h2 class="dash-title">Output</h2>
                        <ul>
                        <?php
                        $outputb = conJSON('/sys/modules/outputs.json');
                        foreach($outputb as $key => $value)
                        {
                            $outname = $outputb[$key]["key"];
                            $outlet = $outputb[$key]["ports"];
                            $mytype = gettype($outlet);

                            echo '<li class="test-name"><span class="serv-name">'.$outname.'</span><ul class="smooth">';

                            if($mytype == 'array')
                            {
                                foreach($outlet as $key => $value)
                                {
                                    echo '<li>'.$value.'</li>';
                                }
                            }
                            else
                            {
                                echo '<li>'.$outlet.'</li>';
                            }

                            echo '</ul></li></li>';

                            
                        }
                        ?>
                        </ul>
                        </div>
                    </div>
                    <div id="input-board" class="inout-dashboard">
                        <div class="left-panel dash-elem">
                        <h2 class="dash-title">Input</h2>
                        <ul>
                        <?php
                        $inputb = conJSON('/sys/modules/inputs.json');
                        foreach($inputb as $key => $value)
                        {
                            $inname = $inputb[$key]["key"];
                            $inlet = $inputb[$key]["ports"];
                            $mytype = gettype($inlet);

                            echo '<li class="test-name"><span class="serv-name">'.$inname.'</span><ul class="smooth">';

                            if($mytype == 'array')
                            {
                                foreach($inlet as $key => $value)
                                {
                                    echo '<li>'.$value.'</li>';
                                }
                            }
                            else
                            {
                                echo '<li>'.$inlet.'</li>';
                            }

                            echo '</ul></li></li>';

                            
                        }
                        ?>
                        </ul>
                        </div>
                    </div>
            </div>
        </div>
</div>
<div id="under-menu">
            <div id="reload" class="men-icon system" aria-label="Reiniciar" data-balloon-pos="up"><img src="/images/reload.png" width="24" /></div>
            <div id="shutdown" class="men-icon system" aria-label="Apagar" data-balloon-pos="up"><img src="/images/shutdown.png" width="24" /></div>
            <div id="exit" class="men-icon system" aria-label="Salir" data-balloon-pos="up"><a href="/sys/logintest.php"  tite="Logout"><img src="/images/exit.png" width="24" /></a></div>
            <div id="footer-logo"><img src="images/icarus_min.png" /></div>
    </div>
</body>
<?php else: ?>
<head>
    <title>IFS user panel <?php echo $version; ?></title>
    <script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <link rel="stylesheet" href="css/balloon.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <script type="text/javascript">
        jQuery(document).ready(function(){
            var scansys; //VARIABLE QUE DETERMINA SI HAY CONEXIÓN CON XPLANE
            var reboot; //VARIABLE QUE DETERMINA SI EL SISTEMA YA REINICIÓ Y REINICIA LOS SERVICIOS

            console.log('<?php echo $initIP; ?>')
            console.log('<?php if($session_val == 0){echo 'Not logged in';} ?>')

            /******************************************************************************** */
            /* GUARDAR IP DE TRABAJO */ 
            /******************************************************************************** */

            jQuery('div#send-me').click(function(){
                let n = jQuery('#work-ip').val();
                console.log('IP = ' + n)
                jQuery.post('sys/jsonencode.php', { ip: n }).done(function(data){
                    console.log(data)
                    if(data == 'ip-saved')
                    {
                        location.reload();
                    }
                });
            });

            /******************************************************************************** */
            /* ESTABLECER IP DE FÁBRICA */
            /******************************************************************************** */

            jQuery('div#reset-me').click(function(){
                let n = "127.0.0.1";
                jQuery.post('sys/jsonencode.php', { ip: n }).done(function(data){
                    console.log(data)
                    if(data == 'ip-saved')
                    {
                        location.reload();
                    }
                });
            });
            
            /******************************************************************************** */
            /* EDITAR IP DE TRABAJO */ 
            /******************************************************************************** */

            jQuery('#edit-me').click(function(){
                jQuery('input#work-ip').removeAttr('disabled').removeClass('disabled')
                jQuery('#send-me').removeClass('disabled')
                jQuery(this).removeClass('visible')
            });

            /******************************************************************************** */
            /* CAMBIA EL STATUS DE LA CONEXIÓN */ 
            /******************************************************************************** */

            if(jQuery('#constat').text() == 'Esperando respuesta')
            {
                var n = ''
                var s = ''
                scansys = setInterval(() => {
                    jQuery.get('/sys/testcon.php', {}).done(function(data){
                        n = JSON.stringify(data);
                    }); 
                    s = n.charAt(1);
                    console.log(s)
                    if(s == 'c')
                    {   
                        jQuery("#constat").html('Conectado')
                        
                    }
                    else
                    {
                        jQuery("#constat").html('Esperando respuesta')
                    }
                }, 1000);
            }

            /*********************************************************************************************** */
            /* REINICIAR EL SISTEMA */
            /*********************************************************************************************** */

            var tm = 0
            jQuery('div#reload').click(function(){
                let a = confirm('¿Desea reiniciar el sistema?')
                clearInterval(scansys)
                
                if(a == true)
                {
                    try
                    {
                        jQuery.get('/sys/reboot.php', {}).done(function(){});
                    }
                    catch(error)
                    {
                        console.log(error)
                    }
                    jQuery('#reboot-overlay').addClass('active')

                    reboot = setInterval(() => {
                        tm++
                        checkServerStatus(tm);
                    }, 1000);
                    
                }
                
            });

            /*********************************************************************************************** */
            /* APAGAR EL SISTEMA */
            /*********************************************************************************************** */

            jQuery('#shutdown').click(function(){
                let a = confirm('¿Desea apagar el sistema?')

                if(a == true)
                {
                    window.top.close();
                    jQuery.get('/sys/shutdown.php', {})
                }
            })

            /*********************************************************************************************** */
            /* ESCANEAR ESTADO DE LA RED CON XPLANE */
            /*********************************************************************************************** */

            jQuery('div#scan-net').click(function(){
                jQuery('#network span.scan').removeClass('inactive')
                jQuery.post('/sys/xplanelook.php', {}).done(function(data){
                    let a = JSON.stringify(data)
                    jQuery('#network span.scan').addClass('inactive');
                    console.log(a)
                    /* EN LA RESPUESTA DE PYTHON EL PRIMER ELEMENTO ES EL CÓDIGO DE RESPUESTA
                    EL SEGUNDO EL NÚMERO DE NODOS CON XPLANE INSTALADO*/
                    let nodenum = parseInt(a.charAt(2));
                    let nodecode = a.charAt(1);

                    if(nodenum > 1)
                    {
                        jQuery.getJSON('/sys/settings.json', function(data){
                            let host = data[0]["ip"]
                            let hstgp = []
                            for(let j = 0; j < (nodenum+1); j++)
                            {
                                if(j == 0){
                                    hstgp[0] = '<span class="op" class="active-ip" aria-label="' + host + '" data-balloon-pos="down"></span>';
                                }
                                else{
                                    let a = "" + (j-1) 
                                    hstgp[j] = '<span class="op" aria-label="' + data[0][a] + '" data-balloon-pos="down"></span>';
                                }
                                
                            }
                            jQuery('#playground-options').html(hstgp)
                            jQuery('.op').click(function(){
                                    let a = jQuery(this).attr('aria-label');
                                    if(a == host){
                                        alert('Esta IP ya ha sido configurada como IP de trabajo, si desea cambiarla de click en cualquiera de las otras opciones')
                                    }
                                    else{
                                        let n = confirm('Ha seleccionado el host ' + a + ' como IP, ¿Desea continuar?')
                                        if(n == true)
                                        {
                                            jQuery.post('sys/jsonencode.php', { ip: a }).done(function(data){
                                                console.log(data)
                                                if(data == 'ip-saved')
                                                {
                                                    location.reload();
                                                }
                                            });
                                        }
                                    }
                            });
                        });
                    }
                    else if(nodenum == 1){
                        jQuery.getJSON('/sys/settings.json', function(data){
                            let host = data[0]["ip"]
                            if(nodecode == 'E')
                            {
                                alert('El equipo encontrado es el mismo que ya ha configurado en sistema, si desea cambiar la IP manualmente puede hacerlo presionando el botón "EDITAR" en la seccion "Configuración general de IP"')
                            }
                            else if(nodecode == 'X')
                            {
                                alert('No se encontraron instalaciones de XPLANE en esta red, verifique la conexión o el estado de su red y vuelva a intentarlo')
                            }
                            else if(nodecode == 'M')
                            {
                                alert('El IFS ha encontrado más de una instalación operativa de XPLANE en la red, seleccione alguna de las opciones que ')
                            }
                            else
                            {
                                let s = confirm("El sistema encontró una confirmación una instalación de XPLANE en la IP " + host + " ¿Desea que establecer la conexión a este equipo?")
                                if(s == true)
                                {
                                    jQuery.post('sys/jsonencode.php', { ip: host }).done(function(data){
                                        console.log(data)
                                        if(data == 'ip-saved')
                                        {
                                            location.reload();
                                        }
                                    });
                                }
                            }
                            
                        });
                        
                    }
                });
            });

            /*************************************************************************************** */
            /* CAMBIAR LA CONTRASEÑA QUE TIENE POR DEFAULT EL SISTEMA */
            /*************************************************************************************** */

            $('#cpass').change(function() {
                if(this.checked) {
                    var returnVal = confirm("¿Está seguro que desea continuar?");
                    $(this).prop("checked", returnVal);
                }
                if(returnVal == true)
                {
                    jQuery('#new-admin').removeAttr('disabled').removeClass('disabled');
                    jQuery('#new-pass').removeAttr('disabled').removeClass('disabled');
                    jQuery('div#npass').removeClass('disabled');
                    jQuery('#pass-settings .warning-box').removeClass('hidden')
                    jQuery('div#npass').removeClass('hidden')
                }
                else
                {
                    jQuery('#new-admin').attr('disabled', true).addClass('disabled').val('')
                    jQuery('#new-pass').attr('disabled', true).addClass('disabled').val('')
                    jQuery('#pass-settings .warning-box').addClass('hidden')
                    jQuery('div#npass').addClass('hidden')
                }     
            });

            jQuery('#npass').click(function(){

                let usr = jQuery('#new-admin').val();
                let pass = jQuery('#new-pass').val();
                let fact = "no";

                //console.log(usr + " " + pass)

                jQuery.post('sys/jsonencode.php', { cadmin: usr, cpass: pass, factory: fact }).done(function(data){
                    console.log(data)
                    if(data == 'keys-saved')
                    {
                        //location.reload();
                        location.href = '/sys/logintest.php'
                    }
                });
            });

            /*************************************************************************************** */
            /* RESTABLECER CONTRASEÑA DE FÁBRICA */
            /*************************************************************************************** */

            jQuery('div#factory-reset').click(function(){
                let usr = "";
                let pass = "";
                let fact = "yes";

                jQuery.post('sys/jsonencode.php', {factory: fact}).done(function(data){
                    console.log(data)
                    if(data == 'reset')
                    {
                        location.href = '/sys/logintest.php'
                    }
                });

            });

            //************************************************************************************************************************* */
            //FUNCIÓN QUE REVISA EL ESTADO DEL REBOOT DIRECTAMENTE SOBRE SERVIDOR, UNA VEZ INICIADO, REGRESA LAS FUNCIONES A LA NORMALIDAD
            //************************************************************************************************************************* */

            function checkServerStatus(count)
            {
                //console.log(tm)
              if(count > 45)
              {
                jQuery('#reboot-overlay').removeClass('active');
                clearInterval(reboot)
                location.reload();
              }
            }
                    
        });
    </script>
</head>
<body>
<div id="reboot-overlay" class="smooth"></div>
    <header>
    <div id="logo"><img src="images/ifslogo.png"></div><div id="title">USER DASHBOARD<span class="version"><?php echo $version; ?></span></div>
        <div id="self-ip" class="smooth" aria-label="IP del Icarus FS" data-balloon-pos="left"><div id="icon-eth"><img src="images/ethernet.png" width="24" /></div><span><?php echo $localIP; ?></span></div>
    </header>
    <aside id="system-status">
        <?php if($initIP == '127.0.0.1'): ?>
        <div id="status-light"><span id="light" class="yellow"></span></div>
        <div id="status-msg" aria-label="Sin conexiones a XPLANE encontradas" data-balloon-pos="down">Sin configurar</div>
        <?php else: ?>
        <div id="status-light"><span id="light" class="light-green"></span></div>
        <div id="status-msg"><span id="constat">Esperando respuesta</span><span>(XPLANE en <?php echo $initIP; ?>)</span></div>
        <?php endif ?>
        
    </aside>
    <div id="main-wrapper">
        <div id="main">
            <div id="working-ip" class="output-sec">
                <h2 class="section-title">Configuración manual de IP</h2>
                <div class="general-paragraph">
                    <?php if($initIP == '127.0.0.1'): ?>
                    <span>El IFS detecta automáticamente las conexiones a XPLANE en su red, es posible que la red no esté configurada adecuadamente o que se encuentre en un rango distinto, si conoce la IP del equipo donde se encuentra su Xplane, escríbalo en el siguiente espacio.</span>
                    <form><input id="work-ip" type="text" name="ip" value=<?php echo '"'.$workIP.'"'; ?>></form>
                    <div id="send-me">Guardar</div>
                    <?php else: ?>
                    <span>Esta es la IP donde se encuentra XPLANE, determinada por el sistema o de forma manual por usted, si desea cambiarla o XPLANE se encuentra en otra dirección, presione el botón 'Editar' para ingresar una nueva dirección IP</span>
                    <form><input id="work-ip" class="disabled" type="text" name="ip" value=<?php echo '"'.$initIP.'"'; ?> disabled></form>
                    <div id="send-me" class="disabled">Guardar</div>
                    <div id="edit-me" class="visible">Editar</div>
                    <div id="reset-me" class="visible">Reset</div>
                    <?php endif ?>
                </div>
            </div>
            <div id="network" class="output-sec">
                <div class="general-title">
                    <h2 class="section-title">XPLANE Network</h2>
                    <div id="scan-net" class="scan men-icon"  aria-label="Escánear" data-balloon-pos="up"><img src="/images/scan.png" width="24" /></div>
                    <div class="general-paragraph">
                    <span class="scan inactive smooth">Revisando</span>
                    <span>Esta sección se activará si el IFS encuentra más de una instalación de Xplane en su sistema, si usted cuenta con un sistema así y no está reflejado en esta sección, verifique el estado de su red local y presione el botón 'escanear'</span>
                    
                </div>
                    <div id="network-playground">
                        <?php if($initIP == '127.0.0.1'): ?>
                        <div id="playground-elems" class="connected">
                            <div id="my-computer" class="play-elem no-con" aria-label=<?php echo '"'.$localIP.'"'; ?> data-balloon-pos="down"></div>
                            <div id="connection" class="no-con" ></div>
                            <div id="xplane-computer" class="play-elem no-con" aria-label="Sin configuración"  data-balloon-pos="down"></div>
                        </div>
                        <div id="playground-options"></div>
                        <?php else: ?>
                        <div id="playground-elems" class="connected">
                            <div id="my-computer" class="play-elem" aria-label=<?php echo '"'.$localIP.'"'; ?> data-balloon-pos="down"></div>
                            <div id="connection" ></div>
                            <div id="xplane-computer" class="play-elem" aria-label=<?php echo '"'.$initIP.'"'; ?> data-balloon-pos="down"></div>
                        </div>
                        <div id="playground-options"></div>
                        <?php endif ?>
                    </div>
                </div>
                
            </div>
            <div id="doc" class="output-sec">
                <div class="general-title">
                    <h2 class="section-title">Documentación</h2>
                </div>
                <div class="general-paragraph">
                    <span>Para descargar el PDF del <b>Manual del Usuario del IFS</b>, da click en el siguiente <b>enlace</b>.</span>
                </div>
            </div>
            <div id="pass-settings" class="output-sec smooth">
                <div class="general-title">
                    <h2 class="section-title">Opciones generales</h2>
                    <div class="switch-place"><!-- Rectangular switch --><label class="switch"><input id="cpass" type="checkbox"><span class="slider"></span></label></div>
                    <?php if($factory == 'no'): ?>
                    <div id="factory-reset" aria-label="Restablecer valores de fábrica" data-balloon-pos="up"><span class="icon smooth"></span></div>
                    <?php endif ?>
                </div>
                <div class="general-paragraph">
                    <span>Puedes cambiar el usuario y contraseña de fábrica, ingresando tus nuevas entradas en estos campos</span>
                        <div class="warning-box hidden smooth">
                            <span class="warning">Si cambias las claves de fábrica, solo podrás regresarlas a su estado original en este panel, si llegas a olvidar tus claves será necesario ingresar la clave de fábrica que viene con tu licencia</span>
                        </div>
                    <div id="password-box">
                            <form>
                            <input id="new-admin" class="disabled" name="new-admin" type="text" placeholder="Usuario" disabled />
                            <input id="new-pass" class="disabled" name="new-pass" type="password" placeholder="Contraseña" disabled />
                            <div id="npass" class="save-me disabled">Guardar<div>
                            </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <div id="help" class="output-sec">
                <div class="general-title">
                    <h2 class="section-title">Ayuda</h2>
                    <span class="contact-info"><a href="mailto:contacto@openicarus.org" target="_blank">contacto@openicarus.org</a></span>
                </div>
                <div class="general-paragraph">
                    <span>¿Necesitas ayuda? Puedes enviarnos un mensaje en el siguiente link, ingresando tus datos nos pondremos en contacto contigo, asegúrate de estar conectado a Internet, si no es el caso, puedes contactarnos por correo electrónico</span>
                    </div>
                    <div class="ticket-box" class="inner-content">
                        <h2>Envíanos un ticket</h2>
                        <span class="contact-info"><a href="#" target="_blank">Ir al sitio de soporte</a></span>
                        <span>Si tienes alguna falla importante o el IFS simplemente no conecta con tu XPLANE, envíanos un ticket y con mucho gusto te ayudaremos, el promedio de respuesta varía en relación a la gravedad del problea <b>(Según sea el caso, puede generar costos adicionales)</b></span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div id="under-menu">
            <div id="settings" class="men-icon" aria-label="Status" data-balloon-pos="up"><a href="#system-status"><img src="/images/connection.png" width="24" /></a></div>
            <div id="settings" class="men-icon" aria-label="IP Principal" data-balloon-pos="up"><a href="#working-ip"><img src="/images/ip.png" width="24" /></a></div>
            <div id="net" class="men-icon" aria-label="XPLANE Network" data-balloon-pos="up"><a href="#network"><img src="/images/network.png" width="24" /></a></div>
            <div id="manual" class="men-icon" aria-label="Documentación" data-balloon-pos="up"><a href="#doc"><img src="/images/manual.png" width="24" /></a></div>
            <div id="settings" class="men-icon" aria-label="Opciones" data-ballon-pos="up"><a href="#pass-settings"><img src="/images/cog.png" width="24"/></a></div>
            <div id="help" class="men-icon" aria-label="Ayuda" data-balloon-pos="up"><a href="#help"><img src="/images/help.png" width="24" /></a></div>
            <div id="reload" class="men-icon system" aria-label="Reiniciar" data-balloon-pos="up"><img src="/images/reload.png" width="24" /></div>
            <div id="shutdown" class="men-icon system" aria-label="Apagar" data-balloon-pos="up"><img src="/images/shutdown.png" width="24" /></div>
            <div id="exit" class="men-icon system" aria-label="Salir" data-balloon-pos="up"><a href="/sys/logintest.php"  tite="Logout"><img src="/images/exit.png" width="24" /></a></div>
            <div id="footer-logo"><img src="images/icarus_min.png" /></div>
    </div>
</body>
<?php endif ?>
</html>
