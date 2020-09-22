import xpc

def getInfo(dref, host):
    with xpc.XPlaneConnect(xpHost=host) as client:
        value = client.getDREF(dref)
        #return value
        if '1' in str(value[0]):
           return 1
        else:
           return 0