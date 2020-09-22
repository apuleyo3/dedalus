from ctest.xpresponse import ftest
import json

jsondata = open('settings.json', 'r')
ipdata = json.load(jsondata)
xhost = ipdata[0]["ip"]

res = ftest(xhost)

if res is None:
    print('No response')
else:
    print('connected')