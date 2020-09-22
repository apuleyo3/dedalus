import xpc
import json
import pyfirmata
import time
from modules.skeleton import getInput, getOutput
from socket import *

#============================================================
#INICIO GENERAL DEL FLIGHT ICARUS SYSTEM
#============================================================

from ctest.xpresponse import ftest

#============================================================
#STATUS GENERAL DEREF
#============================================================

from modules.getStatus import getInfo
from modules.gear import gearUp
from modules.gear import gearDown

#IMPORTA IP DE TRABAJO PARA INICIAR PRUEBAS DE CONEXIÓN

jsondata = open('/var/www/html/sys/settings.json', 'r')
ipdata = json.load(jsondata)
xhost = ipdata[0]["ip"]

#VARIABLES GENERALES DE SISTEMA
#init = ftest(xhost) #PRUEBA GENERAL DE CONEXIÓN CON XPLANE

#ESCANEO DE PUERTOS ABIERTOS

b0 = pyfirmata.ArduinoMega('/dev/ttyACM0') #Linux
#b0 = pyfirmata.ArduinoMega('/dev/ttyS0') #Linux en VM
#b0 = pyfirmata.ArduinoMega('COM3') #WINDOWS
it = pyfirmata.util.Iterator(b0)
it.start()

#Se inician los puertos del starter module

xpout = list(range(2, 12))
xpin = list(range(15, 49))
refout = getOutput()
refin = getInput()


for pt in xpout:
    b0.digital[pt].mode = pyfirmata.OUTPUT

for pt in xpin:
    b0.digital[pt].mode = pyfirmata.INPUT

#PUERTOS DE TEST POR DEFAULT

b0.digital[8].mode = pyfirmata.INPUT 
b0.digital[9].mode = pyfirmata.INPUT


while True:
    #================================================
    #OUTPUTS
    #================================================

    try:
        #===========================================
        #LANDING GEAR DEPLOY READING
        #===========================================
        ldwarning = getInfo(refout['gearUnsafe'], xhost)
        ldeploy = getInfo(refout['gearDeployRatio'], xhost)

        gr0 = b0.digital[8].read()
        gr1 = b0.digital[9].read()

        #if gr0 == True:
        #    gearUp(xhost)
        #    print(gr0)
        #if gr1 == True:
        #    gearDown(xhost)
        #    print(gr1)

        if ldwarning == 0 and ldeploy == 1:
            b0.digital[2].write(0)
            b0.digital[3].write(1)
            if gr0 == True:
                gearUp(xhost)
        elif ldwarning == 1 and ldeploy == 1:
            b0.digital[2].write(1)
            b0.digital[3].write(0)
        elif ldwarning == 1 and ldeploy == 0:
            b0.digital[2].write(1)
            b0.digital[3].write(0)
        else:
            if gr1 == True:
                gearDown(xhost)
            b0.digital[2].write(0)
            b0.digital[3].write(0)

        #b0.digital[2].write(getInfo(refin[0], xhost))
        #print('deploy_ratio', getInfo(refin[1], xhost))
        #b0.digital[3].write(getInfo(refin[1], xhost))

    except timeout:
        b0.digital[2].write(0)
        b0.digital[3].write(0)
        continue

    #================================================
    #INPUTS
    #================================================
    #LANDING GEAR
    #gr0 = b0.digital[15].read()
    #gr1 = b0.digital[16].read()

    #BATTERY
    #bt0 = b0.digital[17]

    time.sleep(0.05)
