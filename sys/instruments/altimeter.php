<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Altimeter</title>
    <script src="/js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <style>
    div#altimeter {
    display: inline-block;
    width: 500px;
    height: 500px;
    position: relative;
}
#manc-3, #manc-1{
    -webkit-transition: all .25s ease-in-out;
-moz-transition: all .25s ease-in-out;
-ms-transition: all .25s ease-in-out;
-o-transition: all .25s ease-in-out;
transition: all .25s ease-in-out;
}
div#manc-3 {
    position: absolute;
    display: inline-block;
    width: 45px;
    height: 220px;
    left: 229px;
    z-index: 100;
    top: 30px;
    transform: rotate(0deg);
    transform-origin: bottom;
}
div#manc-1 {
    width: 57px;
    position: absolute;
    left: 219px;
    top: 136px;
    z-index: 1;
    transform: rotate(0);
    transform-origin: center;
}
#layer_3 .cls-1{fill:#fff;}
#layer_2 .cls-2 {fill: #000000;} 
#layer_2 .cls-2{fill:#262827;}
#manc-3 polygon.cls-1 {fill: white;}
    </style>
    <script>
    let manc = 0
    let danc = 0
    let sec = 0

    var frate = setInterval(() => {

        ref = "sim/cockpit2/gauges/indicators/altitude_ft_pilot"

        jQuery.post('getData.php', {dref : ref}).done(function(data){

            console.log('data = ' + data)

            manc = ((parseInt(data))/1000)
            danc = manc*360
            sec = danc*0.1
        })

        console.log('manc = ' + manc)
        console.log('danc = ' + danc)

        jQuery('#manc-3').css("transform", "rotate(" + danc + "deg)");
        jQuery('#manc-1').css("transform", "rotate(" + sec + "deg)");
        
    }, 64);

    //****************************************************************************************** */
    //DETECCIÓN GENERAL DE MOVIMIENTO DEL RATÓN, SOLO PARA PRUEBAS
    //****************************************************************************************** */

    /*function detectMouseWheelDirection( e )
    {
        var delta = null,
            direction = false
        ;
        if ( !e ) { // if the event is not provided, we get it from the window object
            e = window.event;
        }
        if ( e.wheelDelta ) { // will work in most cases
            delta = e.wheelDelta / 60;
        } else if ( e.detail ) { // fallback for Firefox
            delta = -e.detail / 2;
        }
        if ( delta !== null ) {
            direction = delta > 0 ? 'up' : 'down';
        }

        return direction;
    }
    function handleMouseWheelDirection( direction )
    {
        console.log( direction ); // see the direction in the console
        if ( direction == 'down' ) {
            // do something, like show the next page

            if(manc > 0)
            {
                manc--
            }
            if(sec > 0)
            {
                let a = 10*(sec-1);
                console.log('a-minus = ' + a)

                if(manc == a)
                {
                        sec--
                }
            }

            
            

        } else if ( direction == 'up' ) {
            // do something, like show the previous page

            if(manc >= 0)
            {
                manc++
            }

            if(sec == 0)
            {
                if(manc == 10)
                {
                    sec = 1;
                }
            }
            else
            {
                let a = 10*(sec+1);
                console.log('a-max = ' + a)

                if(manc == a)
                {
                    sec++
                }
                
            }

        } else {
            // this means the direction of the mouse wheel could not be determined
        }
        jQuery('#manc-3').css("transform", "rotate(" + manc + "deg)")

        

        jQuery('#manc-1').css("transform", "rotate(" + sec + "deg)")


        
    }
    document.onmousewheel = function( e ) {
        handleMouseWheelDirection( detectMouseWheelDirection( e ) );
    };
    if ( window.addEventListener ) {
        document.addEventListener( 'DOMMouseScroll', function( e ) {
            handleMouseWheelDirection( detectMouseWheelDirection( e ) );
        });
    }   */
    </script>
