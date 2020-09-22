#ARCHIVO PARA ESCANEAR LOS PUERTOS DE LA RED EN BUSCA DE SISTEMAS XPLANE, REGRESA EL NÚMERO DE ELLOS Y SU IP

# importing libraries 
import subprocess 
import os
import json
from ctest.xpresponse import ftest

test = subprocess.Popen(['hostname', '-I'], stdout = subprocess.PIPE)
stdout = test.communicate()[0]
dhcp = stdout.decode()
dhcp = dhcp.strip()
dhcp = dhcp.split('.')
dhcp = dhcp[:-1]

num = dhcp[0] + '.' + dhcp[1] + '.' + dhcp[2]
netRange = list(range(1, 255))
reshosts = list()

for x in netRange:
    iphost = num + '.' + str(x)
    res = ftest(iphost)
    if res is None:
        continue
    else:
        reshosts.append(x)
        print('response from', iphost)

if len(reshosts) < 1:
    print('No hosts with xplane')
else:
    with open("settings.json", "r+") as jsonFile:
        data = json.load(jsonFile)
        tmp = data[0]["ip"]
        if tmp == '127.0.0.1':
            print('it is!')
            data[0]["ip"] = iphost
            jsonFile.seek(0)  # rewind
            json.dump(data, jsonFile)
            jsonFile.truncate()

    print(data[0]["ip"])