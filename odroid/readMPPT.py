import serial, requests
from datetime import datetime

import sqlite3

conn = sqlite3.connect('/bobodata/database.txt')
c = conn.cursor()

ser = serial.Serial('/dev/ttyUSB2', 19200, timeout=100)

flag = True

while flag == True:
  line = ser.readline()
  print(line)
  
  if line[:3] == "PID":
    line1 = ser.readline()
    print(line1)
    line2 = ser.readline()
    print(line2)
    line3 = ser.readline()
    print(line3)
    batteryVoltage = line3[2:].strip()
    line4 = ser.readline()
    print(line4)
    batteryCurrent = line4[2:].strip()
    line5 = ser.readline()
    print(line5)
    panelVoltage = line5[4:].strip()
    line6 = ser.readline()
    print(line6)
    panelPower = line6[4:].strip()

    date = datetime.now()
    year = date.year
    month = date.month
    tableName = "y" + str(year) + "m" + str(month)

    c.execute("create table if not exists "+tableName+"MPPT (time datetime, panel_voltage integer, panel_power integer, battery_voltage integer, battery_current integer)")

    time = date.strftime("%Y-%m-%d %H:%M:%S")
    c.execute("INSERT INTO "+tableName+"MPPT VALUES ('"+time+"','"+panelVoltage+"','"+panelPower+"','"+batteryVoltage+"','"+batteryCurrent+"')")
    conn.commit()   
    flag = False
    


ser.close()