</head>
<body>
<div id="altimeter">
<div id="manc-3">
<svg id="3" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 492.53"><defs></defs><title>alt-man-2</title><path d="M627.28,711c-15.91,4.72-20.91,47.25,15,47.25,32.1,0,32.1-43.53,12.56-48.66-.46-11.87,1-115.5,1-115.5l-29.25.12S627.28,699.32,627.28,711Z" transform="translate(-613.06 -265.75)"/><polygon class="cls-1" points="13.54 328.49 42.79 328.37 38.86 28.1 27.61 0 12.92 29.33 13.54 328.49"/><circle cx="29" cy="328.84" r="29"/></svg>
</div>
<div id="manc-1">
<svg id="layer_2" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 85.26 296.87"><defs></defs><title>alt-man-1</title><polygon class="cls-1" points="63.93 148.5 75.4 70.88 51.46 0 45.27 0.98 18.13 70.42 30.4 148.5 59.14 148.5 63.93 148.5"/><path class="cls-2" d="M597.74,644a63.7,63.7,0,0,0,42.86,16.4c28.82,0,42.4-16.4,42.4-16.4l-21.33-78.52V512.05H628.14l-2,53.46Z" transform="translate(-597.74 -363.55)"/></svg>
</div>
<div id="altimeter-back">
<svg id="layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 848.07 840.01"><defs><style>#layer_1 .cls-1{fill:#262827;} #layer_1 .cls-2{font-size:75.09px;}#layer_1 .cls-10, #layer_1 .cls-2, #layer_1 .cls-4, #layer_1 .cls-6, #layer_1 .cls-7{fill:#fff;font-family:FuturaPT-Book, Futura PT;} #layer_1 .cls-3,#layer_1 .cls-9{fill:none;}#layer_1 .cls-3{stroke:#fff;stroke-width:2px;} #layer_1 .cls-4,#layer_1 .cls-6{font-size:30px;}#layer_1 .cls-4{letter-spacing:-0.06em;}#layer_1 .cls-5{letter-spacing:0em;}#layer_1 .cls-6{letter-spacing:0.05em;}#layer_1 .cls-7{font-size:50px;}#layer_1 .cls-8{letter-spacing:-0.02em;}#layer_1 .cls-10{font-size:15px;}#layer_1 .cls-11{letter-spacing:-0.05em;}</style></defs><title>altimeter</title><path class="cls-1" d="M1405.08,532.48c0,232-189.85,420-424,420s-424-188-424-420,189.85-420,424-420S1405.08,300.52,1405.08,532.48Z" transform="translate(-557.01 -112.48)"/><text class="cls-2" transform="translate(399.47 188.96)">0</text><text class="cls-2" transform="translate(245.85 246.82)">9</text><text class="cls-2" transform="translate(158.98 368.75)">8</text><text class="cls-2" transform="translate(162.8 525.94)">7</text><text class="cls-2" transform="translate(253.97 632.86)">6</text><text class="cls-2" transform="translate(401.8 691.07)">5</text><text class="cls-2" transform="translate(555.97 638.51)">4</text><text class="cls-2" transform="translate(647.34 508.02)">3</text><text class="cls-2" transform="translate(645.51 362.48)">2</text><text class="cls-2" transform="translate(554.42 232.45)">1</text><line class="cls-3" x1="424.04" y1="129.13" x2="424.04" y2="30.53"/><line class="cls-3" x1="381.39" y1="81.93" x2="375.32" y2="33.64"/><line class="cls-3" x1="339.38" y1="89.96" x2="327.3" y2="42.82"/><line class="cls-3" x1="298.74" y1="103.15" x2="280.84" y2="57.88"/><line class="cls-3" x1="260.03" y1="121.38" x2="236.63" y2="78.71"/><line class="cls-3" x1="253.24" y1="184.67" x2="195.34" y2="104.95"/><line class="cls-3" x1="191.01" y1="171.62" x2="157.72" y2="136.12"/><line class="cls-3" x1="161.74" y1="202.78" x2="124.25" y2="171.75"/><line class="cls-3" x1="136.59" y1="237.44" x2="95.56" y2="211.32"/><line class="cls-3" x1="115.98" y1="274.94" x2="71.97" y2="254.18"/><line class="cls-3" x1="147.64" y1="330.16" x2="54" y2="299.64"/><line class="cls-3" x1="89.61" y1="356.15" x2="41.86" y2="347.04"/><line class="cls-3" x1="84.25" y1="398.63" x2="35.72" y2="395.59"/><line class="cls-3" x1="84.25" y1="441.43" x2="35.72" y2="444.48"/><line class="cls-3" x1="89.61" y1="483.85" x2="41.86" y2="492.97"/><line class="cls-3" x1="147.64" y1="509.91" x2="54" y2="540.36"/><line class="cls-3" x1="115.98" y1="565.13" x2="71.97" y2="585.82"/><line class="cls-3" x1="136.59" y1="602.63" x2="95.56" y2="628.69"/><line class="cls-3" x1="161.74" y1="637.22" x2="124.25" y2="668.26"/><line class="cls-3" x1="191.01" y1="668.45" x2="157.72" y2="703.95"/><line class="cls-3" x1="252.07" y1="654.49" x2="195.34" y2="735.12"/><line class="cls-3" x1="260.03" y1="718.63" x2="236.63" y2="761.3"/><line class="cls-3" x1="298.74" y1="736.86" x2="280.84" y2="782.12"/><line class="cls-3" x1="339.38" y1="750.11" x2="327.3" y2="797.25"/><line class="cls-3" x1="381.39" y1="758.13" x2="375.32" y2="806.43"/><line class="cls-3" x1="424.04" y1="710.93" x2="424.04" y2="809.47"/><line class="cls-3" x1="466.76" y1="758.13" x2="472.83" y2="806.43"/><line class="cls-3" x1="508.7" y1="750.11" x2="520.85" y2="797.25"/><line class="cls-3" x1="549.41" y1="736.86" x2="567.31" y2="782.12"/><line class="cls-3" x1="588.05" y1="718.63" x2="611.51" y2="761.3"/><line class="cls-3" x1="594.91" y1="655.32" x2="652.74" y2="735.12"/><line class="cls-3" x1="657.13" y1="668.45" x2="690.41" y2="703.95"/><line class="cls-3" x1="686.41" y1="637.22" x2="723.83" y2="668.26"/><line class="cls-3" x1="711.48" y1="602.63" x2="752.59" y2="628.69"/><line class="cls-3" x1="732.1" y1="565.13" x2="776.11" y2="585.82"/><line class="cls-3" x1="700.43" y1="509.91" x2="794.14" y2="540.36"/><line class="cls-3" x1="758.47" y1="483.85" x2="806.29" y2="492.97"/><line class="cls-3" x1="763.83" y1="441.43" x2="812.36" y2="444.48"/><line class="cls-3" x1="763.83" y1="398.63" x2="812.36" y2="395.59"/><line class="cls-3" x1="758.47" y1="356.15" x2="806.29" y2="347.04"/><line class="cls-3" x1="700.43" y1="330.16" x2="794.14" y2="299.64"/><line class="cls-3" x1="732.1" y1="274.94" x2="776.11" y2="254.18"/><line class="cls-3" x1="711.48" y1="237.44" x2="752.59" y2="211.32"/><line class="cls-3" x1="686.41" y1="202.78" x2="723.83" y2="171.75"/><line class="cls-3" x1="657.13" y1="171.62" x2="690.41" y2="136.12"/><line class="cls-3" x1="594.91" y1="184.67" x2="652.74" y2="104.95"/><line class="cls-3" x1="588.05" y1="121.38" x2="611.51" y2="78.71"/><line class="cls-3" x1="549.41" y1="103.15" x2="567.31" y2="57.88"/><line class="cls-3" x1="508.7" y1="89.96" x2="520.85" y2="42.82"/><line class="cls-3" x1="466.76" y1="81.93" x2="472.83" y2="33.64"/><text class="cls-4" transform="matrix(0.99, -0.12, 0.12, 0.99, 340.96, 119.85)">1<tspan class="cls-5" x="15.15" y="0">00</tspan></text><text class="cls-6" transform="translate(474.48 115.21) rotate(10)">FEET</text><text class="cls-7" transform="translate(466.34 398.33)">A<tspan class="cls-8" x="31.1" y="0">L</tspan><tspan x="48.1" y="0">T</tspan></text><line class="cls-9" x1="660.35" y1="441.48" x2="614.71" y2="441.48"/><text class="cls-10" transform="translate(291.29 395.57)">CALIBR<tspan class="cls-11" x="43.56" y="0">A</tspan><tspan x="52.21" y="0">TED</tspan></text></svg>
</div>
</div>
</body>
</html>