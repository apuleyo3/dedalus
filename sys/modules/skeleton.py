import json

def getOutput(name="key", elem="dref"):
    with open("/var/www/html/sys/modules/outputs.json", "r+") as jsonFile:
        data = json.load(jsonFile)
        out = dict()
        for line in data:
            out.update( {line[name] : line[elem]} )
        return out

def getInput(name="key", elem="dref"):
    with open("/var/www/html/sys/modules/inputs.json", "r+") as jsonFile:
        data = json.load(jsonFile)
        inp = dict()
        for line in data:
            inp.update( {line[name] : line[elem]} )
        return inp

#print(getInput())
#print(skl) 