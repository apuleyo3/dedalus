import xpc
import sys
import json
  
with open("/var/www/html/sys/settings.json", "r+") as jsonFile:
    data = json.load(jsonFile)
    host = data[0]["ip"]

with xpc.XPlaneConnect(xpHost=host) as client:
    drefs = ["sim/cockpit2/gauges/indicators/pitch_electric_deg_pilot", "sim/cockpit2/gauges/indicators/roll_electric_deg_pilot"]
    try:
        value = client.getDREFs(drefs)
        print(str(value))
    except:
        print(None)