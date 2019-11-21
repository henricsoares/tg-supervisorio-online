import MySQLdb
import serial
import time
import datetime
 

ser = serial.Serial("/dev/ttyS0", 9600)
#Configura o MySQL
db = MySQLdb.connect("localhost", "root","34931123", "rasprush")
curs = db.cursor()
curs.execute('CREATE TABLE IF NOT EXISTS sensores(time text, temp real, lumi real, umi real)')
curs.execute('CREATE TABLE IF NOT EXISTS atuadores(time text, vent text, ilum text, irri text)')

date = str(datetime.datetime.fromtimestamp(int(time.time())).strftime('%Y-%m-%d %H:%M:%S'))

ser.write(b'0')
received = ser.readline()
dado1 = (str(received.decode("utf-8")))
print(dado1)

received = ser.readline()
dado2 = (str(received.decode("utf-8")))
print(dado2)

received = ser.readline()
dado3 = (str(received.decode("utf-8")))
print(dado3)

insere_sql1 = 'INSERT INTO sensores(time, temp, lumi, umi) VALUES (%s,%s,%s,%s)'
dados1 = (date,dado1,dado2,dado3)
curs.execute (insere_sql1,dados1)
db.commit()
