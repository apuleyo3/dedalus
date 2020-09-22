#ARCHIVO PARA ESCANEAR LOS PUERTOS DE LA RED EN BUSCA DE SISTEMAS XPLANE, REGRESA EL NÚMERO DE ELLOS Y SU IP

'''
==================================================================================
CLAVES DE REGRESO DE HOSTS
==================================================================================
E = HOST YA EXISTE EN settings.json
S = HOST NO EXISTE Y SE GUARDÓ EN settings.json
M = MULTIPLES HOSTS GUARDADOS EN settings.json
X = SIN HOSTS EN RED

'''

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
        reshosts.append(iphost)

res = ''

if len(reshosts) < 1:
    res = 'X'
else:
    with open("settings.json", "r+") as jsonFile:
        data = json.load(jsonFile)
        tmp = data[0]["ip"]
        if tmp == '127.0.0.1':
            data[0]["ip"] = iphost
            res = 'S'
        else:
            res = 'E'
        if len(reshosts) > 1:
            idx = 0
            for x in reshosts:
                h = 'ip'
                if idx == 0:
                    data[0]["ip"] = reshosts[idx]
                else:
                    data[0][str(idx)] = reshosts[idx]
                idx += 1
                res = 'M'
        jsonFile.seek(0)  # rewind
        json.dump(data, jsonFile)
        jsonFile.truncate()
res = res + str(len(reshosts))
print(res)
#print('M2') #multiuser test