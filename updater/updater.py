import urllib.request, urllib.parse, urllib.error, json, os, requests, tarfile

#UPDATER ABRE LA CONEXIÓN CON EL SERVIDOR
fhand = urllib.request.urlopen('http://52.170.37.46:8080/repository/release.json')
info = fhand.read().decode()
update = json.loads(info)

#REVISA LA ARQUITECTURA Y VERSIÓN DEL SISTEMA 
setjson = open('/var/www/html/sys/settings.json').read()
sysver = json.loads(setjson)



if sysver[0]['arch'] == 'ARM':
    os.mkdir('tmp')
    url = 'http://52.170.37.46:8080/repository/ARM/' + update[0]['filename']
    intpath = '/var/www/html/updater/tmp/' + update[0]['filename']
    response = requests.get(url)
    if response.ok:
        file = open(intpath, "wb+") # write, binary, allow creation
        file.write(response.content)
        file.close() #SE TERMINA LA DESCARGA DEL ARCHIVO
        filen = "tmp/" + update[0]['filename']
        my_tar = tarfile.open(filen)
        my_tar.extractall('tmp') #SE EXTRAE EL TAR EN LA CARPETA TEMPORAL
        my_tar.close()
    else:
        print("Failed to get the file")