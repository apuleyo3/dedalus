import xpc

def ftest(a, b = "sim/multiplayer/controls/rudder_trim"):
    with xpc.XPlaneConnect(xpHost=a) as client:
        dref = b
        try:
            value = client.getDREF(dref)
            return str(value[0])
        except:
            return None
        

