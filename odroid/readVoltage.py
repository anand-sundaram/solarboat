#!/usr/bin/env python

import os, subprocess, sqlite3, datetime

output = subprocess.check_output("cat /sys/class/saradc/saradc_ch1", shell=True)

reading = int(output.strip())
print reading

voltage = int(100*(reading*0.0882 - 0.014)) / 100.0

print voltage

conn = sqlite3.connect('/bobodata/database.txt')

c = conn.cursor()

date = datetime.datetime.now()
year = date.year
month = date.month
tableName = "y" + str(year) + "m" + str(month)

time = date.strftime("%Y-%m-%d %H:%M:%S")

print time

# Create table
c.execute("CREATE TABLE IF NOT EXISTS "+tableName+"Voltage (time time, battery_voltage integer)")

c.execute("INSERT INTO "+tableName+"Voltage VALUES('"+time+"', '"+str(voltage)+"')")

conn.commit()


conn.close()
