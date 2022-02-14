from multiprocessing import Pool
from difflib import SequenceMatcher
import os
import mysql.connector
from datetime import datetime
from pathlib import Path #Trabajar con archivos
import shutil #Trabajar con archivos
import csv #Para trabajar archivos csv
import numpy as np #Convertir a Array
import inflect #Trabajar entre plural y singular

p = inflect.engine()

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database='integracion'
)

now = datetime.now() # current date and time
cursor = mydb.cursor(dictionary=True)
pathFile = "C:/home/usu_riesgos/sidif/load_excel.csv"
path = Path(pathFile)

def main():
    # Validar existencia archivo
    if path.is_file():
        file = open(pathFile, newline='') #Abrir archivo
        cant = len(file.readlines()) #Contar filas
        # Validar que haya más de 1 fila en el archivo
        if file and cant>1:
            pathFileOpt = (pathFile.replace(".csv", "__"+now.strftime("%Y_%m_%d")+".csv")).replace("C:/home/usu_riesgos/", "")
            id = saveFile(pathFileOpt, cant)
            pathFileOpt = "C:/xampp/htdocs/integracion/storage/app/integracion/risk/"+pathFileOpt
            shutil.copy(pathFile, pathFileOpt) # Copiar archivo
            # Recorrer archivo
            with open(pathFile, newline='') as file:
                saveData(csv.reader(file), id, cant) #Leer archivo
        else:
            print(f'El archivo {pathFile} esta vacío')
    else:
        cursorTemp = cursor
        pathFileOpt = (pathFile.replace(".csv", "")).replace("C:/home/usu_riesgos/", "")
        query = "SELECT * FROM processes WHERE file LIKE '%"+pathFileOpt+"%' ORDER BY id DESC LIMIT 1" # Obtiene el ultimo registro cargado
        cursorTemp.execute(query)
        data = cursorTemp.fetchall()
        del cursorTemp
        if data and data[0] and data[0]['file']:
            pathFileOpt = "C:/xampp/htdocs/integracion/storage/app/integracion/risk/"+data[0]['file']
            pathOpt = Path(pathFileOpt)
            if pathOpt.is_file():
                cant = data[0]['rows'] #Contar filas
                file = open(pathFileOpt, newline='') #Abrir archivo
                saveData(csv.reader(file), data[0]['id'], cant) #Leer archivo
        else:
            print(f'Sin data para guardar')

# Guardar data general archivo
def saveFile(file, cant):
    query = "INSERT INTO `processes` (`file`, `rows`) VALUE (%s, %s)"
    cursor.execute(query, (file, cant))
    mydb.commit()
    return cursor.lastrowid

# Guardar data registros archivo
def saveData(reader, id, cant):
    cont = 1
    models = {1: "Person", 2: "Company"} # Funciones
    avanceTemp = 0
    # Recorre filas
    for row in reader:
        if cont>2:
            avance = round((cont*100)/cant, 0) # Porcentaje del proceso realizado
            data = ""
            # Une todos los registros de la fila en 1 solo
            for dataRow in row:
                data = data+dataRow
            info = replaceSymbols(data).split(';') # Quitar caracteres y obtiene cada dato por separado
            arrayData = {}
            key = 0
            # Separar cada dato en una llave del array
            for dato in info:
                arrayData[key] = dato
                key += 1
            arrayData['id'] = id
            arrayData['fila'] = cont
            # Recorrer los tipos de almacenamiento
            for model in models:
                arrayData['model'] = model
                arrayData['clase'] = models[model]
                # Cruce por id
                if arrayData[10] and arrayData[10].replace(" ", "")!="":
                    arrayData[10] = arrayData[10].replace(" ", "")
                    dataTemp = getCoincidence(models[model], arrayData[10])
                    addCross(dataTemp, arrayData, 1, "")
                # Cruce por nombre
                if arrayData[3] and arrayData[3].replace(" ", "")!="":
                    dataTemp = getCoincidence(models[model], "", arrayData[3])
                    addCross(dataTemp, arrayData, 2, "")
            del arrayData
            if ((avance%4)==0 and avance!=avanceTemp):
                avanceTemp = avance
                print(f' {avance} % ...') # Se usa la f en el print para admitir las variables
        cont += 1 # Fila
    return id

def replaceSymbols(string):
    # En caso de agregar otros caracteres como espacio o simbolos (/*-+) usar variable tipo para adicionar al array sin afectar los originales
    no_permitidas = {0: "_", 1: "-", 2: "'", 3: "\\", 4: "/", 5: "\"", 6: "´", 7: "‘", 8: "¨"}
    permitidas = {0: "", 1: "", 2: "", 3: "", 4: "", 5: "", 6: "", 7: "", 8: ""}
    no_permitidas = np.array(list(no_permitidas.items()))
    for key, characters in no_permitidas:
        string = string.replace(characters, permitidas[int(key)])
    return string

