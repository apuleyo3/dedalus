jQuery(document).ready(function(){

    /***************************************************************************************************************** */
    /* CAMBIAR IP DEL SISTEMA */
    /***************************************************************************************************************** */

    jQuery('div#cip').click(function(){
        let a = confirm('El sistema cambiará su IP principal, cargará en la nueva IP cuando el guardado sea exitoso, asegurese que su nueva IP esté dentro del rango permitido, ¿desea continuar?')

        if(a == true)
        {
            let new_ip = prompt('Escriba la nueva IP de sistema, recuerde que debe estar en el rango de la red local y con los octetos completos X.X.X.X')

            if(new_ip.length <= 7)
            {
                let new_ip = prompt('No ha ingresado una IP válida en el campo, por favor revise su elección y vuelva a intentarlo')
            }
            else
            {
                let conf = confirm('Confirma que desea cambiar la IP de trabajo, si continúa el sistema guardará la IP proporcionada y le redirigirá a la nueva IP de sistema')

                if(conf == true)
                {
                    location.replace(new_ip);
                }
            }
        }
    });

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