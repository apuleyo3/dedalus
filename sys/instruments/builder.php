<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Altimeter</title>
    <script src="/js/jquery-3.4.1.min.js" type="text/javascript"></script>
<style>
body {
    margin: 0;
    background: black;
}
div#attitud-garmin {
    width: 550px;
    margin: auto;
    padding: 50px;
    position: relative;
    z-index: 1;
}
div#attitud-wrap {
    background: #0047f7;
    width: 1000px;
    height: 850px;
    margin: auto;
    overflow: hidden;
}

div#horizontal-back {
    width: 3000px;
    height: 3000px;
    position: relative;
    padding: 0;
    background: #3f2001;
    border-top: 4px solid white;
    transform: rotate(0deg);
    transform-origin: top;
    margin: auto;
    z-index: 0;
    right: 1043px;
    bottom: 256px;
    -webkit-transition: all .15s linear;
-moz-transition: all .15s linear;
-ms-transition: all .15s linear;
-o-transition: all .15s linear;
transition: all .15s linear;
}

</style>
<script>
    jQuery(document).ready(function(){
        
        var getAttitude = setInterval(() => {
            jQuery.get('getData.php', {}).done(function(data){
                let a = data.replace(/[\[\]',()]+/g, '');
                let b = a.split(' ')
                let capbot = jQuery('#horizontal-back').css('bottom');
                let botfin = 256 - (parseFloat(b[0])*5)
                let rot = (Math.floor(parseFloat(b[1])))*-1
                console.log(rot)
                if(a.length < 2)
                {

                }
                else
                {
                    jQuery('div#horizontal-back').css({"transform": "rotate(" + rot + "deg)", 'bottom': botfin + 'px'})
                }
            });
        }, 16);
    });
</script>
</head>
<body>
<div id="attitud-wrap">
<div id="attitud-garmin">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 399.16 354.49"><title>garmin1</title>
<g id="roll-group">
<g id="grades"><line x1="142.84" y1="68.78" x2="254.84" y2="68.78" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="142.84" y1="209.78" x2="254.84" y2="208.78" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="142.84" y1="278.78" x2="252.84" y2="278.78" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="142.84" y1="345.78" x2="254.84" y2="345.78" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="225.84" y1="176.78" x2="171.84" y2="176.78" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="225.84" y1="313.78" x2="171.84" y2="313.78" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="225.84" y1="243.78" x2="171.84" y2="243.78" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><path d="M764.17,290.88H754.3l3.92-5.22c.44-.59.82-1.12,1.12-1.59a14,14,0,0,0,.72-1.24,4.56,4.56,0,0,0,.51-2.08,1.55,1.55,0,0,0-.25-.92.76.76,0,0,0-.65-.35c-.62,0-.93.58-.93,1.75v.22c0,.09,0,.19,0,.31H755l0-.52a4.89,4.89,0,0,1,1.34-3.55,4.55,4.55,0,0,1,3.44-1.39,4.38,4.38,0,0,1,3.3,1.32,4.55,4.55,0,0,1,1.29,3.37,6.53,6.53,0,0,1-.88,3.24,11.49,11.49,0,0,1-1.16,1.66,18.72,18.72,0,0,1-1.72,1.82c.58,0,1.17-.07,1.76-.09s1.2,0,1.82,0Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M775.9,283.81a9.38,9.38,0,0,1-1.34,5.35,4.11,4.11,0,0,1-3.59,2,4.4,4.4,0,0,1-3.82-2,9.69,9.69,0,0,1-1.37-5.55,9.15,9.15,0,0,1,1.37-5.32,4.34,4.34,0,0,1,3.73-2,4.2,4.2,0,0,1,3.69,2A9.84,9.84,0,0,1,775.9,283.81Zm-3.82,0c0-2.77-.42-4.15-1.25-4.15s-1.25,1.24-1.25,3.71c0,3,.41,4.44,1.22,4.44.44,0,.76-.33,1-1A10.69,10.69,0,0,0,772.08,283.79Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M910.17,290.88H900.3l3.92-5.22c.44-.59.82-1.12,1.12-1.59a14,14,0,0,0,.72-1.24,4.56,4.56,0,0,0,.51-2.08,1.55,1.55,0,0,0-.25-.92.76.76,0,0,0-.65-.35c-.62,0-.93.58-.93,1.75v.22c0,.09,0,.19,0,.31H901l0-.52a4.89,4.89,0,0,1,1.34-3.55,4.55,4.55,0,0,1,3.44-1.39,4.38,4.38,0,0,1,3.3,1.32,4.55,4.55,0,0,1,1.29,3.37,6.53,6.53,0,0,1-.88,3.24,11.49,11.49,0,0,1-1.16,1.66,18.72,18.72,0,0,1-1.72,1.82c.58,0,1.17-.07,1.76-.09s1.2,0,1.82,0Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M921.9,283.81a9.38,9.38,0,0,1-1.34,5.35,4.11,4.11,0,0,1-3.59,2,4.4,4.4,0,0,1-3.82-2,9.69,9.69,0,0,1-1.37-5.55,9.15,9.15,0,0,1,1.37-5.32,4.34,4.34,0,0,1,3.73-2,4.2,4.2,0,0,1,3.69,2A9.84,9.84,0,0,1,921.9,283.81Zm-3.82,0c0-2.77-.42-4.15-1.25-4.15s-1.25,1.24-1.25,3.71c0,3,.41,4.44,1.22,4.44.44,0,.76-.33,1-1A10.69,10.69,0,0,0,918.08,283.79Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M764.17,568.88H754.3l3.92-5.22c.44-.59.82-1.12,1.12-1.59a14,14,0,0,0,.72-1.24,4.56,4.56,0,0,0,.51-2.08,1.55,1.55,0,0,0-.25-.92.76.76,0,0,0-.65-.35c-.62,0-.93.58-.93,1.75v.22c0,.09,0,.19,0,.31H755l0-.52a4.89,4.89,0,0,1,1.34-3.55,4.55,4.55,0,0,1,3.44-1.39,4.38,4.38,0,0,1,3.3,1.32,4.55,4.55,0,0,1,1.29,3.37,6.53,6.53,0,0,1-.88,3.24,11.49,11.49,0,0,1-1.16,1.66,17.64,17.64,0,0,1-1.72,1.82c.58,0,1.17-.07,1.76-.09s1.2,0,1.82,0Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M775.9,561.82a9.37,9.37,0,0,1-1.34,5.34,4.11,4.11,0,0,1-3.59,2,4.4,4.4,0,0,1-3.82-2,9.69,9.69,0,0,1-1.37-5.55,9.15,9.15,0,0,1,1.37-5.32,4.34,4.34,0,0,1,3.73-2,4.2,4.2,0,0,1,3.69,2A9.85,9.85,0,0,1,775.9,561.82Zm-3.82,0c0-2.77-.42-4.15-1.25-4.15s-1.25,1.24-1.25,3.71c0,3,.41,4.44,1.22,4.44.44,0,.76-.33,1-1A10.69,10.69,0,0,0,772.08,561.79Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M910.17,568.88H900.3l3.92-5.22c.44-.59.82-1.12,1.12-1.59a14,14,0,0,0,.72-1.24,4.56,4.56,0,0,0,.51-2.08,1.55,1.55,0,0,0-.25-.92.76.76,0,0,0-.65-.35c-.62,0-.93.58-.93,1.75v.22c0,.09,0,.19,0,.31H901l0-.52a4.89,4.89,0,0,1,1.34-3.55,4.55,4.55,0,0,1,3.44-1.39,4.38,4.38,0,0,1,3.3,1.32,4.55,4.55,0,0,1,1.29,3.37,6.53,6.53,0,0,1-.88,3.24,11.49,11.49,0,0,1-1.16,1.66,17.64,17.64,0,0,1-1.72,1.82c.58,0,1.17-.07,1.76-.09s1.2,0,1.82,0Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M921.9,561.82a9.37,9.37,0,0,1-1.34,5.34,4.11,4.11,0,0,1-3.59,2,4.4,4.4,0,0,1-3.82-2,9.69,9.69,0,0,1-1.37-5.55,9.15,9.15,0,0,1,1.37-5.32,4.34,4.34,0,0,1,3.73-2,4.2,4.2,0,0,1,3.69,2A9.85,9.85,0,0,1,921.9,561.82Zm-3.82,0c0-2.77-.42-4.15-1.25-4.15s-1.25,1.24-1.25,3.71c0,3,.41,4.44,1.22,4.44.44,0,.76-.33,1-1A10.69,10.69,0,0,0,918.08,561.79Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M762,362.88h-3.87V351.93h-1.55v-3.37H762Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M775,355.81a9.46,9.46,0,0,1-1.34,5.35,4.11,4.11,0,0,1-3.59,2,4.4,4.4,0,0,1-3.82-2,9.69,9.69,0,0,1-1.37-5.55,9.15,9.15,0,0,1,1.37-5.32,4.34,4.34,0,0,1,3.73-2,4.2,4.2,0,0,1,3.69,2A9.84,9.84,0,0,1,775,355.81Zm-3.82,0c0-2.77-.42-4.15-1.25-4.15s-1.25,1.24-1.25,3.71c0,3,.41,4.44,1.22,4.44.44,0,.76-.33,1-1A11.08,11.08,0,0,0,771.19,355.79Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M908,362.88h-3.87V351.93h-1.55v-3.37H908Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M921,355.81a9.46,9.46,0,0,1-1.34,5.35,4.11,4.11,0,0,1-3.59,2,4.4,4.4,0,0,1-3.82-2,9.69,9.69,0,0,1-1.37-5.55,9.15,9.15,0,0,1,1.37-5.32,4.34,4.34,0,0,1,3.73-2,4.2,4.2,0,0,1,3.69,2A9.84,9.84,0,0,1,921,355.81Zm-3.82,0c0-2.77-.42-4.15-1.25-4.15s-1.25,1.24-1.25,3.71c0,3,.41,4.44,1.22,4.44.44,0,.76-.33,1-1A11.08,11.08,0,0,0,917.19,355.79Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M762,500.88h-3.87V489.93h-1.55v-3.37H762Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M775,493.81a9.46,9.46,0,0,1-1.34,5.35,4.11,4.11,0,0,1-3.59,2,4.4,4.4,0,0,1-3.82-2,9.69,9.69,0,0,1-1.37-5.55,9.15,9.15,0,0,1,1.37-5.32,4.34,4.34,0,0,1,3.73-2,4.2,4.2,0,0,1,3.69,2A9.84,9.84,0,0,1,775,493.81Zm-3.82,0c0-2.77-.42-4.15-1.25-4.15s-1.25,1.24-1.25,3.71c0,3,.41,4.44,1.22,4.44.44,0,.76-.33,1-1A11.08,11.08,0,0,0,771.19,493.79Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M908,500.88h-3.87V489.93h-1.55v-3.37H908Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><path d="M921,493.81a9.46,9.46,0,0,1-1.34,5.35,4.11,4.11,0,0,1-3.59,2,4.4,4.4,0,0,1-3.82-2,9.69,9.69,0,0,1-1.37-5.55,9.15,9.15,0,0,1,1.37-5.32,4.34,4.34,0,0,1,3.73-2,4.2,4.2,0,0,1,3.69,2A9.84,9.84,0,0,1,921,493.81Zm-3.82,0c0-2.77-.42-4.15-1.25-4.15s-1.25,1.24-1.25,3.71c0,3,.41,4.44,1.22,4.44.44,0,.76-.33,1-1A11.08,11.08,0,0,0,917.19,493.79Z" transform="translate(-639.84 -214.64)" style="fill:#fff"/><line x1="143.16" y1="141.42" x2="255.16" y2="140.42" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="226.16" y1="106.42" x2="172.16" y2="106.42" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/></g>
<g id="upperpoint"><path d="M652.33,317.64l23.5,12.5s52-93,163-93,164.5,92.5,164.5,92.5l23-13" transform="translate(-639.84 -214.64)" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="56.49" y1="67" x2="66.51" y2="77.6" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="91.49" y1="23" x2="105.54" y2="47.69" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="130.49" y1="20" x2="134.98" y2="33.74" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="164.49" y1="10" x2="167.12" y2="25.16" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="234.49" y1="10" x2="232.62" y2="25.45" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="269.49" y1="20" x2="263.35" y2="33.74" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="308.49" y1="23" x2="293.08" y2="47.69" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><line x1="342.49" y1="67" x2="332.38" y2="77.33" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><polygon points="189.49 0 208.49 0 199.49 19 189.49 0" style="fill:#fff"/></g>
</g>
<g id="horizontal"><polygon points="128.16 245.36 199.16 212.36 268.16 245.36 198.66 237.86 128.16 245.36" style="fill:#fdfc02"/><polygon points="198.66 225.86 128.66 245.86 198.66 237.86 270.66 245.86 198.66 225.86" style="fill:#6f6734"/><polygon points="399.16 205.36 398.16 210.36 399.16 216.36 331.16 216.36 324.16 210.36 332.16 205.36 399.16 205.36" style="fill:#fdfc02"/><polygon points="398.16 210.36 324.16 210.36 331.16 216.36 399.16 216.36 398.16 210.36" style="fill:#6f6734"/><polygon points="0 204.36 1 209.36 0 215.36 68 215.36 75 209.36 67 204.36 0 204.36" style="fill:#fdfc02"/><polygon points="1 209.36 75 209.36 68 215.36 0 215.36 1 209.36" style="fill:#6f6734"/></g>
<g id="skypoint"><polygon points="209 44.36 190 44.36 199 26.36 209 44.36" style="fill:#fff"/><rect x="190.16" y="47.36" width="18" height="3" style="fill:#fff"/></g></svg>
</div>
<div id="horizontal-back" style="transform: rotate(0deg);"></div>
</div>
</body>
</html>