# Obtener coincidencia según modelo
def getCoincidence(modelo, identification, nombre = ""):
    cursorTemp = cursor
    # p.singular_noun('people')
    if (modelo[len(modelo)-1])=="y":
        modelo = modelo[:-1]+"ie"
    modelo = (p.plural(modelo)).lower()
    query = "SELECT DISTINCT * FROM "+modelo+" WHERE "
    if nombre!="":
        query = query+"MATCH(name) AGAINST('"+replaceSymbols(nombre)+"' IN BOOLEAN MODE) > 0"
    else:
        query = query+"identification = '"+identification+"'"
    cursorTemp.execute(query)
    data = cursorTemp.fetchall()
    del cursorTemp
    return data

def addCross(dataTemp, data, type, fp, topPercent = 95):
    if len(dataTemp)>0:
        dataTemp = (np.array(dataTemp))
        if dataTemp[0] and dataTemp[0]['id']:
            for dataCross in dataTemp:
                if type==2:
                    # No se valida la llave del porcentaje que viene por data ya que como recorre todas las coincidencias necesita volver a hacer el cruce para asegurar la coincidencia
                    s = SequenceMatcher(None, dataCross['name'].upper(), data[3].upper())
                    percent = s.ratio()*100
                else:
                    percent = 100
                if dataCross['id'] and int(dataCross['id'])>0 and percent>=topPercent:
                    data['name'] = data[3]
                    data['identification'] = data[10]
                    data['comment'] = data[11]
                    data['country'] = data[18]
                    if 'porcentage' in data:
                        data['porcentage']
                    else:
                        data['porcentage'] = None
                    if data['porcentage'] is None:
                        data['porcentage'] = percent
                    # Guarda el $class según corresponda
                    if data['model']==1:
                        if data[5] and data[5].replace(" ", "")!="":
                            data['firstname'] = data[4]+" "+data[5]
                        else:
                            data['firstname'] = data[4]
                        if data[7] and data[7].replace(" ", "")!="":
                            data['lastname'] = data[6]+" "+data[7]
                        else:
                            data['lastname'] = data[6]
                        addCrossPerson(data, dataCross['id'], type)
                    elif data['model']==2:
                        addCrossCompany(data, dataCross['id'], type)
                    del data['porcentage']
    return dataTemp

def addCrossPerson(data, id, type):
    cursorTemp = cursor
    dataSave = (id, data['id'], data['comment'], data['fila'])
    if type==2:
        personCross = "cross_name_people"
        addSql1 = ", `porcentage`, `people_name`, `people_lastname`, `people_firstname`"
        addSql2 = ", %s, %s, %s, %s"
        dataSave += (data['porcentage'], data['name'], data['lastname'], data['firstname'])
    else:
        personCross = "cross_id_people"
        addSql1 = ""
        addSql2 = ""
    # Guardar el comentario
    query = "INSERT INTO `"+personCross+"` (`people_id`, `processes_id`, `comment`, `row_file`"+addSql1+") VALUE (%s, %s, %s, %s"+addSql2+")"
    cursorTemp.execute(query, dataSave)
    mydb.commit()
    if cursorTemp.lastrowid:
        txt = "Se guarda comentario"
    else:
        txt = "Error al guardar comentario"
    del cursorTemp
    return txt

def addCrossCompany(data, id, type):
    cursorTemp = cursor
    dataSave = (id, data['id'], data['comment'], data['fila'])
    if type==2:
        companyCross = "cross_name_companies"
        addSql1 = ", `porcentage`, `companies_name`"
        addSql2 = ", %s, %s"
        dataSave += (data['porcentage'], data['name'])
    else:
        companyCross = "cross_id_companies"
        addSql1 = ""
        addSql2 = ""
    # Guardar el comentario
    query = "INSERT INTO `"+companyCross+"` (`companies_id`, `processes_id`, `comment`, `row_file`"+addSql1+") VALUE (%s, %s, %s, %s"+addSql2+")"
    cursorTemp.execute(query, dataSave)
    mydb.commit()
    if cursorTemp.lastrowid:
        txt = "Se guarda comentario"
    else:
        txt = "Error al guardar comentario"
    del cursorTemp
    return txt

print('Inicio recorrido archivo listas Sidif '+(datetime.now()).strftime("%H:%M:%S"))
if __name__=="__main__":
    main()
print('Fin recorrido archivo listas Sidif '+(datetime.now()).strftime("%H:%M:%S"))
