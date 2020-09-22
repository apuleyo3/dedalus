import xpc
from modules.getStatus import getInfo

drefs = ["sim/cockpit/switches/gear_handle_status", "sim/aircraft/parts/acf_gear_deploy"]
values = [0,0]

def gearUp(host):
    with xpc.XPlaneConnect(xpHost=host) as client:
        #val = getInfo(drefs[1], host)
        #if '1' in val:
        client.sendDREF("sim/aircraft/parts/acf_gear_deploy", 0.0)
        #else:
        #   print('Arriba')

def gearDown(host):
    with xpc.XPlaneConnect(xpHost=host) as client:
        #val = getInfo(drefs[1], host)
        #if '1' not in val:
        client.sendDREF("sim/aircraft/parts/acf_gear_deploy", 1.0)
        #else:
        #    print('Abajo') 
